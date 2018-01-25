<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 26-May-17
 * Time: 22:18
 */
class UserController extends N_Controller
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
        $this->model->load("Administrator");
        $dataObj = new AdministratorModel();
        $this->data['title'] = 'Danh sách tài khoản quản trị website';
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
        $this->view->load('admin-list', 'Admin/modules/user', $this->data);
    }

    /**
     * View add
     */
    public function addAction()
    {
        $this->data['title'] = 'Thêm tài khoản quản trị website';

        //Load view
        $this->view->load('admin-add', 'Admin/modules/user', $this->data);
    }

    /**
     * Xử lý thêm
     */
    public function addProcessAction()
    {
        if (isset($_POST['txtUsername'])) {
            $username = $_POST['txtUsername'];
            $password = $_POST['txtPassword'];
            $rePassword = $_POST['txtRePassword'];
            $name = $_POST['txtName'];
            $privilege = $_POST['txtPrivilege'];
            $this->checkAddRequest($username, $password, $rePassword, $name, $privilege);
            if (!empty($this->data))
                $this->addAction();
            else {
                $this->model->load('Administrator');
                $adminObj = new AdministratorModel();
                $username = addslashes($username);
                $password = sha1($password);

                $dataArr = array(
                    'id' => null,
                    'name' => $name,
                    'username' => $username,
                    'password' => $password,
                    'privilege' => $privilege,
                );
                $result = $adminObj->insert('fs_administrator', $dataArr);
                if ($result) {
                    $_SESSION['success_msg'] = 'Thêm nhân viên mới thành công!';
                    header('location:?c=user');
                } else {
                    $this->data['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                    $this->setDataOld($name, $privilege, $username);
                    $this->addAction();
                }
            }
        } else header('location:?c=user&a=add');
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
            $this->model->load("Administrator");
            $dataObj = new AdministratorModel();
            $this->data['title'] = 'Sửa thông tin nhân viên';
            $this->data['data'] = $dataObj->getUserById($id);

            //Load view
            $this->view->load('admin-edit', 'Admin/modules/user', $this->data);
        } else header('location:?c=user');
    }

    /**
     * Xử lý sửa
     */
    public function editProcessAction()
    {
        if (isset($_POST['id'])) {
            $this->model->load('Administrator');
            $adminObj = new AdministratorModel();

            $id = intval($_POST['id']);
            $password = $_POST['txtPassword'];
            $rePassword = $_POST['txtRePassword'];
            $name = $_POST['txtName'];
            if (isset($_POST['txtPrivilege']))
                $privilege = $_POST['txtPrivilege'];
            else {

                $dataTemp = $adminObj->getUserById($id);
                $privilege = $dataTemp[0]['privilege'];
            }
            $this->checkEditRequest($password, $rePassword, $name, $privilege);
            if (!empty($this->data)) {
                $this->data['id_old'] = $id;
                $this->editAction();
            } else {
                $dataArr = array(
                    'name' => $name,
                    'privilege' => $privilege,
                );
                if (!empty($password)) {
                    $password = sha1($password);
                    $dataArr['password'] = $password;
                }
                $where = '`id` = ' . $id;
                $result = $adminObj->update('fs_administrator', $dataArr, $where);
                if ($result) {
                    $_SESSION['success_msg'] = 'Cập nhật nhân viên thành công!';
                    header('location:?c=user');
                } else {
                    $this->data['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                    $this->setDataOld($name, $privilege);
                    $this->editAction();
                }
            }
        } else header('location:?c=user');
    }

    /**
     * Xử lý xóa
     */
    public function delAction()
    {
        if (isset($_GET['id'])) {
            $this->model->load('Administrator');
            $adminObj = new AdministratorModel();

            $id = intval($_GET['id']);
            $user_current_login = $_SESSION['id_admin'];
            $user_delete = $adminObj->getUserById($id);

            if (($id == 1) || ($user_current_login != 1 && $user_delete[0]['privilege'] == 1)) {
                $_SESSION['error_msg'] = 'Bạn không được phép xóa nhân viên này!';
                header('location:?c=user');
            } else {
                $where = '`id` = ' . $id;
                $result = $adminObj->remove('fs_administrator', $where);
                if ($result) {
                    $_SESSION['success_msg'] = 'Xóa nhân viên thành công!';
                    header('location:?c=user');
                } else {
                    $_SESSION['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                    header('location:?c=user');
                }
            }
        } else header('location:?c=user');
    }

    /**
     * Kiểm tra add request có hợp lệ không
     * @param $username
     * @param $password
     * @param $rePassword
     * @param $name
     * @param $privilege
     */
    private function checkAddRequest($username, $password, $rePassword, $name, $privilege)
    {
        if (empty($username)) {
            $this->data['username'] = 'Tên tài khoản không được để trống';
            $this->setDataOld($name, $privilege, $username);
        }
        if (empty($password)) {
            $this->data['password'] = 'Mật khẩu không được để trống';
            $this->setDataOld($name, $privilege, $username);
        }
        if (empty($rePassword) || $rePassword != $password) {
            $this->data['rePassword'] = 'Mật khẩu nhập lại không trùng khớp';
            $this->setDataOld($name, $privilege, $username);
        }
        if (empty($name)) {
            $this->data['name'] = 'Tên không được để trống';
            $this->setDataOld($name, $privilege, $username);
        }

    }

    /**
     * Kiểm tra add request có hợp lệ không
     * @param $username
     * @param $password
     * @param $rePassword
     * @param $name
     * @param $privilege
     */
    private function checkEditRequest($password, $rePassword, $name, $privilege)
    {
        if ($rePassword != $password) {
            $this->data['rePassword'] = 'Mật khẩu nhập lại không trùng khớp';
            $this->setDataOld($name, $privilege);
        }
        if (empty($name)) {
            $this->data['name'] = 'Tên không được để trống';
            $this->setDataOld($name, $privilege);
        }
    }

    /**
     * set data cũ từ form
     * @param $username
     * @param $name
     * @param $privilege
     */
    private function setDataOld($name, $privilege, $username = '')
    {
        if (!empty($username))
            $this->data['username_old'] = $username;
        $this->data['name_old'] = $name;
        $this->data['privilege_old'] = $privilege;
    }

    /**
     *Kiểm tra user có tồn tại không bằng ajax
     */
    public function checkIssetUserByAjaxAction()
    {
        if (isset($_POST['username'])) {
            $this->model->load('Administrator');
            $adminObj = new AdministratorModel();
            $adminObj->getUserByUsername($_POST['username']);
            if ($adminObj->getNumRows())
                echo 'true';
            else echo 'false';
        }
    }
}