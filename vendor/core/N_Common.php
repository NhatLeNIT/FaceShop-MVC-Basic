<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 25-May-17
 * Time: 13:20
 */

function N_Load()
{
    // Lấy phần config khởi tạo ban đầu
    $config = include_once PATH_APPLICATION . '/config/init.php';

    $controller = empty($_GET['c']) ? $config['default_controller'] : $_GET['c'];
    $action = empty($_GET['a']) ? $config['default_action'] : $_GET['a'];

    //Chuyển đổi tên controller và action cho đúng định dạng
    $controller = ucfirst(strtolower($controller)) . 'Controller';
    $action = strtolower($action) . 'Action';

    // Kiểm tra file controller có tồn tại hay không
    if (!file_exists(PATH_APPLICATION . '/' . $controller . '.php')) {
        die ('Không tìm thấy file: ' . $controller . '.php');
    }

    // Include controller chính để các controller con nó kế thừa
    include_once "N_Controller.php";
    include_once "app/Controller/User/BaseController.php";

    // Include model chính để các controller con nó kế thừa
    include_once "N_Model.php";
    // Gọi file controller vào
    require_once(PATH_APPLICATION . '/' . $controller . '.php');

    // Kiểm tra class controller có tồn tại hay không
    if (!class_exists($controller)) {
        die ('Không tìm thấy controller: ' . $controller);
    }

    // Khởi tạo controller
    $controllerObject = new $controller();

    // Kiểm tra action có tồn tại hay không
    if (!method_exists($controllerObject, $action)) {
        die ('Không tìm thấy action: ' . $action);
    }

    // Chạy ứng dụng
    $controllerObject->$action();
}