<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

	public function index()
	{
        $this->auth();
        echo $this->twig->render('dashboard.twig');
    }

    private function auth(){
        if ($this->session->admin != true){
            redirect('/', 'refresh');
        }
    }
}
