<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 27-May-17
 * Time: 15:26
 */
class CategoryController extends N_Controller
{
    private $data = array();

    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['id_admin']))
            header('location:?c=login');
    }

    /**
     * Action index : browse list category
     */
    public function indexAction()
    {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
        $cate = isset($_GET['cate']) ? intval($_GET['cate']) : '';
        $this->model->load("Category");
        $dataObj = new CategoryModel();
        $this->data['title'] = 'Danh sách loại sản phẩm';

        if ($cate == '') {
            $this->data['data'] = $dataObj->getListCateLimit($page, $limit);
            //Tổng số record
            $dataObj->getListCate();
            $totalRecord = $dataObj->getNumRows();
        } else {
            $this->data['data'] = $dataObj->getListCateLimitById($cate, $page, $limit);
            //Tổng số record
            $dataObj->getListCateById($cate);
            $totalRecord = $dataObj->getNumRows();
        }

        $this->data['cateList'] = $dataObj->getListCateParent();

        //setup config pagination
        $config = array(
            'currentPage' => $page,
            'totalRecord' => $totalRecord,
            'limit' => $limit,
            'group' => 10,
            'linkFull' => '?c=category&page={page}',
            'linkFirst' => '?c=category'
        );

        //position
        $this->data['position'] = ($page - 1) * $limit;

        //Load library Pagination
        $this->library->load('Pagination');
        $paginationObj = new PaginationLibrary();
        $paginationObj->init($config);
        $this->data['paginate'] = $paginationObj->html();

        //load view
        $this->view->load('category-list', 'Admin/modules/category', $this->data);
    }

    /**
     * View add
     */
    public function addAction()
    {
        $this->data['title'] = 'Thêm loại sản phẩm mới';

        $this->model->load("Category");
        $dataObj = new CategoryModel();
        $this->data['cateList'] = $dataObj->getListCateParent();
        //Load view
        $this->view->load('category-add', 'Admin/modules/category', $this->data);
    }

    /**
     * Xử lý thêm
     */
    public function addProcessAction()
    {
        if (isset($_POST['txtName'])) {
            $idParent = $_POST['txtParent'];
            $name = $_POST['txtName'];
            $this->checkAddRequest($name, $idParent);
            if (!empty($this->data))
                $this->addAction();
            else {
                $this->model->load('Category');
                $dataObj = new CategoryModel();
                $dataArr = array(
                    'id' => null,
                    'name' => $name,
                    'id_parent' => $idParent,
                );
                $result = $dataObj->insert('fs_category', $dataArr);
                if ($result) {
                    $_SESSION['success_msg'] = 'Thêm loại mới thành công!';
                    header('location:?c=category');
                } else {
                    $this->data['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                    $this->setDataOld($name, $idParent);
                    $this->addAction();
                }
            }
        } else header('location:?c=category&a=add');
    }

    /**
     * View edit
     */
    public function editAction()
    {
        if (isset($_GET['id']) || !empty($this->data)) {
            if (isset($_GET['id']))
                $id = intval($_GET['id']);
            else
                $id = $this->data['id_old'];
            $this->model->load("Category");
            $dataObj = new CategoryModel();
            $this->data['title'] = 'Sửa thông tin loại sản phẩm';
            $this->data['data'] = $dataObj->getCateById($id);

            $this->data['cateList'] = $dataObj->getListCateParent();

            //Load view
            $this->view->load('category-edit', 'Admin/modules/category', $this->data);
        } else header('location:?c=category');
    }

    /**
     * Xử lý sửa
     */
    public function editProcessAction()
    {
        if (isset($_POST['id'])) {
            $this->model->load('Category');
            $adminObj = new CategoryModel();

            $id = intval($_POST['id']);
            $idParent = $_POST['txtParent'];
            $name = $_POST['txtName'];
            $this->checkEditRequest($name, $idParent);
            if (!empty($this->data)) {
                $this->data['id_old'] = $id;
                $this->editAction();
            } else {
                $dataArr = array(
                    'name' => $name,
                    'id_parent' => $idParent,
                );

                $where = '`id` = ' . $id;
                $result = $adminObj->update('fs_category', $dataArr, $where);
                if ($result) {
                    $_SESSION['success_msg'] = 'Cập nhật loại sản phẩm thành công!';
                    header('location:?c=category');
                } else {
                    $this->data['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                    $this->setDataOld($name, $idParent);
                    $this->editAction();
                }
            }
        } else header('location:?c=category');
    }

    /**
     * Xử lý xóa
     */
    public function delAction()
    {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $this->model->load('Category');
            $dataObj = new CategoryModel();
            $dataObj->getListCateById($id);
            echo $dataObj->getNumRows();
            if($dataObj->getNumRows()) {
                $where = '`id_parent` = '. $id;
                $dataObj->remove('fs_category', $where);
                $where = '`id` = ' . $id;
                $result = $dataObj->remove('fs_category', $where);
            }
            else {
                $where = '`id` = ' . $id;
                $result = $dataObj->remove('fs_category', $where);
            }

            if ($result) {
                $_SESSION['success_msg'] = 'Xóa loại sản phẩm thành công!';
                header('location:'.$_SERVER['HTTP_REFERER']);
            } else {
                $_SESSION['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                header('location:'.$_SERVER['HTTP_REFERER']);
            }

        } else header('location:?c=category');
    }

    /**
     * Kiểm tra add request có hợp lệ không
     * @param $name
     * @param $idParent
     */
    private function checkAddRequest($name, $idParent)
    {
        if (empty($name)) {
            $this->data['name'] = 'Tên không được để trống';
            $this->setDataOld($name, $idParent);
        } else {
            $this->model->load('Category');
            $dataTemp = new CategoryModel();
            $dataTemp->getCateByName($name);
            if ($dataTemp->getNumRows()) {
                $this->data['name'] = 'Tên loại sản phẩm này đã tồn tại';
                $this->setDataOld($name, $idParent);
            }
        }
    }

    /**
     * Kiểm tra edit request có hợp lệ không
     * @param $name
     * @param $idParent
     */
    private function checkEditRequest($name, $idParent)
    {
        if (empty($name)) {
            $this->data['name'] = 'Tên không được để trống';
            $this->setDataOld($name, $idParent);
        }
    }

    /**
     * set data cũ từ form
     * @param $username
     * @param $name
     * @param $privilege
     */
    private function setDataOld($name, $idParent)
    {
        $this->data['name_old'] = $name;
        $this->data['parent_old'] = $idParent;
    }
}