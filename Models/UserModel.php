<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model {

    public function checkLogin($username, $password) {
        $sql = "SELECT * FROM users WHERE username = :username: AND password = :password:";
        $data = $this->db->query($sql, [
            'username' => $username,
            'password' => $password
        ]);
        return $data->getRow();
    }

    public function getUser($id) {
        $sql = "SELECT * FROM users WHERE id = :id:";
        $data = $this->db->query($sql, [
            'id' => $id
        ]);
        return $data->getRow();
    }

    public function getUsers() {
        $sql = "SELECT * FROM users";
        $data = $this->db->query($sql);
        return $data->getResult();
    }

    public function addUser($username, $password) {
        $sql = "INSERT INTO users (username, password) VALUES (:username:, :password:)";
        $data = $this->db->query($sql, [
            'username' => $username,
            'password' => $password
        ]);
        return $data->getRow();
    }

    public function updateUser($id, $username, $password) {
        $sql = "UPDATE users SET username = :username:, password = :password: WHERE id = :id:";
        $data = $this->db->query($sql, [
            'id' => $id,
            'username' => $username,
            'password' => $password
        ]);
        return $data->getRow();
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = :id:";
        $data = $this->db->query($sql, [
            'id' => $id
        ]);
        return $data->getRow();
    }

}