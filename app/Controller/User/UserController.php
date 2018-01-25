<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 28-May-17
 * Time: 18:58
 */
class UserController extends BaseController
{
    /**
     * View đăng nhập
     */
    public function loginAction()
    {
        if (isset($_SESSION['id'])) header('location:' . $_SERVER['HTTP_REFERER']);
        $this->data['title'] = 'Đăng nhập tài khoản';
        $this->view->load('login', 'User/modules', $this->data);
    }

    /**
     * Xử lý đăng nhập
     */
    public function processLoginAction()
    {
        if (isset($_POST['email'])) {
            $this->model->load('Customer');
            $dataObj = new CustomerModel();
            $dataObj->email = $_POST['email'];
            $dataObj->password = $_POST['password'];
            $this->checkLoginRequest($dataObj->email, $dataObj->password);
            if (!empty($this->data['email']) || !empty($this->data['password'])) {
                $this->loginAction();
            } else {
                $dataObj->email = addslashes($dataObj->email);
                $dataObj->password = sha1($dataObj->password);
                $data_user = $dataObj->verify($dataObj->email, $dataObj->password);
                if ($data_user != null) {
                    $this->setUp($data_user);
                    if(isset($_SESSION['url']))
                        header('location:'.$_SESSION['url']);
                    else header('location:?c=home');
                    //echo '<script> window.history.go(-2); </script>';
                } else {
                    $this->setErrorLogin($dataObj->email);
                    $this->loginAction();
                }
            }
        } else header('location:?c=user&a=login');
    }

    /**
     * View đăng ký
     */
    public function registerAction()
    {
        $this->data['title'] = 'Đăng ký tài khoản';
        $this->view->load('register', 'User/modules', $this->data);
    }

    /**
     * Xử lý đăng ký
     */
    public function processRegisterAction()
    {
        if (isset($_POST['txtEmail'])) {
            $this->model->load('Customer');
            $dataObj = new CustomerModel();
            $dataObj->email = trim($_POST['txtEmail']);
            $dataObj->name = $_POST['txtName'];
            $dataObj->password = $_POST['txtPassword'];
            $rePassword = $_POST['txtRePassword'];
            $dataObj->mobile = $_POST['txtPhone'];
            $dataObj->dob = $_POST['txtBirthday'];
            $dataObj->gender = $_POST['txtGender'];
            $dataObj->address = $_POST['txtAddress'];

            $this->checkRegisterRequest($dataObj, $rePassword);
            if (!empty($this->data['email_old']))
                $this->registerAction();
            else {
                $dataObj->password = sha1($dataObj->password);
                $dataArr = array(
                    'id' => null,
                    'email' => $dataObj->email,
                    'password' => $dataObj->password,
                    'name' => $dataObj->name,
                    'address' => $dataObj->address,
                    'mobile' => $dataObj->mobile,
                    'dob' => $dataObj->dob,
                    'gender' => $dataObj->gender
                );

                $result = $dataObj->insert('fs_user', $dataArr);
                if ($result) {
                    $_SESSION['success_msg'] = 'Đăng ký tài khoản thành công!';
                    $idInsert = $dataObj->getInsertId();
                    $dataTemp = $dataObj->getUserById($idInsert);
                    $this->setUp($dataTemp);
                    header('location:?c=home');
                } else {
                    $this->data['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                    $this->setDataOld($dataObj->email, $dataObj->name, $dataObj->mobile, $dataObj->dob, $dataObj->gender, $dataObj->address);
                    $this->registerAction();
                }
            }
        } else header('location:?c=user&a=register');
    }

    /**
     * Logout tài khoản
     */
    public function logoutAction()
    {
        if (isset($_SESSION['id'])) {
            unset($_SESSION['id']);
            unset($_SESSION['name']);
            header('location:?c=user&a=login');
        }
    }

    /**
     * Reset password
     */
    public function resetAction()
    {
        $this->view->load('reset-password', 'User/modules', $this->data);
    }

    /**
     * Xử lý reset password
     */
    public function processResetAction()
    {
        if ($_POST['txtEmail']) {
            $this->model->load('Customer');
            $dataObj = new CustomerModel();
            $dataObj->email = trim($_POST['txtEmail']);
            $this->checkResetPasswordRequest($dataObj->email);
            if (!empty($this->data['email_old']))
                $this->resetAction();
            else {
                $this->helper->load('String');
                $newPassword = randomString(8);
                $where = "`email` = '$dataObj->email'";
                $dataArr = array(
                    'password' => sha1($newPassword)
                );
                $update = $dataObj->update('fs_user', $dataArr, $where);
                if ($update) {
                    $this->library->load('Mail');
                    $mail = new MailLibrary();
                    $mail->init('it.quinhat', 'ydgamumoyslqapjk');
                    $content = 'Mật khẩu mới của bạn là: <b>' . $newPassword . '</b>';
                    $check = $mail->sendMail('admin@FaceShop.Dev', $dataObj->email, 'Khôi phục mật khẩu - FaceShop', $content);
                    if ($check)
                        $this->data['success'] = 'Chúng tôi đã gửi mật khẩu mới cho bạn vào email ' . $dataObj->email;
                    else {
                        $this->data['error'] = 'Khôi phục mật khẩu thất bại, vui lòng kiểm tra lại!';
                        $this->data['email_old'] = $dataObj->email;
                    }
                } else {
                    $this->data['error'] = 'Khôi phục mật khẩu thất bại, vui lòng kiểm tra lại!';
                    $this->data['email_old'] = $dataObj->email;
                }
                $this->resetAction();
            }

        } else header('location:?c=user&a=reset');
    }

    /**
     * View profile
     */
    public function profileAction()
    {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $this->model->load('Customer');
            $dataObj = new CustomerModel();
            $this->data['data'] = $dataObj->getUserById($id);

            $this->model->load('Order');
            $orderObj = new OrderModel();
            $this->data['dataOrder'] = $orderObj->getListOrderByIdUser($_SESSION['id']);

            $this->view->load('profile', 'User/modules', $this->data);
        } else header('location:?c=home');
    }

