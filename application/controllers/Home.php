<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_galeri');
    }

    public function index()
    {
        $this->load->view('template/header');
        $this->load->view('home');
        $this->load->view('template/footer');
    }

    public function profil()
    {
        $this->load->view('template/header');
        $this->load->view('profil');
        $this->load->view('template/footer');
    }

    public function galeri()
    {
        $data['galeri'] = $this->M_galeri->get_data();
        $this->load->view('template/header');
        $this->load->view('galeri', $data);
        $this->load->view('template/footer');
    }

    public function kontak()
    {
        $this->load->view('template/header');
        $this->load->view('kontak');
        $this->load->view('template/footer');
    }
}
