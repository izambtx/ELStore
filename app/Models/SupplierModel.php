<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table      = 'supplier';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['nama_supplier', 'created_at', 'updated_at'];

    public function getSupplier($id = false)
    {
        if ($id == false) {
            return $this->orderBy('id')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getCountSupplier($id = false)
    {
        return $this->countAllResults();
    }
}
