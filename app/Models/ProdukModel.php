<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'produk';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = [
        'nama', 'harga', 'stok', 'deskripsi', 'id_kategori', 'id_supplier', 'gambar', 'created_at', 'updated_at'
    ];

    public function getProduk($id = false)
    {
        if ($id == false) {
            return $this->orderBy('created_at')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getWedding($id = false)
    {

        return $this->where(['id_kategori' => 2])->orderBy('created_at')->findAll();
    }

    public function getGraduation($id = false)
    {

        return $this->where(['id_kategori' => 3])->orderBy('created_at')->findAll();
    }

    public function getBeautyProduct($id = false)
    {
        if ($id == false) {

            return $this->where('id_kategori', 1)->orderBy('created_at')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getMakeup($id = false)
    {
        if ($id == false) {

            $kategori = [1];
            return $this->whereNotIn('id_kategori', $kategori)->orderBy('created_at')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getTotalStok($id = false)
    {
        return $this->selectSum('stok')->where('id_kategori', 1)->first();
    }

    public function getTotalStokProduk($id = false)
    {
        return $this->where('id_kategori', 1)->countAllResults();
    }

    public function getCountProduk($id = false)
    {
        return $this->where('id_kategori', 1)->countAllResults();
    }

    public function getCountJasa($id = false)
    {
        return $this->where('id_kategori', 2)->orWhere('id_kategori', 3)->countAllResults();
    }
}
