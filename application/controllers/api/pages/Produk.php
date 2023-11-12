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
		$this->db->select('p.id, p.title, p.price, p.category, i.filepath');
		$this->db->from('product p');
		$this->db->join('(SELECT product_id, MIN(image_id) as image_id FROM product_images WHERE deleted_at IS NULL GROUP BY product_id) pi', 'p.id = pi.product_id', 'left');
		$this->db->join('images i', 'pi.image_id = i.id', 'left');
		$this->db->where(['p.deleted_at' => null, 'published' => 1 ]);
		
		// get params
		if(isset($_GET['kategori'])){
			if($_GET['kategori']!='all'){
				$this->db->where(['category' => $_GET['kategori']]);
			}
		}

		if(isset($_GET['q'])){
			if($_GET['q']!=""){
				$this->db->like('p.title', $_GET['q']);
			}
		}

		if(isset($_GET['sort'])){
			if($_GET['sort']=="populer"){
				$this->db->where(['popular'=>1]);
			}

			$this->db->order_by('p.id', 'DESC');
		}

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

		// kategori
		$kategoris = [
			['code'=>'all', 'name'=>'Semua'],
			['code'=>'sd', 'name'=>"Siswa SD"],
			['code'=>'smp', 'name'=>"Siswa SMP"],
			['code'=>'sma', 'name'=>"Siswa SMA"],
			['code'=>'guru', 'name'=>"Buku Guru"],
			['code'=>'umum', 'name'=>"Buku Umum"],
		];

		$kategori_lists = [];
		foreach ($kategoris as $kategori) {
			// hitung per kategori
			$this->db->select('*');
			$this->db->from('product');
			$this->db->where(['deleted_at'=>null, 'published' => 1]);
			
			if($kategori['code']!='all'){
				$this->db->where(['category' => $kategori['code']]);
			}

			if(isset($_GET['q'])){
				if($_GET['q']!=""){
					$this->db->like('title', $_GET['q']);
				}
			}

			if(isset($_GET['sort'])){
				if($_GET['sort']=="populer"){
					$this->db->where(['popular'=>1]);
				}

				$this->db->order_by('p.id', 'DESC');
			}

			$total = $this->db->count_all_results();

			$kategori_lists[] = [
				'code'=>$kategori['code'], 'name'=>$kategori['name'], 'total'=>$total
			];
		}


		// filter
		$filters = [
			['code'=>'terbaru', 'name'=>'Buku Terbaru'],
			['code'=>'populer', 'name'=>"Buku Populer"],
		];

		$filter_lists = [];
		foreach ($filters as $filter) {
			// hitung per jenis filter
			$this->db->select('*');
			$this->db->from('product');
			$this->db->where(['deleted_at'=>null, 'published' => 1]);
			
			if($filter['code']=='populer'){
				$this->db->where(['popular'=>1]);
			}

			if(isset($_GET['q'])){
				if($_GET['q']!=""){
					$this->db->like('title', $_GET['q']);
				}
			}

			if(isset($_GET['kategori'])){
				if($_GET['kategori']!='all'){
					$this->db->where(['category' => $_GET['kategori']]);
				}
			}

			$this->db->order_by('p.id', 'DESC');

			$total = $this->db->count_all_results();

			$filter_lists[] = [
				'code'=>$filter['code'], 'name'=>$filter['name'], 'total'=>$total
			];
		}


		$data = [
			'products' => $products,
			'kategori' => $kategori_lists,
			'filter' => $filter_lists,
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
				'price' => "Rp " . number_format($product_row->price,0,',','.'),
				'desc' => $product_row->description,
				'category' => $product_row->category,
				'meta_description' => substr(strip_tags($product_row->description), 0, 150),
				'varian' => [],
				'marketplace' => $links
			];

			// get produk terkait (kategori yg sama)
			$this->db->select('p.id, p.title, i.filepath, p.category, p.price');
			$this->db->from('product p');
			$this->db->join('(SELECT product_id, MIN(image_id) as image_id FROM product_images WHERE deleted_at IS NULL GROUP BY product_id) pi', 'p.id = pi.product_id', 'left');
			$this->db->join('images i', 'pi.image_id = i.id', 'left');
			$this->db->where(['p.deleted_at' => null, 'published' => 1 ]);
			$this->db->where(['p.category'=>$product_row->category]);
			$this->db->where(['p.id !=' => $product_row->id]);
			$this->db->order_by('rand()');
			$this->db->limit(6);
			$query_products	= $this->db->get();

			foreach ($query_products->result() as $similar) {
				$productSimilar[] = [
					'id' => $similar->id,
					'title' => $similar->title,
					'category' => $similar->category,
					'image' => base_url().$similar->filepath,
					'price' => "Rp. " . number_format($similar->price,0,',','.'),
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