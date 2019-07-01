<?php
class Users extends CI_Controller {

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

        $this->load->model('users_model');

    }

    public function index() {

        $data['users'] = $this->users_model->getAll();

        $this->load->view('req/head');
        $this->load->view('req/header');
        $this->load->view('req/menu');
        $this->load->view('admin/users', $data);
        $this->load->view('req/footer');
        $this->load->view('req/footerScripts');

    }

    public function block($id = null) {

        if ($id == null) {
            show_404();
            exit();
        }

        if (!$user = $this->account_model->getUserDataById($id)) {
            message('Taki użytkownik nie istnieje!', '/admin/users', 'info');
            exit();
        }

        if ($id == getUser()['user_id']) {
            message('Nie możesz zablokować sam siebie!', '/admin/users', 'warning');
            exit();
        }

        if ($user['type'] == "admin") {
            message('Nie możesz zablokować innego administratora!', '/admin/users', 'info');
            exit();
        }

        if ($this->account_model->block($id)) {
            message('Zablokowano użytkownika!', '/admin/users', 'success');
            exit();
        } else {
            message('Nie udało się zablokować użytkownika!', '/panel/users');
            exit();
        }
    }

    public function unblock($id = null) {

        if ($id == null) {
            show_404();
            exit();
        }

        if ($this->account_model->unblock($id)) {
            message('Odblokowano użytkownika!', '/admin/users', 'success');
            exit();
        } else {
            message('Nie udało się odblokować użytkownika!', '/admin/users');
            exit();
        }
    }

    public function dLicense($id) {

        if ($id == null) {
            show_404();
            exit();
        }

        if ($this->account_model->deleteLicense($id)) {
            message('Usunięto licencję użytkownika!', '/admin/users', 'success');
            exit();
        } else {
            message('Nie udało się usunąć licencji użytkownikowi użytkownika!', '/admin/users');
            exit();
        }

    }

}