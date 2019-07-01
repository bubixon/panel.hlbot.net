<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged')) redirect(base_url('/login'));

        $user = $this->account_model->getUserDataById($this->session->userdata('userId'));

        $this->load->model('support_model');

    }

    public function index() {

        $data['page'] = "index";
        $data['tickets'] = $this->support_model->getAllForUser($this->session->userId);

        $this->load->view('req/head');
        $this->load->view('req/header');
        $this->load->view('req/menu');
        $this->load->view('support', $data);
        $this->load->view('req/footer');
        $this->load->view('req/footerScripts');

    }

    public function create() {

        $data['page'] = "create";

        $this->load->library('form_validation');

        $formArray = array(
            'required' => 'To pole jest wymagane!'
        );

        $this->form_validation->set_rules('title', 'Tytuł zgłoszenia', 'trim|strip_tags|required', $formArray);
        $this->form_validation->set_rules('desc', 'Wpis zgłoszenia', 'trim|strip_tags|required', $formArray);

        if ($this->form_validation->run() === true) {

            $title = $this->input->post('title');
            $desc = $this->input->post('desc');

            $arraySupport = array(
                'title' => $title,
                'userId' => $this->session->userId,
                'date' => date('Y-m-d H:i:s')
            );

            if ($this->support_model->create($arraySupport)) {

                $supportId = $this->db->insert_id();
                $arrayResponse = array(
                    'supportId' => $supportId,
                    'admin' => "0",
                    'desc' => $desc,
                    'date' => date('Y-m-d H:i:s')
                );

                if ($this->support_model->responseAdd($arrayResponse)) {
                    message('Utworzono zgłoszenie!', '/support/view/' . $supportId, 'success');
                    exit();
                } else {
                    message('Błąd! Nie udało się utworzyć zgłoszenia!', '/support/new', 'danger');
                    exit();
                }
            } else {
                message('Błąd! Nie udało się utworzyć zgłoszenia!', '/support/new', 'danger');
                exit();
            }
        }

        $this->load->view('req/head');
        $this->load->view('req/header');
        $this->load->view('req/menu');
        $this->load->view('support', $data);
        $this->load->view('req/footer');
        $this->load->view('req/footerScripts');

    }

    public function view($id) {

        $data['page'] = "view";
        $data['id'] = $id;

        $data['ticket'] = $this->support_model->view($id, $this->session->userId);
        if (!$data['ticket']) {
            message('Błąd! Nie znaleziono takiego zgłoszenia!', '/support');
            exit();
        }

        if ($data['ticket']['ticket'][0]['status'] == "open") {

            $this->load->library('form_validation');

            $this->form_validation->set_rules('desc', 'Wpis zgłoszenia', 'trim|required|strip_tags', array('required' => 'To pole jest wymagane!', 'strip_tags' => 'Nie możesz tego wstawić!'));

            if ($this->form_validation->run() === true) {

                $desc = $this->input->post('desc');

                $arrayResponse = array(
                    'supportId' => $id,
                    'admin' => "0",
                    'desc' => $desc,
                    'date' => date('Y-m-d H:i:s')
                );

                if ($this->support_model->responseAdd($arrayResponse)) {
                    $this->support_model->update($id, array('admin' => "0"));
                    message('Prawidłowo dodano odpowiedź!', '/support/view/' . $id, 'success');
                    exit();
                } else {
                    message('Wystąpił błąd podczas dodawania odpowiedzi!', '/support/view/' . $id);
                    exit();
                }
            }

        }

        $this->load->view('req/head');
        $this->load->view('req/header');
        $this->load->view('req/menu');
        $this->load->view('support', $data);
        $this->load->view('req/footer');
        $this->load->view('req/footerScripts');

    }

}