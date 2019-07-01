<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buy_model extends CI_Model {

    private $table = "buy";

    public function getAll() {
        return $this->db->get($this->table)->result_array();
    }

    public function getById($id) {
        return $this->db->where(array('id' => (int)$id))->get($this->table)->row_array();
    }

    public function getAllPscUser($userId) {
        return $this->db->order_by('id', 'DESC')->where(array('userId' => (int)$userId))->get('psc')->result_array();
    }

    public function getPscForId($id) {
        return $this->db->where(array('id' => (int)$id))->get('psc')->row_array();
    }

    public function getAllPsc() {
        return $this->db->get('psc')->result_array();
    }

    public function newPsc($userId, $serviceId, $price, $date, $code1, $code2, $code3) {
        return $this->db->insert('psc', array('userId' => $userId, 'serviceId' => $serviceId, 'code1' => $code1, 'code2' => $code2, 'code3' => $code3, 'price' => $price, 'date' => $date));
    }

    public function updatePsc($id, $data) {
        return $this->db->where('id', $id)->update('psc', $data);
    }

    public function getAllPp() {
        return $this->db->get('pp')->result_array();
    }

    public function newPp($userId, $serviceId, $price, $date) {
        return $this->db->insert('pp', array('userId' => $userId, 'serviceId' => $serviceId, 'price' => $price, 'date' => $date));
    }

    public function updatePp($id, $data) {
        return $this->db->where('id', $id)->update('pp', $data);
    }

    public function getByPp($column, $data, $oneInArray = false) {
        $result = $this->db->where($column, $data)->get('pp')->result_array();
        if ($result == null) {
            return null;
        } else if (count($result) > 1) {
            return $result;
        } else {
            if ($oneInArray) return $result;
            return $result[0];
        }
    }

    /*public function countServers() {
        return $this->db->
    }*/

}