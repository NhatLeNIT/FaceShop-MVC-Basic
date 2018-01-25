<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 24-May-17
 * Time: 16:07
 */
//Lay thong so cau hinh
require_once "../config/config.php";
//Xac dinh router
$url = $_SERVER['REQUEST_URI'];
$arr_url = explode("/", $url);
$count = count($arr_url);
$params = null;// tham so truyen
if ($arr_url[1] == "fs-admin") { // neu truy cap vao admin
    $nameCtrl =  empty($arr_url[2]) ? DEFAULT_CONTROLLER : $arr_url[2];
    $nameAct = empty($arr_url[3]) ? DEFAULT_ACTION : $arr_url[3];
    for ($i = 4; $i < $count; $i++)
        $params[] = $arr_url[$i];
} else {
    $nameCtrl = $arr_url[1];
    $nameAct = "";
    if(isset($arr_url[2]))
        $nameAct = $arr_url[2];
    for ($i = 3; $i < $count; $i++)
        $params[] = $arr_url[$i];
}

if ($nameCtrl == "") $nameCtrl = DEFAULT_CONTROLLER;
if ($nameAct == "") $nameAct = DEFAULT_ACTION;
echo $nameCtrl."-".$nameAct;
//$c = new $cname($action, $params);
//if (method_exists($c, $action)) $c->$action();