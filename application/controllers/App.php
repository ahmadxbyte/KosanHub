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
     * Index Page for this controller.
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
}
