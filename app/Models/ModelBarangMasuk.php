<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBarangMasuk extends Model
{
    protected $table            = 'barang_masuk';
    protected $primaryKey       = 'id_masuk';
    protected $allowedFields    = [
        'no_order', 'tanggal_masuk', 'id_barang', 'id_supplier', 'jumlah', 'keterangan',
    ];

    public function tampil()
    {
        $sql = "SELECT id_masuk, no_order, tanggal_masuk, barang_masuk.id_barang, barang.nama AS nama_barang, supplier.nama AS nama_supplier, barang_masuk.id_supplier, jumlah, barang_masuk.keterangan FROM barang_masuk
                INNER JOIN barang ON barang_masuk.id_barang = barang.id_barang
                INNER JOIN supplier ON barang_masuk.id_supplier = supplier.id_supplier 
                ORDER BY tanggal_masuk ASC";
        $data = $this->db->query($sql);
        $array = $data->getResultArray();
        return $array;
    }

    public function totalMasuk()
    {
        $sql = "SELECT * FROM barang_masuk";
        $query = $this->db->query($sql);
        $total = $query->getNumRows();
        return $total;
    }

    public function cetak($tanggalAwal, $tanggalAkhir)
    {
        $sql = "SELECT id_masuk, tanggal_masuk, no_order, barang_masuk.id_barang, barang.nama AS nama_barang, 
        barang_masuk.id_supplier, supplier.nama AS nama_supplier, barang_masuk.keterangan, jumlah FROM barang_masuk
        INNER JOIN barang ON barang_masuk.id_barang = barang.id_barang
        INNER JOIN supplier ON barang_masuk.id_supplier = supplier.id_supplier 
        WHERE tanggal_masuk BETWEEN '$tanggalAwal' AND '$tanggalAkhir'
        ORDER BY nama_barang ASC";
        $query = $this->db->query($sql);
        $data = $query->getResultArray();
        return $data;
    }
}
 