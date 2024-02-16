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
		$this->db->where_in('title', ['internasional','nasional_plus','nasional','umum']);
		$query_tags	= $this->db->get();

		$tags = [];
		foreach ($query_tags->result() as $tag) {
			$tags[] = [
				'image' => base_url().$tag->filepath,
				'slug' => $tag->title
			];
		}


		// get nasional plus
		$this->db->select('*');
		$this->db->from('contains');
		$this->db->where(['contains.deleted_at' => null]);
		$query_nasplus	= $this->db->get();

		$contains = [];
		foreach ($query_nasplus->result_array() as $_contains) {
			$contains[$_contains['code']] = $_contains['value'];
		}
		
		$nasplus = [
			'title' => $contains['%nasionalplustitle%'],
			'description' => $contains['%nasionalpluscontent%'],
			'youtube' => $contains['%nasionalplusyt%'],
		];


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


		// get testimonials
		$this->db->select('*');
		$this->db->from('testimonial');
		$this->db->where(['deleted_at'=>null]);
		$this->db->limit(5);
		$query_testimonials	= $this->db->get();

		$testimonials = [];
		foreach ($query_testimonials->result_array() as $testimonial) {
			$testimonials[] = [
				'name' => $testimonial['name'],
				'company' => $testimonial['company'],
				'content' => $testimonial['content'],
				'star' => $testimonial['star'],
				'image' => !empty($testimonial['photo'])?(base_url().$testimonial['photo']):null,
			];
		}


		$data = [
			'slides' => $slides,
			'tags' => $tags,
			'nasplus' => $nasplus,
			'news' => $news,
			'testimonials' => $testimonials
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