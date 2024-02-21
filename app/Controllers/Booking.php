<?php

namespace App\Controllers;

use App\Controllers;
use Config\Services;
use Myth\Auth\Entities\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\LayananModel;
use App\Models\BookingModel;
use App\Models\StatusModel;
use App\Models\CartModel;
use App\Models\AktifasiModel;
use App\Models\UsersModel;
use App\Models\ExtendModel;
use App\Models\FotoCSRModel;


class Booking extends BaseController
{
    protected $db, $builder, $usersModel;
    protected $kategoriModel;
    protected $layananModel;
    protected $cartModel;
    protected $bookingModel;
    protected $fotobookingModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('booking');
        $this->layananModel = new LayananModel();
        $this->bookingModel = new BookingModel();
        $this->cartModel = new CartModel();
        $this->usersModel = new UsersModel();
        $this->fotobookingModel = new FotoCSRModel();
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
        $page = 1;

        if ($this->request->getGet()) {
            $page = $this->request->getGet('page');
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $perPage = 15;

        $limit = $perPage;
        $offset = ($page - 1) * $perPage;


        $keyword = $this->request->getVar('keyword');

        if ($keyword) {

            $this->builder->select('booking.*,layanan.nama_layanan');
            $this->builder->join('layanan', 'layanan.id = booking.id_layanan1');
            $this->builder->like('booking.jadwal_booking', $keyword);
            $this->builder->orderBy('booking.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('booking.*,layanan.nama_layanan');
            $this->builder->join('layanan', 'layanan.id = booking.id_layanan2');
            $this->builder->like('booking.jadwal_booking', $keyword);
            $this->builder->orderBy('booking.created_at', 'DESC');
            $query2 = $this->builder->get($limit, $offset);

            $this->builder->select('booking.*,layanan.nama_layanan');
            $this->builder->join('layanan', 'layanan.id = booking.id_layanan3');
            $this->builder->like('booking.jadwal_booking', $keyword);
            $this->builder->orderBy('booking.created_at', 'DESC');
            $query3 = $this->builder->get($limit, $offset);

            $this->builder->select('booking.*,layanan.nama_layanan');
            $this->builder->join('layanan', 'layanan.id = booking.id_layanan1');
            $this->builder->like('booking.jadwal_booking', $keyword);
            $this->builder->orderBy('booking.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } else {

            $this->builder->select('booking.*,layanan.nama_layanan');
            $this->builder->join('layanan', 'layanan.id = booking.id_layanan1');
            $this->builder->where('booking.pembuat', user_id());
            $this->builder->orderBy('booking.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('booking.*,layanan.nama_layanan');
            $this->builder->join('layanan', 'layanan.id = booking.id_layanan2');
            $this->builder->where('booking.pembuat', user_id());
            $this->builder->orderBy('booking.created_at', 'DESC');
            $query2 = $this->builder->get($limit, $offset);

            $this->builder->select('booking.*,layanan.nama_layanan');
            $this->builder->join('layanan', 'layanan.id = booking.id_layanan3');
            $this->builder->where('booking.pembuat', user_id());
            $this->builder->orderBy('booking.created_at', 'DESC');
            $query3 = $this->builder->get($limit, $offset);

            $this->builder->select('booking.*,layanan.nama_layanan');
            $this->builder->join('layanan', 'layanan.id = booking.id_layanan1');
            $this->builder->where('booking.pembuat', user_id());
            $this->builder->orderBy('booking.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        }

        $data = [
            'title' => 'List History Booking',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'offset' => $offset,
            'currentPage' => $currentPage,
            'selectedTanggal' => $keyword
        ];

        $data['booking'] = $query->getResultArray();
        $data['booking2'] = $query2->getResultArray();
        $data['booking3'] = $query3->getResultArray();

        return view('/Booking/Creator/List/ListHistoryBooking', $data);
    }

    public function create($id = false)
    {
        $data = [
            'title' => 'BOOK US',
            // 'inputFoto' => $this->request->getVar('jumlahFoto'),
            // 'countCsrNo' => $this->bookingModel->getCsrNo(),
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'petugas' => $this->usersModel->getPetugas(),
            'layanan' => $this->layananModel->getLayanan()
        ];

        return view('/Booking/Creator/Input/CreateBooking', $data);
    }

    public function save($id = false)
    {

        // VALIDASI INPUT
        if (!$this->validate([
            'tanggal' => [
                'rules' => 'required|is_unique[booking.jadwal_booking]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi atas {field} pembookingannya terlebih dahulu.'
                ]
            ],
            'layanan1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Layanan belum dipilih.'
                ]
            ],
            'petugas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Petugas belum dipilih.'
                ]
            ]
        ])) {
            $validation = $this->validator->getErrors();
            return redirect()->to('/Form-Create-Booking/' . $id)->withInput()->with('validation', $validation);
        }

        $this->bookingModel->save([
            // 'id_kategori' => 1,
            'pembuat' => user_id(),
            'atas_nama' => $this->request->getVar('nama'),
            'id_layanan1' => $this->request->getVar('layanan1'),
            'id_layanan2' => $this->request->getVar('layanan2'),
            'id_layanan3' => $this->request->getVar('layanan3'),
            'id_petugas' => $this->request->getVar('petugas'),
            'jadwal_booking' => $this->request->getVar('tanggal'),
            'catatan' => $this->request->getVar('catatan'),
            'status' => 'Created'
        ]);

        return redirect()->to('/History-List-Booking')->with('pesan', 'Booking Berhasil Ditambahkan');
    }

