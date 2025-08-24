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
        $email    = $this->input->post('email');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $nama     = $this->input->post('nama');
        $nohp     = $this->input->post('nohp');
        $tmpLahir = $this->input->post('tmpLahir');
        $tglLahir = $this->input->post('tglLahir');
        $gender   = $this->input->post('gender');
        $gambar   = $this->input->post('gambar');
        $alamat   = $this->input->post('alamat');

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
            'waktuBergabung'    => date('Y-m-d H:i:s'),
            'kodeRole'          => 'LV99999999', // kodeRole ini merupakan kode role untuk member
        ];

        // tambahkan fungsi untuk menyimpan data kedalam table user melaui app_helper
        $cek = addData($data, 'user');

        if ($cek) { // jika $cek berjalan
            echo json_encode(['title' => 'Pendaftaran', 'msg' => 'Berhasil diproses', 'tipe' => 'success', 'tujuan' => 'App']);  // berikan parameter 1 = berhasil terdaftar
        } else { // selain itu
            echo json_encode(['title' => 'Pendaftaran', 'msg' => 'Gagal diproses', 'tipe' => 'danger', 'tujuan' => 'App/regist']); // berikan parameter 0 = gagal terdaftar
        }
    }
}
