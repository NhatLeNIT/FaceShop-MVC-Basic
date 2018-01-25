<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 30-May-17
 * Time: 23:59
 */
class DistrictModel extends N_Model
{
    public $id, $name, $id_province;

    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function getListDistrictByProvinceId($id) {
        $sql = "SELECT * FROM `fs_district` WHERE `id_province` = $id";
        $this->execute($sql);
        return $this->getResult();
    }

    public function getNameDistrictById($id) {
        $sql = "SELECT `name` FROM `fs_district` WHERE `id` = $id";
        $this->execute($sql);
        return $this->getResult();
    }
}