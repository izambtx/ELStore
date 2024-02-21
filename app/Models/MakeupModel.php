<?php

namespace App\Models;

use CodeIgniter\Model;

class MakeupModel extends Model
{
    protected $table      = 'produk';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = [
        'nama', 'id_kategori', 'created_at', 'updated_at'
    ];

    public function getMakeup($id = false)
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
}
