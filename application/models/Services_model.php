<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services_model extends CI_Model {

    private $table = "services";

    public function getAll() {
        return $this->db->get($this->table)->result_array();
    }

    public function getById($id) {
        return $this->db->where(array('id' => (int)$id))->get($this->table)->row_array();
    }

}