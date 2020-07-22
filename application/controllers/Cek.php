<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cek extends CI_Controller {

	public function index()
	{
		$this->load->view('cek_ip');
	}

	public function cekIp(){
		$host = $this->input->post('ip');
		$res = exec("ping -n 1 " . $host);
		$data['status'] = [];
		$data['ip'] = $host;

		if (preg_match('/\bReceived = 0\b/', $res) || preg_match('/\bnot\b/', $res)){
			$data['status'] = [
				'status' => 'failed',
				'msg' => $res
			];
		}
		else if(preg_match('/\bMinimum = 0ms\b/', $res)){
			$data['status'] = [
				'status' => 'failed',
				'msg' => $res
			];
		}
		else{
			$data['status'] = [
				'status' => 'success',
				'msg' => $res
			];
		}

		$this->load->view('status', $data);
	}
}
