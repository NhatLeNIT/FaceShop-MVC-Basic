<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 30-May-17
 * Time: 23:29
 */
class OrderController extends BaseController
{
    public function checkoutAction()
    {
        if ($this->data['cartCount']) {
            if (!isset($_SESSION['id'])) {
                $_SESSION['url'] = '?c=order&a=checkout';
                echo "<script>
                alert('Bạn phải đăng nhập trước khi đặt hàng');
                window.location.href='?c=user&a=login';
            </script>
            ";
            } else {
                $this->model->load('Customer');
                $dataObj = new CustomerModel();
                $this->data['dataUser'] = $dataObj->getUserById($_SESSION['id']);

                //load data province
                $this->model->load('Province');
                $provinceObj = new ProvinceModel();
                $this->data['dataProvince'] = $provinceObj->getListProvince();

                //load data district
                $this->model->load('District');
                $districtObj = new DistrictModel();
                $this->data['dataDistrict'] = $districtObj->getListDistrictByProvinceId($this->data['dataProvince'][0]['id']);
                //load data ward
                $this->model->load('Ward');
                $WardObj = new WardModel();
                $this->data['dataWard'] = $WardObj->getListWardByDistrictId($this->data['dataDistrict'][0]['id']);

                $this->view->load('checkout', 'User/modules', $this->data);
            };
        } else header('location:?c=home');
    }

    public function getDistrictListAction()
    {
        if (isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $this->model->load('District');
            $dataObj = new DistrictModel();
            $dataArr = $dataObj->getListDistrictByProvinceId($id);
            foreach ($dataArr as $item) {
                echo "<option value='{$item['id']}'>{$item['name']}</option>";
            }
        }
    }

    public function getWardListAction()
    {
        if (isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $this->model->load('Ward');
            $dataObj = new WardModel();
            $dataArr = $dataObj->getListWardByDistrictId($id);
            foreach ($dataArr as $item) {
                echo "<option value='{$item['id']}'>{$item['name']}</option>";
            }
        }
    }

    public function getShippingAction()
    {
        if (isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $type = intval($_POST['type']);
            $this->model->load('Shipping');
            $dataObj = new ShippingModel();
            $dataArr = $dataObj->getShippingCost($id, $type);
            if ($this->data['cartTotal'] < 500000)
                echo number_format($dataArr[0]['cost'], 0, ',', '.') . "<sup>đ</sup>";
            else echo "Miễn phí giao hàng";
        }
    }

