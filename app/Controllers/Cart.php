<?php

namespace App\Controllers;

use App\Controllers;
use Config\Services;
use Myth\Auth\Entities\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\BagianModel;
use App\Models\CartModel;
use App\Models\TransaksiModel;
use App\Models\AktifasiModel;
use App\Models\UsersModel;
use App\Models\ExtendModel;
use App\Models\FotoCSRModel;


class Cart extends BaseController
{
    protected $db, $builder, $usersModel;
    protected $kategoriModel;
    protected $transaksiModel;
    protected $cartModel;
    protected $fotocartModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('keranjang');
        $this->transaksiModel = new TransaksiModel();
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

            $this->builder->select('keranjang.*, bagian.nama_bagian, users.username');
            $this->builder->join('bagian', 'bagian.id = keranjang.bagian');
            $this->builder->join('users', 'users.id = keranjang.pembuat');
            $this->builder->where('pembuat', user()->id);
            $status = ['Created', 'Updated'];
            $this->builder->whereIn('keranjang.status', $status);
            $this->builder->like('keranjang.tema', $keyword);
            $this->builder->orderBy('keranjang.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('keranjang.*, bagian.nama_bagian, users.username');
            $this->builder->join('bagian', 'bagian.id = keranjang.bagian');
            $this->builder->join('users', 'users.id = keranjang.pembuat');
            $this->builder->where('pembuat', user()->id);
            $status = ['Created', 'Updated'];
            $this->builder->whereIn('keranjang.status', $status);
            $this->builder->like('keranjang.tema', $keyword);
            $this->builder->orderBy('keranjang.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } else {

            $this->builder->select('keranjang.*, produk.*');
            $this->builder->join('produk', 'produk.id = keranjang.id_produk');
            $this->builder->where('pembuat', user()->id);
            $this->builder->orderBy('keranjang.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('keranjang.*, produk.*');
            $this->builder->join('produk', 'produk.id = keranjang.id_produk');
            $this->builder->where('pembuat', user()->id);
            $this->builder->orderBy('keranjang.created_at', 'DESC');
            $query2 = $this->builder->get();

            $this->builder->select('keranjang.*, produk.*');
            $this->builder->join('produk', 'produk.id = keranjang.id_produk');
            $this->builder->where('pembuat', user()->id);
            $this->builder->orderBy('keranjang.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        }

        $data = [
            'title' => 'List History Rental Cart Services',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'offset' => $offset,
            'currentPage' => $currentPage,
            'selectedBagian' => $bagian,
            'selectedTema' => $keyword,
            'selectedWaktu' => $waktu
        ];

        $data['cart'] = $query->getResultArray();
        $data['cart2'] = $query->getRowArray();

        return view('/Proses/Cart/ListCart', $data);
    }

    public function shipment($id = false)
    {
        $this->builder->select('produk.*, keranjang.*');
        $this->builder->join('produk', 'produk.id = keranjang.id_produk');
        $this->builder->where('keranjang.id_produk', $id);
        $query = $this->builder->get();

        $harga_produk = $this->request->getVar('harga_produk');

        $data = [
            'title' => 'checkout pesanan',
            'harga_produk' => $harga_produk,
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'maxTransaksi' => $this->transaksiModel->getMaxTransaksi(),
            'countTransaksi' => $this->transaksiModel->getCountTransaksi()
        ];

        $data['produk'] = $query->getRowArray();

        return view('/Proses/Shipment/ListShipment', $data);
    }

    public function shipmentAll($id = false)
    {
        $this->builder->select('produk.*, keranjang.*');
        $this->builder->join('produk', 'produk.id = keranjang.id_produk');
        $this->builder->where('keranjang.pembuat', user_id());
        $query = $this->builder->get();

        // $this->builder->selectSum('produk.harga');
        // $this->builder->join('produk', 'produk.id = keranjang.id_produk');
        // $this->builder->where('keranjang.pembuat', user_id());
        // $query2 = $this->builder->get();

        $harga_produk = $this->request->getVar('harga_produk');

        // $sum = $this->cartModel->getCartSum();
        // foreach ($sum as $row) {
        //     echo $row->id;
        // }

        $data = [
            'title' => 'checkout pesanan semua',
            'harga_produk' => $harga_produk,
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'maxTransaksi' => $this->transaksiModel->getMaxTransaksi(),
            'sumTransaksi' => $this->cartModel->getCartSum(),
            'countTransaksi' => $this->transaksiModel->getCountTransaksi()
        ];

        $data['produk'] = $query->getResultArray();
        // $data['sumTransaksi'] = $query2->getResultArray();

        return view('/Proses/Shipment/ListShipmentAll', $data);
    }

    public function custom($id = false)
    {

        $data = [
            'title' => 'List History Cart Appointment'
        ];

        return view('/Cart/Creator/Input/CustomCart', $data);
    }

    public function detail($id = false)
    {
        $this->builder->select('keranjang.*, bagian.nama_bagian, singkatan, users.username, fullname');
        $this->builder->join('bagian', 'bagian.id = keranjang.bagian');
        $this->builder->join('users', 'users.id = keranjang.pembuat');
        $this->builder->where('keranjang.id', $id);
        $query = $this->builder->get();

        $this->builder->select('keranjang.*, bagian.nama_bagian, singkatan, users.username, fullname');
        $this->builder->join('bagian', 'bagian.id = keranjang.bagian');
        $this->builder->join('users', 'users.id = keranjang.penyetuju');
        $this->builder->where('keranjang.id', $id);
        $query2 = $this->builder->get();

        $this->builder->select('keranjang.*, bagian.nama_bagian, singkatan, users.username, fullname');
        $this->builder->join('bagian', 'bagian.id = keranjang.bagian');
        $this->builder->join('users', 'users.id = keranjang.returner');
        $this->builder->where('keranjang.id', $id);
        $query3 = $this->builder->get();

        $this->builder->select('keranjang.*, bagian.nama_bagian, singkatan, users.username, fullname');
        $this->builder->join('bagian', 'bagian.id = keranjang.bagian');
        $this->builder->join('users', 'users.id = keranjang.rejecter');
        $this->builder->where('keranjang.id', $id);
        $query4 = $this->builder->get();

        $this->builder->select('keranjang.*, bagian.nama_bagian, singkatan, users.username, fullname');
        $this->builder->join('bagian', 'bagian.id = keranjang.bagian');
        $this->builder->join('users', 'users.id = keranjang.checker');
        $this->builder->where('keranjang.id', $id);
        $query5 = $this->builder->get();

        $data = [
            'title' => 'Detail Form Cost Saving Report',
            'foto_cart' => $this->db->table('foto_cart')->getWhere(['id_cart' => $id])->getResultArray()
        ];

        $data['cart'] = $query->getRowArray();
        $data['cart2'] = $query2->getRowArray();
        $data['cart3'] = $query3->getRowArray();
        $data['cart4'] = $query4->getRowArray();
        $data['cart5'] = $query5->getRowArray();

        return view('/Cart/Creator/Input/CreateCart', $data);
    }

    public function order($id = false)
    {
        $id = $this->request->getVar('check');
        if (!empty($this->request->getVar('check'))) {
            $checked = $this->request->getVar('check');
            foreach ($checked as $c) {
                echo $c;
            }
        }
    }

    public function create($id = false)
    {
        $data = [
            'title' => 'try our makeup services',
        ];

        return view('/Cart/Creator/Input/CreateCart', $data);
    }

    public function rincian($id = false)
    {

        // VALIDASI INPUT

        $this->cartModel->save([
            'id' => $this->request->getVar('id_keranjang'),
            'catatan' => $this->request->getVar('catatan'),
            'jumlah' => $this->request->getVar('jumlah')
        ]);

        return redirect()->to('/Cart')->with('pesan', 'Rincian Pesanan Telah Berhasil Terupdate pada Keranjang');
    }

    public function delete($id = false)
    {
        $this->cartModel->delete($id);
        return redirect()->to('/Cart')->with('pesan', 'Produk Berhasil Dihapus dari Keranjang');
    }

    public function deleteAll($id = false)
    {
        // $this->cartModel->emptyTable('keranjang');
        $this->cartModel->delete('pembuat', user_id());
        return redirect()->to('/List-Produk')->with('pesan', 'Produk Berhasil Dihapus dari Keranjang dan Halaman Telah Dialihkan');
    }
}
