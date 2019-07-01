<?php

class Faq_model extends CI_Model {

    private $table = "faq";

    public function getAll() {
        return $this->db->order_by('id', 'DESC')->get($this->table)->result_array();
    }


}