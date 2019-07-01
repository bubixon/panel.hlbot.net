<?php

class Ipn extends CI_Controller {

    public function paypal() {

        $this->load->model(array('buy_model', 'license_model', 'services_model'));

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            exit();
        }

        if (!isset($_POST['paymentKey'], $_POST['amount'], $_POST['hash'], $_POST['control'])) {
            exit();
        }

        if (empty($_POST['paymentKey']) || empty($_POST['amount']) || empty($_POST['hash']) || empty($_POST['control'])) {
            exit();
        }

        if ($_POST['hash'] != hash('sha256', 'PvBKchHmTT5BREBevbtaUMZG6gcBjWKxSM|' . $_POST['paymentKey'] . '|' . $_POST['amount'])) {
            exit();
        }

        $control = $this->input->post('control');

        if (!$data['payment'] = $this->buy_model->getByPp('id', $control)) {
            exit();
        }

        if (!$data['service'] = $this->services_model->getById($data['payment']['serviceId'])) {
            exit();
        }

        if ($data['payment']['price'] != $_POST['amount']) {
            exit();
        }

        $array = array(
            'status' => 'ok',
            'dateEnd' => date('Y-m-d H:i:s')
        );

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

        $this->account_model->update(array('license_id' => $licenseId), $data['payment']['userId']);

        $this->buy_model->updatePp($control, $array);

        ob_clean();
        exit("OK");

    }

}