<?php
class Paysafecard extends CI_Controller {

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

        $data['payments'] = $this->buy_model->getAllPsc();

        $this->load->view('req/head');
        $this->load->view('req/header');
        $this->load->view('req/menu');
        $this->load->view('admin/paysafecard', $data);
        $this->load->view('req/footer');
        $this->load->view('req/footerScripts');
    }

    public function accept($id = null) {

        if ($id == null) {
            exit();
        }

        $this->load->model('account_model');
        $this->load->model('license_model');
        $this->load->model('services_model');

        if (!$data['payment'] = $this->buy_model->getPscForId($id)) {
            exit();
        }

        if (!$data['service'] = $this->services_model->getById($data['payment']['serviceId'])) {
            exit();
        }

        $this->buy_model->updatePsc($id, array('status' => 'ok'));

        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $license = generateRandomString(4) . '-' . generateRandomString(4) . '-' . generateRandomString(4) . '-' . generateRandomString(4);

        $this->license_model->add($license, $data['service']['days']);
        $licenseId = $this->db->insert_id();

        if ($this->account_model->update(array('license_id' => $licenseId), $data['payment']['userId'])) {
            message('Licencja dodana', '/admin/paysafecard', 'success');
            exit();
        } else {
            message('Nie udało się dodać licencji', '/admin/paysafecard');
            exit();
        }


    }

    public function badCode($id = null) {

        if ($id == null) {
            exit();
        }

        if (!$data['payment'] = $this->buy_model->getPscForId($id)) {
            exit();
        }

        if ($this->buy_model->updatePsc($id, array('status' => 'bad', 'badType' => 'code'))) {
            message('Zaaktualizowano', '/admin/paysafecard', 'success');
            exit();
        } else {
            message('Błąd', '/admin/paysafecard');
            exit();
        }
    }

    public function badFunds($id = null) {

        if ($id == null) {
            exit();
        }

        if (!$data['payment'] = $this->buy_model->getPscForId($id)) {
            exit();
        }

        if ($this->buy_model->updatePsc($id, array('status' => 'bad', 'badType' => 'funds'))) {
            message('Zaaktualizowano', '/admin/paysafecard', 'success');
            exit();
        } else {
            message('Błąd', '/admin/paysafecard');
            exit();
        }
    }

}