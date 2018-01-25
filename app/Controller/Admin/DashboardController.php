<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 26-May-17
 * Time: 14:38
 */
class DashboardController extends N_Controller
{
    private $data = array();

    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['id_admin']))
            header('location:?c=login');
    }

    public function indexAction()
    {

        $this->data['title'] = 'Dashboard';
        $this->view->load('dashboard', 'Admin/modules/dashboard', $this->data);
    }
}