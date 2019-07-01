<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servers_model extends CI_Model {

    private $table = "servers";

    public function getAll() {
        return $this->db->get($this->table)->result_array();
    }

}