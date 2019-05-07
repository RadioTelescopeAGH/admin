<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
        $this->load->library('validator');
    }

	public function index()
	{
        $this->auth();
        $query = $this->db->query("select * from news");
        echo $this->twig->render('newsIndex.twig', ['data' => $query->result()]);
    }

    public function addForm()
	{
        $this->auth();
        echo $this->twig->render('newsAdd.twig', ['error_info' => $this->session->flashdata('error_info')]);
    }

    public function add()
	{
        $this->auth();

        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $validTitle = $this->validator->secInput($title, ['filtr' => '0']);
        $validContent = $this->validator->secInput($content, ['filtr' => '0']);

        if(!$validTitle['ok'] || !$validContent['ok']){
            $this->session->set_flashdata('error_info', 'Error');
            redirect('news/addForm', 'refresh');
        }

        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error_info', $error['error']);
            redirect('news/addForm', 'refresh');
        }

        $data = array('upload_data' => $this->upload->data());
        $fileName = $data['upload_data']['file_name'];

        $this->db->query("insert into news (title, content, file_name) values ('{$title}', '{$content}', '{$fileName}')");

        redirect('news/index', 'refresh');
    }

    public function editForm($id)
	{
        $this->auth();
        $validId = $this->validator->secInput($id, ['filtr' => '0']);

        if(!$validId['ok']){
            $this->session->set_flashdata('error_info', 'Error');
            redirect('news/index', 'refresh');
        }

        $query = $this->db->query("select * from news where id = {$id}");
        if(!isset($query->result()[0])){
            redirect('news/index', 'refresh');
        }

        echo $this->twig->render('newsEdit.twig', ['data' => $query->result()[0], 'error_info' => $this->session->flashdata('error_info')]);
    }

    public function edit($id = 0)
	{
        $this->auth();
        
        $validId = $this->validator->secInput($id, ['filtr' => '0']);

        if(!$validId['ok']){
            $this->session->set_flashdata('error_info', 'Error');
            redirect('news/editForm/'.$id, 'refresh');
        }

        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $validTitle = $this->validator->secInput($title, ['filtr' => '0']);
        $validContent = $this->validator->secInput($content, ['filtr' => '0']);

        if(!$validTitle['ok'] || !$validContent['ok']){
            $this->session->set_flashdata('error_info', 'Error');
            redirect('news/editForm/'.$id, 'refresh');
        }

        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error_info', $error['error']);
            redirect('news/editForm/'.$id, 'refresh');
        }

        $data = array('upload_data' => $this->upload->data());
        $fileName = $data['upload_data']['file_name'];
        
        $this->db->query("update news set title = '{$title}', content = '{$content}', file_name = '{$fileName}' where id = {$id}");
        redirect('news/index', 'refresh');
    }

    public function remove($id)
	{
        $this->auth();
        $validId = $this->validator->secInput($id, ['filtr' => '0']);

        if(!$validId['ok']){
            $this->session->set_flashdata('error_info', 'Error');
            redirect('news/index', 'refresh');
        }

        $this->db->query("delete from news where id = {$id}");
        redirect('news/index', 'refresh');
    }

    private function auth(){
        if ($this->session->admin != true){
            redirect('/', 'refresh');
        }
    }
}
