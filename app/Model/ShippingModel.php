<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 31-May-17
 * Time: 00:42
 */
class ShippingModel extends N_Model
{
    public $id, $type, $cost, $id_ward;

    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function getShippingCost($idWard, $type) {
        $sql = "SELECT `cost` FROM `fs_shipping` WHERE `id_ward` = $idWard AND `type` = $type";
        $this->execute($sql);
        return $this->getResult();
    }

    public function getIdShipping($idWard, $type) {
        $sql = "SELECT `id` FROM `fs_shipping` WHERE `id_ward` = $idWard AND `type` = $type";
        $this->execute($sql);
        return $this->getResult();
    }
    public function getShipping($id) {
        $sql = "SELECT * FROM `fs_shipping` WHERE `id` = $id";
        $this->execute($sql);
        return $this->getResult();
    }
}