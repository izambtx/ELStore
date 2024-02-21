<?php

namespace App\Controllers;

use App\Controllers;
use Config\Services;
use Myth\Auth\Entities\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\UsersModel;
use App\Models\TransaksiModel;
use App\Models\BookingModel;
use App\Models\DetailTransaksiModel;
use App\Models\CartModel;
use App\Models\ProdukModel;
use App\Models\SupplierModel;
use App\Models\LayananModel;
use App\Models\KategoriModel;

class Home extends BaseController
{
    protected $db, $builder, $usersModel;
    protected $kategoriModel;
    protected $transaksiModel;
    protected $cartModel;
    protected $bookingModel;
    protected $detailTransaksiModel;
    protected $produkModel;
    protected $supplierModel;
    protected $layananModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->usersModel = new UsersModel();
        $this->cartModel = new CartModel();
        $this->transaksiModel = new TransaksiModel();
        $this->bookingModel = new BookingModel();
        $this->detailTransaksiModel = new DetailTransaksiModel();
        $this->produkModel = new ProdukModel();
        $this->supplierModel = new SupplierModel();
        $this->layananModel = new LayananModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        return redirect()->to('/Home');
    }

    public function home()
    {
        $pembuat = user_id();

        if (in_groups('user')) {
            $data = [
                'title' => 'Home Page',
                'keranjang' => $this->cartModel->getCart(),
                'keranjangTotal' => $this->cartModel->getCountCart(),
                'transaksiTotal' => $this->transaksiModel->getCountTransaksi($pembuat),
                'bookingTotal' => $this->bookingModel->getCountBooking($pembuat),
                'produkTotal' => $this->detailTransaksiModel->getCountProduk($pembuat),
                'weddingTotal' => $this->detailTransaksiModel->getCountWedding($pembuat),
                'graduationTotal' => $this->detailTransaksiModel->getCountGraduation($pembuat),
                'transaksiLastTotal' => $this->transaksiModel->getCountLastTransaksi($pembuat),
                'bookingLastTotal' => $this->bookingModel->getCountLastBooking($pembuat),
                'produkLastTotal' => $this->detailTransaksiModel->getCountLastProduk($pembuat),
                'weddingLastTotal' => $this->detailTransaksiModel->getCountLastWedding($pembuat),
                'graduationLastTotal' => $this->detailTransaksiModel->getCountLastGraduation($pembuat),
            ];
        } else {
            $data = [
                'title' => 'Home Page',
                'keranjang' => $this->cartModel->getCart(),
                'keranjangTotal' => $this->cartModel->getCountCart(),
                'transaksiTotal' => $this->transaksiModel->getTotalHargaTransaksi(),
                'bookingTotal' => $this->bookingModel->getCountBookingAll(),
                'produkTotal' => $this->detailTransaksiModel->getCountProdukAll(),
                'weddingTotal' => $this->detailTransaksiModel->getCountWeddingAll(),
                'graduationTotal' => $this->detailTransaksiModel->getCountGraduationAll(),
                'usersTotal' => $this->usersModel->getCountUsers(),
                'keranjangTotal' => $this->cartModel->getCountCart(),
                'stokTotal' => $this->produkModel->getTotalStok(),
                'produkStokTotal' => $this->produkModel->getTotalStokProduk(),
                'produk' => $this->produkModel->getCountProduk(),
                'jasa' => $this->produkModel->getCountJasa(),
                'kategori' => $this->kategoriModel->getCountKategori(),
                'pelayanan' => $this->layananModel->getCountLayanan(),
                'supplier' => $this->supplierModel->getCountSupplier(),
                'penghasilan2017' => $this->transaksiModel->getPenghasilan2017(),
                'penghasilan2018' => $this->transaksiModel->getPenghasilan2018(),
                'penghasilan2019' => $this->transaksiModel->getPenghasilan2019(),
                'penghasilan2020' => $this->transaksiModel->getPenghasilan2020(),
                'penghasilan2021' => $this->transaksiModel->getPenghasilan2021(),
                'penghasilan2022' => $this->transaksiModel->getPenghasilan2022(),
                'penghasilan2023' => $this->transaksiModel->getPenghasilan2023(),
                'penghasilan2024' => $this->transaksiModel->getPenghasilan2024(),
                'penghasilan2025' => $this->transaksiModel->getPenghasilan2025(),
                'penghasilan2026' => $this->transaksiModel->getPenghasilan2026(),
                'penghasilanMax' => $this->transaksiModel->getPenghasilanMax(),
            ];
        }

        return view('home', $data);
    }

    public function export()
    {
        $this->builder = $this->db->table('detail_transaksi');

        $users = $this->request->getVar('users');
        $kategori = $this->request->getVar('kategori');
        $produk = $this->request->getVar('produk');
        $makeup = $this->request->getVar('makeup');
        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');
        $month2 = $this->request->getVar('month2');
        $year2 = $this->request->getVar('year2');


        if ($month && $year && $users) {

            $query = $this->db->table('detail_transaksi')->select('detail_transaksi.*, transaksi.*, produk.nama, users.fullname, users.NIK, kategori.nama_kategori, supplier.nama_supplier')->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')->join('users', 'users.id = detail_transaksi.id_user')->join('produk', 'produk.id = detail_transaksi.id_produk')->join('kategori', 'kategori.id = produk.id_kategori')->join('supplier', 'supplier.id = produk.id_supplier')->where('MONTH(detail_transaksi.created_at)', $month)->where('YEAR(detail_transaksi.created_at)', $year)->where(['id_user' => $users])->get();
        } elseif ($month && $year && $produk) {

            $query = $this->db->table('detail_transaksi')->select('detail_transaksi.*, transaksi.*, produk.nama, users.fullname, users.NIK, kategori.nama_kategori, supplier.nama_supplier')->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')->join('users', 'users.id = detail_transaksi.id_user')->join('produk', 'produk.id = detail_transaksi.id_produk')->join('kategori', 'kategori.id = produk.id_kategori')->join('supplier', 'supplier.id = produk.id_supplier')->where('MONTH(detail_transaksi.created_at)', $month)->where('YEAR(detail_transaksi.created_at)', $year)->where(['detail_transaksi.id_produk' => $produk])->get();
        } elseif ($month && $year && $makeup) {

            $query = $this->db->table('detail_transaksi')->select('detail_transaksi.*, transaksi.*, produk.nama, users.fullname, users.NIK, kategori.nama_kategori, supplier.nama_supplier')->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')->join('users', 'users.id = detail_transaksi.id_user')->join('produk', 'produk.id = detail_transaksi.id_produk')->join('kategori', 'kategori.id = produk.id_kategori')->join('supplier', 'supplier.id = produk.id_supplier')->where('MONTH(detail_transaksi.created_at)', $month)->where('YEAR(detail_transaksi.created_at)', $year)->where(['detail_transaksi.id_produk' => $makeup])->get();
        } elseif ($month && $year && $kategori) {

            $query = $this->db->table('detail_transaksi')->select('detail_transaksi.*, transaksi.*, produk.nama, users.fullname, users.NIK, kategori.nama_kategori, supplier.nama_supplier')->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')->join('users', 'users.id = detail_transaksi.id_user')->join('produk', 'produk.id = detail_transaksi.id_produk')->join('kategori', 'kategori.id = produk.id_kategori')->join('supplier', 'supplier.id = produk.id_supplier')->where('MONTH(detail_transaksi.created_at)', $month)->where('YEAR(detail_transaksi.created_at)', $year)->where(['produk.id_kategori' => $kategori])->get();
        } elseif ($month && $year) {

            $query = $this->db->table('detail_transaksi')->select('detail_transaksi.*, transaksi.*, produk.nama, users.fullname, users.NIK, kategori.nama_kategori, supplier.nama_supplier')->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')->join('users', 'users.id = detail_transaksi.id_user')->join('produk', 'produk.id = detail_transaksi.id_produk')->join('kategori', 'kategori.id = produk.id_kategori')->join('supplier', 'supplier.id = produk.id_supplier')->where('MONTH(detail_transaksi.created_at)', $month)->where('YEAR(detail_transaksi.created_at)', $year)->get();
        } elseif ($month2 && $year2) {

            $query = $this->db->table('detail_transaksi')->select('detail_transaksi.*, transaksi.*, produk.nama, users.fullname, users.NIK, kategori.nama_kategori, supplier.nama_supplier')->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')->join('users', 'users.id = detail_transaksi.id_user')->join('produk', 'produk.id = detail_transaksi.id_produk')->join('kategori', 'kategori.id = produk.id_kategori')->join('supplier', 'supplier.id = produk.id_supplier')->where('MONTH(detail_transaksi.approved_at)', $month2)->where('YEAR(detail_transaksi.approved_at)', $year2)->get();
        } else {
            $query = $this->db->table('detail_transaksi')->select('detail_transaksi.*, transaksi.*, produk.nama, users.fullname, users.NIK, kategori.nama_kategori, supplier.nama_supplier')->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')->join('users', 'users.id = detail_transaksi.id_user')->join('produk', 'produk.id = detail_transaksi.id_produk')->join('kategori', 'kategori.id = produk.id_kategori')->join('supplier', 'supplier.id = produk.id_supplier')->get();
        }

        $transaksi = $query->getResultArray();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID Transaksi');
        $sheet->setCellValue('C1', 'Nama Produk');
        $sheet->setCellValue('D1', 'Kategori Produk');
        $sheet->setCellValue('E1', 'Supplier Produk');
        $sheet->setCellValue('F1', 'NIK Customer');
        $sheet->setCellValue('G1', 'Nama Customer');
        $sheet->setCellValue('H1', 'Jumlah Pembelian');
        $sheet->setCellValue('I1', 'Harga Pembelian');
        $sheet->setCellValue('J1', 'Total Jumlah Pembelian');
        $sheet->setCellValue('K1', 'Total Harga Pembelian');
        $sheet->setCellValue('L1', 'Status');
        $sheet->setCellValue('M1', 'Tanggal Keperluan Makeup');
        $sheet->setCellValue('N1', 'No Resi');
        $sheet->setCellValue('O1', 'Waktu Submit Resi');
        $sheet->setCellValue('P1', 'Catatan');
        $sheet->setCellValue('Q1', 'Tanggal Dibuat');
        // $sheet->setCellValue('R1', 'Kondisi Sebelum');
        // $sheet->setCellValue('S1', 'Kondisi Sesudah');
        // $sheet->setCellValue('T1', 'Perhitungan');
        // $sheet->setCellValue('U1', 'Status');
        // $sheet->setCellValue('V1', 'Tanggal Dibuat');
        // $sheet->setCellValue('W1', 'Tanggal DiSetujui');
        $column = 2;
        foreach ($transaksi as $transaksi) {
            $sheet->setCellValue('A' . $column, ($column - 1));
            $sheet->setCellValue('B' . $column, $transaksi['id_transaksi']);
            $sheet->setCellValue('C' . $column, $transaksi['nama']);
            $sheet->setCellValue('D' . $column, $transaksi['nama_kategori']);
            $sheet->setCellValue('E' . $column, $transaksi['nama_supplier']);
            $sheet->setCellValue('F' . $column, $transaksi['NIK']);
            $sheet->setCellValue('G' . $column, $transaksi['fullname']);
            $sheet->setCellValue('H' . $column, $transaksi['jumlah']);
            $sheet->setCellValue('I' . $column, $transaksi['harga']);
            $sheet->setCellValue('J' . $column, $transaksi['jumlah_barang']);
            $sheet->setCellValue('K' . $column, $transaksi['total_harga']);
            $sheet->setCellValue('L' . $column, $transaksi['status']);
            $sheet->setCellValue('M' . $column, $transaksi['tanggal_keperluan']);
            $sheet->setCellValue('N' . $column, $transaksi['noResi']);
            $sheet->setCellValue('O' . $column, $transaksi['waktu_submit_resi']);
            $sheet->setCellValue('P' . $column, $transaksi['catatan']);
            $sheet->setCellValue('Q' . $column, $transaksi['created_at']);
            // $sheet->setCellValue('R' . $column, $transaksi['tanggal_keperluan']);
            // $sheet->setCellValue('S' . $column, $transaksi['tanggal_keperluan']);
            // $sheet->setCellValue('T' . $column, $transaksi['tanggal_keperluan']);
            // $sheet->setCellValue('U' . $column, $transaksi['tanggal_keperluan']);
            // $sheet->setCellValue('V' . $column, $transaksi['created_at']);
            // $sheet->setCellValue('W' . $column, $transaksi['created_at']);
            $column++;
        }

        $sheet->getStyle('A1:Q1')->getFont()->setBold(true);
        $sheet->getStyle('A1:Q1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('93bd84');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('P')->setAutoSize(true);
        $sheet->getColumnDimension('Q')->setAutoSize(true);
        // $sheet->getColumnDimension('R')->setAutoSize(true);
        // $sheet->getColumnDimension('S')->setAutoSize(true);
        // $sheet->getColumnDimension('T')->setAutoSize(true);
        // $sheet->getColumnDimension('U')->setAutoSize(true);
        // $sheet->getColumnDimension('V')->setAutoSize(true);
        // $sheet->getColumnDimension('W')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=EXPORT-ELStore.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();

        return redirect(base_url());
    }
}
