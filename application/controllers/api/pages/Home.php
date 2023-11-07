<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
header('Content-Type: application/json; charset=utf-8');

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Home extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index_get()
	{
		// get slides
		$this->db->select('*');
		$this->db->from('images');
		$this->db->where(['deleted_at'=>null, 'type'=>'slide']);
		$query_slides	= $this->db->get();

		$slides = [];
		foreach ($query_slides->result_array() as $slide) {
			$slides[] = ['image'=>base_url().$slide['filepath']];
		}

		
		// get profile
		$this->db->select('*');
		$this->db->from('contains');
		$this->db->where(['deleted_at'=>null]);
		$this->db->where_in('code', ['%profile%','%profileimg%']);
		$query_profile	= $this->db->get()->result_array();

		$profile = [
			'title' => 'Profil Perusahaan',
			'desc' => $query_profile[0]['value'],
			'image' => base_url().$query_profile[1]['value']
		];

		
		// get produk
		$this->db->select('p.id, p.title, i.filepath');
		$this->db->from('product p');
		$this->db->join('(SELECT product_id, MIN(image_id) as image_id FROM product_images WHERE deleted_at IS NULL GROUP BY product_id) pi', 'p.id = pi.product_id', 'left');
		$this->db->join('images i', 'pi.image_id = i.id', 'left');
		$this->db->where(['p.deleted_at' => null ]);
		$this->db->where(['published' => 1 ]);
		$this->db->limit(8);
		$query_products	= $this->db->get();

		$products = [];
		foreach ($query_products->result_array() as $product) {
			$products[] = [
				'id' => $product['id'],
				'title' => $product['title'],
				'image' => base_url().$product['filepath']
			];
		}


		// get news featured
		$this->db->select('n.id, n.title, n.description, n.author, n.created_at, i.filepath');
		$this->db->from('news n');
		$this->db->join('images i', 'n.image_id = i.id', 'left');
		$this->db->where(['n.deleted_at'=>null, 'published' => 1]);
		$this->db->order_by('n.id', 'DESC');
		$this->db->limit(1);
		$query_news_featured	= $this->db->get();

		$news_featured = [];
		foreach ($query_news_featured->result_array() as $featured) {
			// potong text
			$str_cut = 150;
			$text = $featured['description'];
			if (strlen($text) > $str_cut) 
			{
			    $text = wordwrap($text, $str_cut);
			    $text = substr($text, 0, strpos($text, "\n"));
			}

			$news_featured[] = [
				'id' => $featured['id'],
				'image'=>base_url().$featured['filepath'],
				'title' => $featured['title'],
				'date' => date('d F Y', strtotime($featured['created_at'])),
				'author' => $featured['author'],
				'desc' => $text
			];
		}

		// get news lists
		$this->db->select('n.id, n.title, n.description, n.author, n.created_at, i.filepath');
		$this->db->from('news n');
		$this->db->join('images i', 'n.image_id = i.id', 'left');
		$this->db->where(['n.deleted_at'=>null, 'published' => 1]);
		$this->db->order_by('n.id', 'DESC');
		$this->db->limit(3,1);
		$query_news_list	= $this->db->get();

		$news_list = [];
		foreach ($query_news_list->result_array() as $list) {
			// potong text
			$str_cut = 50;
			$text = $list['description'];
			if (strlen($text) > $str_cut) 
			{
			    $text = wordwrap($text, $str_cut);
			    $text = substr($text, 0, strpos($text, "\n"));
			}

			$news_list[] = [
				'id' => $list['id'],
				'image'=>base_url().$list['filepath'],
				'title' => $list['title'],
				'date' => date('d M Y', strtotime($list['created_at'])),
				'author' => $list['author'],
				'desc' => $text
			];
		}

		$news = [
			'featured' => $news_featured,
			'lists' => $news_list
		];


		$data = [
			'slides' => $slides,
			'profile' => $profile,
			'products' => $products,
			'news' => $news
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