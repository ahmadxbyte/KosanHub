<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
            'title' => 'Selamat Datang',
            'menu'  => $this->db->query('SELECT * FROM ms_menu mm JOIN access_menu am USING(kodeMenu) WHERE am.kodeRole = "' . $this->data['kodeRole'] . '" AND mm.kodeMenu <> "MN00000000" ORDER BY mm.keterangan ASC')->result(),
        ];

        $this->load->view('Template/Content/Header', $param);
        $this->load->view('Template/Content/Navbar', $param);
        $this->load->view('Home', $param);
        $this->load->view('Template/Content/Footer', $param);
    }
}
