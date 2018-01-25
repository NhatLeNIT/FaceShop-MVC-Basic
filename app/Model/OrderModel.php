<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 31-May-17
 * Time: 01:15
 */
class OrderModel extends N_Model
{
    public $id, $name, $mobile, $address, $datetime, $total, $payment_type, $status, $id_shipping, $id_user;

    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function getListOrderByIdUser($id) {
        $sql = "SELECT * FROM `fs_order` WHERE `id_user` = $id ORDER BY `datetime` DESC";
        $this->execute($sql);
        return $this->getResult();
    }

    public function getOrderById($id) {
        $sql = "SELECT * FROM `fs_order` WHERE `id` = $id";
        $this->execute($sql);
        return $this->getResult();
    }
    public function getListOrder() {
        $sql = "SELECT * FROM `fs_order` ORDER BY `datetime` DESC";
        $this->execute($sql);
        return $this->getResult();
    }

    public function getOrderByIdUser($id) {
        $sql = "SELECT * FROM `fs_order` WHERE `id_user` = $id";
        $this->execute($sql);
        return $this->getResult();
    }
}