<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
header('Content-Type: application/json; charset=utf-8');

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Tentangkami extends REST_Controller
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
		
		// get profile
		$profile = [
			'title' => 'Profil Perusahaan',
			'desc' => $contains['%profile%'],
			'image' => base_url().$contains['%profileimg%'],
			'descsub' => $contains['%profilesub%']
		];

		// get visimisi
		$visimisi = [
			'visi' => $contains['%misi%'],
			'misi' => $contains['%visi%'],
			'image' => base_url().$contains['%visiimg%']
		];

		// get struktur organisasi
		$this->db->select('*');
		$this->db->from('person');
		$this->db->where(['deleted_at'=>null]);
		$this->db->order_by('num', 'ASC');
		$query_persons	= $this->db->get();

		$persons = [];
		foreach ($query_persons->result_array() as $person) {
			// set sosial media
			$sosmeds = [];
			foreach (json_decode($person['links']) as $sosmed) {
				$sosmeds[] = [
					'nama' => $sosmed->name,
					'url' => 'https://'.$sosmed->name.'.com/'.$sosmed->value,
				];
			}

			$persons[] = [
				'image' => base_url().$person['photo'],
				'nama' => $person['name'],
				'jabatan' => $person['position'],
				'sosial_media' => $sosmeds,
			];
		}


		// get partner
		$this->db->select('*');
		$this->db->from('images');
		$this->db->where(['deleted_at'=>null, 'type'=>'partner']);
		$query_partners	= $this->db->get();

		$partners = [];
		foreach ($query_partners->result_array() as $partner) {
			$partners[] = ['image'=>base_url().$partner['filepath']];
		}


		$data = [
			'profile' => $profile,
			'visimisi' => $visimisi,
			'persons' => $persons,
			'partners' => $partners
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