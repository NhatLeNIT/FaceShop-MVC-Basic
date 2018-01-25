<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 25-May-17
 * Time: 11:58
 */
session_start();
//Lấy thông số cấu hình
require_once "config/config.php";
// Đường dẫn tới hệ  thống
define('PATH_APPLICATION', 'app/Controller/User');
//file chạy hệ thống
require_once "vendor/core/N_Common.php";
N_Load();
