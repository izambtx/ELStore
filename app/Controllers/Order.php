<?php

namespace App\Controllers;

use App\Controllers;
use Config\Services;
use Myth\Auth\Entities\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;
use App\Models\UsersModel;
use App\Models\CartModel;
use App\Models\KeranjangModel;


class Order extends BaseController
{
    protected $db, $builder, $usersModel;
    protected $kategoriModel;
    protected $cartModel;
    protected $transaksiModel;
    protected $detailTransaksiModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('produk');
        $this->cartModel = new CartModel();
        $this->usersModel = new UsersModel();
        $this->transaksiModel = new TransaksiModel();
        $this->detailTransaksiModel = new DetailTransaksiModel();
    }

    public function detail($id = false)
    {
        $this->builder->select('produk.*');
        $this->builder->where('produk.id', $id);
        $query = $this->builder->get();

        $harga_produk = $this->request->getVar('harga_produk');

        $data = [
            'title' => 'detail Pesanan',
            'harga_produk' => $harga_produk,
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
        ];

        $data['produk'] = $query->getRowArray();

        return view('/Proses/Order/Konfirmasi', $data);
    }

    public function konfirmasi($id = false)
    {
        $this->builder->select('produk.*');
        $this->builder->where('produk.id', $id);
        $query = $this->builder->get();

        $id_transaksi = $this->request->getVar('id_transaksi');
        $nama_produk = $this->request->getVar('nama');
        $harga_produk = $this->request->getVar('harga_produk');
        $tanggal_keperluan = $this->request->getVar('tanggal_keperluan');
        $catatan = $this->request->getVar('catatan');

        $data = [
            'title' => 'Konfirmasi Pesanan',
            'harga_produk' => $harga_produk,
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'maxTransaksi' => $this->transaksiModel->getMaxTransaksi(),
            'countTransaksi' => $this->transaksiModel->getCountTransaksi()
        ];

        $data['produk'] = $query->getRowArray();

        return view('/Proses/Order/Konfirmasi', $data);
    }

    public function order($id = false)
    {
        $this->builder->select('produk.*');
        $this->builder->where('produk.id', $id);
        $query = $this->builder->get();

        /*require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */

        //SAMPLE REQUEST START HERE
        $id_transaksi = $this->request->getVar('id_transaksi');
        $nama_produk = $this->request->getVar('nama');
        $harga_produk = $this->request->getVar('harga_produk') + 15000;
        $tanggal_keperluan = $this->request->getVar('tanggal_keperluan');
        $catatan = $this->request->getVar('catatan');
        $id_order = date('ymd') . $id_transaksi;

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
                'order_id' => $id_order,
                'gross_amount' => $harga_produk,
            ),
            'customer_details' => array(
                'first_name' => user()->fullname,
                'last_name' => '',
                'email' => user()->email,
                'phone' => user()->noHP,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $this->transaksiModel->save([
            'id' => $id_order,
            'id_user' => user()->id,
            'jumlah_barang' => 1,
            'total_harga' => $harga_produk,
            'status' => '',
            'token' => $snapToken
        ]);

        $transaksi_order_id = $this->transaksiModel->getInsertID();

        $this->detailTransaksiModel->save([
            'id_transaksi' => $id_order,
            'id_produk' => $id,
            'id_user' => user()->id,
            'jumlah' => 1,
            'harga' => $harga_produk,
            'tanggal_keperluan' => $tanggal_keperluan
        ]);

        $data = [
            'title' => 'Konfirmasi Pesanan',
            'keranjang' => $this->cartModel->getCart(),
            'keranjangTotal' => $this->cartModel->getCountCart(),
            'harga_produk' => $harga_produk,
            'tanggal_keperluan' => $this->request->getVar('tanggal_keperluan'),
            'catatan' => $this->request->getVar('catatan'),
            'token' => $snapToken,
            'maxTransaksi' => $this->transaksiModel->getMaxTransaksi(),
            'countTransaksi' => $this->transaksiModel->getCountTransaksi()
        ];

        $data['produk'] = $query->getRowArray();

        return view('/Proses/Order/Konfirmasi', $data);
    }

    public function shipmentPembayaran($id = false)
    {

        /*require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */

        //SAMPLE REQUEST START HERE
        $id_transaksi = $this->request->getVar('id_transaksi');
        $id_produk = $this->request->getVar('id_produk');
        $jumlah_barang = $this->request->getVar('jumlah_barang');
        $harga_produk = $this->request->getVar('harga_produk');
        $total_harga = $this->request->getVar('total_harga') + 15000;
        $id_keranjang = $this->request->getVar('id_keranjang');
        $id_order = date('ymd') . $id_transaksi;

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
                'order_id' => $id_order,
                'gross_amount' => $total_harga,
            ),
            'customer_details' => array(
                'first_name' => user()->fullname,
                'last_name' => '',
                'email' => user()->email,
                'phone' => user()->noHP,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $this->transaksiModel->save([
            'id' => $id_order,
            'id_user' => user()->id,
            'jumlah_barang' => $jumlah_barang,
            'total_harga' => $total_harga,
            'status' => '',
            'token' => $snapToken
        ]);

        $transaksi_order_id = $this->transaksiModel->getInsertID();

        $this->detailTransaksiModel->save([
            'id_transaksi' => $id_order,
            'id_produk' => $id,
            'id_user' => user()->id,
            'jumlah' => 1,
            'harga' => $harga_produk,
            'tanggal_keperluan' => ''
        ]);

        $this->cartModel->delete($id_keranjang);

        return redirect()->to('https://app.sandbox.midtrans.com/snap/v2/vtweb/' . $snapToken);
    }
}
