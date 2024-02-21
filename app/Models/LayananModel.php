<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table      = 'layanan';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['nama_layanan', 'id_petugas'];

    public function getLayanan($id = false)
    {
        if ($id == false) {
            $dept = [35];
            return $this->whereNotIn('id', $dept)->orderBy('nama_layanan')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getAllLayanan($id = false)
    {
        if ($id == false) {
            return $this->orderBy('nama_layanan')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getCountLayanan($id = false)
    {
        return $this->countAllResults();
    }
}
