<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBarang extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'id_barang';
    protected $allowedFields    = [
        'kode_barang', 'nama', 'stok', 'keterangan', 'id_kategori', 'id_supplier'
    ];

    function tampil()
    {
        $sql = "SELECT id_barang, kode_barang, barang.nama, stok, keterangan, barang.id_kategori, barang.id_supplier, kategori.nama AS nama_kategori, supplier.nama AS nama_supplier 
        FROM `barang` 
        INNER JOIN kategori ON barang.id_kategori = kategori.id_kategori
        INNER JOIN supplier ON barang.id_supplier  = supplier.id_supplier 
        ORDER BY kode_barang ASC";
        $data = $this->db->query($sql);
        $array = $data->getResultArray();
        return $array;
    }

    function totalBarang()
    {
        $sql = "SELECT * FROM barang";
        $query = $this->db->query($sql);
        $total = $query->getNumRows();
        return $total;
    }

}
