<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBarangMasuk;
use App\Models\ModelBarangkeluar;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends BaseController
{
    // Fungsi ketika halaman laporan barang masuk diakses
    public function laporanMasuk()
    {
        // Ketika belum login kembali ke halaman login
        if (!session('jabatan')) {
            return redirect()->to((base_url('/')));
        }

        if (session('jabatan') == "Administrasi" || session('jabatan') == "Staff Gudang") {
            return redirect()->to((base_url('dashboard')));
        }

        $data = [
            'judul' => 'LAPORAN BARANG MASUK',
            'laporanmasuk' => 'LAPORAN BARANG MASUK',
        ];

        echo view('layout/header', $data);
        echo view('layout/navbar', $data);
        echo view('layout/sidebar', $data);
        echo view('laporan/masuk', $data);
        echo view('layout/footer', $data);
    }

    // Fungsi ketika proses cetak laporan barang masuk diakses
    public function cetakMasuk()
    {
        // Validasi data input laporan barang masuk
        $validasi = $this->validate([

            // Validasi nama
            'tanggalAwal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Awal Harus Terisi !',
                ]
            ],

            // Validasi jabatan
            'tanggalAkhir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Akhir Harus Terisi !',
                ]
            ],
        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('/laporan/laporanMasuk')))->withInput()->with('validate', $isivalidasi);
        }

        // Menangkap nama button
        $print  = $this->request->getPost('tombolPrint');
        $excel = $this->request->getPost('tombolExcel');

        // Menangkap inputan form laporan barang masuk
        $tanggalAwal  = $this->request->getPost('tanggalAwal');
        $tanggalAkhir = $this->request->getPost('tanggalAkhir');

        // Memanggil model barang masuk
        $CetakMasuk = new ModelBarangMasuk();

        // Menggambil data ke database
        $array = $CetakMasuk->cetak($tanggalAwal, $tanggalAkhir);

        if (isset($print)) {
            $data = [
                'cetak' => $array,
                'tanggalAwal' => $tanggalAwal,
                'tanggalAkhir' => $tanggalAkhir
            ];

            return view('laporan/cetakMasuk', $data);
        }

        if (isset($excel)) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Inisialiasi judul
            $sheet->setCellValue('A1', 'Laporan Barang Masuk ' . dateindo($tanggalAwal) . ' s/d ' . dateindo($tanggalAkhir));
            $sheet->mergeCells('A1:G1');

            // Inisialiasi judul isi kolom 
            $sheet->setCellValue('A3', "No");
            $sheet->setCellValue('B3', "Tanggal Masuk");
            $sheet->setCellValue('C3', "No Order");
            $sheet->setCellValue('D3', "Barang");
            $sheet->setCellValue('E3', "Supplier");
            $sheet->setCellValue('F3', "Keterangan");
            $sheet->setCellValue('G3', "Jumlah");

            $no = 1;

            // Inisialiasi mulai isi kolom
            $colum = 4;

            // Inisialisasi isi kolom
            foreach ($array as $row) {
                $sheet->setCellValue('A' . $colum, $no);
                $sheet->setCellValue('B' . $colum, $row['tanggal_masuk']);
                $sheet->setCellValue('C' . $colum, $row['no_order']);
                $sheet->setCellValue('D' . $colum, $row['nama_barang']);
                $sheet->setCellValue('E' . $colum, $row['nama_supplier']);
                $sheet->setCellValue('F' . $colum, $row['keterangan']);
                $sheet->setCellValue('G' . $colum, $row['jumlah']);

                $no++;
                $colum++;
            }

            // Membuat judul kolom menjadi bold
            $sheet->getStyle('A1:G1')->getFont()->setBold(true);
            $sheet->getStyle('A3:G3')->getFont()->setBold(true);
            $sheet->getStyle('A3:G3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00C32D');

            // Membuat setiap kolom ada bordernya
            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ];

            $sheet->getStyle('A3:G' . ($colum - 1))->applyFromArray($styleArray);
            $sheet->getStyle('A1')->applyFromArray($styleArray);

            // Membuat kolom menjadi otomatasi untuk menyesuaikan ukuran dengan isi
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);

            // Memberi judul pada file excel
            $sheet->setTitle("Data Laporan Barang Masuk");

            // Memberikan nama file excel
            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename=Laporan Barang Masuk ' . date('d F Y || H:i:s') . '.xlsx');
            header('Cache-Control:max-age=0');

            // Mendowload file excel
            $writer->save('php://output');
            exit();
        }

        return view('laporan/cetakMasuk');
    }

    // Fungsi ketika proses excel laporan barang masuk diakses
    public function cetakMasukExcel()
    {
        // Validasi data input laporan barang masuk
        $validasi = $this->validate([

            // Validasi nama
            'tanggalAwal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Awal Harus Terisi !',
                ]
            ],

            // Validasi jabatan
            'tanggalAkhir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Akhir Harus Terisi !',
                ]
            ],
        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('/laporan/laporanMasuk')))->withInput()->with('validate', $isivalidasi);
        }

        // Menangkap inputan form laporan barang masuk
        $tanggalAwal  = $this->request->getPost('tanggalAwal');
        $tanggalAkhir = $this->request->getPost('tanggalAkhir');

        // Memanggil model barang masuk
        $CetakMasuk = new ModelBarangMasuk();

        // Menggambil data ke database
        $array = $CetakMasuk->cetak($tanggalAwal, $tanggalAkhir);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', "DATA LAPORAN BARANG MASUK");
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getFont()->setBold(true);

        $sheet->setCellValue('A3', "No");
        $sheet->setCellValue('B3', "Tanggal Masuk");
        $sheet->setCellValue('C3', "No Order");
        $sheet->setCellValue('D3', "Barang");
        $sheet->setCellValue('E3', "Customer");
        $sheet->setCellValue('F3', "Keterangan");
        $sheet->setCellValue('G3', "Jumlah");

        $no = 1;
        $numRows = 4;

        foreach ($array as $row) :
            $sheet->setCellValue('A' . $numRows, $no);
            $sheet->setCellValue('B' . $numRows, $row['tanggal_masuk']);
            $sheet->setCellValue('C' . $numRows, $row['no_order']);
            $sheet->setCellValue('D' . $numRows, $row['nama_barang']);
            $sheet->setCellValue('E' . $numRows, $row['nama_supplier']);
            $sheet->setCellValue('F' . $numRows, $row['keterangan']);
            $sheet->setCellValue('G' . $numRows, $row['jumlah']);

            $no++;
            $numRows++;
        endforeach;

        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->setTitle("Data Barang Masuk");

        header('Content-Type : application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename = "Laporan Barang Masuk.xlsx"');
        header('Cache-Control:max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    // Fungsi ketika halaman laporan barang keluar diakses
    public function laporanKeluar()
    {
        // Ketika belum login kembali ke halaman login
        if (!session('jabatan')) {
            return redirect()->to((base_url('/')));
        }

        if (session('jabatan') == "Administrasi" || session('jabatan') == "Staff Gudang") {
            return redirect()->to((base_url('dashboard')));
        }

        $data = [
            'judul' => 'LAPORAN BARANG KELUAR',
            'laporanmasuk' => 'LAPORAN BARANG KELUAR',
        ];

        echo view('layout/header', $data);
        echo view('layout/navbar', $data);
        echo view('layout/sidebar', $data);
        echo view('laporan/keluar', $data);
        echo view('layout/footer', $data);
    }

    // Fungsi ketika proses cetak laporan barang keluar diakses
    public function cetakKeluar()
    {
        // Validasi data input laporan barang keluar
        $validasi = $this->validate([

            // Validasi nama
            'tanggalAwal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Awal Harus Terisi !',
                ]
            ],

            // Validasi jabatan
            'tanggalAkhir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Akhir Harus Terisi !',
                ]
            ],
        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('/laporan/laporanKeluar')))->withInput()->with('validate', $isivalidasi);
        }

        // Menangkap nama button
        $print  = $this->request->getPost('tombolPrint');
        $excel = $this->request->getPost('tombolExcel');

        // Menangkap inputan form laporan barang keluar
        $tanggalAwal  = $this->request->getPost('tanggalAwal');
        $tanggalAkhir = $this->request->getPost('tanggalAkhir');

        // Memanggil model barang keluar
        $CetakKeluar = new ModelBarangKeluar();

        // Menggambil data ke database
        $array = $CetakKeluar->cetak($tanggalAwal, $tanggalAkhir);

        if (isset($print)) {
            $data = [
                'cetak' => $array,
                'tanggalAwal' => $tanggalAwal,
                'tanggalAkhir' => $tanggalAkhir
            ];

            return view('laporan/cetakKeluar', $data);
        }

        if (isset($excel)) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Inisialiasi judul
            $sheet->setCellValue('A1', 'Laporan Barang Keluar ' . dateindo($tanggalAwal) . ' s/d ' . dateindo($tanggalAkhir));
            $sheet->mergeCells('A1:G1');

            // Inisialiasi judul isi kolom 
            $sheet->setCellValue('A3', "No");
            $sheet->setCellValue('B3', "Tanggal Masuk");
            $sheet->setCellValue('C3', "No Order");
            $sheet->setCellValue('D3', "Barang");
            $sheet->setCellValue('E3', "Customer");
            $sheet->setCellValue('F3', "Keterangan");
            $sheet->setCellValue('G3', "Jumlah");

            $no = 1;

            // Inisialiasi mulai isi kolom
            $colum = 4;

            // Inisialisasi isi kolom
            foreach ($array as $row) {
                $sheet->setCellValue('A' . $colum, $no);
                $sheet->setCellValue('B' . $colum, $row['tanggal_keluar']);
                $sheet->setCellValue('C' . $colum, $row['no_order']);
                $sheet->setCellValue('D' . $colum, $row['nama_barang']);
                $sheet->setCellValue('E' . $colum, $row['customer']);
                $sheet->setCellValue('F' . $colum, $row['keterangan']);
                $sheet->setCellValue('G' . $colum, $row['jumlah']);

                $no++;
                $colum++;
            }

            // Membuat judul kolom menjadi bold
            $sheet->getStyle('A1:G1')->getFont()->setBold(true);
            $sheet->getStyle('A3:G3')->getFont()->setBold(true);
            $sheet->getStyle('A3:G3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00C32D');

            // Membuat setiap kolom ada bordernya
            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ];

            $sheet->getStyle('A3:G' . ($colum - 1))->applyFromArray($styleArray);
            $sheet->getStyle('A1')->applyFromArray($styleArray);

            // Membuat kolom menjadi otomatasi untuk menyesuaikan ukuran dengan isi
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);

            // Memberi judul pada file excel
            $sheet->setTitle("Data Laporan Barang Keluar");

            // Memberikan nama file excel
            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename=Laporan Barang Keluar ' . date('d F Y || H:i:s') . '.xlsx');
            header('Cache-Control:max-age=0');

            // Mendowload file excel
            $writer->save('php://output');
            exit();
        }
    }
}