    /**
     * View update
     */
    public function updateAction()
    {
        if (isset($_SESSION['id'])) {
            if (isset($_GET['id']) && $_GET['id'] != $_SESSION['id'])
                header('location:?c=home');
            if (!empty($this->data['id_old']) && $this->data['id_old'] != $_SESSION['id'])
                header('location:?c=home');
            if (isset($_GET['id']))
                $id = intval($_GET['id']);
            else
                $id = $this->data['id_old'];
            $this->model->load('Customer');
            $dataObj = new CustomerModel();
            $this->data['data'] = $dataObj->getUserById($id);
            $this->view->load('update-profile', 'User/modules', $this->data);
        } else header('location:?c=home');
    }

    /**
     * Xử lý cập nhật
     */
    public function processUpdateAction()
    {
        if (isset($_POST['id'])) {
            $this->model->load('Customer');
            $dataObj = new CustomerModel();
            $dataObj->id = $_POST['id'];
            $dataObj->name = $_POST['txtName'];
            $dataObj->mobile = $_POST['txtPhone'];
            $dataObj->address = $_POST['txtAddress'];
            $dataObj->dob = $_POST['txtBirthday'];
            $dataObj->gender = $_POST['txtGender'];
            $dataObj->password = $_POST['txtPassword'];
            $newPassword = $_POST['txtPasswordNew'];
            $reNewPassword = $_POST['txtRePasswordNew'];

            $this->checkUpdateRequest($dataObj, $newPassword, $reNewPassword);
            if (!empty($this->data['id_old'])) {
                $this->data['id_old'] = $dataObj->id;
                $this->updateAction();
            } else {
                $dataArr = array(
                    'name' => $dataObj->name,
                    'address' => $dataObj->address,
                    'mobile' => $dataObj->mobile,
                    'dob' => $dataObj->dob,
                    'gender' => $dataObj->gender
                );
                if (!empty($newPassword))
                    $dataArr['password'] = sha1($newPassword);

                $where = "`id`='" . $dataObj->id . "'";

                $result = $dataObj->update('fs_user', $dataArr, $where);
                if ($result) {
                    $_SESSION['success_msg'] = 'Cập nhật tài khoản thành công!';
                    $_SESSION['name'] = $dataObj->name;
                    header('location:?c=user&a=update&id=' . $dataObj->id);
                } else {
                    $this->data['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                    $this->setDataOld($dataObj->name, $dataObj->mobile, $dataObj->dob, $dataObj->gender, $dataObj->address, $dataObj->email);
                    $this->updateAction();
                }
            }
        } else header('location:?c=home');
    }

    /**
     * Kiểm tra request login
     * @param $email
     * @param $password
     */
    private function checkLoginRequest($email, $password)
    {
        if (empty($email)) {
            $this->data['email'] = 'Bạn chưa nhập email';
            $this->data['email_old'] = $email;
        } else {
            $pattern = '/^[a-z][a-z0-9\._]{2,31}@[a-z0-9\-]{3,}(\.[a-z]{2,4}){1,2}$/';
            if (!preg_match($pattern, $email)) {
                $this->data['email'] = 'Email bạn nhập chưa đúng định dạng';
                $this->data['email_old'] = $email;
            }
        }
        if (empty($password)) {
            $this->data['password'] = 'Bạn chưa nhập mật khẩu';
            $this->data['email_old'] = $email;
        }

    }

    /**
     * Kiểm tra request đăng ký
     * @param $dataObj
     * @param $rePassword
     */
    private function checkRegisterRequest($dataObj, $rePassword)
    {
        if (empty($dataObj->email)) {
            $this->data['email'] = 'Bạn chưa nhập email';
            $this->setDataOld($dataObj);
        } else {
            $pattern = '/^[a-z][a-z0-9\._]{2,31}@[a-z0-9\-]{3,}(\.[a-z]{2,4}){1,2}$/';
            if (!preg_match($pattern, $dataObj->email)) {
                $this->data['email'] = 'Email bạn nhập chưa đúng định dạng';
                $this->setDataOld($dataObj);
            }
        }
        if (empty($dataObj->password)) {
            $this->data['password'] = 'Bạn chưa nhập mật khẩu';
            $this->setDataOld($dataObj);
        } else if (strlen($dataObj->password) < 6) {
            $this->data['password'] = 'Mật khẩu phải lớn hơn 6 ký tự';
            $this->setDataOld($dataObj);
        } else if ($dataObj->password != $rePassword) {
            $this->data['password'] = 'Mật khẩu nhập lại không trùng khớp';
            $this->setDataOld($dataObj);
        }
        if (empty($dataObj->name)) {
            $this->data['name'] = 'Bạn chưa nhập họ tên';
            $this->setDataOld($dataObj);
        }
        if (empty($dataObj->mobile)) {
            $this->data['phone'] = 'Bạn chưa nhập số điện thoại';
            $this->setDataOld($dataObj);
        }
        if (empty($dataObj->dob)) {
            $this->data['dob'] = 'Bạn chưa nhập ngày sinh';
            $this->setDataOld($dataObj);
        }
        if (empty($dataObj->address)) {
            $this->data['address'] = 'Bạn chưa nhập địa chỉ';
            $this->setDataOld($dataObj);
        }

        $this->helper->load('Captcha');
        $siteKey = '6LdiOSMUAAAAAMGzYd5BmjGHeOX6lCnWIImrr0Ea';
        $secretKey = '6LdiOSMUAAAAAM2YpHyyNqAx0Fkz01sLMuYvgr5J';
        $postName = 'txtEmail';
        if (!checkReCaptcha($siteKey, $secretKey, $postName)) {
            $this->data['captcha'] = 'Bạn chưa nhập captcha';
            $this->setDataOld($dataObj);
        }
    }

    /**
     * Kiểm tra request reset password
     * @param $email
     */
    public function checkResetPasswordRequest($email)
    {
        if (empty($email)) {
            $this->data['email'] = 'Bạn chưa nhập email';
            $this->data['email_old'] = $email;
        } else {
            $pattern = '/^[a-z][a-z0-9\._]{2,31}@[a-z0-9\-]{3,}(\.[a-z]{2,4}){1,2}$/';
            if (!preg_match($pattern, $email)) {
                $this->data['email'] = 'Email bạn nhập chưa đúng định dạng';
                $this->data['email_old'] = $email;
            } else {
                $this->model->load('Customer');
                $dataTempObj = new CustomerModel();
                $email = addslashes($email);
                $dataTemp = $dataTempObj->getUserByEmail($email);
                if ($dataTemp == null) {
                    $this->data['error'] = 'Email này không tồn tại trong hệ thống';
                    $this->data['email_old'] = $email;
                }
            }
        }
    }

    /**
     * Kiểm tra request khi update
     * @param $dataObj
     * @param $newPassword
     * @param $reNewPassword
     */
    public function checkUpdateRequest($dataObj, $newPassword, $reNewPassword)
    {
        if (empty($dataObj->password)) {
            $this->data['password'] = 'Bạn chưa nhập mật khẩu hiện tại';
            $this->setDataOld($dataObj);
        } else {
            $this->model->load('Customer');
            $dataTempObj = new CustomerModel();
            $dataTemp = $dataTempObj->getUserById($dataObj->id);
            if (sha1($dataObj->password) != $dataTemp[0]['password']) {
                $this->data['password'] = 'Mật khẩu hiện tại không chính xác';
                $this->setDataOld($dataObj);
            }
        }
        if (!empty($newPassword) && strlen($newPassword) < 6) {
            $this->data['newPassword'] = 'Mật khẩu mới phải lớn hơn 6 ký tự';
            $this->setDataOld($dataObj);
        } else if ($newPassword != $reNewPassword) {
            $this->data['reNewPassword'] = 'Mật khẩu mới nhập lại không trùng khớp';
            $this->setDataOld($dataObj);
        }
        if (empty($dataObj->name)) {
            $this->data['name'] = 'Bạn chưa nhập họ tên';
            $this->setDataOld($dataObj);
        }
        if (empty($dataObj->mobile)) {
            $this->data['phone'] = 'Bạn chưa nhập số điện thoại';
            $this->setDataOld($dataObj);
        }
        if (empty($dataObj->dob)) {
            $this->data['dob'] = 'Bạn chưa nhập ngày sinh';
            $this->setDataOld($dataObj);
        }
        if (empty($dataObj->address)) {
            $this->data['address'] = 'Bạn chưa nhập địa chỉ';
            $this->setDataOld($dataObj);
        }
    }

    /**
     * Set data cũ từ form
     * @param $dataObj
     */
    private function setDataOld($dataObj)
    {
        if(!empty($dataObj->id))
        $this->data['id_old'] = $dataObj->id;
        if ($dataObj->email != '')
            $this->data['email_old'] = $dataObj->email;
        $this->data['name_old'] = $dataObj->name;
        $this->data['phone_old'] = $dataObj->mobile;
        $this->data['dob_old'] = $dataObj->dob;
        $this->data['gender_old'] = $dataObj->gender;
        $this->data['address_old'] = $dataObj->address;
    }

    /**
     * Set lỗi khi đăng nhập thất bại
     * @param $email
     */
    private function setErrorLogin($email)
    {
        $this->data['error'] = 'Tài khoản hoặc mật khẩu không chính xác';
        $this->data['email_old'] = $email;
    }

    /**
     * Set thông tin khi đăng nhập thành công
     * @param $user
     */
    private function setUp($user)
    {
        $_SESSION['id'] = $user[0]['id'];
        $_SESSION['name'] = $user[0]['name'];
    }

    public function getOrderDetailAction() {
        if(isset($_GET['id'])) {
            $this->model->load('Customer');
            $dataObj = new CustomerModel();
            $this->data['data'] = $dataObj->getUserById($_SESSION['id']);

            $id = addslashes($_GET['id']);
            $this->model->load('OrderDetail');
            $orderDetailObj = new OrderDetailModel();
            $this->data['dataOrderDetail'] = $orderDetailObj->getOrderDetail($id);

            $this->model->load('Order');
            $orderObj = new OrderModel();
            $this->data['dataOrder'] = $orderObj->getOrderById($id);
            $this->view->load('order-detail', 'User/modules', $this->data);

        } else header('location:?c=home');
    }
}