<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 27-May-17
 * Time: 13:53
 */
class CustomerController extends N_Controller
{
    private $data = array();

    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['id_admin']))
            header('location:?c=login');
    }

    /**
     * Action index : browse list user
     */
    public function indexAction()
    {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5;
        $this->model->load("Customer");
        $dataObj = new CustomerModel();
        $this->data['title'] = 'Danh sách tài khoản khách hàng';
        $this->data['data'] = $dataObj->getListUserLimit($page, $limit);

        //Tổng số record
        $dataObj->getListUser();
        $totalRecord = $dataObj->getNumRows();

        //setup config pagination
        $config = array(
            'currentPage' => $page,
            'totalRecord' => $totalRecord,
            'limit' => $limit,
            'group' => 10,
            'linkFull' => '?c=user&page={page}',
            'linkFirst' => '?c=user'
        );

        //position
        $this->data['position'] = ($page - 1) * $limit;

        //Load library Pagination
        $this->library->load('Pagination');
        $paginationObj = new PaginationLibrary();
        $paginationObj->init($config);
        $this->data['paginate'] = $paginationObj->html();

        //load view
        $this->view->load('customer-list', 'Admin/modules/user', $this->data);
    }

    /**
     * Xử lý xóa
     */
    public function delAction()
    {
        if (isset($_GET['id'])) {
            $this->model->load('Customer');
            $dataObj = new CustomerModel();

            $id = intval($_GET['id']);
            $where = '`id` = ' . $id;

            $this->model->load('Order');
            $orderObj = new OrderModel();

            $this->model->load('OrderDetail');
            $orderDetailObj = new OrderDetailModel();

            $dataTemp = $orderObj->getOrderByIdUser($id);
            foreach ($dataTemp as $item) {
                $orderDetailObj->remove('fs_order_detail', "id_order = {$item['id']}");//xóa đơn hàng chi tiết
            }
            $orderObj->remove('fs_order',"id_user = $id");///xóa đơn hàng


            $result = $dataObj->remove('fs_user', $where);
            if ($result) {
                $_SESSION['success_msg'] = 'Xóa khách hàng thành công!';
                header('location:?c=customer');
            } else {
                $_SESSION['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                header('location:?c=customer');
            }
        } else header('location:?c=user');
    }
}