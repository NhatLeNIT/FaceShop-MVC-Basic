<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 30-May-17
 * Time: 21:42
 */
class CartController extends BaseController
{
    public function viewAction()
    {
        $this->data['content'] = $this->cartObj->content();
        $this->data['count'] = $this->cartObj->countItem();
        $this->data['total'] = $this->cartObj->total();
        $this->view->load('cart', 'User/modules', $this->data);
    }

    public function addAction()
    {
        if (isset($_GET['code'])) {
            $qty = isset($_POST['qty']) ? intval($_POST['qty']) : 1;
            $code = trim($_GET['code']);
            $this->model->load('Product');
            $dataObj = new ProductModel();
            $item = $dataObj->getProductByCode($code);
            $dataArr = ['code' => $code, 'name' => $item[0]['name'], 'image' => $item[0]['image'], 'qty' => $qty, 'price' => $item[0]['price']];
            $this->cartObj->addItem($dataArr);
            header('location:?c=cart&a=view');
        } else header('location:?c=home');
    }

    public function updateAction() {
        $count = $this->cartObj->countItem();
        $dataArr = array();
        for ($i = 0; $i < $count; $i++) {
            $dataArr[] = max(1, intval($_POST['qty'.$i]));
        }
        $this->cartObj->updateItem($dataArr);
        $_SESSION['success_msg'] = "Cập nhật thành công";
        header('location:?c=cart&a=view');
    }

    public function deleteAction() {
        if(isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $this->cartObj->deleteItem($id);
            echo 'success';
        } else echo 'fail';
    }
}