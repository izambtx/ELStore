<?php

namespace App\Controllers;

use App\Controllers;
use Config\Services;
use Myth\Auth\Entities\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\UsersModel;
use App\Models\BookingModel;
use App\Models\CartModel;
use App\Models\DetailTransaksiModel;
use App\Models\ProdukModel;
use App\Models\KategoriModel;

class Users extends BaseController
{
    protected $db, $builder, $usersModel, $email;
    protected $bookingModel;
    protected $cartModel;
    protected $detailTransaksiModel;
    protected $produkModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->email = \Config\Services::email();
        $this->builder = $this->db->table('users');
        $this->usersModel = new UsersModel();
        $this->cartModel = new CartModel();
        $this->detailTransaksiModel = new DetailTransaksiModel();
        $this->bookingModel = new BookingModel();
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function index($id = false)
    {

        $users = $this->request->getVar('users');
        $kategori = $this->request->getVar('kategori');
        $produk = $this->request->getVar('produk');
        $makeup = $this->request->getVar('makeup');
        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');
        $month2 = $this->request->getVar('month2');
        $year2 = $this->request->getVar('year2');
        $data = [
            'title' => 'Dashboard',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'usersNama' => $this->usersModel->getUsers($users),
            'usersList' => $this->usersModel->getUsers(),
            'users' => $users,
            'kategoriNama' => $this->kategoriModel->getKategori($kategori),
            'kategoriList' => $this->kategoriModel->getKategori(),
            'kategori' => $kategori,
            'month' => $month,
            'year' => $year,
            'month2' => $month2,
            'year2' => $year2,
            'produkNama' => $this->produkModel->getBeautyProduct($produk),
            'produkList' => $this->produkModel->getBeautyProduct(),
            'produk' => $produk,
            'makeupNama' => $this->produkModel->getMakeup($makeup),
            'makeupList' => $this->produkModel->getMakeup(),
            'makeup' => $makeup,
        ];

        // dd($produk);
        if ($produk && $month && $year) {
            $data['countMB'] = $this->detailTransaksiModel->getCountMonthlyProduk($month, $year, $produk);
            $data['countMF'] = $this->detailTransaksiModel->getCountMonthlyProduk($month, $year, $produk);
            $data['countMU'] = $this->detailTransaksiModel->getCountMonthlyProduk($month, $year, $produk);
            $data['countML'] = $this->detailTransaksiModel->getCountMonthlyProduk($month, $year, $produk);
            $data['countTMB'] = $this->detailTransaksiModel->getTotalMonthlyProduk($month, $year, $produk);
            $data['countTMF'] = $this->detailTransaksiModel->getTotalMonthlyProduk($month, $year, $produk);
            $data['countTMU'] = $this->detailTransaksiModel->getTotalMonthlyProduk($month, $year, $produk);
            $data['countTML'] = $this->detailTransaksiModel->getTotalMonthlyProduk($month, $year, $produk);
            $data['countTB'] = $this->detailTransaksiModel->getTotalProduk($month, $year, $produk);
            $data['countTF'] = $this->detailTransaksiModel->getTotalProduk($month, $year, $produk);
            $data['countTU'] = $this->detailTransaksiModel->getTotalProduk($month, $year, $produk);
            $data['countTL'] = $this->detailTransaksiModel->getTotalProduk($month, $year, $produk);
        } elseif ($users && $month && $year) {
            $data['countMB'] = $this->detailTransaksiModel->getCountUsers($year, $month, $users);
            $data['countMF'] = $this->detailTransaksiModel->getCountUsers($year, $month, $users);
            $data['countMU'] = $this->detailTransaksiModel->getCountUsers($year, $month, $users);
            $data['countML'] = $this->detailTransaksiModel->getCountUsers($year, $month, $users);
            $data['countTMB'] = $this->detailTransaksiModel->getTotalMonthlyUsers($year, $month, $users);
            $data['countTMF'] = $this->detailTransaksiModel->getTotalMonthlyUsers($year, $month, $users);
            $data['countTMU'] = $this->detailTransaksiModel->getTotalMonthlyUsers($year, $month, $users);
            $data['countTML'] = $this->detailTransaksiModel->getTotalMonthlyUsers($year, $month, $users);
            $data['countTB'] = $this->detailTransaksiModel->getTotalUsers($year, $month, $users);
            $data['countTF'] = $this->detailTransaksiModel->getTotalUsers($year, $month, $users);
            $data['countTU'] = $this->detailTransaksiModel->getTotalUsers($year, $month, $users);
            $data['countTL'] = $this->detailTransaksiModel->getTotalUsers($year, $month, $users);
        } elseif ($month && $year && $makeup) {
            $data['countMB'] = $this->detailTransaksiModel->getCountMonthlyMakeup($month, $year, $makeup);
            $data['countMF'] = $this->detailTransaksiModel->getCountMonthlyMakeup($month, $year, $makeup);
            $data['countMU'] = $this->detailTransaksiModel->getCountMonthlyMakeup($month, $year, $makeup);
            $data['countML'] = $this->detailTransaksiModel->getCountMonthlyMakeup($month, $year, $makeup);
            $data['countTMB'] = $this->detailTransaksiModel->getTotalMonthlyMakeup($month, $year, $makeup);
            $data['countTMF'] = $this->detailTransaksiModel->getTotalMonthlyMakeup($month, $year, $makeup);
            $data['countTMU'] = $this->detailTransaksiModel->getTotalMonthlyMakeup($month, $year, $makeup);
            $data['countTML'] = $this->detailTransaksiModel->getTotalMonthlyMakeup($month, $year, $makeup);
            $data['countTB'] = $this->detailTransaksiModel->getTotalMakeup($month, $year, $makeup);
            $data['countTF'] = $this->detailTransaksiModel->getTotalMakeup($month, $year, $makeup);
            $data['countTU'] = $this->detailTransaksiModel->getTotalMakeup($month, $year, $makeup);
            $data['countTL'] = $this->detailTransaksiModel->getTotalMakeup($month, $year, $makeup);
        } elseif ($month && $year && $kategori) {
            $data['countMB'] = $this->detailTransaksiModel->getCountYearMonthKategori($year, $month, $kategori);
            $data['countMF'] = $this->detailTransaksiModel->getCountYearMonthKategori($year, $month, $kategori);
            $data['countMU'] = $this->detailTransaksiModel->getCountYearMonthKategori($year, $month, $kategori);
            $data['countML'] = $this->detailTransaksiModel->getCountYearMonthKategori($year, $month, $kategori);
            $data['countTMB'] = $this->detailTransaksiModel->getTotalYearMonthKategori($year, $month, $kategori);
            $data['countTMF'] = $this->detailTransaksiModel->getTotalYearMonthKategori($year, $month, $kategori);
            $data['countTMU'] = $this->detailTransaksiModel->getTotalYearMonthKategori($year, $month, $kategori);
            $data['countTML'] = $this->detailTransaksiModel->getTotalYearMonthKategori($year, $month, $kategori);
            $data['countTB'] = $this->detailTransaksiModel->getTotalMonthYearKategori($year, $month, $kategori);
            $data['countTF'] = $this->detailTransaksiModel->getTotalMonthYearKategori($year, $month, $kategori);
            $data['countTU'] = $this->detailTransaksiModel->getTotalMonthYearKategori($year, $month, $kategori);
            $data['countTL'] = $this->detailTransaksiModel->getTotalMonthYearKategori($year, $month, $kategori);
        } elseif ($month && $year) {
            $data['countMB'] = $this->detailTransaksiModel->getCountYearMonth($year, $month);
            $data['countMF'] = $this->detailTransaksiModel->getCountYearMonth($year, $month);
            $data['countMU'] = $this->detailTransaksiModel->getCountYearMonth($year, $month);
            $data['countML'] = $this->detailTransaksiModel->getCountYearMonth($year, $month);
            $data['countTMB'] = $this->detailTransaksiModel->getTotalYearMonth($year, $month);
            $data['countTMF'] = $this->detailTransaksiModel->getTotalYearMonth($year, $month);
            $data['countTMU'] = $this->detailTransaksiModel->getTotalYearMonth($year, $month);
            $data['countTML'] = $this->detailTransaksiModel->getTotalYearMonth($year, $month);
            $data['countTB'] = $this->detailTransaksiModel->getTotalMonthYear($year, $month);
            $data['countTF'] = $this->detailTransaksiModel->getTotalMonthYear($year, $month);
            $data['countTU'] = $this->detailTransaksiModel->getTotalMonthYear($year, $month);
            $data['countTL'] = $this->detailTransaksiModel->getTotalMonthYear($year, $month);
        } elseif ($month2 && $year2) {
            $data['countMB'] = $this->bookingModel->getCountYearMonth2($year2, $month2);
            $data['countMF'] = $this->bookingModel->getCountYearMonth2($year2, $month2);
            $data['countMU'] = $this->bookingModel->getCountYearMonth2($year2, $month2);
            $data['countML'] = $this->bookingModel->getCountYearMonth2($year2, $month2);
            $data['countTMB'] = $this->bookingModel->getTotalYearMonth2($year2, $month2);
            $data['countTMF'] = $this->bookingModel->getTotalYearMonth2($year2, $month2);
            $data['countTMU'] = $this->bookingModel->getTotalYearMonth2($year2, $month2);
            $data['countTML'] = $this->bookingModel->getTotalYearMonth2($year2, $month2);
            $data['countTB'] = $this->bookingModel->getTotalMonthYear2($year2, $month2);
            $data['countTF'] = $this->bookingModel->getTotalMonthYear2($year2, $month2);
            $data['countTU'] = $this->bookingModel->getTotalMonthYear2($year2, $month2);
            $data['countTL'] = $this->bookingModel->getTotalMonthYear2($year2, $month2);
        } else {
            $data['countMB'] = 0;
            $data['countMF'] = 0;
            $data['countMU'] = 0;
            $data['countML'] = 0;
            $data['countTMB'] = 0;
            $data['countTMF'] = 0;
            $data['countTMU'] = 0;
            $data['countTML'] = 0;
            $data['countTB'] = 0;
            $data['countTF'] = 0;
            $data['countTU'] = 0;
            $data['countTL'] = 0;
        }

        return view('dashboard', $data);
    }

