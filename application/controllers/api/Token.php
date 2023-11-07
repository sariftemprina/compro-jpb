<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends REST_Controller
 */
require(APPPATH. '/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Token extends REST_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->library('Authorization_Token');
		$this->load->model('user_model');
	}

	/**
	 * register function.
	 * 
	 * @access public
	 * @return void
	 */

	public function auth_post() {

		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == false) {
			
			// validation not ok, send validation errors to the view
            $this->response(['Validation rules violated'], REST_Controller::HTTP_OK);

		} else {
			
			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->user_model->resolve_user_login($username, $password)) {
				
				$user_id = $this->user_model->get_user_id_from_username($username);
				$user    = $this->user_model->get_user($user_id);

				// token regeneration process
				$token_data['uid'] 		= $user_id;
				$token_data['username'] = $username;
				$tokenData = $this->authorization_token->generateToken($token_data);
				$final = $token_data;
				$final['access_token'] = 'Bearer ' . $tokenData;
				$final['status'] = true;

				$this->response($final, REST_Controller::HTTP_OK);
			} else
				$this->response(['status' => false, 'msg' => 'unauthorized access'], REST_Controller::HTTP_OK);
		} 
	}

	public function regenerate_post() {

		// set variables from the form
		$username = $this->input->post('username');
		if (!empty($username)) {
			$user_id = $this->user_model->get_user_id_from_username($username);
			if (!empty($user_id)) {

				// token regeneration process
				$token_data['uid'] = $user_id;
				$token_data['username'] = $username;
				$tokenData = $this->authorization_token->generateToken($token_data);
				$final = $token_data;
				$final['access_token'] = 'Bearer ' . $tokenData;
				$final['status'] = true;

				$this->response($final, REST_Controller::HTTP_OK);
			} else
				$this->response(['status' => false, 'msg' => 'username not valid'], REST_Controller::HTTP_OK);
		} else
			$this->response(['status' => false, 'msg' => 'username is required to regenerate token.'], REST_Controller::HTTP_OK);

	}

	public function verify_post()
	{  
		$headers = $this->input->request_headers(); 
		if (isset($headers['Authorization'])) {
			$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
			$this->response($decodedToken);
		}
		else {
			$this->response(['Authentication failed'], REST_Controller::HTTP_OK);
		}
			
		  
	}
}