<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBarangKeluar extends Model
{
    protected $table            = 'barang_keluar';
    protected $primaryKey       = 'id_keluar';
    protected $allowedFields    = [
        'no_order', 'tanggal_keluar', 'id_barang', 'customer', 'jumlah', 'keterangan',
    ];

    public function tampil()
    {
        $sql = "SELECT id_keluar, no_order, tanggal_keluar, customer, barang_keluar.id_barang, barang.nama AS nama_barang, jumlah, barang_keluar.keterangan FROM barang_keluar
                INNER JOIN barang ON barang_keluar.id_barang = barang.id_barang 
                ORDER BY tanggal_keluar ASC";
        $data = $this->db->query($sql);
        $array = $data->getResultArray();
        return $array;
    }

    public function totalKeluar()
    {
        $sql = "SELECT * FROM barang_keluar";
        $query = $this->db->query($sql);
        $total = $query->getNumRows();
        return $total;
    }

    public function cetak($tanggalAwal, $tanggalAkhir)
    {
        $sql = "SELECT id_keluar, no_order, tanggal_keluar, 
        barang_keluar.id_barang, barang.nama AS nama_barang, customer, jumlah, barang_keluar.keterangan 
        FROM barang_keluar
        INNER JOIN barang ON barang_keluar.id_barang = barang.id_barang
        WHERE tanggal_keluar BETWEEN '$tanggalAwal' AND '$tanggalAkhir'
        ORDER BY nama_barang ASC";
        $query = $this->db->query($sql);
        $data = $query->getResultArray();
        return $data;
    }
}
 