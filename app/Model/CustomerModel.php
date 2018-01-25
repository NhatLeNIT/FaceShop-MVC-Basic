<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 27-May-17
 * Time: 13:50
 */
class CustomerModel extends N_Model
{
    public $id, $email, $password, $name, $address, $mobile, $dob, $gender;
    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function getListUser() {
        $sql = "SELECT * FROM `fs_user`";
        $this->execute($sql);
        return $this->getResult();
    }

    public function getListUserLimit($page = 1, $limit = 10) {
        $pos = ($page - 1) * $limit;
        $sql = "SELECT * FROM `fs_user` LIMIT $pos,$limit";
        $this->execute($sql);
        return $this->getResult();
    }

    public function verify($email, $password)
    {
        $sql = "SELECT * FROM `fs_user` WHERE `email` = '$email' AND `password` = '$password'";
        $this->execute($sql);
        return $this->getResult();
    }
    public function getUserById($id) {
        $sql = "SELECT * FROM `fs_user` WHERE `id` = $id";
        $this->execute($sql);
        return $this->getResult();
    }
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM `fs_user` WHERE `email` = '$email'";
        $this->execute($sql);
        return $this->getResult();
    }
}