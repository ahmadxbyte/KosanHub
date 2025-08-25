<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cogs extends CI_Controller
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
            'title' => 'Pengaturan',
            'web' => getData('pengaturan_web', ['id' => 1]),
        ];

        $this->load->view('Template/Content/Header', $param);
        $this->load->view('Template/Content/Navbar', $param);
        $this->load->view('Cogs', $param);
        $this->load->view('Template/Content/Footer', $param);
    }

    /**
     * update progress
     * */
    public function updateProses()
    {
        // Validate required fields
        $this->form_validation->set_rules('nama', 'Nama', 'required|min_length[3]', [
            'required'      => 'Nama wajib diisi',
            'min_length'    => 'Nama minimal 3 karakter'
        ]);
        $this->form_validation->set_rules('wa', 'WA/No Hp', 'required|numeric|min_length[10]|max_length[13]', [
            'required'      => 'WA/Nomor HP wajib diisi',
            'numeric'       => 'WA/Nomor HP harus berupa angka',
            'min_length'    => 'WA/Nomor HP minimal 10 digit',
            'max_length'    => 'WA/Nomor HP maksimal 13 digit'
        ]);
        $this->form_validation->set_rules('github', 'Github', 'required|min_length[3]|valid_url', [
            'required'      => 'Github wajib diisi',
            'min_length'    => 'Github minimal 3 karakter',
            'valid_url'     => 'Github harus berupa URL yang valid'
        ]);
        $this->form_validation->set_rules('instagram', 'Instagram', 'required|min_length[3]|valid_url', [
            'required'      => 'Instagram wajib diisi',
            'min_length'    => 'Instagram minimal 3 karakter',
            'valid_url'     => 'Instagram harus berupa URL yang valid'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|min_length[3]', [
            'required'      => 'Email wajib diisi',
            'valid_email'   => 'Format email tidak valid',
            'min_length'    => 'Email minimal 3 karakter'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[3]', [
            'required'      => 'Alamat wajib diisi',
            'min_length'    => 'Alamat minimal 3 karakter'
        ]);
        $this->form_validation->set_rules('smtp', 'Kode SMTP', 'required|min_length[3]', [
            'required'      => 'Kode SMTP wajib diisi',
            'min_length'    => 'Kode SMTP minimal 3 karakter'
        ]);

        if ($this->form_validation->run() == FALSE) { // jika validasi gagal
            echo json_encode([
                'title'     => 'Validasi',
                'msg'       => validation_errors(),
                'tipe'      => 'error',
                'tujuan'    => 'Cogs',
                'param'     => 1
            ]);  // berikan parameter gagal validasi
            return;
        }

        $nama         = $this->session->userdata('nama', TRUE);
        $wa           = $this->input->post('wa', TRUE);
        $github       = $this->input->post('github', TRUE);
        $instagram    = $this->input->post('instagram', TRUE);
        $email        = $this->input->post('email', TRUE);
        $smtp         = $this->input->post('smtp', TRUE);
        $alamat       = $this->input->post('alamat', TRUE);

        // konfigurasi gambar
        $config['upload_path']    = 'assets/image/web/'; // lokasi penyimpanan
        $config['allowed_types']  = 'jpg|png|jpeg'; // format yg diterima
        $config['max_size']       = '10240'; // ukuran maksimal
        $this->load->library('upload', $config); // load library upload
        $this->upload->initialize($config); // inisial konfigurasinya

        if (isset($_FILES['favicon']['name']) && !empty($_FILES['favicon']['name'])) { // jika file didapatkan nama filenya
            // Check if upload was successful
            if (!$this->upload->do_upload('favicon')) {
                echo json_encode([
                    'title'     => 'Error',
                    'msg'       => $this->upload->display_errors(),
                    'tipe'      => 'error',
                    'tujuan'    => 'Profile',
                    'param'     => 0
                ]);
                return;
            }

            // Get uploaded filename
            $favicon = $this->upload->data('file_name');

            // Delete old image if exists and different
            if ('logo.png' !== $favicon) {
                $old_file = 'assets/image/user/' . 'logo.png';
                if (file_exists($old_file)) {
                    unlink($old_file);
                }
            }
        } else {
            $favicon = 'logo.png';
        }

        if (isset($_FILES['loading']['name']) && !empty($_FILES['loading']['name'])) { // jika file didapatkan nama filenya
            // Check if upload was successful
            if (!$this->upload->do_upload('loading')) {
                echo json_encode([
                    'title'     => 'Error',
                    'msg'       => $this->upload->display_errors(),
                    'tipe'      => 'error',
                    'tujuan'    => 'Profile',
                    'param'     => 0
                ]);
                return;
            }

            // Get uploaded filename
            $loading = $this->upload->data('file_name');

            // Delete old image if exists and different
            if ('logo.png' !== $loading) {
                $old_file = 'assets/image/user/' . 'logo.png';
                if (file_exists($old_file)) {
                    unlink($old_file);
                }
            }
        } else {
            $loading = 'logo.png';
        }

        if (isset($_FILES['logo']['name']) && !empty($_FILES['logo']['name'])) { // jika file didapatkan nama filenya
            // Check if upload was successful
            if (!$this->upload->do_upload('logo')) {
                echo json_encode([
                    'title'     => 'Error',
                    'msg'       => $this->upload->display_errors(),
                    'tipe'      => 'error',
                    'tujuan'    => 'Profile',
                    'param'     => 0
                ]);
                return;
            }

            // Get uploaded filename
            $logo = $this->upload->data('file_name');

            // Delete old image if exists and different
            if ('logo3.png' !== $logo) {
                $old_file = 'assets/image/user/' . 'logo3.png';
                if (file_exists($old_file)) {
                    unlink($old_file);
                }
            }
        } else {
            $logo = 'logo3.png';
        }

        if (isset($_FILES['latar_belakang']['name']) && !empty($_FILES['latar_belakang']['name'])) { // jika file didapatkan nama filenya
            // Check if upload was successful
            if (!$this->upload->do_upload('latar_belakang')) {
                echo json_encode([
                    'title'     => 'Error',
                    'msg'       => $this->upload->display_errors(),
                    'tipe'      => 'error',
                    'tujuan'    => 'Profile',
                    'param'     => 0
                ]);
                return;
            }

            // Get uploaded filename
            $latar_belakang = $this->upload->data('file_name');

            // Delete old image if exists and different
            if ('bg.png' !== $latar_belakang) {
                $old_file = 'assets/image/user/' . 'bg.png';
                if (file_exists($old_file)) {
                    unlink($old_file);
                }
            }
        } else {
            $latar_belakang = 'bg.png';
        }

        $data = [
            'nama'              => $nama,
            'alamat'            => $alamat,
            'logo'              => $logo,
            'favicon'           => $favicon,
            'loading'           => $loading,
            'wa'                => $wa,
            'github'            => $github,
            'instagram'         => $instagram,
            'email'             => $email,
            'smtp'              => $smtp,
            'latar_belakang'    => $latar_belakang,
        ];

        // lakukan update data
        $update = updateData('pengaturan_web', $data, ['id' => 1]);

        if ($update) { // jika user ada
            echo json_encode([
                'title'     => 'Pengaturan',
                'msg'       => 'Data berhasil diperbarui',
                'tipe'      => 'success',
                'tujuan'    => 'Cogs',
                'param'     => 0
            ]);  // berikan parameter gagal Profil, email sudah terdaftar
        } else {
            echo json_encode([
                'title'     => 'Pengaturan',
                'msg'       => 'Data gagal diperbarui',
                'tipe'      => 'error',
                'tujuan'    => 'Cogs',
                'param'     => 0
            ]);  // berikan parameter gagal Profil, email sudah terdaftar
        }
    }
}
