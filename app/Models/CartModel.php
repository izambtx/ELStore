<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table      = 'keranjang';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = [
        'id_produk', 'pembuat', 'jumlah', 'catatan', 'created_at', 'updated_at'
    ];

    public function getCart($id = false)
    {
        if ($id == false) {
            return $this->join('produk', 'produk.id = keranjang.id_produk')->select('keranjang.*,produk.nama,produk.gambar,produk.harga,produk.stok')->where(['pembuat' => user_id()])->orderBy('keranjang.created_at', 'ASC')->findAll();
        }

        // return $this->join('keranjang', 'keranjang.id_produk = produk.id')->where(['keranjang.pembuat' => $id])->findall();
    }

    public function getCartSum($id = false)
    {

        // $this->join('produk', 'produk.id = keranjang.id_produk')->selectSum('harga');
        // return $this->get();

        return $this->join('produk', 'produk.id = keranjang.id_produk')->selectSum('harga')->findAll();
    }

    public function getCountCart($id = false)
    {
        if ($id == false) {
            return $this->countAllResults();
        }

        return $this->where(['pembuat' => $id])->countAllResults();
    }
}
