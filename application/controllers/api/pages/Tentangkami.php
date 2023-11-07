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
			'image' => base_url().$contains['%profileimg%']
		];

		// get visimisi
		$visimisi = [
			'visi' => $contains['%misi%'],
			'misi' => $contains['%visi%'],
			'image' => base_url().$contains['%visiimg%']
		];

		// get penghargaan
		$this->db->select('*');
		$this->db->from('images');
		$this->db->where(['deleted_at'=>null, 'type'=>'achievement']);
		$query_penghargaans	= $this->db->get();

		$penghargaans = [];
		foreach ($query_penghargaans->result_array() as $penghargaan) {
			$penghargaans[] = ['image'=>base_url().$penghargaan['filepath']];
		}

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


		$data = [
			'profile' => $profile,
			'visimisi' => $visimisi,
			'penghargaans' => $penghargaans,
			'persons' => $persons
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