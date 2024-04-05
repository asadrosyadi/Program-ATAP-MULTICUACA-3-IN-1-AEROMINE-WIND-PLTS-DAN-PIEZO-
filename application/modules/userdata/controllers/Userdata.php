<?php

class Userdata extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    function index()
    {
        $datas['data'] = $this->db->select('*')->from('user')->get()->result(); //Untuk mengambil data dari database webinar

        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/list', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai
    }

    function add()
    {
        $this->load->helper('string');
        $HWID = random_string('alnum', 8);
        $isi = array(

            'name'     => $this->input->post('name'),
            'email'    => $this->input->post('email'),
            'image' => 'default.jpg',
            'password'     => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role_id'     => $this->input->post('role_id'),
            'is_active'     => $this->input->post('is_active'),
            'date_created'     => time(),
            'token'     => random_string('alnum', 16),
            'HWID'   => $HWID

        );


        $data_sensor = [
            'HWID'     => $HWID,
            'email' => $this->input->post('email')
        ];


        $this->db->insert('user', $isi);
        $this->db->insert('datasensor', $data_sensor);
        redirect('userdata');
    }


    function edit()
    {
        if (isset($_POST['submit'])) {
            $data = array(

                'name'     => $this->input->post('name'),
                'email'    => $this->input->post('email'),
                'role_id'     => $this->input->post('role_id'),
                'is_active'     => $this->input->post('is_active'),
                'token'     => $this->input->post('token'),
                'HWID'     => $this->input->post('HWID')

            );

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $id   = $this->input->post('id');
            $this->db->where('id', $id); //difilter berdasarkan id
            $this->db->update('user', $data); //eksekusi update
            redirect('userdata');
        } else {
            $id           = $this->uri->segment(3);
            $datas['data'] = $this->db->get_where('user', array('email' => $id))->row_array();
            $datas['data2'] = $this->db->select('*')->from('user')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar


            $datas['title'] = 'User Data';
            $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $this->load->view('templates/header', $datas);
            $this->load->view('templates/sidebar', $datas);
            $this->load->view('templates/topbar', $datas);
            $this->template->load('template1', 'edit2', $datas);
        }
    }

    function hapus()
    {
        $id = $this->uri->segment(3);
        if (!empty($id)) {
            // proses delete data
            $this->db->where('HWID', $id);
            $this->db->delete('user');
        }
        redirect('userdata');
    }


    function datasensor()
    {
        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar
        //$datas['data'] = $this->db->select('*')->from('datasensor')->where('email', $this->session->userdata('email'))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar
        $datas['data2'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar

        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/historydevice', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai       
    }

    function monitoring()
    {
        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $datas['user2'] = $this->db->select('*')->from('user')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar
        //$datas['rule'] = $this->db->get_where('fuzzyrule', ['email' => $this->session->userdata('email')])->row_array();       
        //$datas['data'] = $this->db->get_where('datasensor', ['email' => $this->session->userdata('email')])->row_array();       
        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/index', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai
    }

    public function clearData()
    {
        // Mendapatkan email dari session
        $HWID = $this->session->userdata('HWID');

        // Menghapus data berdasarkan email
        $this->DataModel->clearDataByEmail($HWID);

        // Mengatur isi database menjadi 0
        $this->DataModel->resetData();

        // Redirect atau tampilkan pesan berhasil
        // Redirect contoh:
        redirect('userdata/' . $HWID); // Ganti 'dashboard' dengan halaman yang sesuai
    }


    public function save_switch6()
    {
        $switchStatus6 = $_POST['switch_status6'];
        $userEmail = $this->session->userdata('HWID');

        $this->db->set('lampu', $switchStatus6);
        $this->db->where('HWID', $userEmail);
        $this->db->update('user');
    }

    public function save_switch5()
    {
        $switchStatus5 = $_POST['switch_status5'];
        $userEmail = $this->session->userdata('HWID');

        $this->db->set('stopkontak_2', $switchStatus5);
        $this->db->where('HWID', $userEmail);
        $this->db->update('user');
    }

    public function save_switch4()
    {
        $switchStatus5 = $_POST['switch_status4'];
        $userEmail = $this->session->userdata('HWID');

        $this->db->set('stopkontak_1', $switchStatus5);
        $this->db->where('HWID', $userEmail);
        $this->db->update('user');
    }


    public function save_switch3()
    {
        $switchStatus5 = $_POST['switch_status3'];
        $userEmail = $this->session->userdata('HWID');

        $this->db->set('output_dc', $switchStatus5);
        $this->db->where('HWID', $userEmail);
        $this->db->update('user');
    }

    public function save_switch2()
    {
        $switchStatus5 = $_POST['switch_status2'];
        $userEmail = $this->session->userdata('HWID');

        $this->db->set('faktor_daya', $switchStatus5);
        $this->db->where('HWID', $userEmail);
        $this->db->update('user');
    }

    public function save_switch1()
    {
        $switchStatus5 = $_POST['switch_status1'];
        $userEmail = $this->session->userdata('HWID');

        $this->db->set('sumber_listrik', $switchStatus5);
        $this->db->where('HWID', $userEmail);
        $this->db->update('user');
    }

    function grafikjason()
    {
        $data = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(4500)->order_by('id', 'DESC')->get()->result();
        echo json_encode($data);
    }


    function arus_masuk()
    {
        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/arus_masuk', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function tegangan_masuk()
    {
        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/tegangan_masuk', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function daya_masuk()
    {
        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/daya_masuk', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function arus_baterai()
    {
        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/arus_baterai', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function tegangan_baterai()
    {
        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/tegangan_baterai', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function daya_baterai()
    {
        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/daya_baterai', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function presentase_baterai()
    {
        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/presentase_baterai', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function arus_keluar()
    {
        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/arus_keluar', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function tegnagan_keluar()
    {
        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/tegnagan_keluar', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function daya_keluar()
    {
        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/daya_keluar', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function arus_ac()
    {
        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/arus_ac', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function tengangan_ac()
    {
        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/tengangan_ac', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function daya_aktif()
    {
        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/daya_aktif', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function daya_reaktif()
    {
        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/daya_reaktif', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function faktor_daya()
    {
        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/faktor_daya', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }

    function daya_semu()
    {
        $datas['title'] = 'User Data';
        $datas['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $datas['data'] = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar



        $this->load->view('templates/header', $datas);
        $this->load->view('templates/sidebar', $datas);
        $this->load->view('templates/topbar', $datas);
        $this->template->load('template1', 'userdata/daya_semu', $datas);
        //$this->load->view('templates/footer'); // gak usah di pakai   
    }
}
