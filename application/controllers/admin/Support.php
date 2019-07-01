<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller {

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

        $this->load->model('support_model');
        $this->load->model('account_model');

    }

    public function index() {

        $data['page'] = "index";
        $data['tickets'] = $this->support_model->getAll();

        $this->load->view('req/head');
        $this->load->view('req/header');
        $this->load->view('req/menu');
        $this->load->view('admin/support', $data);
        $this->load->view('req/footer');
        $this->load->view('req/footerScripts');

    }

    public function view($id) {

        $data['page'] = "view";
        $data['id'] = $id;

        $data['ticket'] = $this->support_model->viewAdmin($id);
        if (!$data['ticket']) {
            message('Błąd! Nie znaleziono takiego zgłoszenia!', '/admin/support');
            exit();
        }

        $data['user'] = $this->account_model->getUserDataById($data['ticket']['ticket'][0]['userId']);

        $this->load->library('form_validation');

        $this->form_validation->set_rules('desc', 'Wpis zgłoszenia', 'trim|required', array('required' => 'To pole jest wymagane!'));

        if ($this->form_validation->run() === true) {

            $desc = $this->input->post('desc');

            $arrayResponse = array(
                'supportId' => $id,
                'admin' => "1",
                'desc' => $desc,
                'date' => date('Y-m-d H:i:s')
            );

            if ($this->support_model->responseAdd($arrayResponse)) {
                $this->support_model->update($id, array('admin' => "1"));
                message('Prawidłowo dodano odpowiedź!', '/admin/support/view/' . $id, 'success');
                exit();
            } else {
                message('Wystąpił błąd podczas dodawania odpowiedzi!', '/admin/support/view/' . $id);
                exit();
            }
        }

        $this->load->view('req/head');
        $this->load->view('req/header');
        $this->load->view('req/menu');
        $this->load->view('admin/support', $data);
        $this->load->view('req/footer');
        $this->load->view('req/footerScripts');

    }

    public function close($id = null) {

        if ($id == null){
            show_404();
            exit();
        }

        if ($this->support_model->update($id, array('status' => 'closed'))) {
            message('Zamknięto zgłoszenie!', '/admin/support', 'success');
            exit();
        } else {
            message('Wystąpił błąd', '/admin/support');
            exit();
        }

    }

}