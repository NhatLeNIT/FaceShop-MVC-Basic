<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 26-May-17
 * Time: 07:47
 */
class LoginController extends N_Controller
{
    private $data = array();

    public function indexAction()
    {
        if(isset($_SESSION['id_admin']))
            header('location:?c=dashboard');
        $this->view->loadNoMaster('login', 'Admin/Auth', $this->data);
    }

    public function checkAction()
    {
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $this->LoginRequest($username, $password);
            if (!empty($this->data))
                $this->indexAction();
            else {

                $this->model->load('Administrator');
                $admin = new AdministratorModel();
                $username = addslashes($username);
                $password = sha1($password);
                $data_user = $admin->verify($username, $password);
                if ($data_user != null) {
                    $this->setUp($data_user);
                    header('location:?c=dashboard');
                } else {
                    $this->setErrorLogin($username);
                    $this->indexAction();
                }
            };
        } else header('location:?c=login');
    }

    private function setUp($user)
    {
        $_SESSION['id_admin'] = $user[0]['id'];
        $_SESSION['name_admin'] = $user[0]['name'];
        $_SESSION['privilege'] = $user[0]['privilege'];
    }

    private function setErrorLogin($username)
    {
        $this->data['error'] = 'Tài khoản hoặc mật khẩu không chính xác';
        $this->data['username_old'] = $username;
    }

    private function LoginRequest($username, $password)
    {
        if (empty($username) && empty($password)) {
            $this->data['username'] = 'Bạn chưa nhập username';
            $this->data['password'] = 'Bạn chưa nhập mật khẩu';
            $this->data['username_old'] = $username;
        } else if (empty($username)) {
            $this->data['username'] = 'Bạn chưa nhập username';
            $this->data['username_old'] = $username;
        } else if (empty($password)){
            $this->data['password'] = 'Bạn chưa nhập mật khẩu';
            $this->data['username_old'] = $username;
        }
    }

    public function logoutAction() {
        if(isset($_SESSION['id_admin']))
        {
            unset($_SESSION['id_admin']);
            unset($_SESSION['name_admin']);
            unset($_SESSION['privilege']);
            header('location:?c=login');
        }
    }
}