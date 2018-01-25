<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 24-May-17
 * Time: 16:18
 */
class N_Controller
{
    protected $view = null;
    protected $model = null;
    protected $library = null;
    protected $helper = null;
    protected $config = null;

    /**
     * N_Controller constructor.
     * Load cac thu vien can thiet
     */
    public function __construct()
    {

        // Loader cho config
        require_once 'loader/N_Config_Loader.php';
        $this->config   = new N_Config_Loader();
        $this->config->load('config');
        // Loader Library
        require_once 'loader/N_Library_Loader.php'; //đường dẫn tính từ file N_Controller.php
        $this->library = new N_Library_Loader();

        // Load Helper
        require_once 'loader/N_Helper_Loader.php';
        $this->helper = new N_Helper_Loader();

        // Load View
        require_once 'loader/N_View_Loader.php';
        $this->view = new N_View_Loader();

        // Load Model
        require_once 'loader/N_Model_Loader.php';
        $this->model = new N_Model_Loader();

//        // Load Request
//        require_once 'loader/N_Request_Loader.php';
//        $this->model = new N_Request_Loader();
    }

    public function __destruct()
    {
        $this->view->show();
    }
}