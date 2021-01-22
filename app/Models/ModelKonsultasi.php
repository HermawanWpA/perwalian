<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKonsultasi extends Model
{
    protected $table = 'tblkonsultasi';

    public function __construct()
    {
        $this->connect = db_connect();
        $this->builder = $this->connect->table($this->table);
        // $this->validation = \Config\Services::validation();
        // $this->session = session();
    }
    public function getAllData()
    {
        return $this->builder->get();
    }


    public function getDataById($id)
    {

        $this->builder->where('nid', $id);
        return $this->builder->get()->getRowArray();
    }

    public function tambah($data)
    {
        return $this->builder->insert($data);
    }
    public function hapus($id)
    {
        return $this->builder->delete(['nid' => $id]);
    }
    public function ubah($data, $id)
    {
        return $this->builder->update($data, ['nid' => $id]);
    }
}
