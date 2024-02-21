<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoCSRModel extends Model
{
    protected $table      = 'foto_csr';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['id_csr', 'id_kategori', 'nama_foto', 'keterangan', 'pembuat'];

    public function getFotoCsr($id = false)
    {
        if ($id == false) {
            return $this->orderBy('nama_foto')->findAll();
        }

        return $this->where(['id_csr' => $id])->findAll();
    }

    public function getCountFotoCsr($id = 0)
    {
        return $this->where(['id_csr' => $id])->countAllResults();
    }
}
