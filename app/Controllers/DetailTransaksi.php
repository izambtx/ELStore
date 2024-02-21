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
use App\Models\KategoriModel;


class DetailTransaksi extends BaseController
{
    protected $db, $builder, $usersModel;
    protected $kategoriModel;
    protected $cartModel;
    protected $transaksiModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('detail_transaksi');
        $this->cartModel = new CartModel();
        $this->usersModel = new UsersModel();
        $this->transaksiModel = new TransaksiModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function orderMakeup($id = false)
    {
        $this->builder->select('detail_transaksi.*, produk.*, users.fullname, transaksi.jumlah_barang, transaksi.total_harga, transaksi.token, transaksi.noResi, transaksi.status, transaksi.waktu_submit_resi');
        $this->builder->join('produk', 'produk.id = detail_transaksi.id_produk');
        $this->builder->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi');
        $this->builder->join('users', 'users.id = detail_transaksi.id_user');
        $this->builder->where('detail_transaksi.id_transaksi', $id);
        $query = $this->builder->get();

        $data = [
            'title' => 'Detail Transaksi',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
        ];

        $data['makeup'] = $query->getRowArray();

        return view('/Transaksi/Creator/Detail/DetailHistoryTransaksi', $data);
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


        $keyword = $this->request->getVar('keyword');
        $waktu = $this->request->getVar('waktu');

        if ($waktu) {

            $this->builder->select('detail_transaksi.*, transaksi.*, users.fullname, kategori.nama_kategori');
            $this->builder->join('users', 'users.id = detail_transaksi.id_user');
            $this->builder->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi');
            $this->builder->join('produk', 'produk.id = detail_transaksi.id_produk');
            $this->builder->join('kategori', 'kategori.id = produk.id_kategori');
            $this->builder->where('detail_transaksi.id_user', user_id());
            $this->builder->like('detail_transaksi.created_at', $waktu);
            $this->builder->orderBy('transaksi.id', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('detail_transaksi.*, transaksi.*, users.fullname, kategori.nama_kategori');
            $this->builder->join('users', 'users.id = detail_transaksi.id_user');
            $this->builder->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi');
            $this->builder->join('produk', 'produk.id = detail_transaksi.id_produk');
            $this->builder->join('kategori', 'kategori.id = produk.id_kategori');
            $this->builder->where('detail_transaksi.id_user', user_id());
            $this->builder->like('detail_transaksi.created_at', $waktu);
            $this->builder->orderBy('transaksi.id', 'DESC');
            $total = $this->builder->countAllResults();
        } elseif ($keyword) {

            $this->builder->select('detail_transaksi.*, transaksi.*, users.fullname, kategori.nama_kategori');
            $this->builder->join('users', 'users.id = detail_transaksi.id_user');
            $this->builder->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi');
            $this->builder->join('produk', 'produk.id = detail_transaksi.id_produk');
            $this->builder->join('kategori', 'kategori.id = produk.id_kategori');
            $this->builder->where('detail_transaksi.id_user', user_id());
            $this->builder->where('produk.id_kategori', $keyword);
            $this->builder->orderBy('transaksi.id', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('detail_transaksi.*, transaksi.*, users.fullname, kategori.nama_kategori');
            $this->builder->join('users', 'users.id = detail_transaksi.id_user');
            $this->builder->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi');
            $this->builder->join('produk', 'produk.id = detail_transaksi.id_produk');
            $this->builder->join('kategori', 'kategori.id = produk.id_kategori');
            $this->builder->where('detail_transaksi.id_user', user_id());
            $this->builder->where('produk.id_kategori', $keyword);
            $this->builder->orderBy('transaksi.id', 'DESC');
            $total = $this->builder->countAllResults();
        } else {

            $this->builder->select('detail_transaksi.*, transaksi.*, users.fullname, kategori.nama_kategori');
            $this->builder->join('users', 'users.id = detail_transaksi.id_user');
            $this->builder->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi');
            $this->builder->join('produk', 'produk.id = detail_transaksi.id_produk');
            $this->builder->join('kategori', 'kategori.id = produk.id_kategori');
            $this->builder->where('detail_transaksi.id_user', user_id());
            $this->builder->orderBy('transaksi.id', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('detail_transaksi.*, transaksi.*, users.fullname, kategori.nama_kategori');
            $this->builder->join('users', 'users.id = detail_transaksi.id_user');
            $this->builder->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi');
            $this->builder->join('produk', 'produk.id = detail_transaksi.id_produk');
            $this->builder->join('kategori', 'kategori.id = produk.id_kategori');
            $this->builder->where('detail_transaksi.id_user', user_id());
            $this->builder->orderBy('transaksi.id', 'DESC');
            $total = $this->builder->countAllResults();
        }

        $data = [
            'title' => 'History Transaksi Pesanan',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'kategori' => $this->kategoriModel->getKategori(),
            'kategoriNama' => $this->kategoriModel->getKategori($keyword),
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'offset' => $offset,
            'currentPage' => $currentPage,
            'selectedWaktu' => $waktu,
            'selectedKategori' => $keyword,
        ];

        $data['makeup'] = $query->getResultArray();

        return view('/Transaksi/Creator/List/ListHistoryTransaksi', $data);
    }

    public function konfirmasiOrderMakeup($id = false)
    {
        $this->builder->select('detail_transaksi.*, produk.*, users.fullname, transaksi.jumlah_barang, transaksi.total_harga, transaksi.token');
        $this->builder->join('produk', 'produk.id = detail_transaksi.id_produk');
        $this->builder->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi');
        $this->builder->join('users', 'users.id = detail_transaksi.id_user');
        $this->builder->where('detail_transaksi.id_transaksi', $id);
        $query = $this->builder->get();

        /*require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */

        //SAMPLE REQUEST START HERE
        $id_transaksi = $this->request->getVar('id_transaksi');
        $harga_transaksi = $this->request->getVar('harga_transaksi');
        // $id_order = date('ymd') . $id_transaksi;

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-HrJZLgI6Ak4AUG2NOamr2BlK';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $id,
                'gross_amount' => $harga_transaksi,
            ),
            'customer_details' => array(
                'first_name' => user()->fullname,
                'last_name' => '',
                'email' => user()->email,
                'phone' => user()->noHP,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $data['makeup'] = $query->getRowArray();

        return redirect()->to('https://app.sandbox.midtrans.com/snap/v2/vtweb/' . $snapToken);
    }
}
