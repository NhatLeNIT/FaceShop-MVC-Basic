<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 28-May-17
 * Time: 17:48
 */
class HomeController extends BaseController
{
    public function indexAction() {
        $this->data['title'] = 'Bán hàng trực tuyến FaceShop';
        $this->model->load('Product');
        $dataObj = new ProductModel();
        $this->data['dataRandom'] = $dataObj->getListProductRandom(0,8);
        $this->data['dataNew'] = $dataObj->getListProductNew(8);
        $this->data['dataSold'] =
        $this->data['dataView'] = $dataObj->getListProductView(0,4);
        $this->data['dataFeature'] = $dataObj->getListProductRandom(0,4);
        $this->view->load('home', 'User/modules', $this->data);
    }
}