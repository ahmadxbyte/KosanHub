<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $param = [
            'title' => 'Selamat Datang'
        ];

        $this->load->view('Template/App/Header', $param);
        $this->load->view('App/Login', $param);
        $this->load->view('Template/App/Footer', $param);
    }
}
