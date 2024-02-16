<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
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

		$form = [
			'image' => base_url().'files/upload/kontak.webp',
			'title' => 'Masukan Anda Sangat Berarti',
			'description' => 'Tulis kritik, saran atau pesan Anda kepada kami dan dapatkan informasi seputar program dan pelatihan.'
		];

		$data = [
			'form' => $form,
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


	public function form_post()
	{
		$stream = $this->input->raw_input_stream;
		$post = json_decode($stream);
		
		if(empty($post->nama_lengkap) && empty($post->institusi) && empty($post->jabatan) && empty($post->kota) && empty($post->no_telp) && empty($post->pesan)) {

			$response = [
				'status'=>'error',
				'status_message'=>'Query get errors',
				'data'=> [
					'message' => 'Harap memasukan semua field. '
				],
				'server_time'=>time(),
				'server_timezone'=>'Asia/Jakarta',
				'api_version'=>'1.0',
			];
		
		} else {

			$contact['name']		= $post->nama_lengkap;
			$contact['institutions']	= $post->instansi;
			$contact['position']	= $post->jabatan;
			$contact['phone']	= $post->no_telp;
			$contact['whatsapp']	= $post->no_telp;
			$contact['city']	= $post->kota;
			$contact['message']	= $post->pesan;

			$this->db->insert('contact', $contact);

			$data = [
				'message' => 'Form berhasil disimpan.',
				'id' => $this->db->insert_id()
			];

			$response = [
				'status'=>'success',
				'status_message'=>'Query was successful',
				'data'=>$data,
				'server_time'=>time(),
				'server_timezone'=>'Asia/Jakarta',
				'api_version'=>'1.0',
			];

		}

		$this->response($response);
	}
}