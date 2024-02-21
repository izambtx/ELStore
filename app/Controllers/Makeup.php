<?php

namespace App\Controllers;

use App\Controllers;
use Config\Services;
use Myth\Auth\Entities\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\MakeupModel;
use App\Models\CartModel;
use App\Models\UsersModel;
use App\Models\FotoCSRModel;


class Makeup extends BaseController
{
    protected $db, $builder, $usersModel;
    protected $kategoriModel;
    protected $makeupModel;
    protected $cartModel;
    protected $fotocartModel;
    protected $statusModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('produk');
        $this->makeupModel = new MakeupModel();
        $this->cartModel = new CartModel();
        $this->usersModel = new UsersModel();
        $this->fotocartModel = new FotoCSRModel();
    }

    public function index($id = false)
    {


        $page = 1;

        if ($this->request->getGet()) {
            $page = $this->request->getGet('page');
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $perPage = 15;

        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        $keyword = $this->request->getVar('keyword');
        $waktu = $this->request->getVar('waktu');
        $bagian = $this->request->getVar('bagian');

        if ($keyword) {

            $this->builder->select('produk.*, bagian.nama_bagian, users.username');
            $this->builder->join('bagian', 'bagian.id = produk.bagian');
            $this->builder->join('users', 'users.id = produk.pembuat');
            $this->builder->where('pembuat', user()->id);
            $status = ['Created', 'Updated'];
            $this->builder->whereIn('produk.status', $status);
            $this->builder->like('produk.tema', $keyword);
            $this->builder->orderBy('produk.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('produk.*, bagian.nama_bagian, users.username');
            $this->builder->join('bagian', 'bagian.id = produk.bagian');
            $this->builder->join('users', 'users.id = produk.pembuat');
            $this->builder->where('pembuat', user()->id);
            $status = ['Created', 'Updated'];
            $this->builder->whereIn('produk.status', $status);
            $this->builder->like('produk.tema', $keyword);
            $this->builder->orderBy('produk.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } else {

            $this->builder->select('produk.*');
            $this->builder->orderBy('produk.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('produk.*');
            $this->builder->orderBy('produk.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        }

        $data = [
            'title' => 'List History Rental Makeup Services',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'offset' => $offset,
            'currentPage' => $currentPage
        ];

        $data['makeup'] = $query->getResultArray();

        return view('/Makeup/Creator/List/ListHistoryMakeup', $data);
    }

    public function custom($id = false)
    {

        $data = [
            'title' => 'List History Makeup Appointment'
        ];

        return view('/Makeup/Creator/Input/CustomMakeup', $data);
    }

    public function create($id = false)
    {
        $data = [
            'title' => 'try our makeup services',
            // 'inputFoto' => $this->request->getVar('jumlahFoto'),
            // 'countCsrNo' => $this->cartModel->getCsrNo(),
            'wedding' => $this->makeupModel->getWedding(),
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'graduation' => $this->makeupModel->getGraduation()
        ];

        return view('/Makeup/Creator/Input/ListMakeup', $data);
    }

    public function save($id = false)
    {

        // VALIDASI INPUT

        $this->cartModel->save([
            // 'id_kategori' => 1,
            'id_produk' => $this->request->getVar('id_paket'),
            'pembuat' => user_id()
        ]);

        return redirect()->to('/Konfirmasi/' . $id)->with('pesan', 'Makeup Berhasil Ditambahkan');
    }
}
