<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 24-May-17
 * Time: 16:32
 */
//Thong tin ung dung
define('BASE_URL', 'faceshop.dev');
define('APP_NAME', 'FaceShop');
// Đường dẫn tới hệ  thống
define('PATH_SYSTEM', BASE_URL . '/vendor');

//Thong so database
define('HOST', 'localhost');
define('DB_NAME', 'faceshop');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
//Thong so controller va action mac dinh
define('CONTROLLER_DEFAULT','home');
define('ACTION_DEFAULT','index');
define('404_CONTROLLER', 'error');
define('404_ACTION', 'index');