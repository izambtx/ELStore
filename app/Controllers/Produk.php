<?php

namespace App\Controllers;

use App\Controllers;
use Config\Services;
use Myth\Auth\Entities\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\ProdukModel;
use App\Models\CartModel;
use App\Models\StatusModel;
use App\Models\AktifasiModel;
use App\Models\UsersModel;
use App\Models\ExtendModel;
use App\Models\FotoCSRModel;


class Produk extends BaseController
{
    protected $db, $builder, $usersModel;
    protected $kategoriModel;
    protected $makeupModel;
    protected $cartModel;
    protected $fotocartModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('produk');
        $this->makeupModel = new ProdukModel();
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

            $this->builder->select('produk.*, supplier.nama_supplier');
            $this->builder->join('supplier', 'supplier.id = produk.id_supplier');
            $this->builder->where('produk.id_kategori', 1);
            $this->builder->orderBy('produk.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('produk.*, supplier.nama_supplier');
            $this->builder->join('supplier', 'supplier.id = produk.id_supplier');
            $this->builder->where('produk.id_kategori', 1);
            $this->builder->orderBy('produk.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        }

        $data = [
            'title' => 'List Produk Kecantikan',
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

        $data['produk'] = $query->getResultArray();

        return view('/Produk/List/ListProduk', $data);
    }

    public function custom($id = false)
    {

        $data = [
            'title' => 'List History Produk Appointment'
        ];

        return view('/Produk/Creator/Input/CustomProduk', $data);
    }

    public function detail($id = false)
    {
        $this->builder->select('produk.*, supplier.nama_supplier');
        $this->builder->join('supplier', 'supplier.id = produk.id_supplier');
        $this->builder->where('produk.id', $id);
        $query = $this->builder->get();

        $this->builder->select('produk.*, supplier.nama_supplier, keranjang.id_produk, jumlah, keranjang.id AS keranjang_id');
        $this->builder->join('supplier', 'supplier.id = produk.id_supplier');
        $this->builder->join('keranjang', 'keranjang.id_produk = produk.id');
        $this->builder->where('produk.id', $id);
        $query2 = $this->builder->get();

        $data = [
            'title' => 'Detail Produk Kecantikan',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
        ];

        $data['produk'] = $query->getRowArray();
        $data['keranjang_produk'] = $query2->getRowArray();

        return view('/Produk/Detail/DetailProduk', $data);
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

        return view('/Produk/Creator/Input/CreateProduk', $data);
    }

    public function save($id = false)
    {

        // VALIDASI INPUT
        $total_jumlah_produk_keranjang = $this->request->getVar('jumlah_produk_keranjang') + 1;

        // dd($this->request->getVar('id_produk'));

        if ($this->request->getVar('id_produk_keranjang') == $id) {
            $this->cartModel->save([
                'id' => $this->request->getVar('keranjang_id'),
                'jumlah' => $total_jumlah_produk_keranjang
            ]);

            return redirect()->to('/List-Produk')->with('pesan', 'Produk Berhasil Ditambahkan ke Keranjang');
        } else {
            $this->cartModel->save([
                // 'id_kategori' => 1,
                'id_produk' => $id,
                'jumlah' => '1',
                'pembuat' => user_id()
            ]);

            return redirect()->to('/List-Produk')->with('pesan', 'Produk Berhasil Dimasukan Keranjang');
        }
    }
}
