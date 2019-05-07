<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consol extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
        $this->load->library('validator');
    }

	public function index()
	{
        
    }

    public function consol()
	{
        $this->auth();
        echo $this->twig->render('consol.twig', ['error_info' => $this->session->flashdata('error_info')]);
    }

    private function auth(){
        if ($this->session->admin != true){
            redirect('/', 'refresh');
        }
    }
}
