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

		
		// get kategori
		$this->db->select('*');
		$this->db->from('images');
		$this->db->where(['deleted_at'=>null, 'type'=>'kategori']);
		$this->db->where_in('title', ['guru','sd','smp','sma','umum']);
		$query_kategori	= $this->db->get();

		$kategoris = $lists = $featured = [];
		$col = ['sd'=>6,'smp'=>5,'sma'=>5,'umum'=>6];
		foreach ($query_kategori->result() as $kategori) {
			if($kategori->title=='guru'){
				$featured[] = [
					'col' => 3,
					'image' => base_url().$kategori->filepath,
					'slug' => $kategori->title
				];
			}else{
				$lists[] = [
					'col' => $col[$kategori->title],
					'image' => base_url().$kategori->filepath,
					'slug' => $kategori->title
				];
			}

			$kategoris['featured'] = $featured;
			$kategoris['lists'] = $lists;
		}

		
		// get produk terbaru
		$this->db->select('p.id, p.title, p.price, p.category, i.filepath');
		$this->db->from('product p');
		$this->db->join('(SELECT product_id, MIN(image_id) as image_id FROM product_images WHERE deleted_at IS NULL GROUP BY product_id) pi', 'p.id = pi.product_id', 'left');
		$this->db->join('images i', 'pi.image_id = i.id', 'left');
		$this->db->where(['p.deleted_at' => null, 'published' => 1 ]);
		$this->db->order_by('p.id', 'DESC');
		$this->db->limit(12);
		$query_products	= $this->db->get();

		$products = [];
		foreach ($query_products->result() as $product) {
			$products[] = [
				'id' => $product->id,
				'title' => $product->title,
				'category' => $product->category,
				'image' => base_url().$product->filepath,
				'price' => "Rp. " . number_format($product->price,0,',','.'),
			];
		}

		// get produk populer
		$this->db->select('p.id, p.title, p.price, p.category, i.filepath');
		$this->db->from('product p');
		$this->db->join('(SELECT product_id, MIN(image_id) as image_id FROM product_images WHERE deleted_at IS NULL GROUP BY product_id) pi', 'p.id = pi.product_id', 'left');
		$this->db->join('images i', 'pi.image_id = i.id', 'left');
		$this->db->where(['p.deleted_at' => null, 'published' => 1, 'popular'=>1 ]);
		$this->db->limit(6);
		$query_populars	= $this->db->get();

		$populars = [];
		foreach ($query_populars->result() as $popular) {
			$populars[] = [
				'id' => $popular->id,
				'title' => $popular->title,
				'category' => $product->category,
				'image' => base_url().$popular->filepath,
				'price' => "Rp. " . number_format($popular->price,0,',','.'),
			];
		}


		// get news lists
		$this->db->select('n.id, n.title, n.category, n.author, n.created_at, i.filepath');
		$this->db->from('news n');
		$this->db->join('images i', 'n.image_id = i.id', 'left');
		$this->db->where(['n.deleted_at'=>null, 'published' => 1]);
		$this->db->order_by('n.id', 'DESC');
		$this->db->limit(6);
		$query_news	= $this->db->get();

		$news = [];
		foreach ($query_news->result() as $list) {
			$news[] = [
				'id' => $list->id,
				'image'=>base_url().$list->filepath,
				'title' => $list->title,
				'date' => date('d M Y', strtotime($list->created_at)),
				'author' => $list->author,
				'category' => $list->category
			];
		}


		$data = [
			'slides' => $slides,
			'kategoris' => $kategoris,
			'products' => $products,
			'populars' => $populars,
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