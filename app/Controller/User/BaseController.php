<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 28-May-17
 * Time: 19:08
 */
class BaseController extends N_Controller
{
    protected $data = array();
    protected $cartObj = array();
    public function __construct()
    {
        parent::__construct();
        $this->model->load('Category');
        $cateObj = new CategoryModel();
        $this->data['dataCate'] = $cateObj->getListCateParent();
        $this->library->load('ShoppingCart');
        $this->cartObj = new ShoppingCartLibrary();
        $this->data['cartCount'] = $this->cartObj->countItem();
        $this->data['cartTotal'] = $this->cartObj->total();
        $this->data['cartContent'] = $this->cartObj->content();
    }
}