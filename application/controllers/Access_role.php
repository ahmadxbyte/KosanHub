<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Access_role extends CI_Controller
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
            'title'         => 'Akses Role',
            'menu'          => Result('ms_menu'),
            'role'          => Result('ms_role'),
        ];

        $this->load->view('Template/Content/Header', $param);
        $this->load->view('Template/Content/Navbar', $param);
        $this->load->view('Access', $param);
        $this->load->view('Template/Content/Footer', $param);
    }

    /**
     * Index Page for this controller (Home page).
     */
    public function list()
    {
        $this->load->model("M_accessRole");
        // Retrieve data from the model
        $list = $this->M_accessRole->get_datatables();

        $data = [];
        $no = $_POST['start'] + 1;

        // Loop through the list to populate the data array
        foreach ($list as $rd) {
            $role       = Result('ms_role');

            $row    = [];
            $row[]  = '<div class="float-end">' . $no . '</div>';
            $row[]  = $rd->keterangan;
            $nor    = 1;
            foreach ($role as $r) {
                $menu_akses = $this->db->query("SELECT * FROM access_menu WHERE kodeRole = '$r->kodeRole' AND kodeMenu = '$rd->kodeMenu' LIMIT 1")->row();

                $akses = ($menu_akses) ? $menu_akses->id : '0';
                $row[] = '<div class="d-flex justify-content-center align-items-center bg-table">
                    <input type="checkbox" style="width: 30px; height: 30px;" class="form-check-input" id="krole' . $no . '_' . $nor . '" ' . (($akses > 0) ? 'checked' : '') . ' name="krole[]" value="' . $r->kodeRole . '" onclick="changeAkses(' . "'" . $rd->kodeMenu . "', '" . $r->kodeRole . "', '" . $no . "', '" . $nor . "', '" . $rd->keterangan . "', '" . $r->keterangan . "', '" . $rd->idm . "'" . ')">
                </div>';
                $nor++;
            }
            $data[] = $row;
            $no++;
        }

        // Prepare the output in JSON format
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_accessRole->count_all(),
            "recordsFiltered" => $this->M_accessRole->count_filtered(),
            "data" => $data,
        ];

        // Send the output to the view
        echo json_encode($output);
    }

    // change menu
    public function changeMenu()
    {
        $kdrole   = $this->input->get('kdrole');
        $idmenu   = $this->input->get('idmenu');

        $menu     = getData('ms_menu', ['id' => $idmenu]);
        $cek_menu = getData('access_menu', ['kodeRole' => $kdrole, 'kodeMenu' => $menu['kodeMenu']]);

        if ($cek_menu) {
            $cek = delData('access_menu', ['kodeRole' => $kdrole, 'kodeMenu' => $menu['kodeMenu']]);
        } else {
            $cek = addData('access_menu', ['kodeAccess' => _masterKode('access menu', 10, 'AM'), 'kodeRole' => $kdrole, 'kodeMenu' => $menu['kodeMenu']]);
        }

        if ($cek) {
            echo json_encode([
                'title'     => 'Akses Role',
                'msg'       => 'Data berhasil diperbarui',
                'tipe'      => 'success',
                'tujuan'    => 'Access_role',
                'param'     => 0
            ]);  // berikan parameter berhasil diupdate
        } else {
            echo json_encode([
                'title'     => 'Akses Role',
                'msg'       => 'Data gagal diperbarui',
                'tipe'      => 'error',
                'tujuan'    => 'Access_role',
                'param'     => 0
            ]);  // berikan parameter gagal diupdate
        }
    }
}
