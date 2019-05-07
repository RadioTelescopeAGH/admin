<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('validator');
        $this->load->database();
    }

	public function index()
	{
        if ($this->session->admin != true){
            $this->load->view('login');
        }
        else {
            redirect('/panel', 'refresh');
        }
    }

    public function login()
	{
        if ($this->session->admin != true){
            $login = $this->input->post('login');
            $password = $this->input->post('password');
            $validLogin = $this->validator->secInput($login, ['filtr' => '0', 'min' => 1, 'max' => 100]);
            $validPassword = $this->validator->secInput($password, ['filtr' => '0', 'min' => 1, 'max' => 100]);
            if(!$validLogin['ok'] || !$validPassword['ok']){
                redirect('/', 'refresh');
            }

            $query = $this->db->query("select * from admin where login = '{$login}' and password = '{$password}'");
            if(isset($query->result()[0])){
                $this->session->set_userdata('admin', true);
                redirect('/panel', 'refresh');
            } else {
                $this->session->set_flashdata('login_info', 'Error');
                redirect('/', 'refresh');
            }
        }
        else {
            redirect('/panel', 'refresh');
        }
    }
    
    public function log_out()
	{
        $this->session->unset_userdata('admin');
        redirect('/', 'refresh');
	}
}
