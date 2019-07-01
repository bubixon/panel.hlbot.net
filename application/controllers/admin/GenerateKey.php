<?php

class GenerateKey extends CI_Controller {

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

        $this->load->model('license_model');
        $this->load->library('form_validation');

    }

    public function index() {

        $this->form_validation->set_rules('days', 'Dni', 'trim|strip_tags|required');

        if ($this->form_validation->run() === true) {

            $days = $this->input->post('days');

            if ($this->license_model->newLicense($days, getUser()['email'])) {
                message('Wygenerowano licencje!', '/admin/generateKey', 'success');
                exit();
            } else {
                message('Nie udało się wygenerować licencji!', '/admin/generateKey');
                exit();
            }

        }

        $data['licenses'] = $this->license_model->getAll();

        $this->load->view('req/head');
        $this->load->view('req/header');
        $this->load->view('req/menu');
        $this->load->view('admin/generateKey', $data);
        $this->load->view('req/footer');
        $this->load->view('req/footerScripts');

    }

}