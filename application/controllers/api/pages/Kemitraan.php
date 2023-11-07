<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
header('Content-Type: application/json; charset=utf-8');

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Kemitraan extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index_get()
	{		
		// load table contains
		$this->db->select('*');
		$this->db->from('contains');
		$this->db->where(['contains.deleted_at' => null]);
		$query	= $this->db->get();

		$contains = [];
		foreach ($query->result_array() as $_contains) {
			$contains[$_contains['code']] = $_contains['value'];
		}
		
		$data = [
			'title' => $contains['%partnershiptitle%'],
			'subtitle' => $contains['%partnershipsubtitle%'],
			'description' => $contains['%partnershipcontent%'],
			'image' => base_url().$contains['%partnershipimg%'],
			'whatsapp'=> json_decode($contains['%partnershipcontact%']),
		];

		$response = [
			'status'=>'success',
			'status_message'=>'Query was successful',
			'data'=>$data,
			'server_time'=>time(),
			'server_timezone'=>'Asia/Jakarta',
			'api_version'=>'1.0',
		];

		$this->response($response); 
	}
}