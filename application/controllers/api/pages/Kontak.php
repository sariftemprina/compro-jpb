<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
header('Content-Type: application/json; charset=utf-8');

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Kontak extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index_get()
	{		
		// get kontak
		$this->db->select('*');
		$this->db->from('companies');
		$this->db->where(['deleted_at'=>null,'hq'=>0]);
		$this->db->order_by('id', 'ASC');
		$query_companies	= $this->db->get();

		$companies = [];
		foreach ($query_companies->result() as $company) {
			// gambar
			$gambar = json_decode($company->images);

			$companies[] = [
				'name' => $company->name,
				'building' => $company->building,
				'address' => $company->address,
				'email' => $company->email,
				'maps' => $company->maps,
				'contacts' => json_decode($company->contacts),
				'images'=> isset($gambar[0])?base_url().$gambar[0]->value:'',
			];
		}

		$data = [
			'companies' => $companies
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