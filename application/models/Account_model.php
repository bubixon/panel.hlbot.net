<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

    private $table = "user";

    public function login($email, $password) {
        if ($this->db->where(array('email' => $email, 'password' => $this->hashPassword($password)))->get($this->table)->row_array()) {
            return true;
        } else {
            return false;
        }

    }

    public function loginHistory($userId, $ip, $browser, $platform) {
        if ($this->db->insert('history', array('userId' => $userId, 'ip' => $ip, 'date' => date('Y-m-d H:i:s'), 'browser' => $browser, 'platform' => $platform))) {
            return true;
        } else {
            return false;
        }
    }

    public function getHistory($userId) {
        if ($result = $this->db->where('userId', $userId)->limit(20)->order_by('id', 'DESC')->get('history')->result_array()) {
            return $result;
        } else {
            return false;
        }
    }

    public function register($email, $password) {
        if ($this->db->insert($this->table, array('email' => $email, 'password' => $this->hashPassword($password), 'register_date' => date('Y-m-d H:i:s')))) {
            return true;
        } else {
            return false;
        }
    }

    public function getIdByEmail($email) {
        if ($result = $this->db->select('user_id')->where('email', $email)->get($this->table)->row_array()) {
            return $result['user_id'];
        } else {
            return false;
        }
    }

    public function getUserDataById($id) {
        if ($result = $this->db->where('`user`.`user_id`', (int)$id)->select('`user`.*, `l`.`date` as `l_date`, `l`.`end_date` AS `l_end_date`')->join('`license` as `l`', '`user`.`license_id` = `l`.`license_id`', 'left')->get($this->table)->row_array()) {
            return $result;
        } else {
            return false;
        }
    }

    public function getUserDataByEmail($email) {
        if ($result = $this->db->where('email', $email)->get($this->table)->row_array()) {
            return $result;
        } else {
            return false;
        }
    }

    public function changePassword($id, $password, $newPassword) {

        if ($result = $this->db->where(array('user_id' => $id, 'password' => $this->hashPassword($password)))->get($this->table)->row_array()) {
            if ($this->db->where('user_id', $id)->update('user', array('password' => $this->hashPassword($newPassword)))) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public function update($data, $userId) {
        return $this->db->where('user_id', $userId)->update($this->table, $data);
    }

    public function checkLicenseUsed($licenseId) {
        return $this->db->where('license_id', $licenseId)->get($this->table)->row_array();
    }

    private function hashPassword($password) {

        return hash('md5', $password);

    }

    public function block($userId) {
        return $this->db->where('user_id', $userId)->update($this->table, array('status' => 'bl'));
    }

    public function unblock($userId) {
        return $this->db->where('user_id', $userId)->update($this->table, array('status' => 'ok'));
    }

    public function deleteLicense($userId) {
        return $this->db->where('user_id', $userId)->update($this->table, array('license_id' => NULL));
    }

}