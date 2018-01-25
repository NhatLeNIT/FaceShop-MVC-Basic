<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 25-May-17
 * Time: 13:36
 */
class N_Library_Loader
{
    /**
     * @desc hàm load library
     * @param $library tên của library
     * @param array $agrs danh sách các biến trong hàm khởi tạo (nếu có)
     */
    public function load($library, $agrs = array()) {
        // Nếu thư viện chưa được load thì thực hiện load
        if ( empty($this->$library) )
        {
            // Chuyển đúng định dang
            $class = ucfirst($library) . 'Library';
            require_once('vendor/library/' . $class . '.php'); // đường dẫn tính từ admin.php
            $this->$library = new $class($agrs);
        }
    }
}