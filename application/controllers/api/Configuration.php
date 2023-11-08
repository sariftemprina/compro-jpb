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

		$socmed =  json_decode($contains['%socmed%']);
		$socmeds = [];
		foreach ($socmed as $_socmed) {
			if(!empty($_socmed->value)){
				$socmeds[] = ['name'=>$_socmed->name,'value'=>$_socmed->value];
			}
		}

		$marketplace = [
			[
				'name' => 'tokopedia',
				'url' => 'https://tokopedia.com',
				'image' => base_url().'files/upload/marketplace_tokopedia.png'
			],
			[
				'name' => 'shopee',
				'url' => 'https://shopee.co.id',
				'image' => base_url().'files/upload/marketplace_shopee.png'
			],
		];

		$data = [
			'nama_perusahaan' => $contains['%company%'],
			'title' => $contains['%title%'],
			'meta_title' => ' » '.$contains['%title%'],
			'meta_description' => $contains['%description%'],
			'meta_keywords' => $contains['%keywords%'],
			'logo' => base_url().$contains['%logo%'],

			'address' => 'Jl. Karah Agung No. 45 Karah <br>Kec. Jambangan - Surabaya <br>Jawa Timur 60232',
	    'phone' => '031 - 828 9999 <em>(ext: 303)</em>',
	    'fax' => '031 - 828 1004',
	    'office_hour' => '<span>Senin - Sabtu:</span>  08.00 - 17.00 WIB',
	    'google_map' => 'https://www.google.com/maps/embed/v1/place?key=AIzaSyCoo3U1bS1Xd5SMll4PyxuziUdVUElEYIQ&q=Jl.+Karah+Agung+I+No.45,+Karah,+Kec.+Jambangan,+Surabaya,+Jawa+Timur+60232',

			'social_media' => $socmeds,
			'marketplace' => $marketplace,
			'not_found_image' => base_url().'files/upload/404.png',
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