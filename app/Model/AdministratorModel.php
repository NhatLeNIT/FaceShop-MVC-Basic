<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 26-May-17
 * Time: 13:54
 */
class AdministratorModel extends N_Model
{
    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function verify($username, $password)
    {
        $sql = "SELECT * FROM `fs_administrator` WHERE `username` = '$username' AND `password` = '$password'";
        $this->execute($sql);
        return $this->getResult();
    }
    public function getListUser() {
        $sql = "SELECT * FROM `fs_administrator`";
        $this->execute($sql);
        return $this->getResult();
    }
    public function getListUserLimit($page = 1, $limit = 10) {
        $pos = ($page - 1) * $limit;
        $sql = "SELECT * FROM `fs_administrator` LIMIT $pos,$limit";
        $this->execute($sql);
        return $this->getResult();
    }

    public function getUserByUsername($username) {
        $sql = "SELECT * FROM `fs_administrator` WHERE `username` = '$username'";
        $this->execute($sql);
    }

    public function getUserById($id) {
        $sql = "SELECT * FROM `fs_administrator` WHERE `id` = '$id'";
        $this->execute($sql);
        return $this->getResult();
    }
}