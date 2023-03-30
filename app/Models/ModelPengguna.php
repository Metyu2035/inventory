<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPengguna extends Model
{
    protected $table            = 'pengguna';
    protected $primaryKey       = 'id_user';
    protected $allowedFields    = [
        'nama', 'jabatan', 'username', 'password', 'email', 'id_level'
    ];

    function tampil()
    {
        $sql = "SELECT id_user, nama, jabatan, username, password, email, pengguna.id_level, level.nama_level as hak_akses 
        FROM `pengguna` 
        INNER JOIN level ON pengguna.id_level = level.id_level
        ORDER BY nama ASC";
        $data = $this->db->query($sql);
        $array = $data->getResultArray();
        return $array;
    }

    function cek_id()
    {
        $sql = "SELECT max(`id_user`) AS `totalId` FROM `pengguna`";
        $data = $this->db->query($sql);
        return $data;
    }

    function cek_username($username)
    {
        $builder = $this->db->table('pengguna')->where('username', $username);
        $row = $builder->get()->getRow();
        return $row;
    }

    function cek_password($password)
    {
        $builder = $this->db->table('pengguna')->where('password', $password);
        $row = $builder->get()->getRow();
        return $row;
    }

    function totalPengguna()
    {
        $sql = "SELECT * FROM pengguna";
        $query = $this->db->query($sql);
        $total = $query->getNumRows();
        return $total;
    }
}
