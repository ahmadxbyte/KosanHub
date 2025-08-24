<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App extends CI_Controller
{
    public $data;

    function __construct()
    {
        parent::__construct();

        /**
         * @data merupakan isian dari pengaturan web
         */
        $this->data = [
            'nama'              =>  _webSetting()->nama,
            'alamat'            =>  _webSetting()->alamat,
            'logo'              =>  _webSetting()->logo,
            'favicon'           =>  _webSetting()->favicon,
            'loading'           =>  _webSetting()->loading,
            'wa'                =>  _webSetting()->wa,
            'instagram'         =>  _webSetting()->instagram,
            'github'            =>  _webSetting()->github,
            'email'             =>  _webSetting()->email,
            'latar_belakang'    =>  _webSetting()->latar_belakang,
        ];
    }

    /**
     * Index Page for this controller (Login page).
     */
    public function index()
    {
        $param = [
            $this->data,
            'title' => 'Selamat Datang',
        ];

        $this->load->view('Template/App/Header', $param);
        $this->load->view('App/Login', $param);
        $this->load->view('Template/App/Footer', $param);
    }

    /**
     * Regist Page for this controller.
     */
    public function regist()
    {
        $param = [
            $this->data,
            'title' => 'Ayo Bergabung Sekarang',
        ];

        $this->load->view('Template/App/Header', $param);
        $this->load->view('App/Regist', $param);
        $this->load->view('Template/App/Footer', $param);
    }

    /**
     * Resgitration progress
     * */
    public function registProses()
    {
        // Validate required fields
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]', [
            'required'      => 'Email wajib diisi',
            'valid_email'   => 'Format email tidak valid',
            'is_unique'     => 'Email sudah terdaftar'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]', [
            'required'      => 'Sandi wajib diisi',
            'min_length'    => 'Sandi minimal 4 karakter'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required|min_length[3]', [
            'required'      => 'Nama wajib diisi',
            'min_length'    => 'Nama minimal 3 karakter'
        ]);
        $this->form_validation->set_rules('nohp', 'No HP', 'required|numeric|min_length[10]|max_length[13]', [
            'required'      => 'Nomor HP wajib diisi',
            'numeric'       => 'Nomor HP harus berupa angka',
            'min_length'    => 'Nomor HP minimal 10 digit',
            'max_length'    => 'Nomor HP maksimal 13 digit'
        ]);
        $this->form_validation->set_rules('tmpLahir', 'Tempat Lahir', 'required', [
            'required'      => 'Tempat lahir wajib diisi'
        ]);
        $this->form_validation->set_rules('tglLahir', 'Tanggal Lahir', 'required', [
            'required'      => 'Tanggal lahir wajib diisi'
        ]);
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required|in_list[1,2]', [
            'required'      => 'Jenis kelamin wajib diisi',
            'in_list'       => 'Pilihan jenis kelamin tidak valid'
        ]);

        if ($this->form_validation->run() == FALSE) { // jika validasi gagal
            echo json_encode([
                'title'     => 'Validasi',
                'msg'       => validation_errors(),
                'tipe'      => 'error',
                'tujuan'    => 'App/regist',
                'param'     => 1
            ]);  // berikan parameter gagal validasi
            return;
        }

        $email    = $this->input->post('email', TRUE);
        $password = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT);
        $nama     = $this->input->post('nama', TRUE);
        $nohp     = $this->input->post('nohp', TRUE);
        $tmpLahir = $this->input->post('tmpLahir', TRUE);
        $tglLahir = $this->input->post('tglLahir', TRUE);
        $gender   = $this->input->post('gender', TRUE);
        $gambar   = $this->input->post('gambar', TRUE);
        $alamat   = $this->input->post('alamat', TRUE);

        // konfigurasi gambar
        $config['upload_path']    = 'assets/image/user/'; // lokasi penyimpanan
        $config['allowed_types']  = 'jpg|png|jpeg'; // format yg diterima
        $config['max_size']       = '10240'; // ukuran maksimal
        $this->load->library('upload', $config); // load library upload
        $this->upload->initialize($config); // inisial konfigurasinya

        if (isset($_FILES['gambar']['name']) && !empty($_FILES['gambar']['name'])) { // jika file didapatkan nama filenya
            // upload file
            $this->upload->do_upload('gambar');

            // ambil namanya berdasarkan nama file upload
            $gambar                = $this->upload->data('file_name');
        } else { // selain itu
            // beri nilai default
            if ($gender == '1' || $gender == 1) { // jika gender laki-laki
                // gambarnya pria
                $gambar = 'pria.png';
            } else { // selain itu
                // gambarnya wanita
                $gambar = 'wanita.png';
            }
        }

        // simpan semua parameter kedalam data
        $data = [
            'email'             => $email,
            'password'          => $password,
            'nama'              => $nama,
            'nohp'              => $nohp,
            'alamat'            => $alamat,
            'tmpLahir'          => $tmpLahir,
            'tglLahir'          => $tglLahir,
            'gambar'            => $gambar,
            'gender'            => $gender,
            'aktif'             => 1,
            'waktuBergabung'    => date('Y-m-d H:i:s'),
            'kodeRole'          => 'LV99999999', // kodeRole ini merupakan kode role untuk member
        ];

        // lakukan pengecekan user melalui email
        $user = getData('user', ['email' => $email]);

        if ($user) { // jika user ada
            echo json_encode([
                'title'     => 'Pendaftaran',
                'msg'       => 'Email sudah terdaftar',
                'tipe'      => 'info',
                'tujuan'    => 'App/regist'
            ]);  // berikan parameter gagal pendaftaran, email sudah terdaftar

            return;
        }

        // tambahkan fungsi untuk menyimpan data kedalam table user melaui app_helper
        $cek = addData('user', $data);

        if ($cek) { // jika $cek berjalan
            echo json_encode([
                'title'     => 'Pendaftaran',
                'msg'       => 'Berhasil diproses',
                'tipe'      => 'success',
                'tujuan'    => 'App',
                'param'     => 0
            ]);  // berikan parameter berhasil terdaftar
        } else { // selain itu
            echo json_encode([
                'title'     => 'Pendaftaran',
                'msg'       => 'Gagal diproses',
                'tipe'      => 'warning',
                'tujuan'    => 'App/regist',
                'param'     => 0
            ]); // berikan parameter gagal terdaftar
        }
    }

    /**
     * Login progress
     * */
    public function loginProses()
    {
        // Validate required fields
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
            'required'      => 'Email wajib diisi',
            'valid_email'   => 'Format email tidak valid',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]', [
            'required'      => 'Sandi wajib diisi',
            'min_length'    => 'Sandi minimal 4 karakter'
        ]);

        if ($this->form_validation->run() == FALSE) { // jika validasi gagal
            echo json_encode([
                'title'     => 'Validasi',
                'msg'       => validation_errors(),
                'tipe'      => 'error',
                'tujuan'    => 'App/regist',
                'param'     => 1
            ]);  // berikan parameter gagal validasi
            return;
        }

        // lakukan pengecekan user melalui email
        $user = getData('user', ['email' => $this->input->post('email', TRUE)]);

        if ($user) { // jika user ada
            // lakukan pengecekan password
            if (password_verify($this->input->post('password', TRUE), $user['password'])) { // Check if input password matches stored hash
                // buat tampungan data yang diambil dari table user
                $data = [
                    'email'     => $user['email'],
                    'nama'      => $user['nama'],
                    'nohp'      => $user['nohp'],
                    'alamat'    => $user['alamat'],
                    'tmpLahir'  => $user['tmpLahir'],
                    'tglLahir'  => $user['tglLahir'],
                    'gambar'    => $user['gambar'],
                    'gender'    => $user['gender'],
                    'kodeRole'  => $user['kodeRole'],
                ];

                // set kedalam session
                $this->session->set_userdata($data);

                // berikan feedback
                echo json_encode([
                    'title'     => 'Masuk sistem',
                    'msg'       => 'Proses berhasil',
                    'tipe'      => 'success',
                    'tujuan'    => 'Home',
                    'param'     => 0
                ]);  // berikan parameter berhasil login

                // simpan juga ke localStorage
                // echo "<script>
                //     localStorage.setItem('userData', '" . json_encode($data) . "');
                // </script>";
            } else { // jika password berbeda
                echo json_encode([
                    'title'     => 'Masuk sistem',
                    'msg'       => 'Proses gagal, password tidak sesuai',
                    'tipe'      => 'warning',
                    'tujuan'    => 'App',
                    'param'     => 0
                ]);  // berikan parameter salah password
            }
        } else { // jika email tidak ada di table user
            echo json_encode([
                'title'     => 'Masuk sistem',
                'msg'       => 'Email belum terdaftar, silahkan daftarkan terlebih dahulu',
                'tipe'      => 'info',
                'tujuan'    => 'App/regist',
                'param'     => 0
            ]); // berikan parameter email belum terdaftar
        }
    }

    /**
     * Login progress
     * */
    public function logout()
    {
        // Destroy all session data
        $this->session->sess_destroy();

        // Redirect to login page with success message
        echo json_encode([
            'title'     => 'Keluar sistem',
            'msg'       => 'Berhasil keluar dari sistem',
            'tipe'      => 'success',
            'tujuan'    => 'App',
            'param'     => 0
        ]);
    }
}
