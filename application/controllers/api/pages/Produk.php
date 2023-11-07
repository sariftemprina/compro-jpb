<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
header('Content-Type: application/json; charset=utf-8');

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Produk extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index_get()
	{
		// get produk
		$this->db->select('p.id, p.title, i.filepath');
		$this->db->from('product p');
		$this->db->join('(SELECT product_id, MIN(image_id) as image_id FROM product_images WHERE deleted_at IS NULL GROUP BY product_id) pi', 'p.id = pi.product_id', 'left');
		$this->db->join('images i', 'pi.image_id = i.id', 'left');
		$this->db->where(['p.deleted_at' => null ]);
		$this->db->where(['published' => 1 ]);
		
		// get params
		if(isset($_GET['kategori'])){
			$kategori = $_GET['kategori'];

			if($kategori=='quran'){
				$this->db->where(['category' => 'quran']);
			}elseif($kategori=='kitab'){
				$this->db->where(['category' => 'kitab']);
			}
		}

		$query_products	= $this->db->get();

		$products = [];
		foreach ($query_products->result_array() as $product) {
			$products[] = [
				'id' => $product['id'],
				'title' => $product['title'],
				'image' => base_url().$product['filepath']
			];
		}

		// kategori
		$kategori = [
			['code'=>'all', 'name'=>'Semua'],
			['code'=>'quran', 'name'=>"Al-Qur'an"],
			['code'=>'kitab', 'name'=>'Kitab'],
		];


		$data = [
			'products' => $products,
			'kategori' => $kategori,
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
		// get detil produk
		// $this->db->select('p.id, p.title, p.description, p.created_at, p.price, i.filepath, p.category');
		// $this->db->from('product p');
		// $this->db->join('(SELECT product_id, MIN(image_id) as image_id FROM product_images WHERE deleted_at IS NULL GROUP BY product_id) pi', 'p.id = pi.product_id', 'left');
		// $this->db->join('images i', 'pi.image_id = i.id', 'left');
		// $this->db->where(['p.deleted_at' => null, 'published' => 1 ]);

		$this->db->select(["p.id", "p.title", "p.description", "p.created_at", "p.price", "p.category", "i.filepath", "(SELECT GROUP_CONCAT(JSON_OBJECT('name', name, 'value', link)) as value FROM product_stores WHERE product_id = p.id GROUP BY product_id) as link"]);
    $this->db->from('product p');
    $this->db->join('(SELECT product_id, MIN(image_id) as image_id FROM product_images WHERE deleted_at IS NULL GROUP BY product_id) pi', 'p.id = pi.product_id', 'left');
    $this->db->join('images i', 'pi.image_id = i.id', 'left');
    $this->db->group_by('p.id');
    $this->db->where(['p.deleted_at' => null, 'published' => 1 ]);

		
		// get params
		if(isset($_GET['id'])){
			$this->db->where(['p.id' => $_GET['id']]);
		}

		$query_product	= $this->db->get();
		$product_row	= $query_product->row();

		$product = [];
		$productSimilar = [];

		if(isset($product_row)){
			// marketplace
			$link = json_decode('['.$product_row->link.']');
			$btn = ['blibli'=>'primary','bukalapak'=>'danger','shopee'=>'warning','tokopedia'=>'success'];
			$links = [];
			foreach ($link as $_link) {
				$links[] = [
					'name' => $_link->name,
					'value' => $_link->value,
					'btn' => $btn[$_link->name],
				];
			}

			$product = [
				'id' => $product_row->id,
				'title' => $product_row->title,
				'image' => base_url().$product_row->filepath,
				'date' => date('d M Y', strtotime($product_row->created_at)),
				'price' => "Rp " . number_format($product_row->price,2,',','.'),
				'desc' => $product_row->description,
				'category' => $product_row->category,
				'varian' => [],
				'marketplace' => $links
			];

			// get produk terkait (kategori yg sama)
			$this->db->select('p.id, p.title, i.filepath');
			$this->db->from('product p');
			$this->db->join('(SELECT product_id, MIN(image_id) as image_id FROM product_images WHERE deleted_at IS NULL GROUP BY product_id) pi', 'p.id = pi.product_id', 'left');
			$this->db->join('images i', 'pi.image_id = i.id', 'left');
			$this->db->where(['p.deleted_at' => null, 'published' => 1 ]);
			$this->db->where(['p.category'=>$product_row->category]);
			$this->db->where(['p.id !=' => $product_row->id]);
			$this->db->limit(4);
			$query_products	= $this->db->get();

			foreach ($query_products->result() as $similar) {
				$productSimilar[] = [
					'id' => $similar->id,
					'title' => $similar->title,
					'image' => base_url().$similar->filepath
				];
			}
		}


		$data = [
			'product' => $product,
			'product_similar' => $productSimilar,
			'count' => count($query_product->result()),
			'count_similar' => count($query_products->result()),
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