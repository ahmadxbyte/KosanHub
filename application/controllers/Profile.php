<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public $data;

    function __construct()
    {
        parent::__construct();

        /**
         * @data merupakan isian dari pengaturan web dan session
         */
        if (!empty($this->session->userdata("email"))) { // jika session email ada
            $user = getData('user', ["email" => $this->session->userdata("email")]);

            // tampung data ke variable data public
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
                'mail'              =>  $this->session->userdata('email'),
                'gambar'            =>  $user['gambar'],
                'kodeRole'          =>  $user['kodeRole'],
                'nama'              =>  $user['nama'],
                'latar_belakang'    =>  _webSetting()->latar_belakang,
                'uri'               => getData('ms_menu', ['url' => $this->uri->segment(1)]),
            ];
        } else { // jika tidak ada session
            redirect('App');
        }
    }

    /**
     * Index Page for this controller (Home page).
     */
    public function index()
    {
        $param = [
            $this->data,
            'title'     => 'Profil',
            'profile'   => getData('user', ["email" => $this->session->userdata("email")]),
        ];

        $this->load->view('Template/Content/Header', $param);
        $this->load->view('Template/Content/Navbar', $param);
        $this->load->view('Profile', $param);
        $this->load->view('Template/Content/Footer', $param);
    }

    /**
     * update progress
     * */
    public function updateProses()
    {
        // pembeda tab
        $param = $this->input->post('fortab');

        // Validate required fields
        if ($param == 1) {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]', [
                'required'      => 'Sandi wajib diisi',
                'min_length'    => 'Sandi minimal 4 karakter'
            ]);
        } else {
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
        }

        if ($this->form_validation->run() == FALSE) { // jika validasi gagal
            echo json_encode([
                'title'     => 'Validasi',
                'msg'       => validation_errors(),
                'tipe'      => 'error',
                'tujuan'    => 'Profile',
                'param'     => 1
            ]);  // berikan parameter gagal validasi
            return;
        }

        $email = $this->session->userdata('email', TRUE);
        $nama = $this->input->post('nama', TRUE);
        $nohp = $this->input->post('nohp', TRUE);
        $gender = $this->input->post('gender', TRUE);
        $tmpLahir = $this->input->post('tmpLahir', TRUE);
        $tglLahir = $this->input->post('tglLahir', TRUE);
        $alamat = $this->input->post('alamat', TRUE);

        if ($param == 1) {
            $password = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT);
        }

        // konfigurasi gambar
        $config['upload_path']    = 'assets/image/user/'; // lokasi penyimpanan
        $config['allowed_types']  = 'jpg|png|jpeg'; // format yg diterima
        $config['max_size']       = '10240'; // ukuran maksimal
        $this->load->library('upload', $config); // load library upload
        $this->upload->initialize($config); // inisial konfigurasinya

        $user = getData('user', ['email' => $email]);

        if (isset($_FILES['gambar']['name']) && !empty($_FILES['gambar']['name'])) { // jika file didapatkan nama filenya
            // Check if upload was successful
            if (!$this->upload->do_upload('gambar')) {
                echo json_encode([
                    'title' => 'Error',
                    'msg'   => $this->upload->display_errors(),
                    'tipe'  => 'error',
                    'tujuan' => 'Profile',
                    'param' => 0
                ]);
                return;
            }

            // Get uploaded filename
            $gambar = $this->upload->data('file_name');

            // Delete old image if exists and different
            if ($user && $user['gambar'] !== $gambar && $user['gambar'] !== 'pria.png' && $user['gambar'] !== 'wanita.png') {
                $old_file = 'assets/image/user/' . $user['gambar'];
                if (file_exists($old_file)) {
                    unlink($old_file);
                }
            }
        } else {
            // Set default or existing image
            if ($user && !empty($user['gambar'])) {
                $gambar = $user['gambar'];
            } else {
                $gambar = ($gender == '1') ? 'pria.png' : 'wanita.png';
            }
        }

        if ($param == 0) { // jika param 0 = isi data profile
            $data = [
                'nama'      => $nama,
                'nohp'      => $nohp,
                'gender'    => $gender,
                'tmpLahir'  => $tmpLahir,
                'tglLahir'  => $tglLahir,
                'alamat'    => $alamat,
                'gambar'    => $gambar,
            ];
        } else { // selain itu = isi data password
            $data = [
                'password'  => $password,
            ];
        }

        // lakukan update data
        $update = updateData('user', $data, ['email' => $email]);

        if ($update) { // jika user ada
            if ($param == 1) {
                echo json_encode([
                    'title'     => 'Profil',
                    'msg'       => 'Kata sandi berhasil diperbarui',
                    'tipe'      => 'success',
                    'tujuan'    => 'Profile',
                    'param'     => 0
                ]);  // berikan parameter gagal Profil, email sudah terdaftar
            } else {
                echo json_encode([
                    'title'     => 'Profil',
                    'msg'       => 'Data diri berhasil diperbarui',
                    'tipe'      => 'success',
                    'tujuan'    => 'Profile',
                    'param'     => 0
                ]);  // berikan parameter gagal Profil, email sudah terdaftar
            }
        }
    }
}
