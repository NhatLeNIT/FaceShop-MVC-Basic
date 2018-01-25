<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 25-May-17
 * Time: 14:46
 */


/**
 * Chuyển đổi tiêu đề thành không dấu
 * @param $string
 * @return mixed|string
 */
function changeTitle($str)
{
    $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd' => 'đ', 'D' => 'Đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ', 'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i' => 'í|ì|ỉ|ĩ|ị', 'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự', 'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ', 'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
    );
    foreach ($unicode as $khongdau => $codau) {
        $arr = explode("|", $codau);
        $str = str_replace($arr, $khongdau, $str);
    }

    $str = str_replace(array('?', '&', '+', '%', "'", '"'), "", $str);
    $str = trim($str);
    while (strpos($str, '  ') > 0) $str = str_replace("  ", " ", $str);
    $str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');
    $str = str_replace(" ", "-", $str);
    return $str;
}

/**
 * Cắt chuỗi theo độ dài
 * @param $str
 * @param $length
 * @param int $minWord
 * @return string
 */
function cutString($str, $length, $minWord = 3)
{
    $sub = '';
    $len = 0;
    foreach (explode(' ', $str) as $word) {
        $part = (($sub != '') ? ' ' : '') . $word;//kiem tra neu la chu dau thi ghep '' voi tu dau tien, neu sub khong rong tuc la khong phai chu dau => ghep voi khoang trang ' '
        $sub .= $part;//noi cac tu lai voi nhau
        $len += strlen($part);//dem do dai cua cac tu duoc tach ra
        //=== Neu do dai cua mot chu > do dai toi thieu cua mot chu va do dai cua cau da ghep duoc > so chu muon lay thi dung lai
        if (strlen($word) > $minWord && strlen($sub) >= $length) {
            break;
        }
    }
    return $sub . (($len < strlen($str)) ? '...' : '');
}

/**
 * Tạo chuỗi ngẫu nhiên
 * @param $length
 * @return string
 */
function randomString($length)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    $str = '';
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[mt_rand(0, $size - 1)];
    }
    return $str;
}