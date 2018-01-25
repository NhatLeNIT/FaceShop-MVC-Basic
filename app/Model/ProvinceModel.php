<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 30-May-17
 * Time: 23:55
 */
class ProvinceModel extends N_Model
{
    public $id, $name;

    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function getListProvince() {
        $sql = "SELECT * FROM `fs_province`";
        $this->execute($sql);
        return $this->getResult();
    }
    public function getNameProvinceById($id) {
        $sql = "SELECT `name` FROM `fs_province` WHERE `id` = $id";
        $this->execute($sql);
        return $this->getResult();
    }
}