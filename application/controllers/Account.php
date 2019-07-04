<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public function login() {

        if (getUser()) {
            redirect(base_url('/'));
            exit();
        }

        $user = $this->account_model->getUserDataById($this->session->userdata('userId'));

        $this->load->library('form_validation');
        $this->load->library('user_agent');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', array('required' => 'Email jest wymagany!'));
        $this->form_validation->set_rules('password', 'Hasło', 'required', array('required' => 'Pole Hasło jest wymagane!'));
        $this->form_validation->set_rules('recaptcha_response', 'recaptcha_response', 'trim|required', array('required' => 'Recaptcha jest wymagana!'));

        if ($this->form_validation->run() === true) {

            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $recaptcha_response = $this->input->post('recaptcha_response');

            $recaptcha = @file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6Lft_6sUAAAAAJFtvHHl-Xt-VfCpG27fRY2AOR8e&response=' . $recaptcha_response);
            $recaptcha = json_decode($recaptcha);
            if (!$recaptcha->score >= 0.5) {
                message('Błąd z recaptcha!', '/login');
                exit();
            }

            if ($this->account_model->login($email, $password)) {

                $userId = $this->account_model->getIdByEmail($email);
                $user = $this->account_model->getUserDataById($userId);

                if ($user['status'] == "bl") {
                    message('To konto jest zablokowane!', '/login', 'danger');
                    exit();
                }

                $hash = md5($email . $this->input->ip_address() . $userId . md5($password) . $user['status']);

                $this->account_model->loginHistory($userId, $this->input->ip_address(), $this->agent->browser(), $this->agent->platform());

                $this->session->set_userdata('logged', (bool)TRUE);
                $this->session->set_userdata('email', (string)$email);
                $this->session->set_userdata('userId', $userId);
                $this->session->set_userdata('hash', (string)$hash);

                message('OK! Zalogowano prawidłowo.', '/', 'success');
                exit();
            } else {
                message('Błąd! Podane dane są nieprawidłowe!', '/login');
                exit();
            }

        }

        $this->load->view('login');

    }

    public function register() {

        if (getUser()) {
            redirect(base_url('/'));
            exit();
        }

        $this->load->model('account_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]', array('required' => 'Email jest wymagany!'));
        $this->form_validation->set_rules('password', 'Hasło', 'trim|required|min_length[5]', array('required' => 'Pole Hasło jest wymagane!', 'min_length' => 'Pole hasło wymaga minimum 5 znaków!'));
        $this->form_validation->set_rules('passwordConf', 'Hasło', 'trim|required|min_length[5]|matches[password]', array('required' => 'Pole Hasło jest wymagane!', 'matches' => 'Hasła muszą się zgadzać!'));
        $this->form_validation->set_rules('recaptcha_response', 'recaptcha_response', 'trim|required', array('required' => 'Recaptcha jest wymagana!'));

        if ($this->form_validation->run() === true) {

            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $recaptcha_response = $this->input->post('recaptcha_response');

            $recaptcha = @file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6Lft_6sUAAAAAJFtvHHl-Xt-VfCpG27fRY2AOR8e&response=' . $recaptcha_response);
            $recaptcha = json_decode($recaptcha);
            if (!$recaptcha->score >= 0.5) {
                message('Błąd z recaptcha!', '/register');
                exit();
            }

            if ($this->account_model->register($email, $password)) {
                message('OK! Rejestracja przebiegła pomyślnie! Teraz musisz się zalogować.', '/login', 'success');
                exit();
            } else {
                exit('bad');
            }

        }

        $this->load->view('register');

    }

    public function resetPass() {

        if (getUser()) {
            redirect(base_url('/'));
            exit();
        }

        $this->load->view('req/head');
        $this->load->view('req/menu');
        $this->load->view('resetPass');
        $this->load->view('req/footer');
        $this->load->view('req/footerScripts');

    }

    public function changePass() {

        if (!getUser()) {
            redirect(base_url('/'));
            exit();
        }

        $this->load->model('account_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('password', 'Hasło', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('newPassword', 'Hasło', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('newPasswordConf', 'Hasło', 'trim|required|min_length[5]|matches[newPassword]');

        if ($this->form_validation->run()) {

            $password = $this->input->post('password');
            $newPassword = $this->input->post('newPassword');

            if ($password == $newPassword) {
                message('Błąd! Nowe i aktualne hasło nie różnią się.', '/profile');
                exit();
            }

            if ($this->account_model->changePassword($this->session->userId, $password, $newPassword)) {
                message('Prawidłowo zmieniono hasło!', '/profile', 'success');
                exit();
            } else {
                message('Błąd! Podane aktualne hasło jest nieprawidłowe!', '/profile');
                exit();
            }

        } else {
            message('Błąd! Podane nowe hasła nie zgadzają się lub ich złożoność jest nieprawidłowa!', '/profile');
            exit();
        }

    }

    public function logout() {
        if ($this->session->userdata('logged')) {
            $this->session->sess_destroy();
        }
        redirect(base_url('/login'));
        exit();
    }

}