    public function view_profile()
    {
        $users = $this->usersModel->findAll();

        $data = [
            'title' => 'View My Profile',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'users' => $users
        ];

        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $data['users'] = $query->getResult();

        return view('user/index', $data);
    }

    public function changePassword()
    {
        $id = user_id();
        $data = [
            'password' => $this->usersModel->getUsers($id),
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'title' => 'Change User Password'
        ];
        return view('admin/ubahPassword', $data);
    }

    public function updatePassword()
    {

        //Rules for the update password form
        $rules = [
            'old-password' => [
                // 'rules'  => 'required|checkOldPasswords',
                'rules'  => 'required',
                'errors' => [
                    // 'checkOldPasswords' => 'Password Lama Tidak Sesuai',
                    'required' => 'Password Lama Harus Diisi',
                ]
            ],
            'new-password' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password Baru Harus Diisi',

                ]
            ],
            'password' => [
                'rules'  => 'required|matches[new-password]',
                'errors' => [
                    'required' => 'Konfirmasi Password Baru Harus Diisi',
                    'matches' => 'Password Tidak Sesuai Dengan Password Baru'
                ]
            ],
        ];

        if ($this->request->getMethod() === 'post' && $this->validate($rules)) {

            //Create new instance of the MythAuth UserModel
            $users = model(UserModel::class);

            //Get the id of the current user
            $user_id = user_id();

            //Create new user entity
            $entity = new User();

            //Get current password from input field
            $newPassword = $this->request->getVar('password');

            //Hash password using the "setPassword" function of the User entity
            $entity->setPassword($newPassword);

            //Save the hashed password in the variable "hash"
            $hash  = $entity->password_hash;

            //update the current users password_hash in the database with the new hashed password.
            $users->update($user_id, ['password_hash' => $hash]);

            //Return back with success message
            return redirect()->to('/change-password')->with('pesan', "Password Has Been Updated");
        } else {
            $validation = $this->validator->listErrors();
            //Return with errors
            return redirect()->to('/change-password')->withInput()->with('validation', $validation);
        }
    }

    public function editEmail()
    {
        $id = user_id();
        $data = [
            'password' => $this->usersModel->getUsers($id),
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'title' => 'Update User Profile'
        ];
        if ($id != null) {
            $query = $this->db->table('users')->getWhere(['id' => $id]);

            if ($query->resultID->num_rows > 0) {

                $data['user'] = $query->getRow();

                return view('admin/edit', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function updateEmail($id)
    {
        $this->usersModel->save([
            'id' => $id,
            'NIK' => $this->request->getVar('NIK'),
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'email' => $this->request->getVar('email'),
            'alamat' => $this->request->getVar('alamat'),
            'noHP' => $this->request->getVar('noHP')
        ]);
        return redirect()->to('/change-profile')->with('pesan', 'Data Has Been Updated');
    }

    public function sendEmail()
    {
    }
}
