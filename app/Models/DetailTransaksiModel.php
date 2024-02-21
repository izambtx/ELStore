<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksiModel extends Model
{
    protected $table      = 'detail_transaksi';
    protected $primaryKey      = 'id';
    protected $useTimeStamps      = True;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowCallbacks = true;
    protected $allowedFields = ['id_transaksi', 'id_produk', 'id_user', 'jumlah', 'harga', 'tanggal_keperluan'];

    public function getStatus($id = false)
    {
        return $this->select('transaksi.*, users.username')->join('users', 'users.id = detail_transaksi.id_user')->where(['id_csr' => $id])->orderBy('created_at')->findAll();
    }

    public function getMaxTransaksi($id = false)
    {
        return $this->selectMax('id')->first();
    }

    public function getCountTransaksi($id = false)
    {
        return $this->selectCount('id')->first();
    }

    public function getCountProduk($id = false)
    {
        if ($id == false) {
            return $this->join('produk', 'produk.id = detail_transaksi.id_produk')->where(['id_kategori' => 1])->countAllResults();
        }

        return $this->join('produk', 'produk.id = detail_transaksi.id_produk')->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')->where(['detail_transaksi.id_user' => $id])->where(['id_kategori' => 1])->where('YEAR(transaksi.created_at)', date('Y'))->countAllResults();
    }

    public function getCountLastProduk($id = false)
    {
        if ($id == false) {
            return $this->join('produk', 'produk.id = detail_transaksi.id_produk')->where(['id_kategori' => 1])->countAllResults();
        }

        return $this->join('produk', 'produk.id = detail_transaksi.id_produk')->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')->where(['detail_transaksi.id_user' => $id])->where(['id_kategori' => 1])->where('YEAR(transaksi.created_at)', date('Y') - 1)->countAllResults();
    }

    public function getCountWedding($id = false)
    {
        if ($id == false) {
            return $this->join('produk', 'produk.id = detail_transaksi.id_produk')->where(['id_kategori' => 2])->countAllResults();
        }

        return $this->join('produk', 'produk.id = detail_transaksi.id_produk')->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')->where(['detail_transaksi.id_user' => $id])->where(['id_kategori' => 2])->where('YEAR(transaksi.created_at)', date('Y'))->countAllResults();
    }

    public function getCountLastWedding($id = false)
    {
        if ($id == false) {
            return $this->join('produk', 'produk.id = detail_transaksi.id_produk')->where(['id_kategori' => 2])->countAllResults();
        }

        return $this->join('produk', 'produk.id = detail_transaksi.id_produk')->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')->where(['detail_transaksi.id_user' => $id])->where(['id_kategori' => 2])->where('YEAR(transaksi.created_at)', date('Y') - 1)->countAllResults();
    }

    public function getCountGraduation($id = false)
    {
        if ($id == false) {
            return $this->join('produk', 'produk.id = detail_transaksi.id_produk')->where(['id_kategori' => 3])->countAllResults();
        }

        return $this->join('produk', 'produk.id = detail_transaksi.id_produk')->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')->where(['detail_transaksi.id_user' => $id])->where(['id_kategori' => 3])->where('YEAR(transaksi.created_at)', date('Y'))->countAllResults();
    }

    public function getCountLastGraduation($id = false)
    {
        if ($id == false) {
            return $this->join('produk', 'produk.id = detail_transaksi.id_produk')->where(['id_kategori' => 3])->countAllResults();
        }

        return $this->join('produk', 'produk.id = detail_transaksi.id_produk')->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')->where(['detail_transaksi.id_user' => $id])->where(['id_kategori' => 3])->where('YEAR(transaksi.created_at)', date('Y') - 1)->countAllResults();
    }

    public function getCountProdukAll($id = false)
    {

        return $this->join('produk', 'produk.id = detail_transaksi.id_produk')->where(['id_kategori' => 1])->countAllResults();
    }

    public function getCountWeddingAll($id = false)
    {

        return $this->join('produk', 'produk.id = detail_transaksi.id_produk')->where(['id_kategori' => 2])->countAllResults();
    }

    public function getCountGraduationAll($id = false)
    {

        return $this->join('produk', 'produk.id = detail_transaksi.id_produk')->where(['id_kategori' => 3])->countAllResults();
    }



    public function getCountYearMonth($year, $month)
    {
        return $this->selectCount('id')->where('YEAR(created_at)', $year)->where('MONTH(created_at)', $month)->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->findAll();
    }

    public function getTotalYearMonth($year, $month)
    {
        return $this->selectCount('id')->where('YEAR(created_at)', $year)->where('MONTH(created_at)', $month)->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->countAllResults();
    }

    public function getTotalMonthYear($year, $month)
    {
        return $this->selectCount('id')->where('YEAR(created_at)', $year)->where('MONTH(created_at)', $month)->orderBy('created_at', 'ASC')->countAllResults();
    }



    public function getCountYearMonthKategori($year, $month, $kategori)
    {
        return $this->selectCount('detail_transaksi.id')->join('produk', 'produk.id = detail_transaksi.id_produk')->where('YEAR(detail_transaksi.created_at)', $year)->where('MONTH(detail_transaksi.created_at)', $month)->where('id_kategori', $kategori)->groupBy('WEEK(detail_transaksi.created_at)')->orderBy('detail_transaksi.created_at', 'ASC')->findAll();
    }

    public function getTotalYearMonthKategori($year, $month, $kategori)
    {
        return $this->selectCount('detail_transaksi.id')->join('produk', 'produk.id = detail_transaksi.id_produk')->where('YEAR(detail_transaksi.created_at)', $year)->where('MONTH(detail_transaksi.created_at)', $month)->where('id_kategori', $kategori)->groupBy('WEEK(detail_transaksi.created_at)')->orderBy('detail_transaksi.created_at', 'ASC')->countAllResults();
    }

    public function getTotalMonthYearKategori($year, $month, $kategori)
    {
        return $this->selectCount('detail_transaksi.id')->join('produk', 'produk.id = detail_transaksi.id_produk')->where('YEAR(detail_transaksi.created_at)', $year)->where('MONTH(detail_transaksi.created_at)', $month)->where('id_kategori', $kategori)->orderBy('detail_transaksi.created_at', 'ASC')->countAllResults();
    }



    public function getCountMonthlyProduk($month, $year, $produk)
    {
        return $this->selectCount('id')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where('id_produk', $produk)->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->findAll();
    }

    public function getTotalMonthlyProduk($month, $year, $produk)
    {
        return $this->selectCount('id')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where('id_produk', $produk)->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->countAllResults();
    }

    public function getTotalProduk($month, $year, $produk)
    {
        return $this->selectCount('id')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where('id_produk', $produk)->orderBy('created_at', 'ASC')->countAllResults();
    }



    public function getCountUsers($year, $month, $users)
    {
        return $this->selectCount('id')->where('YEAR(created_at)', $year)->where('MONTH(created_at)', $month)->where('id_user', $users)->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->findAll();
    }

    public function getTotalMonthlyUsers($year, $month, $users)
    {
        return $this->selectCount('id')->where('YEAR(created_at)', $year)->where('MONTH(created_at)', $month)->where('id_user', $users)->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->countAllResults();
    }

    public function getTotalUsers($year, $month, $users)
    {
        return $this->selectCount('id')->where('YEAR(created_at)', $year)->where('MONTH(created_at)', $month)->where('id_user', $users)->orderBy('created_at', 'ASC')->countAllResults();
    }



    public function getCountMonthlyMakeup($month, $year, $makeup)
    {
        return $this->selectCount('id')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where('id_produk', $makeup)->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->findAll();
    }

    public function getTotalMonthlyMakeup($month, $year, $makeup)
    {
        return $this->selectCount('id')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where('id_produk', $makeup)->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->countAllResults();
    }

    public function getTotalMakeup($month, $year, $makeup)
    {
        return $this->selectCount('id')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where('id_produk', $makeup)->orderBy('created_at', 'ASC')->countAllResults();
    }
}
