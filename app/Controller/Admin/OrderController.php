<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 31-May-17
 * Time: 03:15
 */
class OrderController extends N_Controller
{
    public function indexAction()
    {
        $this->model->load('Order');
        $orderObj = new OrderModel();
        $data['data'] = $orderObj->getListOrder();
        $this->view->load('order-list', 'Admin/modules/order', $data);
    }

    public function deleteAction()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->model->load('Order');
            $this->model->load('OrderDetail');

            $orderObj = new OrderModel();
            $orderDetailObj = new OrderDetailModel();
            $resultDetail = $orderDetailObj->remove('fs_order_detail', "id_order = $id");
            if($resultDetail) {
                $result = $orderObj->remove('fs_order', "id = $id");
                if($result) {
                    $_SESSION['success_msg'] = 'Xóa đơn hàng thành công!';
                    header('location:' . $_SERVER['HTTP_REFERER']);
                }
                else {
                    $_SESSION['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                    header('location:'.$_SERVER['HTTP_REFERER']);
                }
            }
            else {
                $_SESSION['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                header('location:'.$_SERVER['HTTP_REFERER']);
            }
        } else header('location:?c=order');
    }

    public function detailAction() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->model->load('Order');
            $this->model->load('OrderDetail');
            $this->model->load('Shipping');

            $orderObj = new OrderModel();
            $orderDetailObj = new OrderDetailModel();

            $data['dataOrder'] = $orderObj->getOrderById($id);
            $data['dataOrderDetail'] = $orderDetailObj->getOrderDetail($id);
            $this->view->load('order-detail', 'Admin/modules/order', $data);


        }else header('location:?c=order');
    }

    public function updateAction() {
        if(isset($_POST['id'])) {
            $id = $_POST['id'];
            $status = intval($_POST['status']);
            $this->model->load('Order');
            $orderObj = new OrderModel();
            $result = $orderObj->update('fs_order', ['status' => $status], "id = $id");
            if($result) {
                $_SESSION['success_msg'] = 'Cập nhật đơn hàng thành công!';
                header('location:' . $_SERVER['HTTP_REFERER']);
            }else {
                $_SESSION['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                header('location:'.$_SERVER['HTTP_REFERER']);
            }
        } else header('location:?c=order');
    }
}