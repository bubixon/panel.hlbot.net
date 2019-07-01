<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class License_model extends CI_Model {

    private $table = "license";

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function genKey() {
        return $this->generateRandomString(4) . '-' . $this->generateRandomString(4) . '-' . $this->generateRandomString(4) . '-' . $this->generateRandomString(4);
    }

    public function getAll() {
        return $this->db->order_by('license_id', 'DESC')->get($this->table)->result_array();
    }

    public function getLicense($id) {
        $result = $this->db->where(array('license_id' => $id))->get($this->table)->row_array();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function add($key, $days) {
        return $this->db->insert('license', array('license' => $key, 'status' => '1', 'date' => date('Y-m-d H:i:s'), 'end_date' => date('Y-m-d H:i:s',strtotime('+' . (int)$days . ' days', strtotime(date('Y-m-d H:i:s'))))));
    }

    public function checkKey($key) {
        return $this->db->where(array('license' => $key))->get($this->table)->row_array();
    }

    public function update($data, $id) {
        return $this->db->where('license_id', $id)->update($this->table, $data);
    }

    public function newLicense($days, $admin) {
        return $this->db->insert('license', array('license' => $this->genKey(), 'days' => (int)$days, 'admin' => $admin, 'date' => date('Y-m-d H:i:s')));
    }

}