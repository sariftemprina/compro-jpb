<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
header('Content-Type: application/json; charset=utf-8');

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Berita extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index_get()
	{
		// get berita
		$this->db->select('n.id, n.title, n.description, n.author, n.category, n.created_at, i.filepath');
		$this->db->from('news n');
		$this->db->join('images i', 'n.image_id = i.id', 'left');
		$this->db->where(['n.deleted_at'=>null, 'published' => 1]);
		$this->db->order_by('n.id', 'DESC');

		// get params
		if(isset($_GET['kategori'])){
			$kategori = $_GET['kategori'];

			if($kategori=='informasi'){
				$this->db->where(['category' => 'informasi']);
			}elseif($kategori=='event'){
				$this->db->where(['category' => 'event']);
			}
		}

		$query_news_list	= $this->db->get();

		$news = [];
		foreach ($query_news_list->result() as $list) {
			// potong text
			$str_cut = 80;
			$text = $list->description;
			if (strlen($text) > $str_cut) 
			{
			    $text = wordwrap($text, $str_cut);
			    $text = substr($text, 0, strpos($text, "\n"));
			}

			$news[] = [
				'id' => $list->id,
				'image'=>base_url().$list->filepath,
				'title' => $list->title,
				'date' => date('d M Y', strtotime($list->created_at)),
				'author' => $list->author,
				'desc' => strip_tags($text),
				'category' => $list->category
			];
		}

		// kategori
		$kategori = [
			['code'=>'all', 'name'=>'Semua'],
			['code'=>'event', 'name'=>"Event Perusahaan"],
			['code'=>'informasi', 'name'=>'Informasi'],
		];

		$kategori_lists = [];
		foreach ($kategori as $_kategori) {
			// hitung per kategori
			$this->db->select('*');
			$this->db->from('news');
			$this->db->where(['deleted_at'=>null, 'published' => 1]);
			
			if($_kategori['code']!='all'){
				$this->db->where(['category' => $_kategori['code']]);
			}

			$total = $this->db->count_all_results();

			$kategori_lists[] = [
				'code'=>$_kategori['code'], 'name'=>$_kategori['name'], 'total'=>$total
			];
		}


		$data = [
			'news' => $news,
			'kategori' => $kategori_lists,
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


	public function detil_get()
	{
		// get detil berita
		$this->db->select('n.id, n.title, n.description, n.author, n.category, n.created_at, i.filepath');
		$this->db->from('news n');
		$this->db->join('images i', 'n.image_id = i.id', 'left');
		$this->db->where(['n.deleted_at'=>null, 'published' => 1]);
		
		// get params
		if(isset($_GET['id'])){
			$this->db->where(['n.id' => $_GET['id']]);
		}

		$query_berita	= $this->db->get();
		$berita_row = $query_berita->row();

		$berita = [];
		$beritaLain = [];

		if(isset($berita_row)){
			$berita = [
				'id' => $berita_row->id,
				'title' => $berita_row->title,
				'image' => base_url().$berita_row->filepath,
				'date' => date('d M Y', strtotime($berita_row->created_at)),
				'desc' => $berita_row->description,
				'category' => $berita_row->category,
				'author' => $berita_row->author,				
				'meta_description' => substr(strip_tags($berita_row->description), 0, 150),
			];

			// get berita lain (kecuali yg ditampilkan)
			$this->db->select('n.id, n.title, n.description, n.author, n.category, n.created_at, i.filepath');
			$this->db->from('news n');
			$this->db->join('images i', 'n.image_id = i.id', 'left');
			$this->db->where(['n.deleted_at'=>null, 'published' => 1]);
			$this->db->order_by('n.id', 'DESC');
			$this->db->where(['n.id !=' => $berita_row->id]);
			$this->db->limit(5);
			$query_beritas	= $this->db->get();

			foreach ($query_beritas->result() as $lain) {
				$beritaLain[] = [
					'id' => $lain->id,
					'title' => $lain->title,
					'image' => base_url().$lain->filepath
				];
			}
		}


		$data = [
			'berita' => $berita,
			'berita_lain' => $beritaLain,
			'count' => count($query_berita->result()),
			'count_lain' => count($query_beritas->result()),
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