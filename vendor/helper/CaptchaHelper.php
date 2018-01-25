<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 28-May-17
 * Time: 21:34
 */

function checkReCaptcha($siteKey, $secretKey, $postName)
{
    //cấu hình thông tin do google cung cấp
    $api_url = 'https://www.google.com/recaptcha/api/siteverify';
    $site_key = $siteKey;
    $secret_key = $secretKey;

//kiem tra submit form
    if (isset($_POST[$postName])) {
        //lấy dữ liệu được post lên
        $site_key_post = $_POST['g-recaptcha-response'];

        //lấy IP của khach
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $remoteIP = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $remoteIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $remoteIP = $_SERVER['REMOTE_ADDR'];
        }

        //tạo link kết nối
        $api_url = $api_url . '?secret=' . $secret_key . '&response=' . $site_key_post . '&remoteip=' . $remoteIP;
        //lấy kết quả trả về từ google
        $response = file_get_contents($api_url);
        //dữ liệu trả về dạng json
        $response = json_decode($response);
        if (!isset($response->success)) {
            //echo 'Captcha khong dung';
            return false;
        }
        if ($response->success == true) {
            //echo 'Captcha dung';
            return true;
        } else {
            //echo 'Captcha khong dung';
            return false;
        }
    }
    return false;
}