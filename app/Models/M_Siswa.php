<?php 

namespace App\Models;

use CodeIgniter\Model;

class M_Siswa extends Model{

    protected $table = 'siswa';

    // koneksi database
    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    // mengambil data di table
    public function getAllData()
    {
        return $this->builder->get()->getResultArray();
    }

    // menambah data ke table
    public function tambah($data)
    {
        return $this->builder->insert($data);
    }

    // menghapus data table
    public function hapus($id)
    {
        return $this->builder->delete(array('id' => $id));
    }

    public function getDataById($id){
        $this->builder->where('id', $id);
        return $this->builder->get()->getRowArray();
    }

    // ubah data
    public function ubah($data, $id){
        return $this->builder->update($data, ['id' => $id]);
    }
}

?>