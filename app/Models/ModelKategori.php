<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKategori extends Model
{
    protected $table            = 'kategori';
    protected $primaryKey       = 'id_kategori';
    protected $allowedFields    = [
        'nama'
    ];

    function totalKategori()
    {
        $sql = "SELECT * FROM kategori";
        $query = $this->db->query($sql);
        $total = $query->getNumRows();
        return $total;
    }
}
