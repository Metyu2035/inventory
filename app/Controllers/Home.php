<?php

namespace App\Controllers;

// Memanggil model dari folder Models
use App\Models\ModelPengguna;

use CodeIgniter\Exceptions\AlertError;

class Home extends BaseController
{
    // Fungsi ketika website pertama dibuka
    public function index()
    {
        // Ketika sudah login tidak bisa ke halaman login
        if (session('jabatan')) {
            return redirect()->to((base_url('dashboard')));
        }

        return view('login');
    }

    // Fungsi ketika halaman registrasi diakses
    public function registrasi()
    {
        if (session('jabatan') != "Administrasi") {
            return redirect()->to((base_url('dashboard')));
        }

        if (!session('jabatan')) {
            return redirect()->to((base_url('/')));
        }

        return view('registrasi');
    }

    // Fungsi ketika proses login diakses
    public function login()
    {
        // Validasi data input login
        $validasi = $this->validate([

            // Validasi username
            'username' => [
                'rules'  => 'required|min_length[4]|max_length[8]|alpha',
                'errors' => [
                    'required' => 'Username Harus Terisi !',
                    'min_length' => 'Username Minimal 4 Huruf !',
                    'max_length' => 'Username Maximal 8 Huruf !',
                    'alpha' => 'Username Harus Huruf !',
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
        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('/')))->withInput()->with('validate', $isivalidasi);
        }

        // Menangkap inputan user di form login
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Memanggil varibel model
        $pengguna = new ModelPengguna();

        // Fungsi cek username dan password ke database
        $fieldU = $pengguna->cek_username($username);
        $fieldP = $pengguna->cek_password($password);

        // // Jika username dan password yang di input salah
        // if (!$fieldU && !$fieldP) {
        //     session()->setFlashdata('error', 'Username & Password Salah !');
        //     return redirect()->to(base_url('/'));
        // }

        // Jika username tidak terdaftar
        if (!$fieldU) {
            session()->setFlashdata('error', 'Username Tidak Terdaftar !');
            return redirect()->to(base_url('/'));
        }
        // Jika password yang di input salah
        if (!password_verify($password, $fieldU->password)) {
            session()->setFlashdata('error', 'Password Salah !');
            return redirect()->to(base_url('/'));
        }

        // Jika password yang di input sama dengan password yang di hash
        if (password_verify($password, $fieldU->password)) {
            $data = [
                'log' => true,
                'nama' => $fieldU->nama,
                'jabatan' => $fieldU->jabatan,
                'level' => $fieldU->id_level,
            ];
            session()->set($data);
            session()->setFlashdata('pesan', 'Anda Berhasil Login !');
            return redirect()->to(base_url('/dashboard'));
        }
    }

    // Fungsi ketika proses logout diakses
    public function logout()
    {
        // Menghilangkan session login
        $session = session();
        $session = $session->destroy();

        // Membuat pesan session berhasil logout
        $session = session()->setFlashdata('pesan', 'Anda Berhasil Logout!');
        return redirect()->to(base_url('/'));
    }

    // Fungsi ketika halaman forgot diakses
    public function forgot()
    {
        // Ketika sudah login tidak bisa ke halaman login
        if (session('jabatan')) {
            return redirect()->to((base_url('dashboard')));
        }

        return view('forgot');
    }

    // Fungsi ketika proses reset password diakses
    public function reset()
    {
        // Validasi data input forgot
        $validasi = $this->validate([

            // Validasi username
            'username' => [
                'rules'  => 'required|min_length[4]|max_length[8]|alpha|is_not_unique[pengguna.username]',
                'errors' => [
                    'required' => 'Username Harus Terisi !',
                    'min_length' => 'Username Minimal 4 Huruf !',
                    'max_length' => 'Username Maximal 8 Huruf !',
                    'alpha' => 'Username Harus Huruf !',
                    'is_not_unique' => 'Username Tidak Terdaftar !',
                ]
            ],
        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('/forgot')))->withInput()->with('validate', $isivalidasi);
        }

        // Menangkap input username
        $username = $_POST['username'];

        // Memanggil model pengguna
        $pengguna = new ModelPengguna();

        // Mengambil data ke database
        $array = $pengguna->select('*')->where('username', $username)->findAll();

        $data = [
            'user' => $array,
        ];

        if ($array) {
            session()->setFlashdata('pesan', 'Silahkan Reset Password Anda !');
            return view('reset', $data);
        }
    }

    // Fungsi ketika halaman reset password dikases
    public function resetpassword()
    {
        // Ketika belum belum login tidka bisa diakses
        if (!session('jabatan')) {
            return redirect()->to((base_url('forgot')));
        }

        // Ketika sudah login tidak bisa ke halaman login
        if (session('jabatan')) {
            return redirect()->to((base_url('dashboard')));
        }

        return view('reset');
    }

    // Fungsi ketika proses reset dan update password
    public function prosesReset()
    {
        // Validasi data input forgot
        $validasi = $this->validate([

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

        ]);

        // Jika variabel input terdapat validasi
        if (!$validasi) {
            $isivalidasi = \Config\Services::validation();
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to((base_url('/reset')))->withInput()->with('validate', $isivalidasi);
        }

        // Mengkap id pengguna
        $id = ['id_user' => $_POST['id']];

        // Memanggil model pengguna
        $pengguna = new ModelPengguna();

        // Menangkap password yang ingin diubah
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        $data = [
            'password' => $password,
        ];

        // Mengubah data ke database
        $update = $pengguna->update($id, $data);

        // Jika update data berhasil maka
        if ($update) {
            session()->setFlashdata('pesan', 'Berhasil Mereset Password !');
            return redirect()->to((base_url('/')));
        }
    }
}