    public function edit($id = false)
    {
        $data = [
            'title' => 'Edit Appointment',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'petugas' => $this->usersModel->getPetugas(),
            'layanan' => $this->layananModel->getLayanan(),
            'booking' => $this->bookingModel->getBooking($id)
        ];

        return view('/Booking/Creator/Input/EditBooking', $data);
    }

    public function update($id = false)
    {

        // CEK TEMA
        $bookingLama = $this->bookingModel->getBooking($id);
        if ($bookingLama['jadwal_booking'] == $this->request->getVar('tanggal')) {
            $rule_tanggal = 'required';
        } else {
            $rule_tanggal = 'required|is_unique[booking.jadwal_booking]';
        }

        // VALIDASI INPUT
        if (!$this->validate([
            // 'tanggal' => [
            //     'rules' => $rule_tanggal,
            //     'errors' => [
            //         'required' => '{field} harus diisi.',
            //         'is_unique' => '{field} sudah terdaftar.'
            //     ]
            // ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi atas {field} pembookingannya terlebih dahulu.'
                ]
            ],
            'layanan1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Layanan belum dipilih.'
                ]
            ],
            // 'layanan2' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => 'Layanan belum dipilih.'
            //     ]
            // ],
            // 'layanan3' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => 'Layanan belum dipilih.'
            //     ]
            // ],
            'petugas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Petugas belum dipilih.'
                ]
            ]
        ])) {
            $validation = $this->validator->getErrors();
            return redirect()->to('/Form-Edit-Booking/' . $id)->withInput()->with('validation', $validation);
        }

        $this->bookingModel->save([
            'id' => $id,
            'pembuat' => user_id(),
            'atas_nama' => $this->request->getVar('nama'),
            'id_layanan1' => $this->request->getVar('layanan1'),
            'id_layanan2' => $this->request->getVar('layanan2'),
            'id_layanan3' => $this->request->getVar('layanan3'),
            'id_petugas' => $this->request->getVar('petugas'),
            'jadwal_booking' => $this->request->getVar('tanggal'),
            'catatan' => $this->request->getVar('catatan'),
            'status' => 'Updated'
        ]);

        return redirect()->to('/History-List-Booking')->with('pesan', 'Booking Berhasil Diupdate');
    }

    public function delete($id = false)
    {
        $this->bookingModel->delete($id);
        return redirect()->to('/History-List-Booking')->with('pesan', 'Booking Berhasil Dibatalkan');
    }

    public function listAdminBookings()
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

        if ($keyword) {

            $this->builder->select('booking.*');
            $this->builder->like('booking.atas_nama', $keyword);
            $this->builder->orderBy('booking.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('booking.*');
            $this->builder->like('booking.atas_nama', $keyword);
            $this->builder->orderBy('booking.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } else {

            $this->builder->select('booking.*');
            $this->builder->orderBy('booking.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('booking.*');
            $this->builder->orderBy('booking.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        }

        $data = [
            'title' => 'List Of Booking',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'offset' => $offset,
            'currentPage' => $currentPage
        ];

        $data['booking'] = $query->getResultArray();

        return view('/admin/Booking/ListBooking', $data);
    }

    public function editAdminBookings($id = 0)
    {
        $data = [
            'title' => 'Create Data Booking',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'petugas' => $this->usersModel->getPetugas(),
            'layanan' => $this->layananModel->getLayanan(),
            'booking' => $this->bookingModel->getBooking($id)
        ];

        return view('admin/booking/editBooking', $data);
    }

    public function detailAdminBookings($id = false)
    {
        $this->builder->select('booking.*, users.fullname, layanan.nama_layanan');
        $this->builder->join('users', 'users.id = booking.id_petugas');
        $this->builder->join('layanan', 'layanan.id = booking.id_layanan1');
        $this->builder->where('booking.id', $id);
        $query = $this->builder->get();

        $this->builder->select('booking.*, users.fullname, layanan.nama_layanan');
        $this->builder->join('users', 'users.id = booking.pembuat');
        $this->builder->join('layanan', 'layanan.id = booking.id_layanan2');
        $this->builder->where('booking.id', $id);
        $query2 = $this->builder->get();

        $this->builder->select('booking.*, layanan.nama_layanan');
        $this->builder->join('layanan', 'layanan.id = booking.id_layanan3');
        $this->builder->where('booking.id', $id);
        $query3 = $this->builder->get();

        $data = [
            'title' => 'Detail Booking Customer',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
        ];

        $data['booking'] = $query->getRowArray();
        $data['booking2'] = $query2->getRowArray();
        $data['booking3'] = $query3->getRowArray();

        return view('/admin/Booking/DetailsBooking', $data);
    }

    public function confirmAdminBookings($id = false)
    {
        // dd(date('Y-m-d h:i:sa'));
        $this->bookingModel->save([
            'id' => $id,
            'status' => 'Confirmed',
            'confirmed_at' => date('Y-m-d h:i:sa')
        ]);

        return redirect()->to('/admin/detail/bookings/' . $id)->with('pesan', 'Booking Berhasil Dikonfirmasi');
    }

    public function returnAdminBookings($id = false)
    {
        // dd(date('Y-m-d h:i:sa'));
        $this->bookingModel->save([
            'id' => $id,
            'status' => 'Returned',
            'returned_at' => date('Y-m-d h:i:sa')
        ]);

        return redirect()->to('/admin/bookings')->with('pesan', 'Booking Berhasil Dikembalikan');
    }
}
