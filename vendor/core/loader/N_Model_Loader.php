<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 25-May-17
 * Time: 16:51
 */
class N_Model_Loader
{
    /**
     * Load model
     *
     * @param 	string
     * @desc    hàm load model, tham số truyền vào là tên của model và các biến truyền vào hàm khởi tạo
     */
    public function load($model, $args  = array())
    {
        // Nếu model chưa load thì tiến hành load
        if (empty($this->{$model})){
            $class = ucfirst($model) . 'Model';
            require_once('app/Model/' . $class . '.php');
            $this->$model = new $class($args);
        }
    }
}