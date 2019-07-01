<?php

class Support_model extends CI_Model {

    private $table = "support";

    public function getAll() {
        return $this->db->get($this->table)->result_array();
    }

    public function getAllForUser($userId) {
        return $this->db->where(array('userId' => (int)$userId))->get($this->table)->result_array();
    }

    public function viewAdmin($id) {

        $ticket = $this->db->where(array('id' => (int)$id))->get($this->table)->result_array();
        $replices = $this->db->where(array('supportId' => (int)$id))->get('support_responses')->result_array();

        if ($ticket) {

            $array = array(
                'ticket' => $ticket,
                'replices' => $replices
            );

            return $array;

        } else {
            return false;
        }

    }

    public function view($id, $userId) {

        $ticket = $this->db->where(array('id' => (int)$id, 'userId' => (int)$userId))->get($this->table)->result_array();
        $replices = $this->db->where(array('supportId' => (int)$id))->get('support_responses')->result_array();

        if ($ticket) {

            $array = array(
                'ticket' => $ticket,
                'replices' => $replices
            );

            return $array;

        } else {
            return false;
        }

    }


    public function create($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function responseAdd($data) {
        return $this->db->insert('support_responses', $data);
    }

}