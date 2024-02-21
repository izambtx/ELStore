<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table      = 'kategori';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['nama_kategori', 'created_at', 'updated_at'];

    public function getKategori($id = false)
    {
        if ($id == false) {
            return $this->orderBy('id')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getCountKategori($id = false)
    {
        return $this->countAllResults();
    }
}
