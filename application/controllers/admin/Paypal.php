<?php

class Paypal extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!getUser()) {
            redirect(base_url('/login'));
            exit();
        }

        if (getUser()['type'] != "admin") {
            redirect(base_url('/'));
            exit();
        }

        $this->load->model('buy_model');

    }

    public function index() {

        $data['payments'] = $this->buy_model->getAllPp();

        $this->load->view('req/head');
        $this->load->view('req/header');
        $this->load->view('req/menu');
        $this->load->view('admin/paypal', $data);
        $this->load->view('req/footer');
        $this->load->view('req/footerScripts');


    }

}