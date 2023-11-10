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

		$socmed =  json_decode($contains['%socmed%']);
		$socmeds = [];
		foreach ($socmed as $_socmed) {
			if(!empty($_socmed->value)){
				$socmeds[] = ['name'=>$_socmed->name,'value'=>$_socmed->value];
			}
		}

		// get kontak
		$this->db->select('*');
		$this->db->from('companies');
		$this->db->where(['deleted_at'=>null, 'hq'=>1]);
		$this->db->order_by('id', 'ASC');
		$com_query	= $this->db->get();
		$com_row = $com_query->row();

		if(isset($com_row)){
			$c_address = $com_row->address;
			$c_office_hour = $com_row->office_hour;
			$c_maps = $com_row->maps;

			$contacts = json_decode($com_row->contacts);
			$contact = [];
			$c_phone = "";
			$c_fax = "";
			$d_label = "";

			foreach ($contacts as $d_contact) {

				if($d_contact->name=='telephone'){
					if(!empty($d_contact->label)){
						$d_label = ' <em>('.$d_contact->label.')</em>';
					}
					$c_phone = $d_contact->value.$d_label;
				}elseif($d_contact->name=='fax'){
					$c_fax = $d_contact->value;
				}
			}
		}else{
			$c_address = $c_office_hour = $c_maps = $c_phone = $c_fax = "";
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

			'address' => $c_address,
	    'phone' => $c_phone,
	    'fax' => $c_fax,
	    'office_hour' => $c_office_hour,
	    'google_map' => $c_maps,

			'social_media' => $socmeds,
			'marketplace' => $marketplace,
			'not_found_image' => base_url().'files/upload/404.png',
			'console_status' => '[JPbooks] API terhubung :D'
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