    public function processCheckoutAction()
    {
        if (isset($_POST['txtName'])) {
            $this->model->load('Order');
            $orderObj = new OrderModel();
            $orderObj->name = trim($_POST['txtName']);
            $orderObj->mobile = trim($_POST['txtPhone']);
            $province = intval($_POST['txtProvince']);
            $district = intval($_POST['txtDistrict']);
            $ward = intval($_POST['txtWard']);
            $orderObj->address = trim($_POST['txtAddress']);
            $orderObj->payment_type = intval($_POST['txtPayment']);
            $delivery = intval($_POST['txtDelivery']);
            $this->checkRequest($orderObj->name, $orderObj->mobile, $orderObj->address);
            if (!empty($this->data['old']))
                $this->checkoutAction();
            else {
                $this->model->load('Province');
                $this->model->load('District');
                $this->model->load('Ward');

                $provinceObj = new ProvinceModel();
                $districtObj = new DistrictModel();
                $wardObj = new WardModel();

                $this->model->load('Shipping');
                $shippingObj = new ShippingModel();

                $dataShippingArr = $shippingObj->getShippingCost($ward, $delivery);
                $shipping_cost = $dataShippingArr[0]['cost'];

                if ($this->data['cartTotal'] > 500000)
                    $shipping_cost = 0;

                $orderObj->id = time();
                $orderObj->address = $orderObj->address . ' - ' . $wardObj->getNameWardById($ward)[0]['name'] . ' - ' . $districtObj->getNameDistrictById($district)[0]['name'] . ' - ' . $provinceObj->getNameProvinceById($province)[0]['name'];
                $orderObj->datetime = date('Y-m-d H:i:s', date('U'));
                $orderObj->total = $this->data['cartTotal'] + $shipping_cost;
                $orderObj->status = 0;
                $orderObj->id_shipping = $shippingObj->getIdShipping($ward, $delivery)[0]['id'];
                $orderObj->id_user = $_SESSION['id'];

                //data insert
                $dataArr = array(
                    'id' => $orderObj->id,
                    'name' => $orderObj->name,
                    'mobile' => $orderObj->mobile,
                    'address' => $orderObj->address,
                    'datetime' => $orderObj->datetime,
                    'total' => $orderObj->total,
                    'payment_type' => $orderObj->payment_type,
                    'status' => $orderObj->status,
                    'id_shipping' => $orderObj->id_shipping,
                    'id_user' => $orderObj->id_user
                );

                if ($orderObj->payment_type == 1) { //thanh toán trực tiếp
                    $result = $orderObj->insert('fs_order', $dataArr);
                    if ($result) {
                        $this->model->load('OrderDetail');
                        $orderDetailObj = new OrderModel();
                        foreach ($this->data['cartContent'] as $item) {
                            $dataDetailArr = array(
                                'id_order' => $orderObj->id,
                                'code_product' => $item['code'],
                                'qty' => $item['qty'],
                                'price' => $item['price']
                            );
                            $resultDetail = $orderDetailObj->insert('fs_order_detail', $dataDetailArr);
                            if ($resultDetail) {
                                $_SESSION['success_msg'] = 'Đặt hàng thành công, thông tin đơn hàng đã gửi vào email!';
                                //cập nhật số lần bán của sản phẩm
                                $this->model->load('Product');
                                $productObj = new ProductModel();
                                foreach ($this->data['cartContent'] as $item) {
                                    $productObj->updateSold($item['code']);
                                }
                                //gửi mail
                                $this->model->load('Customer');
                                $userObj = new CustomerModel();
                                $dataUser = $userObj->getUserById($_SESSION['id']);
                                $this->library->load('Mail');
                                $mail = new MailLibrary();
                                $mail->init('it.quinhat', 'ydgamumoyslqapjk');
                                $content = 'Đơn hàng của bạn đã được lưu';
                                $check = $mail->sendMail('admin@FaceShop.Dev', $dataUser[0]['email'], 'Thông tin đơn hàng - FaceShop', $content);
                                if ($check)
                                    $this->data['success'] = 'Chúng tôi đã gửi thông tin đơn hàng cho bạn vào email ' . $dataUser[0]['email'];
                                //hủy giỏ hàng
                                $this->cartObj->destroy();
                                header('location:?c=home');
                            } else {
                                $this->data['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                                //xóa đơn hàng
                                $orderObj->remove('fs_order', "id = $orderObj->id");
                                $this->checkoutAction();
                            }
                        }
                    } else {
                        $this->data['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                        $this->checkoutAction();
                    }
                } else if ($orderObj->payment_type == 2) { //thanh toán qua Bảo Kim
//                  Thông tin để thanh toán bên Bảo Kim
                    $order_id = $orderObj->id;// Mã đơn Hàng
                    $url_thanhtoanthanhcong = "index.php?c=order&a=BCSuccess/" . $order_id;
                    $business = "quinhatpy@gmail.com";//EMAIL_BUYER;
                    $total_amount = $this->data['cartTotal'];//Giá trị đơn hàng
                    $url_success = $url_thanhtoanthanhcong;//URL_SUCCESS;
                    $url_cancel = 'index.php?c=order&a=BCFail';//URL_CANCEL;
                    $shipping_fee = $shipping_cost;
                    $tax_fee = 0;
                    $order_description = 'Thanh toán đơn hàng tại FaceShop';
                    $url_detail = '';

                    // Lưu thông tin đơn hàng
                    $result = $orderObj->insert('fs_order', $dataArr);
                    if ($result) {
                        $this->model->load('OrderDetail');
                        $orderDetailObj = new OrderModel();
                        foreach ($this->data['cartContent'] as $item) {
                            $dataDetailArr = array(
                                'id_order' => $orderObj->id,
                                'code_product' => $item['code'],
                                'qty' => $item['qty'],
                                'price' => $item['price']
                            );
                            $resultDetail = $orderDetailObj->insert('fs_order_detail', $dataDetailArr);
                            if ($resultDetail) {
                                $_SESSION['success_msg'] = 'Đặt hàng thành công, thông tin đơn hàng đã gửi vào email!';
                                //cập nhật số lần bán của sản phẩm
                                $this->model->load('Product');
                                $productObj = new ProductModel();
                                foreach ($this->data['cartContent'] as $item) {
                                    $productObj->updateSold($item['code']);
                                }
                                //gửi mail
                                $this->model->load('Customer');
                                $userObj = new CustomerModel();
                                $dataUser = $userObj->getUserById($_SESSION['id']);
                                $this->library->load('Mail');
                                $mail = new MailLibrary();
                                $mail->init('it.quinhat', 'ydgamumoyslqapjk');
                                $content = 'Đơn hàng của bạn đã được lưu';
                                $check = $mail->sendMail('admin@FaceShop.Dev', $dataUser[0]['email'], 'Thông tin đơn hàng - FaceShop', $content);
                                if ($check)
                                    $this->data['success'] = 'Chúng tôi đã gửi thông tin đơn hàng cho bạn vào email ' . $dataUser[0]['email'];
                                //hủy giỏ hàng
                                $this->cartObj->destroy();

                                $this->library->load('BaoKimPayment');
                                $bkim = new BaoKimPaymentLibrary();
                                $url = $bkim->createRequestUrl($order_id, $business, $total_amount, $shipping_fee, $tax_fee, $order_description, $url_success, $url_cancel, $url_detail);
                                header('location:' . $url);

                                //header('location:?c=home');
                            } else {
                                $this->data['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                                //xóa đơn hàng
                                $orderObj->remove('fs_order', "id = $orderObj->id");
                                $this->checkoutAction();
                            }
                        }
                    } else {
                        $this->data['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                        $this->checkoutAction();
                    }


                }
            }
        } else header('location:?c=cart&a=view');
    }

    public function BCSuccessAction($id)
    {
        $this->model->load('Order');
        $dataObj = new OrderModel();
        $dataObj->update('fs_order', ['status' => 5], "id = '$id'");
        $_SESSION['success_msg'] = 'Thanh toán đơn hàng thành công';
        header('location:?c=home');
    }

    public function checkRequest($name, $phone, $address)
    {
        if (empty($name)) {
            $this->data['name'] = 'Bạn chưa nhập họ tên người nhận';
            $this->setDataOld($name, $phone, $address);
        }
        if (empty($phone)) {
            $this->data['name'] = 'Bạn chưa nhập số điện thoại người nhận';
            $this->setDataOld($name, $phone, $address);
        }
        if (empty($address)) {
            $this->data['name'] = 'Bạn chưa nhập địa chỉ người nhận';
            $this->setDataOld($name, $phone, $address);
        }
    }

    public function setDataOld($name, $phone, $address)
    {
        $this->data['name_old'] = $name;
        $this->data['phone_old'] = $phone;
        $this->data['address_old'] = $address;
        $this->data['old'] = 1;
    }

    public function cancelAction() {
        if(isset($_GET['id'])) {
            $id = addslashes($_GET['id']);
            $this->model->load('Order');
            $orderObj = new OrderModel();
            $result = $orderObj->update('fs_order', ['status' => -1], "id = $id");
            if($result) {
                $_SESSION['success_msg'] = 'Hủy đơn hàng thành công!';
                header('location:'.$_SERVER['HTTP_REFERER']);
            }
            else {
                $_SESSION['error_msg'] = 'Hủy đơn hàng thất bại!';
                header('location:'.$_SERVER['HTTP_REFERER']);
            }
        }
    }
}