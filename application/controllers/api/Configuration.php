<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
header('Content-Type: application/json; charset=utf-8');

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Configuration extends REST_Controller
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

		// get kontak
		$this->db->select('*');
		$this->db->from('companies');
		$this->db->where(['deleted_at'=>null]);
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

		$socmed =  json_decode($contains['%socmed%']);
		$socmeds = [];
		foreach ($socmed as $_socmed) {
			if(!empty($_socmed->value)){
				$socmeds[] = ['name'=>$_socmed->name,'value'=>$_socmed->value];
			}
		}

		$data = [
			'nama_perusahaan' => $contains['%company%'],
			'title' => $contains['%title%'],
			'meta_title' => ' » '.$contains['%title%'],
			'meta_description' => $contains['%description%'],
			'meta_keywords' => $contains['%keywords%'],
			'logo' => base_url().$contains['%logo%'],
			'social_media' => $socmeds,
			'companies' => $companies,
			'console_status' => '[CahayaQuran] API terhubung :D'
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