<?php

class Device extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('DataModel');
        is_logged_in();
    }


    function index()
    {
        $datas['title'] = 'Monitoring';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar


        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/index', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai
    }

    public function clearData()
    {
        // Mendapatkan email dari session
        $email = $this->session->userdata('email');

        // Menghapus data berdasarkan email
        $this->DataModel->clearDataByEmail($email);

        // Mengatur isi database menjadi 0
        $this->DataModel->resetData();

        // Redirect atau tampilkan pesan berhasil
        // Redirect contoh:
        redirect('device'); // Ganti 'dashboard' dengan halaman yang sesuai
    }

    public function save_switch6()
    {
        $switchStatus6 = $_POST['switch_status6'];
        $userEmail = $this->session->userdata('email');

        $this->db->set('lampu', $switchStatus6);
        $this->db->where('email', $userEmail);
        $this->db->update('user');
    }

    public function save_switch5()
    {
        $switchStatus5 = $_POST['switch_status5'];
        $userEmail = $this->session->userdata('email');

        $this->db->set('stopkontak_2', $switchStatus5);
        $this->db->where('email', $userEmail);
        $this->db->update('user');
    }

    public function save_switch4()
    {
        $switchStatus5 = $_POST['switch_status4'];
        $userEmail = $this->session->userdata('email');

        $this->db->set('stopkontak_1', $switchStatus5);
        $this->db->where('email', $userEmail);
        $this->db->update('user');
    }


    public function save_switch3()
    {
        $switchStatus5 = $_POST['switch_status3'];
        $userEmail = $this->session->userdata('email');

        $this->db->set('output_dc', $switchStatus5);
        $this->db->where('email', $userEmail);
        $this->db->update('user');
    }

    public function save_switch2()
    {
        $switchStatus5 = $_POST['switch_status2'];
        $userEmail = $this->session->userdata('email');

        $this->db->set('faktor_daya', $switchStatus5);
        $this->db->where('email', $userEmail);
        $this->db->update('user');
    }

    public function save_switch1()
    {
        $switchStatus5 = $_POST['switch_status1'];
        $userEmail = $this->session->userdata('email');

        $this->db->set('sumber_listrik', $switchStatus5);
        $this->db->where('email', $userEmail);
        $this->db->update('user');
    }

    function grafikjason()
    {
        $data = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(4500)->order_by('id', 'DESC')->get()->result();
        echo json_encode($data);
    }

    function historydevice()
    {
        $datas['title'] = 'History Device';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar
        $datas['data2'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar

        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/historydevice', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai
    }

    function faktor_daya()
    {
        $datas['title'] = 'Monitoring';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar

        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/faktor_daya', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai
    }

    function arus_masuk()
    {
        $datas['title'] = 'Monitoring';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/arus_masuk', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function tegangan_masuk()
    {
        $datas['title'] = 'Monitoring';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/tegangan_masuk', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function daya_masuk()
    {
        $datas['title'] = 'Monitoring';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/daya_masuk', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function arus_baterai()
    {
        $datas['title'] = 'Monitoring';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/arus_baterai', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function tegangan_baterai()
    {
        $datas['title'] = 'Monitoring';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/tegangan_baterai', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function daya_baterai()
    {
        $datas['title'] = 'Monitoring';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/daya_baterai', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function presentase_baterai()
    {
        $datas['title'] = 'Monitoring';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/presentase_baterai', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function arus_keluar()
    {
        $datas['title'] = 'Monitoring';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/arus_keluar', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function tegnagan_keluar()
    {
        $datas['title'] = 'Monitoring';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/tegnagan_keluar', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function daya_keluar()
    {
        $datas['title'] = 'Monitoring';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/daya_keluar', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function arus_ac()
    {
        $datas['title'] = 'Monitoring';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/arus_ac', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function tengangan_ac()
    {
        $datas['title'] = 'Monitoring';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/tengangan_ac', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function daya_aktif()
    {
        $datas['title'] = 'Monitoring';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/daya_aktif', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function daya_reaktif()
    {
        $datas['title'] = 'Monitoring';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/daya_reaktif', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function daya_semu()
    {
        $datas['title'] = 'Monitoring';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'device/daya_semu', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }
}
