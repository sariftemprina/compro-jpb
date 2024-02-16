<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index()
	{
        redirect('/jpb');
    }

    public function login()
	{
        if($this->input->get('do') == 'login'){
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if($this->form_validation->run() == FALSE){
                echo json_encode(['status' => false, 'msg' => validation_errors()]);
                return false;
            }

            $param  = ['username' => $this->input->post('username'), 'password' => $this->input->post('password')];

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => base_url('login'),
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

            if($response['status'] == false){
                echo json_encode(['status' => false, 'msg' => $response['msg']]);
                return false;
            }
            $this->session->set_userdata('uid',$response['uid']);
            $this->session->set_userdata('username',$response['username']);
            $this->session->set_userdata('email',$response['email']);
            $this->session->set_userdata('access_token',$response['access_token']);
            $this->session->set_userdata('logged_in',$response['status']);

            echo json_encode(['status' => true]);
            return false;
        }

        $this->session->unset_userdata('uid');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('logged_in');

        $site   = $this->db->get_where('contains', ['section' => 'site']);
        $profile   = $this->db->get_where('contains', ['section' => 'profile']);
        foreach($site->result_array() as $k => $v){
            $key    = str_replace('%', '', $v['code']);
            $data['site'][$key] = $v['value'];
        }
        foreach($profile->result_array() as $k => $v){
            $key    = str_replace('%', '', $v['code']);
            $data['profile'][$key] = $v['value'];
        }
        
        $this->load->view('login', $data);
    }
}