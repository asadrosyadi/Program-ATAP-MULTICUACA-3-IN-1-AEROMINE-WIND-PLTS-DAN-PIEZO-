<?php
class Rest extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		//is_logged_in();

	}
	function index()
	{
		$tolak = json_encode("access denied");
		echo $tolak;
	}

	function bacajason()
	{

		$data = $this->db->select('*')->from('user')->where('HWID', $this->uri->segment(3))->limit(1)->order_by('id', 'DESC')->get()->result();
		$response = array("Data" => array());
		foreach ($data as $r) {
			$temp = array(
				"sumber_listrik" => $r->sumber_listrik,
				"faktor_daya" => $r->faktor_daya,
				"output_dc" => $r->output_dc,
				"stopkontak_1" => $r->stopkontak_1,
				"stopkontak_2" => $r->stopkontak_2,
				"lampu" => $r->lampu,
				"email" => $r->email
			);

			array_push($response["Data"], $temp);
		}
		$data = json_encode($response);
		echo "$data";
	}


	function updatesumberlistrik()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = array(
				'sumber_listrik'     => $this->input->post('sumber_listrik'),
				'email'     => $this->input->post('email')
			);
			$hwid   = $this->input->post('HWID');
			$this->db->where('HWID', $hwid);
			$this->db->update('user', $data);

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				echo "gagal";
			} else {
				echo "sukses";
			}
		}
	}

	function updatefaktordaya()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = array(
				'faktor_daya'     => $this->input->post('faktor_daya'),
				'email'     => $this->input->post('email')
			);
			$hwid   = $this->input->post('HWID');
			$this->db->where('HWID', $hwid);
			$this->db->update('user', $data);

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				echo "gagal";
			} else {
				echo "sukses";
			}
		}
	}

	function updateoutputdc()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = array(
				'output_dc'     => $this->input->post('output_dc'),
				'email'     => $this->input->post('email')
			);
			$hwid   = $this->input->post('HWID');
			$this->db->where('HWID', $hwid);
			$this->db->update('user', $data);

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				echo "gagal";
			} else {
				echo "sukses";
			}
		}
	}

	function updatestopkontak1()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = array(
				'stopkontak_1'     => $this->input->post('stopkontak_1'),
				'email'     => $this->input->post('email')
			);
			$hwid   = $this->input->post('HWID');
			$this->db->where('HWID', $hwid);
			$this->db->update('user', $data);

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				echo "gagal";
			} else {
				echo "sukses";
			}
		}
	}

	function updatestopkontak2()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = array(
				'stopkontak_2'     => $this->input->post('stopkontak_2'),
				'email'     => $this->input->post('email')
			);
			$hwid   = $this->input->post('HWID');
			$this->db->where('HWID', $hwid);
			$this->db->update('user', $data);

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				echo "gagal";
			} else {
				echo "sukses";
			}
		}
	}

	function lampu()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = array(
				'lampu'     => $this->input->post('lampu'),
				'email'     => $this->input->post('email')
			);
			$hwid   = $this->input->post('HWID');
			$this->db->where('HWID', $hwid);
			$this->db->update('user', $data);

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				echo "gagal";
			} else {
				echo "sukses";
			}
		}
	}



	public function kirimdatasensor()
	{
		$this->db->select('*')->from('user')->where('HWID', $_GET['HWID'])->where('token', $_GET['token'])->get()->row()->id;
		$isi = array(

			'HWID'     => $_GET['HWID'],
			'arus_masuk'     => $_GET['arus_masuk'],
			'tegangan_masuk'     => $_GET['tegangan_masuk'],
			'daya_masuk'     => $_GET['daya_masuk'],
			'arus_baterai'     => $_GET['arus_baterai'],
			'tegangan_baterai'     => $_GET['tegangan_baterai'],
			'daya_baterai'     => $_GET['daya_baterai'],
			'presentase_baterai'     => $_GET['presentase_baterai'],
			'arus_keluar'     => $_GET['arus_keluar'],
			'tegnagan_keluar'     => $_GET['tegnagan_keluar'],
			'daya_keluar'     => $_GET['daya_keluar'],
			'arus_ac'     => $_GET['arus_ac'],
			'tengangan_ac'     => $_GET['tengangan_ac'],
			'daya_aktif'     => $_GET['daya_aktif'],
			'daya_reaktif'     => $_GET['daya_reaktif'],
			'daya_semu'     => $_GET['daya_semu'],
			'faktor_daya'     => $_GET['faktor_daya'],
			'email'     => $_GET['email']

		);
		$this->db->insert('datasensor', $isi);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			echo "gagal";
		} else {
			echo "sukses";
		}
	}

	function log_sensor()
	{

		$log_sensor = $this->db->select('*')->from('datasensor')->where('HWID', $this->uri->segment(3))->order_by('id', 'DESC')->get()->result(); //Untuk mengambil data dari database webinar
		$response = array("log_sensor" => array());
		foreach ($log_sensor as $r) {
			$temp = array(
				"arus_masuk" => $r->arus_masuk,
				"tegangan_masuk" => $r->tegangan_masuk,
				"daya_masuk" => $r->daya_masuk,
				"arus_baterai" => $r->arus_baterai,
				"tegangan_baterai" => $r->tegangan_baterai,
				"daya_baterai" => $r->daya_baterai,
				"presentase_baterai" => $r->presentase_baterai,
				"arus_keluar" => $r->arus_keluar,
				"tegnagan_keluar" => $r->tegnagan_keluar,
				"daya_keluar" => $r->daya_keluar,
				"arus_ac" => $r->arus_ac,
				"tengangan_ac" => $r->tengangan_ac,
				"daya_aktif" => $r->daya_aktif,
				"daya_reaktif" => $r->daya_reaktif,
				"daya_semu" => $r->daya_semu,
				"time" => $r->time
			);

			array_push($response["log_sensor"], $temp);
		}
		$data = json_encode($response);
		echo "$data";
	}
}
