<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSupplier extends Model
{
    protected $table            = 'supplier';
    protected $primaryKey       = 'id_supplier';
    protected $allowedFields    = [
        'nama', 'kota'
    ];

    function totalSupplier()
    {
        $sql = "SELECT * FROM supplier";
        $query = $this->db->query($sql);
        $total = $query->getNumRows();
        return $total;
    }
}
