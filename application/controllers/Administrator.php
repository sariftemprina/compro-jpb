<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	
	public function __construct(){
        parent::__construct();

		if($this->session->userdata('uid') == false){
			header('location:'.base_url('main/login'));
		}
    }

	public function index()
	{
		$data['breadcrumb'][]	= ['text' => '<i class="bi-house-door"></i>', 'url' => base_url()];
		$data['breadcrumb'][]	= ['text' => 'Dashboard', 'url' => base_url()];

		$data['title']			= "Dashboard";
		$data['content']		= "administrator/dashboard";
		$this->load->view('administrator/index', $data);
	}

	public function menu()
	{

		if($this->input->get('get') == 'data'){

			$this->db->select(['menu.id','menu.text','menu.url','menu.index', 'IFNULL(idx.text,\'<i>Menu Utama</i>\') as text_index', 'menu.sort','menu.created_at','menu.updated_at','menu.deleted_at']);
			$this->db->join('menu idx', 'idx.id = menu.index', 'left');
			if($this->input->post('id')){
				$this->db->where(['menu.id' => $this->input->post('id')]);
			}
			$this->db->where(['menu.deleted_at' => null]);
			$this->db->order_by('menu.index');
			$this->db->order_by('menu.sort');
			$query	= $this->db->get('menu');
			
			echo json_encode(['status' => true, 'result' => $query->result_array()]);
			return false;

		}

		if($this->input->get('do') == 'delete'){
			$this->form_validation->set_rules('id', 'ID', 'required');
			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

			$this->db->update('menu', ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $this->input->post('id')]);
			echo json_encode(['status' => true, 'msg' => 'berhasil menghapus menu']);
			return false;
		}
		
		if($this->input->get('do') == 'submit'){
			$this->form_validation->set_rules('text', 'Text', 'required');
			$this->form_validation->set_rules('url', 'Alamat Url', 'required');

			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

			$insert_menu['text']	= $this->input->post('text');
			$insert_menu['url']		= $this->input->post('url');
			$insert_menu['index']	= $this->input->post('index');
			$insert_menu['sort']	= $this->input->post('sort');
			$this->db->insert('menu', $insert_menu);

			echo json_encode(['status' => true, 'msg' => 'berhasil menambah menu']);
			return false;
		}

		$data['breadcrumb'][]	= ['text' => '<i class="bi-house-door"></i>', 'url' => base_url()];
		$data['breadcrumb'][]	= ['text' => 'Menu Setting', 'url' => base_url('administrator/menu')];

		$data['title']			= "Pengaturan Menu";
		$data['content']		= "administrator/setting_menu";
		$this->load->view('administrator/index', $data);
	}

	public function user()
	{
		if($this->input->get('get') == 'data'){
			$this->db->from('users');
			$this->db->where(['deleted_at' => null]);
			$query	= $this->db->get();
			
			echo json_encode(['status' => true, 'result' => $query->result_array()]);
			return false;		
		}
		if($this->input->get('do') == 'delete'){
			$query = $this->db->update('users',  ['deleted_at' => time()], ['id' => $this->input->post('id')]);
			if($this->db->affected_rows() > 0){
				echo json_encode(['status' => true, 'msg' => 'user successfully deleted']);
			}else{
				echo json_encode(['status' => false, 'msg' => 'error']);
			}
			return false;		
		}
		if($this->input->get('do') == 'submit'){

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');

			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

            $param  = [
						'username' => $this->input->post('username'), 
						'email' => $this->input->post('email'), 
						'password' => $this->input->post('password'), 
						'cpassword' => $this->input->post('cpassword')
					];

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => base_url('./api/User/register'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,   
                CURLOPT_POST => 1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $param,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
            ));
            $result = curl_exec($curl);		
            curl_close($curl);

            $response = json_decode($result, true);

			echo json_encode($response);
			return false;
		}


		$data['breadcrumb'][]	= ['text' => '<i class="bi-house-door"></i>', 'url' => base_url()];
		$data['breadcrumb'][]	= ['text' => 'User Setting', 'url' => base_url('administrator/user')];

		$data['title']			= "Pengaturan Pengguna";
		$data['content']		= "administrator/setting_user";
		$this->load->view('administrator/index', $data);
	}

	public function profile()
	{
		/** Partnership */
		if($this->input->get('do') == 'save-partnership'){
			$this->form_validation->set_rules('partnershiptitle', 'Judul', 'required');		
			$this->form_validation->set_rules('partnershipcontent', 'Deskripsi', 'required');		

			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);	
				return false;			
			}

			$input = $this->input->post();
			if($this->input->post('partnershipimg') != ""){
				$img	= $this->images_model->decodeBase64($this->input->post('partnershipimg'));
				if($img['status'] == false){
					echo json_encode($img);
					return false;
				}

				$filepath_profile = "files/upload/img-partnership.jpg";
				file_put_contents($filepath_profile, $img['images']);
				
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= $filepath_profile;
				$config['maintain_ratio'] 	= TRUE;
				$config['width']         	= 800;
				$config['height']       	= 800;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$input['partnershipimg'] = $filepath_profile;
			}else{
				unset($input['partnershipimg']);
			}

			foreach($input as $k => $v){
				$where['code']		= "%{$k}%";
				$where['lang']		= ($this->session->userdata('lang') ?? 'ID');
				$set['value']		= $v;
				$this->db->update('contains', $set, $where);
			}
			echo json_encode(['status' => true, 'msg' => 'berhasil mengupdate informasi partnership']);
			return false;
		}

		/** Site */
		if($this->input->get('do') == 'save-site'){

			$input = $this->input->post();
			if($this->input->post('logo') != ""){
				$img	= $this->images_model->decodeBase64($this->input->post('logo'));
				if($img['status'] == false){
					echo json_encode($img);
					return false;
				}

				$filename = "logo-utama.png";
				$filepath = "files/upload/{$filename}";
				file_put_contents($filepath, $img['images']);
				
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= $filepath;
				$config['maintain_ratio'] 	= TRUE;
				$config['width']         	= 800;
				$config['height']       	= 800;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$input['logo'] = $filepath;
			}else{
				unset($input['logo']);
			}

			$input['socmed']	= json_encode($this->input->post('socmed'));
			$input['stores']	= json_encode($this->input->post('stores'));

			foreach($input as $k => $v){
				$where['code']		= "%{$k}%";
				$where['lang']		= ($this->session->userdata('lang') ?? 'ID');
				$set['value']		= $v;
				$this->db->update('contains', $set, $where);
			}

			echo json_encode(['status' => true, 'msg' => 'berhasil mengupdate pengaturan website']);
			return false;
		}

		/** Profile */
		if($this->input->get('do') == 'save-profile'){
			$input = $this->input->post();
			if($this->input->post('profileimg') != ""){
				$img	= $this->images_model->decodeBase64($this->input->post('profileimg'));
				if($img['status'] == false){
					echo json_encode($img);
					return false;
				}

				$filepath_profile = "files/upload/img-profile.jpg";
				file_put_contents($filepath_profile, $img['images']);
				
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= $filepath_profile;
				$config['maintain_ratio'] 	= TRUE;
				$config['width']         	= 800;
				$config['height']       	= 800;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$input['profileimg'] = $filepath_profile;
			}else{
				unset($input['profileimg']);
			}

			if($this->input->post('visiimg') != ""){
				$img	= $this->images_model->decodeBase64($this->input->post('visiimg'));
				if($img['status'] == false){
					echo json_encode($img);
					return false;
				}

				$filepath_visi = "files/upload/img-visi.jpg";
				file_put_contents($filepath_visi, $img['images']);
				
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= $filepath_visi;
				$config['maintain_ratio'] 	= TRUE;
				$config['width']         	= 800;
				$config['height']       	= 800;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$input['visiimg'] = $filepath_visi;
			}else{
				unset($input['visiimg']);
			}

			if($this->input->post('misiimg') != ""){
				$img	= $this->images_model->decodeBase64($this->input->post('misiimg'));
				if($img['status'] == false){
					echo json_encode($img);
					return false;
				}

				$filepath_misi = "files/upload/img-misi.jpg";
				file_put_contents($filepath_misi, $img['images']);
				
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= $filepath_misi;
				$config['maintain_ratio'] 	= TRUE;
				$config['width']         	= 800;
				$config['height']       	= 800;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$input['misiimg'] = $filepath_misi;
			}else{
				unset($input['misiimg']);
			}

			foreach($input as $k => $v){
				$where['code']		= "%{$k}%";
				$where['lang']		= ($this->session->userdata('lang') ?? 'ID');
				$set['value']		= $v;
				$this->db->update('contains', $set, $where);
			}

			echo json_encode(['status' => true, 'msg' => 'berhasil mengupdate profile website']);
			return false;
		}

		/* Company */
		if($this->input->get('do') == 'save-company'){
			$this->form_validation->set_rules('name', 'Nama Perusahaan', 'required');		
			// $this->form_validation->set_rules('building', 'Gedung', 'required');		
			$this->form_validation->set_rules('address', 'Alamat', 'required');			

			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);	
				return false;			
			}
			
			if($this->input->post('images')){
				$images	= [];
				foreach($this->input->post('images') as $k => $v){
					if (file_exists($v['value'])) {
						array_push($images, array('name' => 'file', 'value' => $v['value']));	
					}else if($v['value'] != ""){
						$img	= $this->images_model->decodeBase64($v['value']);
						if($img['status'] == false){
							echo json_encode($img);
							return false;
						}
						$filename = _uniqid(50);
						$filepath = "files/upload/{$filename}.{$img['type']}";
						file_put_contents($filepath, $img['images']);
				
						$config['image_library'] 	= 'gd2';
						$config['source_image'] 	= $filepath;
						$config['maintain_ratio'] 	= TRUE;
						$config['width']         	= 1024;
						$config['height']       	= 1024;
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						array_push($images, array('name' => $v['name'], 'value' => $filepath));	
					}else{
						array_push($images, array('name' => 'foto', 'value' => null));	
					}
				}

			}

			$set_company['name']		= $this->input->post('name');
			$set_company['building']	= $this->input->post('building');
			$set_company['address']		= $this->input->post('address');
			$set_company['contacts']	= json_encode($this->input->post('contacts'));
			$set_company['email']		= $this->input->post('email');
			$set_company['maps']		= $this->input->post('maps');
			$set_company['hq']			= $this->input->post('hq');
			$set_company['office_hour']	= nl2br($this->input->post('office_hour'));

			if($set_company['hq'] == '1'){
				$this->db->update('companies', ['hq' => 0], ['hq' => 1]);
			}

			if($images){
				$set_company['images']		= json_encode($images);
			}

			if($this->input->get('id')){
				$company = $this->db->get_where('companies', ['id' => $this->input->get('id')]);
				$this->db->update('companies', $set_company, ['id' => $this->input->get('id')]);
				echo json_encode(['status' => true, 'msg' => 'berhasil merubah kontak perusahaan']);
			}else{
				$this->db->insert('companies', $set_company);
				echo json_encode(['status' => true, 'msg' => 'berhasil menambah kontak perusahaan']);
			}

			return false;
		}

		if($this->input->get('do') == 'delete-company'){
			$this->form_validation->set_rules('id', 'ID', 'required');
			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

			$this->db->update('companies', ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $this->input->post('id')]);
			echo json_encode(['status' => true, 'msg' => 'berhasil menghapus informasi perusahaan']);
			return false;
		}

		/* Person */
		if($this->input->get('do') == 'delete-person'){
			$this->form_validation->set_rules('id', 'ID', 'required');
			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

			$this->db->update('person', ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $this->input->post('id')]);
			echo json_encode(['status' => true, 'msg' => 'berhasil menghapus dari struktur organisasi']);
			return false;
		}

		if($this->input->get('do') == 'save-person'){
			$this->form_validation->set_rules('name', 'Nama', 'required');			
			$this->form_validation->set_rules('position', 'Jabatan', 'required');			

			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);	
				return false;			
			}

			$img	= $this->images_model->decodeBase64($this->input->post('photo'));
			if($img['status'] == false){
				echo json_encode($img);
				return false;
			}

			$filename = _uniqid(50);
			$filepath = "files/upload/{$filename}.{$img['type']}";
			file_put_contents($filepath, $img['images']);
			
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= $filepath;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 800;
			$config['height']       	= 800;
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$input['logo'] = $filepath;


			$person_insert['name']		= $this->input->post('name');
			$person_insert['position']	= $this->input->post('position');
			$person_insert['links']		= json_encode($this->input->post('links'));
			$person_insert['num']		= $this->input->post('num');
			$person_insert['photo']		= $filepath;
			$this->db->insert('person', $person_insert);

			echo json_encode(['status' => true, 'msg' => 'berhasil menambah personal']);
			return false;
		}


		if($this->input->get('get') == 'data'){
			$this->db->where(['deleted_at' => null]);
			$query_site = $this->db->where(['section' => 'site'])->get('contains');
			$query_profile = $this->db->where(['section' => 'profile'])->get('contains');
			$query_partnership = $this->db->where(['section' => 'partnership'])->get('contains');

			/** Person */
			$query_person = $this->db->where(['deleted_at' => null])->order_by('num')->get('person');

			/* Companies */
			$query_companies = $this->db->where(['deleted_at' => null])->get('companies');

			$data['result']['site']			= $query_site->result_array();
			$data['result']['profile']		= $query_profile->result_array();
			$data['result']['person']		= $query_person->result_array();
			$data['result']['companies']	= $query_companies->result_array();
			$data['result']['partnership']	= $query_partnership->result_array();
			$data['status']	= true;

			echo json_encode($data);
			return false;
		}

		$data['breadcrumb'][]	= ['text' => '<i class="bi-house-door"></i>', 'url' => base_url()];
		$data['breadcrumb'][]	= ['text' => 'Profile', 'url' => base_url('administrator/profile')];

		$data['title']			= "Profile Website dan Perusahaan";
		$data['content']		= "administrator/profile";
		$this->load->view('administrator/index', $data);
	}

	public function news()
	{
		if($this->input->get('get') == 'count'){
			$this->db->select(['COUNT(*) as total', 'published'], FALSE);
			$this->db->from('news');
			$this->db->where(['news.deleted_at' => null]);
			$this->db->group_by('published');
			$query	= $this->db->get();
			
			echo json_encode(['status' => true, 'result' => $query->result_array()]);
			return false;
		}

		if($this->input->get('get') == 'data'){
			$this->db->select(['news.id','news.title','news.description','news.category','news.description','news.published','news.author','news.created_at','images.filepath','images.caption']);
			$this->db->from('news');
			$this->db->where(['news.deleted_at' => null]);
			$this->db->join('images', 'news.image_id = images.id', 'left');

			if($this->input->post('id')){
				$this->db->where(['news.id' => $this->input->post('id')]);
			}

			$query	= $this->db->get();
			
			echo json_encode(['status' => true, 'result' => $query->result_array()]);
			return false;
		}

		if($this->input->get('do') == 'delete'){
			$this->form_validation->set_rules('id', 'ID', 'required');
			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

			$this->db->update('news', ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $this->input->post('id')]);
			echo json_encode(['status' => true, 'msg' => 'berhasil menghapus artikel']);
			return false;
		}

		if($this->input->get('do') == 'update'){
			$this->form_validation->set_rules('title', 'Judul', 'required');
			$this->form_validation->set_rules('description', 'Isi', 'required');
			$this->form_validation->set_rules('category', 'Kategori', 'required');

			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

			if($this->input->post('imgbase64') != ""){
				$img	= $this->images_model->decodeBase64($this->input->post('imgbase64'));
				if($img['status'] == false){
					echo json_encode($img);
					return false;
				}

				$filename = _uniqid(50);
				$filepath = "files/upload/{$filename}.{$img['type']}";
				file_put_contents($filepath, $img['images']);
				
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= $filepath;
				$config['maintain_ratio'] 	= TRUE;
				$config['width']         	= 1024;
				$config['height']       	= 1024;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();

				$insert_img['caption']	= $this->input->post('imgcaption');
				$insert_img['filepath']	= $filepath;
				$insert_img['type']		= 'article';
				$this->db->insert('images', $insert_img);
	
				$update_news['image_id']	= $this->db->insert_id();	
			}

			$update_news['title']		= $this->input->post('title');
			$update_news['description']	= $this->input->post('description');
			$update_news['category']	= $this->input->post('category');
			$update_news['published']	= $this->input->post('published');
			$update_news['author']		= $this->session->userdata('username');
			$this->db->update('news', $update_news, ['id' => $this->input->post('id')]);

			echo json_encode(['status' => true, 'msg' => 'berhasil menambahkan artikel']);
			return false;
		}

		if($this->input->get('do') == 'add'){
			$this->form_validation->set_rules('imgbase64', 'image', 'required');
			$this->form_validation->set_rules('title', 'Judul', 'required');
			$this->form_validation->set_rules('description', 'Isi', 'required');
			$this->form_validation->set_rules('category', 'Kategori', 'required');

			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

			$img	= $this->images_model->decodeBase64($this->input->post('imgbase64'));
			if($img['status'] == false){
				echo json_encode($img);
				return false;
			}

			$filename = _uniqid(50);
			$filepath = "files/upload/{$filename}.{$img['type']}";
			file_put_contents($filepath, $img['images']);
			
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= $filepath;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 1024;
			$config['height']       	= 1024;
			$this->image_lib->initialize($config);
			$this->image_lib->resize();

			$insert_img['caption']	= $this->input->post('imgcaption');
			$insert_img['filepath']	= $filepath;
			$insert_img['type']		= 'article';
			$this->db->insert('images', $insert_img);

			$insert_news['image_id']	= $this->db->insert_id();
			$insert_news['title']		= $this->input->post('title');
			$insert_news['description']	= $this->input->post('description');
			$insert_news['category']	= $this->input->post('category');
			$insert_news['published']	= $this->input->post('published');
			$insert_news['author']		= $this->session->userdata('username');

			$this->db->insert('news', $insert_news);

			echo json_encode(['status' => true, 'msg' => 'berhasil menambahkan artikel']);
			return false;
		}

		$data['breadcrumb'][]	= ['text' => '<i class="bi-house-door"></i>', 'url' => base_url()];
		$data['breadcrumb'][]	= ['text' => 'News and Articles', 'url' => base_url('administrator/news/list')];
		$data['breadcrumb'][]	= ['text' => (($this->uri->segment(3) == 'form') ? 'Add New' : 'Browse'), 'url' => (($this->uri->segment(3) == 'form') ? base_url('administrator/news/add') : base_url('administrator/news/list'))];

		$data['title']			= "Pengaturan Berita dan Artikel";
		$data['content']		= "administrator/news" . ($this->uri->segment(3) == 'form' ? '_form' : '_list');
		$this->load->view('administrator/index', $data);
	}

	public function gallery()
	{
		if($this->input->get('get') == 'count'){
			$this->db->select(['COUNT(*) as total', 'published'], FALSE);
			$this->db->from('album');
			$this->db->where(['album.deleted_at' => null]);
			$this->db->group_by('published');
			$query	= $this->db->get();
			
			echo json_encode(['status' => true, 'result' => $query->result_array()]);
			return false;
		}

		if($this->input->get('get') == 'data'){
			$this->db->select(['album.id','album.title','album.description','album.published','album.created_at', 'album_images.data as images']);
			$this->db->from('album');
			$this->db->join("(SELECT CONCAT('[', GROUP_CONCAT((JSON_OBJECT('id', images.id, 'caption', images.caption, 'filepath', images.filepath))), ']') as data, album_id from album_images left join images on images.id = album_images.image_id where images.deleted_at is null and album_images.deleted_at is null group by album_id) album_images", 'album.id = album_images.album_id', 'left');
			$this->db->where(['album.deleted_at' => null ]);
			$this->db->group_by('album.id');
			
			if($this->input->post('id')){
				$this->db->where(['album.id' => $this->input->post('id')]);
			}

			$query	= $this->db->get();
			
			echo json_encode(['status' => true, 'result' => $query->result_array()]);
			return false;
		}

		if($this->input->get('do') == 'update'){
			$this->form_validation->set_rules('title', 'Judul', 'required');
			$this->form_validation->set_rules('description', 'Isi', 'required');

			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

			$images	= array();
			if($this->input->post('images')){				
				foreach($this->input->post('images') as $k => $v){
					$img	= $this->images_model->decodeBase64($v['imgbase64']);
					if($img['status'] == false){
						echo json_encode($img);
						return false;
					}

					$filename = _uniqid(50);
					$filepath = "files/upload/{$filename}.{$img['type']}";
					file_put_contents($filepath, $img['images']);
			
					$config['image_library'] 	= 'gd2';
					$config['source_image'] 	= $filepath;
					$config['maintain_ratio'] 	= TRUE;
					$config['width']         	= 1024;
					$config['height']       	= 1024;
					$this->image_lib->initialize($config);
					$this->image_lib->resize();

					array_push($images, array('imgcaption' => $v['imgcaption'], 'filepath' => $filepath));
				}
			}

			$album_id	= $this->input->post('id');
			$update_album['title']		= $this->input->post('title');
			$update_album['description']	= $this->input->post('description');
			$update_album['published']	= $this->input->post('published');
			$this->db->update('album', $update_album, ['id' => $album_id]);

			foreach($images as $k => $v){
				$insert_img['caption']		= $v['imgcaption'];
				$insert_img['filepath']		= $v['filepath'];
				$insert_img['type']			= 'album';
				$this->db->insert('images', $insert_img);	

				$image_id	= $this->db->insert_id();
				$this->db->insert('album_images', ['album_id' => $album_id, 'image_id' => $image_id]);	
			}

			echo json_encode(['status' => true, 'msg' => 'berhasil merubah album']);
			return false;
		}

		if($this->input->get('do') == 'add'){
			$this->form_validation->set_rules('title', 'Judul', 'required');
			$this->form_validation->set_rules('description', 'Isi', 'required');

			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

			$images	= array();
			if($this->input->post('images')){				
				foreach($this->input->post('images') as $k => $v){
					$img	= $this->images_model->decodeBase64($v['imgbase64']);
					if($img['status'] == false){
						echo json_encode($img);
						return false;
					}

					$filename = _uniqid(50);
					$filepath = "files/upload/{$filename}.{$img['type']}";
					file_put_contents($filepath, $img['images']);
			
					$config['image_library'] 	= 'gd2';
					$config['source_image'] 	= $filepath;
					$config['maintain_ratio'] 	= TRUE;
					$config['width']         	= 1024;
					$config['height']       	= 1024;
					$this->image_lib->initialize($config);
					$this->image_lib->resize();

					array_push($images, array('imgcaption' => $v['imgcaption'], 'filepath' => $filepath));
				}
			}

			if(count($images) == 0){
				echo json_encode(['status' => false, 'msg' => 'gambar album harus diisi']);
				return false;
			}

			$insert_album['title']			= $this->input->post('title');
			$insert_album['description']	= $this->input->post('description');
			$insert_album['published']		= $this->input->post('published');
			$this->db->insert('album', $insert_album);
			$album_id	= $this->db->insert_id();

			foreach($images as $k => $v){
				$insert_img['caption']		= $v['imgcaption'];
				$insert_img['filepath']		= $v['filepath'];
				$insert_img['type']			= 'album';
				$this->db->insert('images', $insert_img);	
				$image_id	= $this->db->insert_id();

				$this->db->insert('album_images', ['album_id' => $album_id, 'image_id' => $image_id]);	
			}

			echo json_encode(['status' => true, 'msg' => 'berhasil menambahkan album']);
			return false;
		}

		if($this->input->get('do') == 'delete-image'){
			$this->form_validation->set_rules('image_id', 'Gambar Album', 'required');
			$this->form_validation->set_rules('album_id', 'Data Album', 'required');
			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

			$this->db->delete('album_images', ['image_id' => $this->input->post('image_id'), 'album_id' => $this->input->post('album_id')]);
			$this->db->update('images', ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $this->input->post('image_id')]);

			echo json_encode(['status' => true, 'msg' => 'berhasil menghapus gambar produk']);
			return false;
		}

		if($this->input->get('do') == 'delete'){
			$this->form_validation->set_rules('id', 'ID Album', 'required');
			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

			$this->db->update('album', ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $this->input->post('id')]);
			echo json_encode(['status' => true, 'msg' => 'berhasil menghapus produk']);
			return false;
		}

		$data['breadcrumb'][]	= ['text' => '<i class="bi-house-door"></i>', 'url' => base_url()];
		$data['breadcrumb'][]	= ['text' => 'Gallery and Album', 'url' => base_url('administrator/gallery/list')];
		$data['breadcrumb'][]	= ['text' => (($this->uri->segment(3) == 'form') ? 'Add New' : 'Browse'), 'url' => (($this->uri->segment(3) == 'form') ? base_url('administrator/gallery/add') : base_url('administrator/gallery/list'))];

		$data['title']			= "Album Gallery";
		$data['content']		= "administrator/gallery" . ($this->uri->segment(3) == 'form' ? '_form' : '_list');
		$this->load->view('administrator/index', $data);
	}

	public function product()
	{
		if($this->input->get('get') == 'count'){
			$this->db->select(['COUNT(*) as total', 'published'], FALSE);
			$this->db->from('product');
			$this->db->where(['product.deleted_at' => null]);
			$this->db->group_by('published');
			$query	= $this->db->get();
			
			echo json_encode(['status' => true, 'result' => $query->result_array()]);
			return false;
		}

		if($this->input->get('get') == 'data'){
			$this->db->select(['product.id','product.title','product.description','product.category','product.popular','product.published','product.price','product.created_at', 'product_images.data as images', 'product_stores.data as stores']);
			$this->db->from('product');
			$this->db->join("(SELECT CONCAT('[', GROUP_CONCAT((JSON_OBJECT('id', images.id, 'caption', images.caption, 'filepath', images.filepath))), ']') as data, product_id from product_images left join images on images.id = product_images.image_id where images.deleted_at is null and product_images.deleted_at is null group by product_id) product_images", 'product.id = product_images.product_id', 'left');
			$this->db->join("(SELECT CONCAT('[', GROUP_CONCAT((JSON_OBJECT('store', product_stores.name, 'link', product_stores.link))), ']') as data, product_id from product_stores where deleted_at is null group by product_id) product_stores", 'product.id = product_stores.product_id', 'left');
			$this->db->where(['product.deleted_at' => null ]);
			$this->db->group_by('product.id');
			
			if($this->input->post('id')){
				$this->db->where(['product.id' => $this->input->post('id')]);
			}

			$query	= $this->db->get();
			
			echo json_encode(['status' => true, 'result' => $query->result_array()]);
			return false;
		}

		if($this->input->get('do') == 'update'){
			$this->form_validation->set_rules('title', 'Judul', 'required');
			$this->form_validation->set_rules('description', 'Isi', 'required');

			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

			$images	= array();
			$stores	= ($this->input->post('stores')) ? $this->input->post('stores') : array();
			if($this->input->post('images')){				
				foreach($this->input->post('images') as $k => $v){
					$img	= $this->images_model->decodeBase64($v['imgbase64']);
					if($img['status'] == false){
						echo json_encode($img);
						return false;
					}

					$filename = _uniqid(50);
					$filepath = "files/upload/{$filename}.{$img['type']}";
					file_put_contents($filepath, $img['images']);
			
					$config['image_library'] 	= 'gd2';
					$config['source_image'] 	= $filepath;
					$config['maintain_ratio'] 	= TRUE;
					$config['width']         	= 1024;
					$config['height']       	= 1024;
					$this->image_lib->initialize($config);
					$this->image_lib->resize();

					array_push($images, array('imgcaption' => $v['imgcaption'], 'filepath' => $filepath));
				}
			}

			$product_id	= $this->input->post('id');
			$update_product['title']		= $this->input->post('title');
			$update_product['description']	= $this->input->post('description');
			$update_product['price']		= $this->input->post('price');
			$update_product['published']	= $this->input->post('published');
			$update_product['popular']		= $this->input->post('popular');
			$update_product['category']		= $this->input->post('category');
			$this->db->update('product', $update_product, ['id' => $product_id]);

			foreach($images as $k => $v){
				$insert_img['caption']		= $v['imgcaption'];
				$insert_img['filepath']		= $v['filepath'];
				$insert_img['type']			= 'product';
				$this->db->insert('images', $insert_img);	

				$image_id	= $this->db->insert_id();
				$this->db->insert('product_images', ['product_id' => $product_id, 'image_id' => $image_id]);	
			}

			foreach($stores as $k => $v){
				$insert_store['product_id']		= $product_id;
				$insert_store['name']		= $v['name'];
				$insert_store['link']		= $v['link'];
				$this->db->insert('product_stores', $insert_store);	
			}

			echo json_encode(['status' => true, 'msg' => 'berhasil merubah product']);
			return false;
		}

		if($this->input->get('do') == 'add'){
			$this->form_validation->set_rules('title', 'Judul', 'required');
			$this->form_validation->set_rules('description', 'Isi', 'required');

			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

			$images	= array();
			$store	= ($this->input->post('store')) ? $this->input->post('store') : array();
			if($this->input->post('images')){				
				foreach($this->input->post('images') as $k => $v){
					$img	= $this->images_model->decodeBase64($v['imgbase64']);
					if($img['status'] == false){
						echo json_encode($img);
						return false;
					}

					$filename = _uniqid(50);
					$filepath = "files/upload/{$filename}.{$img['type']}";
					file_put_contents($filepath, $img['images']);
			
					$config['image_library'] 	= 'gd2';
					$config['source_image'] 	= $filepath;
					$config['maintain_ratio'] 	= TRUE;
					$config['width']         	= 1024;
					$config['height']       	= 1024;
					$this->image_lib->initialize($config);
					$this->image_lib->resize();

					array_push($images, array('imgcaption' => $v['imgcaption'], 'filepath' => $filepath));
				}
			}

			if(count($images) == 0){
				echo json_encode(['status' => false, 'msg' => 'gambar produk harus diisi']);
				return false;
			}

			$update_product['title']		= $this->input->post('title');
			$update_product['description']	= $this->input->post('description');
			$update_product['price']		= $this->input->post('price');
			$update_product['published']	= $this->input->post('published');
			$update_product['popular']		= $this->input->post('popular');
			$update_product['category']		= $this->input->post('category');
			$this->db->insert('product', $update_product);
			$product_id	= $this->db->insert_id();

			foreach($images as $k => $v){
				$insert_img['caption']		= $v['imgcaption'];
				$insert_img['filepath']		= $v['filepath'];
				$insert_img['type']			= 'product';
				$this->db->insert('images', $insert_img);	
				$image_id	= $this->db->insert_id();

				$this->db->insert('product_images', ['product_id' => $product_id, 'image_id' => $image_id]);	
			}

			foreach($store as $k => $v){
				$insert_store['name']		= $v['name'];
				$insert_store['link']		= $v['link'];
				$this->db->insert('product_stores', $insert_store);	
			}

			echo json_encode(['status' => true, 'msg' => 'berhasil menambahkan product']);
			return false;
		}

		if($this->input->get('do') == 'delete-image'){
			$this->form_validation->set_rules('image_id', 'Gambar Produk', 'required');
			$this->form_validation->set_rules('product_id', 'Data Produk', 'required');
			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

			$this->db->delete('product_images', ['image_id' => $this->input->post('image_id'), 'product_id' => $this->input->post('product_id')]);
			$this->db->update('images', ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $this->input->post('image_id')]);

			echo json_encode(['status' => true, 'msg' => 'berhasil menghapus gambar produk']);
			return false;
		}

		if($this->input->get('do') == 'delete-store'){
			$this->form_validation->set_rules('store', 'Link Pembelian', 'required');
			$this->form_validation->set_rules('product_id', 'Data Produk', 'required');
			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

			$this->db->delete('product_stores', ['name' => $this->input->post('store'), 'product_id' => $this->input->post('product_id')]);
			echo json_encode(['status' => true, 'msg' => 'berhasil menghapus link pembelian produk']);
			return false;
		}

		if($this->input->get('do') == 'delete'){
			$this->form_validation->set_rules('id', 'ID Produk', 'required');
			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

			$this->db->update('product', ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $this->input->post('id')]);
			echo json_encode(['status' => true, 'msg' => 'berhasil menghapus produk']);
			return false;
		}

		$data['breadcrumb'][]	= ['text' => '<i class="bi-house-door"></i>', 'url' => base_url()];
		$data['breadcrumb'][]	= ['text' => 'News and Product', 'url' => base_url('administrator/product/list')];
		$data['breadcrumb'][]	= ['text' => (($this->uri->segment(3) == 'form') ? 'Add New' : 'Browse'), 'url' => (($this->uri->segment(3) == 'form') ? base_url('administrator/news/add') : base_url('administrator/news/list'))];


		$data['title']			= "Katalog Produk";
		$data['content']		= "administrator/product" . ($this->uri->segment(3) == 'form' ? '_form' : '_list');
		$this->load->view('administrator/index', $data);
	}

	public function images()
	{
		if($this->input->get('get') == 'data'){

			$this->db->where_in('type', $this->input->post('type'));
			$this->db->where('deleted_at', NULL);
			$query = $this->db->get('images');

			$data['status']		= true;
			$data['result']		= $query->result_array();
			echo json_encode($data);
			return false;
		}

		if($this->input->get('do') == 'delete'){
			$this->form_validation->set_rules('id', 'ID Album', 'required');
			if($this->form_validation->run() == false){
				echo json_encode(['status' => false, 'msg' => validation_errors()]);
				return false;
			}

			$this->db->update('images', ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $this->input->post('id')]);
			echo json_encode(['status' => true, 'msg' => 'berhasil menghapus gambar']);
			return false;
		}

		if($this->input->get('do') == 'upload'){
			$title		= $this->input->post('title');
			$img		= $this->input->post('img');
			$caption	= $this->input->post('caption');
			$type	= $this->input->post('type');

			if($img == ""){
				$data	= ['status' => false, 'msg' => 'gambar belum diisi'];
				echo json_encode($data);
				return false;
			}

			$x 		= $this->images_model->decodeBase64($img);
			if($x['status'] == false){
				$data	= ['status' => false, 'msg' => $x['message']];
				echo json_encode($data);
				return false;
			}

			$filename = md5($img);
			$filepath = "files/upload/{$filename}.{$x['type']}";
			file_put_contents($filepath, $x['images']);
			
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= $filepath;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 1440;
			$config['height']       	= 1440;
			$config['quality']       	= 80;

			$this->image_lib->initialize($config);
			$this->image_lib->resize();

			$this->db->insert('images', ['title' => $title, 'filepath' => $filepath, 'caption' => $caption, 'type' => $type]);

			$data		= ['status' => true, 'location' => $filepath, 'msg' => 'berhasil menambah gambar'];
			echo json_encode($data);
			return false;
		}

		$data['breadcrumb'][]	= ['text' => '<i class="bi-house-door"></i>', 'url' => base_url()];
		$data['breadcrumb'][]	= ['text' => 'Photos', 'url' => base_url()];
		$data['title']			= "Pengaturan Foto dan Gambar";
		$data['content']		= "administrator/images";
		$this->load->view('administrator/index', $data);

	}



}
