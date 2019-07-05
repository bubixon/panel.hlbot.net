<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!getUser()) {
            redirect(base_url('/login'));
            exit();
        }

    }

    public function index() {


        $this->load->model('license_model');
        $this->load->model('buy_model');
        $this->load->model('servers_model');
        $data['countServers'] = $this->buy_model->countServers();
        $data['countUsers'] = $this->buy_model->countUsers();

        $data['account'] = $this->account_model->getUserDataByEmail($this->session->email);
        $data['license'] = $this->license_model->getLicense($data['account']['license_id']);

        $this->load->view('req/head');
        $this->load->view('req/header');
        $this->load->view('req/menu');
        $this->load->view('home', $data);
        $this->load->view('req/footer');
        $this->load->view('req/footerScripts');

	}

	public function profile() {

        $this->load->model('buy_model');

        $data['account'] = $this->account_model->getUserDataByEmail(getUser()['user_id']);
        $data['history'] = $this->account_model->getHistory(getUser()['user_id']);

        $this->load->view('req/head');
        $this->load->view('req/header');
        $this->load->view('req/menu');
        $this->load->view('profile', $data);
        $this->load->view('req/footer');
        $this->load->view('req/footerScripts');

    }

    public function transactions() {

        $this->load->model('buy_model');

        $data['pscs'] = $this->buy_model->getAllPscUser(getUser()['user_id']);

        $this->load->view('req/head');
        $this->load->view('req/header');
        $this->load->view('req/menu');
        $this->load->view('transactions', $data);
        $this->load->view('req/footer');
        $this->load->view('req/footerScripts');

    }

    public function activateKey() {

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->model(array('license_model', 'account_model'));

        $this->form_validation->set_rules('key', 'Klucz licencji', 'trim|strip_tags|required', array('required' => 'To pole jest wymagane!'));
        if ($this->form_validation->run() === true) {

            $key = $this->input->post('key');

            if ($license = $this->license_model->checkKey($key)) {
                if ($license['status'] == "1") {
                    message('Nie znaleziono takiego klucza!', '/activateKey');
                    exit();
                }
                if ($this->account_model->checkLicenseUsed($license['license_id'])) {
                    message('Nie znaleziono takiego klucza!', '/activateKey');
                    exit();
                }
                if ($this->account_model->update(array('license_id' => $license['license_id']), getUser()['user_id'])) {
                    if ($license['days'] > 0 && $license['end_date'] == NULL) {
                        $this->license_model->update(array('status' => 1, 'end_date' => date('Y-m-d H:i:s', strtotime('+' . (int)$license['days'] . ' days'))), $license['license_id']);
                    } else {
                        $this->license_model->update(array('status' => 1), $license['license_id']);
                    }
                    message('Poprawnie przypisano licencję do konta!', '/profile', 'success');
                    exit();
                } else {
                    message('Nie znaleziono takiego klucza!', '/activateKey');
                    exit();
                }
            } else {
                message('Nie znaleziono takiego klucza!', '/activateKey');
                exit();
            }

        }

        $this->load->view('req/head');
        $this->load->view('req/header');
        $this->load->view('req/menu');
        $this->load->view('activateKey');
        $this->load->view('req/footer');
        $this->load->view('req/footerScripts');

    }

    public function plans() {

        $this->load->model('services_model');

        $data['plans'] = $this->services_model->getAll();

        $this->load->view('req/head');
        $this->load->view('req/header');
        $this->load->view('req/menu');
        $this->load->view('plans', $data);
        $this->load->view('req/footer');
        $this->load->view('req/footerScripts');

    }

    public function servers() {

        $this->load->model('servers_model');

        $data['servers'] = $this->servers_model->getAll();

        $this->load->view('req/head');
        $this->load->view('req/header');
        $this->load->view('req/menu');
        $this->load->view('servers', $data);
        $this->load->view('req/footer');
        $this->load->view('req/footerScripts');

    }

    public function faq() {

        $this->load->model('faq_model');

        $data['faq'] = $this->faq_model->getAll();

        $this->load->view('req/head');
        $this->load->view('req/header');
        $this->load->view('req/menu');
        $this->load->view('faq', $data);
        $this->load->view('req/footer');
        $this->load->view('req/footerScripts');

    }

}
