<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 31-May-17
 * Time: 00:02
 */
class WardModel extends N_Model
{
    public $id, $name, $id_district;

    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function getListWardByDistrictId($id) {
        $sql = "SELECT * FROM `fs_ward` WHERE `id_district` = $id";
        $this->execute($sql);
        return $this->getResult();
    }
    public function getNameWardById($id) {
        $sql = "SELECT `name` FROM `fs_ward` WHERE `id` = $id";
        $this->execute($sql);
        return $this->getResult();
    }
}