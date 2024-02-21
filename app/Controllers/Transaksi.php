<?php

namespace App\Controllers;

use App\Controllers;
use Config\Services;
use Myth\Auth\Entities\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\TransaksiModel;
use App\Models\UsersModel;
use App\Models\CartModel;
use App\Models\ProdukModel;


class Transaksi extends BaseController
{
    protected $db, $builder, $usersModel;
    protected $kategoriModel;
    protected $cartModel;
    protected $produkModel;
    protected $transaksiModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('transaksi');
        $this->cartModel = new CartModel();
        $this->usersModel = new UsersModel();
        $this->transaksiModel = new TransaksiModel();
        $this->produkModel = new ProdukModel();
    }

    public function historyMakeup($id = false)
    {
        $page = 1;

        if ($this->request->getGet()) {
            $page = $this->request->getGet('page');
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $perPage = 15;

        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        $this->builder->select('transaksi.*, users.fullname');
        $this->builder->join('users', 'users.id = transaksi.id_user');
        $this->builder->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi');
        $this->builder->join('produk', 'produk.id = detail_transaksi.id_produk');
        $this->builder->where('transaksi.id_user', user_id());
        $id_kategori = [1];
        $this->builder->whereNotIn('produk.id_kategori', $id_kategori);
        $this->builder->orderBy('transaksi.id', 'DESC');
        $query = $this->builder->get($limit, $offset);

        $this->builder->select('transaksi.*, users.fullname');
        $this->builder->join('users', 'users.id = transaksi.id_user');
        $this->builder->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi', 'RIGHT');
        $this->builder->join('produk', 'produk.id = detail_transaksi.id_produk');
        $this->builder->where('transaksi.id_user', user_id());
        $id_kategori = [1];
        $this->builder->whereNotIn('produk.id_kategori', $id_kategori);
        $this->builder->orderBy('transaksi.id', 'DESC');
        $total = $this->builder->countAllResults();

        $data = [
            'title' => 'History Pemesanan Jasa Makeup',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'offset' => $offset,
            'currentPage' => $currentPage,
        ];

        $data['makeup'] = $query->getResultArray();

        return view('/Makeup/Creator/List/ListHistoryMakeup', $data);
    }

    public function listAdmin()
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

            $this->builder->select('transaksi.*, users.fullname');
            $this->builder->join('users', 'users.id = transaksi.id_user');
            $this->builder->like('users.fullname', $keyword);
            $this->builder->orderBy('transaksi.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('transaksi.*, users.fullname');
            $this->builder->join('users', 'users.id = transaksi.id_user');
            $this->builder->like('users.fullname', $keyword);
            $this->builder->orderBy('transaksi.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } else {

            $this->builder->select('transaksi.*, users.fullname');
            $this->builder->join('users', 'users.id = transaksi.id_user');
            $this->builder->orderBy('transaksi.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('transaksi.*, users.fullname');
            $this->builder->join('users', 'users.id = transaksi.id_user');
            $this->builder->orderBy('transaksi.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        }

        $data = [
            'title' => 'List Of Transaksi',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'offset' => $offset,
            'currentPage' => $currentPage
        ];

        $data['transaksi'] = $query->getResultArray();

        return view('/Transaksi/Admin/ListTransaksi', $data);
    }

    public function detailAdmin($id = false)
    {
        $this->builder->select('transaksi.*, detail_transaksi.*, produk.*');
        $this->builder->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id');
        $this->builder->join('produk', 'produk.id = detail_transaksi.id_produk');
        $this->builder->where('transaksi.id', $id);
        $query = $this->builder->get();

        // $this->builder->select('produk.*, supplier.nama_supplier, keranjang.id_produk, jumlah, keranjang.id AS keranjang_id');
        // $this->builder->join('supplier', 'supplier.id = produk.id_supplier');
        // $this->builder->join('keranjang', 'keranjang.id_produk = produk.id');
        // $this->builder->where('produk.id', $id);
        // $query2 = $this->builder->get();

        $data = [
            'title' => 'Detail Transactions',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
        ];

        $data['transaksi'] = $query->getRowArray();
        // $data['keranjang_produk'] = $query2->getRowArray();

        return view('/Transaksi/Admin/DetailsTransaksi', $data);
    }

    public function Check($id = false)
    {
        $update_stok = $this->request->getVar('stok_produk') - 1;

        // dd($update_stok);

        $this->transaksiModel->save([
            'id' => $id,
            'status' => 'Terkonfirmasi'
        ]);

        $this->produkModel->save([
            'id' => $this->request->getVar('id_produk'),
            'stok' => $update_stok
        ]);

        return redirect()->to('/Admin-List-Transaksi')->with('pesan', 'Data Transaksi Berhasil Terkonfirmasi');
    }

    public function Resi($id = false)
    {

        // VALIDASI INPUT
        if (!$this->validate([
            'noResi' => [
                'rules' => 'required|is_unique[transaksi.noResi]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'waktuResi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harap isi waktu penyubmitan barang dengan benar dan sesuai terlebih dahulu.'
                ]
            ]
        ])) {
            $validation = $this->validator->getErrors();
            return redirect()->to('/Detail-Admin-Transaksi/' . $id)->withInput()->with('validation', $validation);
        }

        $this->transaksiModel->save([
            'id' => $id,
            'status' => 'Dalam Pengiriman',
            'noResi' => $this->request->getVar('noResi'),
            'waktu_submit_resi' => $this->request->getVar('waktuResi')
        ]);

        return redirect()->to('/Admin-List-Transaksi')->with('pesan', 'Berhasil Melakukan Penginputan Nomor Resi Pengiriman');
    }

    public function terimaBarang($id = false)
    {
        $this->transaksiModel->save([
            'id' => $id,
            'status' => 'Diterima Pembeli'
        ]);

        return redirect()->to('/List-History-Transaction')->with('pesan', 'Berhasil Melakukan Penerimaan Barang');
    }
}
