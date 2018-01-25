<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 25-May-17
 * Time: 14:47
 */
class N_Helper_Loader
{
    public function load($helper) {
        $helper = ucfirst($helper) . 'Helper';
        require_once('vendor/helper/' . $helper . '.php'); // đường dẫn tính từ admin.php
    }
}