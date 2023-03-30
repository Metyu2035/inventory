<?php

namespace App\Controllers;

use App\Models\ModelPengguna;
use App\Models\ModelBarang;
use App\Models\ModelBarangMasuk;
use App\Models\ModelBarangkeluar;
use App\Models\ModelKategori;
use App\Models\ModelSupplier;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    // Fungsi ketika halaman dashboard diakses
    public function index()
    {
        // Ketika belum login kembali ke halaman login
        if (!session('jabatan')) {
            return redirect()->to((base_url('/')));
        }

        // Memanggil setiap model menu
        $pengguna = new ModelPengguna();
        $barang = new ModelBarang();
        $kategori = new ModelKategori();
        $supplier = new ModelSupplier();
        $masuk = new ModelBarangMasuk();
        $keluar = new ModelBarangkeluar();

        // Menghitung jumlah data pengguna
        $total1 = $pengguna->totalPengguna();
        
        // Menghitung jumlah data barang
        $total2 = $barang->totalBarang();

        // Menghitung jumlah data kategori
        $total3 = $kategori->totalKategori();

        // Menghitung jumlah data supplier
        $total4 = $supplier->totalSupplier();
        
        // Menghitung jumlah data barang masuk
        $total5 = $masuk->totalMasuk();

        // Menghitung jumlah data barang keluar
        $total6 = $keluar->totalKeluar();

        $data = [
            'judul' => 'DASHBOARD',
            'totPengguna' => $total1,
            'totBarang' => $total2,
            'totKategori' => $total3,
            'totSupplier' => $total4,
            'totMasuk' => $total5,
            'totKeluar' => $total6,
        ];

        echo view('layout/header', $data);
        echo view('layout/navbar', $data);
        echo view('layout/sidebar', $data);
        echo view('dashboard/index', $data);
        echo view('layout/footer', $data);
    }

    // Fungsi ketika halaman pengguna diakses
    public function pengguna()
    {
        // Ketika belum login kembali ke halaman login
        if (!session('jabatan')) {
            return redirect()->to((base_url('/')));
        }

        // Ketika yang mengakses bukan Administrasi
        if (session('jabatan') != "Administrasi") {
            return redirect()->to((base_url('dashboard')));
        }

        // Memanggil model pengguna
        $pengguna = new ModelPengguna();

        // Mengambil semua data pengguna dengan query builder
        $array = $pengguna->findAll();

        // Mengambil semua data pengguna
        $test = $pengguna->tampil();

        $data = [
            'judul' => 'PENGGUNA',
            'tabel' => 'TABEL DATA PENGGUNA',
            'subjudul' => 'DATA PENGGUNA',
            'pengguna' => $test,
        ];

        echo view('layout/header', $data);
        echo view('layout/navbar', $data);
        echo view('layout/sidebar', $data);
        echo view('dashboard/pengguna', $data);
        echo view('layout/footer', $data);
    }

    // Fungsi ketika proses tambah pengguna diakses
    public function tambahPengguna()
    {
        // Validasi data input login
        $validasi = $this->validate([

            // Validasi nama
            'nama' => [
                'rules' => 'required|alpha_space|max_length[50]',
                'errors' => [
                    'required' => 'Nama Harus Terisi !',
                    'alpha_space' => 'Nama Harus Huruf !',
                    'max_length' => 'Nama Maximal 50 Huruf !',
                ]
            ],

            // Validasi jabatan
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jabatan Harus Terisi !',
                ]
            ],

            // Validasi username
            'username' => [
                'rules'  => 'required|min_length[4]|max_length[8]|alpha|is_unique[pengguna.username]',
                'errors' => [
                    'required' => 'Username Harus Terisi !',
                    'min_length' => 'Username Minimal 4 Huruf !',
                    'max_length' => 'Username Maximal 8 Huruf !',
                    'alpha' => 'Username Harus Huruf !',
                    'is_unique' => 'Username Sudah Terdaftar !',
                ]
            ],

            // Validasi password
            'password' => [
                'rules'  => 'required|min_length[4]|max_length[10]|numeric',
                'errors' => [
                    'required' => 'Password Harus Terisi !',
                    'min_length' => 'Password Minimal 4 Angka !',
                    'max_length' => 'Password Maximal 10 Angka !',
                    'numeric' => 'Password Harus Angka !',
                ]
            ],

            // Validasi email
            'email' => [
                'rules'  => 'required|max_length[40]|valid_email|valid_emails',
                'errors' => [
                    'required' => 'Email Harus Terisi !',
                    'max_length' => 'Email Maximal 40 Huruf !',
                    'valid_email' => 'Email Harus Valid !',
                    'valid_emails' => 'Email Harus Valid !',
                ]
            ],

            // Validasi level
            'level' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Hak Akses Harus Terisi !',
                ]
            ],
        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('/registrasi')))->withInput()->with('validate', $isivalidasi);
        }

        // Menangkap inputan ke data array
        $data = [
            'nama' => $_POST['nama'],
            'jabatan' => $_POST['jabatan'],
            'username' => $_POST['username'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'email' => $_POST['email'],
            'id_level' => $_POST['level'],
        ];

        // Memanggil model pengguna
        $pengguna = new ModelPengguna();

        // Memasukan hasil data array ke database
        $insert = $pengguna->insert($data);

        // Jika berhasil maka memberi pesan dan kembali ke halaman pengguna
        if ($insert) {
            session()->setFlashdata('pesan', 'Berhasil Membuat Akun !');
            return redirect()->to(base_url('dashboard/pengguna'));
        }
    }

    // Fungsi ketika proses ubah pengguna diakses
    public function ubahPengguna()
    {
        // Validasi data input login
        $validasi = $this->validate([

            // Validasi nama
            'nama' => [
                'rules' => 'required|alpha_space|max_length[50]',
                'errors' => [
                    'required' => 'Nama Harus Terisi !',
                    'alpha_space' => 'Nama Harus Huruf !',
                    'max_length' => 'Nama Maximal 50 Huruf !',
                ]
            ],

            // Validasi jabatan
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jabatan Harus Terisi !',
                ]
            ],

            // Validasi email
            'email' => [
                'rules'  => 'required|max_length[40]|valid_email|valid_emails',
                'errors' => [
                    'required' => 'Email Harus Terisi !',
                    'max_length' => 'Email Maximal 40 Huruf !',
                    'valid_email' => 'Email Harus Valid !',
                    'valid_emails' => 'Email Harus Valid !',
                ]
            ],

            // Validasi level
            'level' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Hak Akses Harus Terisi !',
                ]
            ],
        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('dashboard/pengguna')))->withInput()->with('validate', $isivalidasi);
        }

        // Menangkap id data yang ingin diubah
        $id = ['id_user' => $_POST['id']];

        // Menangkap inputan ke data array
        $data = [
            'nama' => $_POST['nama'],
            'jabatan' => $_POST['jabatan'],
            'email' => $_POST['email'],
            'id_level' => $_POST['level'],
        ];

        // Memanggil model pengguna
        $pengguna = new ModelPengguna();

        // Mengubah hasil data array ke database
        $insert = $pengguna->update($id, $data);

        // Jika berhasil maka memberi pesan dan kembali ke halaman pengguna
        if ($insert) {
            session()->setFlashdata('pesan', 'Berhasil Mengubah Pengguna !');
            return redirect()->to(base_url('dashboard/pengguna'));
        }
    }

    // Fungsi ketika proses hapus pengguna diakses
    public function hapusPengguna()
    {
        // Menangkap id dari pengguna
        $id = ['id_user' => $_POST['id']];

        // Memanggil model pengguna
        $pengguna = new ModelPengguna();

        // Menghapus pengguna dari database
        $hapus = $pengguna->delete($id, false);

        // Jika hapus data berhasil
        if ($hapus) {
            session()->setFlashdata('pesan', 'Berhasil Menghapus Pengguna !');
            return redirect()->to(base_url('dashboard/pengguna'));
        }
    }

    // Fungsi ketika halaman barang diakses
    public function barang()
    {
        // Ketika belum login kembali ke halaman login
        if (!session('jabatan')) {
            return redirect()->to((base_url('/')));
        }

        if (session('jabatan') == "Administrasi") {
            return redirect()->to((base_url('dashboard')));
        }

        // Memanggil model pengguna
        $barang = new ModelBarang();
        $kategori = new ModelKategori();
        $suppplier = new ModelSupplier();

        // Mengambil semua data pengguna dengan query builder
        $array1 = $barang->findAll();
        $array2 = $kategori->findAll();
        $array3 = $suppplier->findAll();

        // Mengambil semua data pengguna
        $test = $barang->tampil();

        $data = [
            'judul' => 'BARANG',
            'tabel' => 'TABEL DATA BARANG',
            'subjudul' => 'DATA BARANG',
            'barang' => $test,
            'kategori' => $array2,
            'supplier' => $array3,
        ];

        echo view('layout/header', $data);
        echo view('layout/navbar', $data);
        echo view('layout/sidebar', $data);
        echo view('dashboard/barang', $data);
        echo view('layout/footer', $data);
    }

    // Fungsi ketika proses tambah barang diakses
    public function tambahBarang()
    {
        // Validasi data input barang
        $validasi = $this->validate([

            // Validasi nama
            'nama' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama Barang Harus Terisi !',
                    'max_length' => 'Nama Maximal 50 Huruf !',
                ]
            ],

            // Validasi kota
            'kode' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode Barang Harus Terisi !',
                ]
            ],

            // Validasi stok
            // 'stok' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => 'Stok Harus Terisi !',
            //     ]
            // ],

            // Validasi keterangan
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Harus Terisi !',
                ]
            ],

            // Validasi kategori
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori Harus Terisi !',
                ]
            ],

            // Validasi supplier
            'supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Supplier Harus Terisi !',
                ]
            ],
        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('dashboard/barang')))->withInput()->with('validate', $isivalidasi);
        }

        // Memanggil model barang
        $barang = new ModelBarang();

        // Menangkap inputan dari form tambah barang
        $data = [
            'nama' => $_POST['nama'],
            'stok' => $_POST['stok'],
            'kode_barang' => $_POST['kode'],
            'keterangan' => $_POST['keterangan'],
            'id_kategori' => $_POST['kategori'],
            'id_supplier' => $_POST['supplier'],
        ];

        // Masukan data ke database
        $insert = $barang->insert($data);

        // Jika tambah data berhasil maka
        if ($insert) {
            session()->setFlashdata('pesan', 'Berhasil Menambah Barang !');
            return redirect()->to(base_url('dashboard/barang'));
        }

    }

    // Fungsi ketika proses ubah barang diakses
    public function ubahBarang()
    {
        // Validasi data input barang
        $validasi = $this->validate([

            // Validasi nama
            'nama' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama Barang Harus Terisi !',
                    'max_length' => 'Nama Maximal 50 Huruf !',
                ]
            ],

            // Validasi kota
            'kode' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode Barang Harus Terisi !',
                ]
            ],

            // Validasi keterangan
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Harus Terisi !',
                ]
            ],

            // Validasi kategori
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori Harus Terisi !',
                ]
            ],

            // Validasi supplier
            'supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Supplier Harus Terisi !',
                ]
            ],
        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('dashboard/barang')))->withInput()->with('validate', $isivalidasi);
        }

        // Memanggil model barang
        $barang = new ModelBarang();

        // Menangkap id data yang ingin diubah
        $id = ['id_barang' => $_POST['id']];

        // Menangkap data yang diinput dari form ubah barang
        $data = [
            'nama' => $_POST['nama'],
            'kode_barang' => $_POST['kode'],
            'id_kategori' => $_POST['kategori'],
            'keterangan' => $_POST['keterangan'],
            'id_supplier' => $_POST['supplier'],
        ];

        // Mengubah data ke database
        $update = $barang->update($id, $data);

        // Jika tambah data berhasil maka
        if ($update) {
            session()->setFlashdata('pesan', 'Berhasil Merubah Barang !');
            return redirect()->to(base_url('dashboard/barang'));
        }
    }

    // Fungsi ketika proses hapus barang diakses
    public function hapusBarang()
    {
        // Menangkap id dari barang
        $id = ['id_barang' => $_POST['id']];

        // Memanggil model barang
        $barang = new ModelBarang();

        // Menghapus pengguna dari database
        $hapus = $barang->delete($id, false);

        // Jika hapus data berhasil
        if ($hapus) {
            session()->setFlashdata('pesan', 'Berhasil Menghapus Barang !');
            return redirect()->to(base_url('dashboard/barang'));
        }
    }

    // Fungsi ketika halaman kategori diakses
    public function kategori()
    {
        // Ketika belum login kembali ke halaman login
        if (!session('jabatan')) {
            return redirect()->to((base_url('/')));
        }

        if (session('jabatan') == "Administrasi" || session('jabatan') == "Kepala Gudang") {
            return redirect()->to((base_url('dashboard')));
        }

        // Memanggil model kategori
        $kategori = new ModelKategori();

        // Mengambil semua data kategori dengan query builder
        $array = $kategori->findAll();

        $data = [
            'judul' => 'KATEGORI',
            'tabel' => 'TABEL DATA KATEGORI',
            'subjudul' => 'DATA KATEGORI',
            'kategori' => $array,
        ];

        echo view('layout/header', $data);
        echo view('layout/navbar', $data);
        echo view('layout/sidebar', $data);
        echo view('dashboard/kategori', $data);
        echo view('layout/footer', $data);
    }

    // Fungsi ketika proses tambah kategori diakses
    public function tambahKategori()
    {
        // Validasi data input kategori
        $validasi = $this->validate([

            // Validasi nama
            'nama' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama Kategori Harus Terisi !',
                    'max_length' => 'Nama Maximal 50 Huruf !',
                ]
            ],
        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('dashboard/kategori')))->withInput()->with('validate', $isivalidasi);
        }

        // Memanggil model kategori
        $kategori = new ModelKategori();

        // Menangkap data yang diinput form tambah kategori
        $data = ['nama' => $_POST['nama']];

        // Memasukan data ke database
        $insert = $kategori->insert($data);

        // Jika tambah data berhasil maka
        if ($insert) {
            session()->setFlashdata('pesan', 'Berhasil Menambah Kategori !');
            return redirect()->to(base_url('dashboard/kategori'));
        }
    }

    // Fungsi ketika proses ubah kategori diakses
    public function ubahKategori()
    {
        // Validasi data input kategori
        $validasi = $this->validate([

            // Validasi nama
            'nama' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama Kategori Harus Terisi !',
                    'max_length' => 'Nama Maximal 50 Huruf !',
                ]
            ],
        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('dashboard/kategori')))->withInput()->with('validate', $isivalidasi);
        }

        // Memanggil model kategori
        $kategori = new ModelKategori();

        // Mengkap id kategori yang ingin diubah
        $id = ['id_kategori' => $_POST['id']];

        // Menangkap data yang diinput form tambah kategori
        $data = ['nama' => $_POST['nama']];

        // Memasukan data ke database
        $update = $kategori->update($id, $data);

        // Jika tambah data berhasil maka
        if ($update) {
            session()->setFlashdata('pesan', 'Berhasil Mengubah Kategori !');
            return redirect()->to(base_url('dashboard/kategori'));
        }
    }

    // Fungsi ketika proses hapus kategori diakses
    public function hapusKategori()
    {
        // Menangkap id dari kategori
        $id = ['id_kategori' => $_POST['id']];

        // Memanggil model kategori
        $kategori = new ModelKategori();

        // Menghapus pengguna dari database
        $hapus = $kategori->delete($id, false);

        // Jika hapus data berhasil
        if ($hapus) {
            session()->setFlashdata('pesan', 'Berhasil Menghapus Kategori !');
            return redirect()->to(base_url('dashboard/kategori'));
        }
    }

    // Fungsi ketika halaman supplier diakses
    public function supplier()
    {
        // Ketika belum login kembali ke halaman login
        if (!session('jabatan')) {
            return redirect()->to((base_url('/')));
        }

        if (session('jabatan') == "Administrasi" || session('jabatan') == "Kepala Gudang") {
            return redirect()->to((base_url('dashboard')));
        }

        // Memanggil model supplier
        $supplier = new ModelSupplier();

        // Mengambil semua data supplier dengan query builder
        $array = $supplier->findAll();

        $data = [
            'judul' => 'SUPPLIER',
            'tabel' => 'TABEL DATA SUPPLIER',
            'subjudul' => 'DATA SUPPLIER',
            'supplier' => $array,
        ];

        echo view('layout/header', $data);
        echo view('layout/navbar', $data);
        echo view('layout/sidebar', $data);
        echo view('dashboard/supplier', $data);
        echo view('layout/footer', $data);
    }

    // Fungsi ketika proses tambah supplier diakses
    public function tambahSupplier()
    {
        // Validasi data input supplier
        $validasi = $this->validate([

            // Validasi nama
            'nama' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama Supplier Harus Terisi !',
                    'max_length' => 'Nama Maximal 50 Huruf !',
                ]
            ],

            // Validasi nama
            'kota' => [
                'rules' => 'required|max_length[30]|alpha_space',
                'errors' => [
                    'required' => 'Kota Harus Terisi !',
                    'alpha_space' => 'Kota Harus Huruf !',
                    'max_length' => 'Nama Maximal 30 Huruf !',
                ]
            ],
        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('dashboard/supplier')))->withInput()->with('validate', $isivalidasi);
        }

        // Memanggil model supplier
        $supplier = new ModelSupplier();

        // Menangkap data yang diinput form tambah supplier
        $data = [
            'nama' => $_POST['nama'],
            'kota' => $_POST['kota'],
        ];

        // Memasukan data ke database
        $insert = $supplier->insert($data);

        // Jika masukan data berhasil maka
        if ($insert) {
            session()->setFlashdata('pesan', 'Berhasil Menambah Supplier !');
            return redirect()->to((base_url('dashboard/supplier')));
        }
    }

    // Fungsi ketika proses ubah supplier diakses
    public function ubahSupplier()
    {
        // Validasi data input supplier
        $validasi = $this->validate([

            // Validasi nama
            'nama' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama Supplier Harus Terisi !',
                    'max_length' => 'Nama Maximal 50 Huruf !',
                ]
            ],

            // Validasi nama
            'kota' => [
                'rules' => 'required|max_length[30]|alpha_space',
                'errors' => [
                    'required' => 'Kota Harus Terisi !',
                    'alpha_space' => 'Kota Harus Huruf !',
                    'max_length' => 'Nama Maximal 30 Huruf !',
                ]
            ],
        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('dashboard/supplier')))->withInput()->with('validate', $isivalidasi);
        }

        // Memanggil model supplier
        $supplier = new ModelSupplier();

        // Menangkap id supplier yang ingin diubah
        $id = ['id_supplier' => $_POST['id']];

        // Menangkap data yang diinput form ubah supplier
        $data = [
            'nama' => $_POST['nama'],
            'kota' => $_POST['kota'],
        ];

        // Mengubah data ke database
        $update = $supplier->update($id, $data);

        // Jika mengubah data berhasil maka
        if ($update) {
            session()->setFlashdata('pesan', 'Berhasil Merubah Supplier !');
            return redirect()->to((base_url('dashboard/supplier')));
        }
    }

    // Fungsi ketika proses hapus supplier diakses
    public function hapusSupplier()
    {
        // Memanggil model suppplier
        $supplier = new ModelSupplier();

        // Menangkap id supplier yang ingin dihapus
        $id = ['id_supplier' => $_POST['id']];

        // Menghaspus data ke database
        $hapus = $supplier->delete($id, false);

        // Jika menghapus data berhasil maka
        if ($hapus) {
            session()->setFlashdata('pesan', 'Berhasil Menghaspus Supplier !');
            return redirect()->to((base_url('dashboard/supplier')));
        }
    }

    // Fungsi ketika halaman barang masuk diakses
    public function barangmasuk()
    {
        // Ketika belum login kembali ke halaman login
        if (!session('jabatan')) {
            return redirect()->to((base_url('/')));
        }

        if (session('jabatan') == "Administrasi") {
            return redirect()->to((base_url('dashboard')));
        }

        // Memanggil model pengguna
        $masuk = new ModelBarangMasuk();
        $barang = new ModelBarang();
        $suppplier = new ModelSupplier();

        // Mengambil semua data pengguna dengan query builder
        $array1 = $barang->findAll();
        $array2 = $suppplier->findAll();

        // Mengambil semua data pengguna
        $test = $masuk->tampil();

        $data = [
                'judul' => 'BARANG MASUK',
                'tabel' => 'TABEL DATA BARANG MASUK',
                'subjudul' => 'DATA BARANG MASUK',
                'barangmsk' => $test,
                'barang' => $array1,
                'supplier' => $array2,
            ];

        echo view('layout/header', $data);
        echo view('layout/navbar', $data);
        echo view('layout/sidebar', $data);
        echo view('dashboard/masuk', $data);
        echo view('layout/footer', $data);
    }

    // Fungsi ketika proses tambah barang masuk diakses
    public function tambahMasuk()
    {
        // Validasi data input barang masuk
        $validasi = $this->validate([

            // Validasi tanggal
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Harus Terisi !'
                ]
            ],

            // Validasi no orderan
            'order' => [
                'rules' => 'required|max_length[10]|',
                'errors' => [
                    'required' => 'No Order Harus Terisi !',
                    'max_length' => 'No Order Maximal 10 Karakter !',
                ]
            ],

            // Validasi nama barang
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Barang Harus Terisi !'
                ]
            ],

            // Validasi nama barang
            'supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Supplier Harus Terisi !'
                ]
            ],

            // Validasi jumlah
            'jumlah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah Barang Harus Terisi !',
                    'numeric' => 'Jumlah Barang Harus Angka !'
                ]
            ],

            // Validasi keterangan
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Harus Terisi !'
                ]
            ],
        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('dashboard/barangmasuk')))->withInput()->with('validate', $isivalidasi);
        }

        // Memanggil model barang masuk
        $masuk = new ModelBarangMasuk();

        // Menangkap inputan dari form tambah barang masuk
        $data = [
            'tanggal_masuk' => $_POST['tanggal'],
            'no_order' => $_POST['order'],
            'id_barang' => $_POST['nama'],
            'id_supplier' => $_POST['supplier'],
            'jumlah' => $_POST['jumlah'],
            'keterangan' => $_POST['keterangan'],
        ];

        // Memasukan data ke database
        $insert = $masuk->insert($data);

        // Jika tambah data berhasil maka
        if ($insert) {
            session()->setFlashdata('pesan', 'Berhasil Menambah Barang Masuk !');
            return redirect()->to((base_url('dashboard/barangmasuk')));
        }

    }

    // Fungsi ketika proses ubah barang masuk diakses
    public function ubahMasuk()
    {
        // Validasi data input barang masuk
        $validasi = $this->validate([

            // Validasi no orderan
            'order' => [
                'rules' => 'required|max_length[10]|',
                'errors' => [
                    'required' => 'No Order Harus Terisi !',
                    'max_length' => 'No Order Maximal 10 Karakter !',
                ]
            ],

            // Validasi jumlah
            'jumlah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah Barang Harus Terisi !',
                    'numeric' => 'Jumlah Barang Harus Angka !'
                ]
            ],

            // Validasi keterangan
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Harus Terisi !'
                ]
            ],
        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('dashboard/barangmasuk')))->withInput()->with('validate', $isivalidasi);
        }

        // Memanggil model barang masuk
        $masuk = new ModelBarangMasuk();

        // Menangkap id barang masuk yang ingin diubah
        $id = ['id_masuk' => $_POST['id']];

        // Menangkap inputan dari form tambah barang masuk
        $data = [
            'no_order' => $_POST['order'],
            'id_barang' => $_POST['nama'],
            'id_supplier' => $_POST['supplier'],
            'jumlah' => $_POST['jumlah'],
            'keterangan' => $_POST['keterangan'],
        ];

        // Memasukan data ke database
        $update = $masuk->update($id, $data);

        // Jika ubah data berhasil maka
        if ($update) {
            session()->setFlashdata('pesan', 'Berhasil Merubah Barang Masuk !');
            return redirect()->to((base_url('dashboard/barangmasuk')));
        }
    }

    // Fungsi ketika proses ubah barang masuk diakses
    public function hapusMasuk()
    {
        // Memanggil model barang masuk
        $masuk = new ModelBarangMasuk();

        // Menangkap id barang masuk yang ingin dihapus
        $id = ['id_masuk' => $_POST['id']];

        $hapus = $masuk->delete($id, false);

        // Jika hapus data berhasil maka
        if ($hapus) {
            session()->setFlashdata('pesan', 'Berhasil Menghapus Barang Masuk !');
            return redirect()->to((base_url('dashboard/barangmasuk')));
        }

    }

    // Fungsi ketika halaman barang masuk diakses
    public function barangkeluar()
    {
        // Ketika belum login kembali ke halaman login
        if (!session('jabatan')) {
            return redirect()->to((base_url('/')));
        }

        if (session('jabatan') == "Administrasi") {
            return redirect()->to((base_url('dashboard')));
        }

        // Memanggil model pengguna
        $keluar = new ModelBarangKeluar();
        $barang = new ModelBarang();

        // Mengambil semua data pengguna dengan query builder
        $array1 = $barang->findAll();

        // Mengambil semua data barang masuk
        $test = $keluar->tampil();

        $data = [
            'judul' => 'BARANG KELUAR',
            'tabel' => 'TABEL DATA BARANG KELUAR',
            'subjudul' => 'DATA BARANG KELUAR',
            'barangklr' => $test,
            'barang' => $array1,
        ];

        echo view('layout/header', $data);
        echo view('layout/navbar', $data);
        echo view('layout/sidebar', $data);
        echo view('dashboard/keluar', $data);
        echo view('layout/footer', $data);
    }

    // Fungsi ketika tambah barang keluar diakses
    public function tambahKeluar()
    {
        // Validasi data input barang keluar
        $validasi = $this->validate([

            // Validasi tanggal
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Harus Terisi !'
                ]
            ],

            // Validasi no orderan
            'order' => [
                'rules' => 'required|max_length[10]|',
                'errors' => [
                    'required' => 'No Order Harus Terisi !',
                    'max_length' => 'No Order Maximal 10 Karakter !',
                ]
            ],

            // Validasi nama barang
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Barang Harus Terisi !'
                ]
            ],

            // Validasi jumlah
            'jumlah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah Barang Harus Terisi !',
                    'numeric' => 'Jumlah Barang Harus Angka !'
                ]
            ],

            // Validasi customer
            'customer' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama Customer Harus Terisi !',
                    'max_length' => 'Nama Customer Maximal 50 Huruf !',
                ]
            ],

            // Validasi keterangan
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Harus Terisi !'
                ]
            ],
        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('dashboard/barangkeluar')))->withInput()->with('validate', $isivalidasi);
        }

        // Memanggil model barang keluar
        $keluar = new ModelBarangkeluar();

        // Menangkap data inputan dari form tambah barang masuk
        $data = [
            'tanggal_keluar' => $_POST['tanggal'],
            'no_order' => $_POST['order'],
            'id_barang' => $_POST['nama'],
            'customer' => $_POST['customer'],
            'jumlah' => $_POST['jumlah'],
            'keterangan' => $_POST['keterangan'],
        ];

        // Memasukan data ke database
        $insert = $keluar->insert($data);

        // Jika tambah data barang keluar berhasil maka
        if ($insert) {
            session()->setFlashdata('pesan', 'Berhasil Menambah Barang Keluar !');
            return redirect()->to((base_url('dashboard/barangkeluar')));
        }
    }

    // Fungsi ketika ubah barang keluar diakses
    public function ubahKeluar()
    {
        // Validasi data input barang keluar
        $validasi = $this->validate([

            // Validasi no orderan
            'order' => [
                'rules' => 'required|max_length[10]|',
                'errors' => [
                    'required' => 'No Order Harus Terisi !',
                    'max_length' => 'No Order Maximal 10 Karakter !',
                ]
            ],

            // Validasi jumlah
            'jumlah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah Barang Harus Terisi !',
                    'numeric' => 'Jumlah Barang Harus Angka !'
                ]
            ],

            // Validasi customer
            'customer' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama Customer Harus Terisi !',
                    'max_length' => 'Nama Customer Maximal 50 Huruf !',
                ]
            ],

            // Validasi keterangan
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Harus Terisi !'
                ]
            ],
        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('dashboard/barangkeluar')))->withInput()->with('validate', $isivalidasi);
        }

        // Memanggil model barang keluar
        $keluar = new ModelBarangkeluar();

        // Menangkap data inputan dari form ubah barang keluar
        $data = [
            'no_order' => $_POST['order'],
            'id_barang' => $_POST['nama'],
            'customer' => $_POST['customer'],
            'jumlah' => $_POST['jumlah'],
            'keterangan' => $_POST['keterangan'],
        ];

        // Menangkap id barang keluar yang ingin diubah
        $id = ['id_keluar' => $_POST['id']];

        // Merubah data ke database
        $update = $keluar->update($id, $data);

        // Jika tambah data barang keluar berhasil maka
        if ($update) {
            session()->setFlashdata('pesan', 'Berhasil Merubah Barang Keluar !');
            return redirect()->to((base_url('dashboard/barangkeluar')));
        }
    }

    // Fungsi ketika hapus barang keluar diakses
    public function hapusKeluar()
    {
        // Mengangkap id barang keluar yang mau dihapus
        $id = ['id_keluar' => $_POST['id']];

        // Memanggil model barang keluar
        $keluar = new ModelBarangkeluar();

        // Menghapus data ke database
        $hapus = $keluar->delete($id, false);

        if ($hapus) {
            session()->setFlashdata('pesan', 'Berhasil Menghapus Barang Keluar !');
            return redirect()->to((base_url('dashboard/barangkeluar')));
        }
    }
}
