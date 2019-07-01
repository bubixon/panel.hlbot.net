<?php

function getUser() {

    $CI = & get_instance();
    if ($CI->session->userdata('logged')) {
        $user = $CI->account_model->getUserDataById($CI->session->userdata('userId'));
        if ($CI->session->userdata('hash') != hash('md5', $user['email'] . $CI->input->ip_address() . $user['user_id'] . $user['password'] . $user['status'])) {
            $CI->session->sess_destroy();
            redirect(base_url('/login'));
            exit();
        }
        return $user;
    } else {
        return false;
    }

}