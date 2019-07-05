<?php

class Setting_model extends CI_Model {

    private $table = "settings";

    public function getSettings() {

        return $this->db->get('settings')->row_array();

    }


}