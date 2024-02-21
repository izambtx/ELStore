<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'transaksi';
    protected $primaryKey      = 'id';
    protected $useAutoIncrement = False;
    protected $useTimeStamps      = True;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowCallbacks = true;
    protected $allowedFields = ['id_produk', 'id_user', 'jumlah_barang', 'total_harga', 'status', 'noResi', 'waktu_submit_resi', 'token'];

    public function getStatus($id = false)
    {
        return $this->select('transaksi.*, users.username')->join('users', 'users.id = detail_status.id_user')->where(['id_csr' => $id])->orderBy('created_at')->findAll();
    }

    public function getMaxTransaksi($id = false)
    {
        return $this->selectMax('id')->first();
    }

    public function getCountTransaksi($id = false)
    {
        if ($id == false) {
            return $this->countAllResults();
        }

        return $this->where('id_user', $id)->where('YEAR(transaksi.created_at)', date('Y'))->countAllResults();
    }

    public function getCountLastTransaksi($id = false)
    {
        if ($id == false) {
            return $this->countAllResults();
        }

        return $this->where('id_user', $id)->where('YEAR(transaksi.created_at)', date('Y') - 1)->countAllResults();
    }

    public function getCountTransaksiAll($id = false)
    {
        return $this->countAllResults();
    }

    public function getTotalHargaTransaksi($id = false)
    {
        return $this->selectSum('total_harga')->first();
    }

    public function getPenghasilan2017($id = false)
    {
        return $this->selectSum('total_harga')->where('YEAR(transaksi.created_at)', 2017)->first();
    }

    public function getPenghasilan2018($id = false)
    {
        return $this->selectSum('total_harga')->where('YEAR(transaksi.created_at)', 2018)->first();
    }

    public function getPenghasilan2019($id = false)
    {
        return $this->selectSum('total_harga')->where('YEAR(transaksi.created_at)', 2019)->first();
    }

    public function getPenghasilan2020($id = false)
    {
        return $this->selectSum('total_harga')->where('YEAR(transaksi.created_at)', 2020)->first();
    }

    public function getPenghasilan2021($id = false)
    {
        return $this->selectSum('total_harga')->where('YEAR(transaksi.created_at)', 2021)->first();
    }

    public function getPenghasilan2022($id = false)
    {
        return $this->selectSum('total_harga')->where('YEAR(transaksi.created_at)', 2022)->first();
    }

    public function getPenghasilan2023($id = false)
    {
        return $this->selectSum('total_harga')->where('YEAR(transaksi.created_at)', 2023)->first();
    }

    public function getPenghasilan2024($id = false)
    {
        return $this->selectSum('total_harga')->where('YEAR(transaksi.created_at)', date('Y') + 1)->first();
    }

    public function getPenghasilan2025($id = false)
    {
        return $this->selectSum('total_harga')->where('YEAR(transaksi.created_at)', date('Y') + 2)->first();
    }

    public function getPenghasilan2026($id = false)
    {
        return $this->selectSum('total_harga')->where('YEAR(transaksi.created_at)', date('Y') + 3)->first();
    }

    public function getPenghasilanMax($id = false)
    {
        // $total = max($this->selectSum('total_harga')->groupBy('YEAR(transaksi.created_at)')->findAll());
        return max($this->selectSum('total_harga')->groupBy('YEAR(transaksi.created_at)')->findAll());
    }
}
