<?php

class Users_model extends CI_Model {

    private $table = "user";

    public function getAll() {
        return $this->db->select('`user`.*, `l`.`date` as `l_date`, `l`.`end_date` AS `l_end_date`')->join('`license` as `l`', '`user`.`license_id` = `l`.`license_id`', 'left')->get($this->table)->result_array();
    }

}