<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CHome extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MHome');
	}
	public function index()
	{

		if ($_FILES) {
			$this->upload();
		}
		$data['anh'] = $this->MHome->get_anh();

		$data['user'] = getSession()[0];
		$data['message'] = getMessages();
		$data['url'] = base_url();
		$temp['data'] = $data;
		// pr($data);
		$temp['template'] = "VHome";
		$this->load->view('layout/VContent', $temp);
	}
	public function upload()
	{
        $data   = [];
		$count  = count($_FILES['files']['name']);
		// pr($count);
		$result = 0;
		for ($i = 0; $i < $count; $i++) {

			if (!empty($_FILES['files']['name'][$i])) {

				$_FILES['file']['name']    = $_FILES['files']['name'][$i];
				$_FILES['file']['type']    = $_FILES['files']['type'][$i];
				$_FILES['file']['tmp_name'] =  $_FILES['files']['tmp_name'][$i];
				$_FILES['file']['error']   = $_FILES['files']['error'][$i];
				$_FILES['file']['size']    = $_FILES['files']['size'][$i];

				$config = array(
					'upload_path'   => './public/img',
					'allowed_types' => 'jpg|gif|png',
					'max_size'      => '5000',
				);
				$config['file_name'] = time().$i;
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file')) {
					$data = array('upload_data' => $this->upload->data());
					
					$anh = array(
						'PK_iMaAnh' => time().rand(999, 9999),
						'tLink'		=> $data['upload_data']['file_name']
					);
					$result = $this->MHome->save_upload($anh);
				}
			}
		}
		// pr($anh);
		echo json_decode($result);
		exit();
	}
}
