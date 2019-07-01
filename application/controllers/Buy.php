<?php

class Buy extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!getUser()) {
            redirect(base_url('/login'));
            exit();
        }

    }

    public function index($type = null, $id = null) {

        if ($type == null || $id == null) {
            show_404();
            exit();
        }

        $this->load->model(array('services_model', 'buy_model'));
        $this->load->helper('form');
        $this->load->library('form_validation');

        if ($type == "psc") {

            $data['page'] = "pay";
            if (!$data['service'] = $this->services_model->getById($id)) {
                show_404();
                exit();
            }

            $this->form_validation->set_rules('code1', 'Pierwszy kod', 'trim|strip_tags|required|regex_match[/^\d{4}\-\d{4}\-\d{4}\-\d{4}\z/]', array('required' => 'To pole jest wymagane!', 'regex_match' => 'Błędny format pola!'));
            $this->form_validation->set_rules('code2', 'Drugi kod', 'trim|strip_tags|regex_match[/^\d{4}\-\d{4}\-\d{4}\-\d{4}\z/]', array('regex_match' => 'Błędny format pola!'));
            $this->form_validation->set_rules('code3', 'Trzeci kod', 'trim|strip_tags|regex_match[/^\d{4}\-\d{4}\-\d{4}\-\d{4}\z/]', array('regex_match' => 'Błędny format pola!'));

            if ($this->form_validation->run() === true) {

                $code1 = $this->input->post('code1');
                $code2 = $this->input->post('code2');
                $code3 = $this->input->post('code3');

                $serviceId = $data['service']['id'];
                $userId = getUser()['user_id'];

                if ($this->buy_model->newPsc($userId, $serviceId, $data['service']['price'], date('Y-m-d H:i:s'), $code1, $code2, $code3)) {
                    message('Dodano płatności do sprawdzenia.', '/buy/status/psc/' . $this->db->insert_id(), 'success');
                    exit();
                } else {
                    message('Nie udało się dodać płatność do sprawdzenia!', '/buy/psc/', $id);
                    exit();
                }
            }

            $this->load->view('req/head');
            $this->load->view('req/header');
            $this->load->view('req/menu');
            $this->load->view('paysafecard', $data);
            $this->load->view('req/footer');
            $this->load->view('req/footerScripts');

        } elseif ($type == "pp") {

            if (!$data['service'] = $this->services_model->getById($id)) {
                show_404();
                exit();
            }

            $this->buy_model->newPp(getUser()['user_id'], $data['service']['id'], $data['service']['price'], date('Y-m-d H:i:s'), $data['service']['days']);

            $itemName = "Licencja do programu";
            $control = $this->db->insert_id();

            $array = [
                'serviceId' => '3',
                'price' => $data['service']['price'],
                'itemName' => $itemName,
                'control' => $control,
                'urlSuccess' => base_url('/'),
                'urlFail' => base_url('/'),
                'hash' => hash('sha256', 'PvBKchHmTT5BREBevbtaUMZG6gcBjWKxSM|3|' . $data['service']['price'] . '|' . $itemName . '|' . $control . '|' . base_url('/') . '|' . base_url('/'))
            ];

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://paypal.systemy.net/api/payment/generate');
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $array);

            $result = json_decode(curl_exec($curl));
            curl_close($curl);

            if ($result->status == "success") {
                $this->buy_model->updatePp($control, array('trId' => $result->paymentId));
                redirect($result->redirectUrl);
                exit('Trwa przekierowywanie do płatności.');
            } else {
                message('Błąd! Nie udało się wygenerować płatności!', '/plans', 'warning');
                exit();
            }

        }


    }

    public function status($type = null, $id = null) {

        if ($type == null || $id == null) {
            show_404();
            exit();
        }

        $this->load->model('buy_model');

        if ($type == "psc") {

            if (!$data['payment'] = $this->buy_model->getPscForId($id)) {
                show_404();
                exit();
            }

            if ($data['payment']['userId'] != getUser()['user_id']) {
                show_404();
                exit();
            }

            $this->load->view('req/head');
            $this->load->view('req/header');
            $this->load->view('req/menu');
            $this->load->view('paysafecardStatus', $data);
            $this->load->view('req/footer');
            $this->load->view('req/footerScripts');

        }

    }

}