<?php

class Setting_model extends CI_Model {

    private $table = "settings";

    public function getSettings() {

        return $this->db->get('settings')->row_array();

    }

    public function getNews() {

        return $this->db->limit(5)->order_by('id', 'DESC')->get('news')->result_array();
    }

}