<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 26-May-17
 * Time: 22:55
 */
class N_Config_Loader
{
    /**
     * @var array
     */
    protected $config = array();

    /**
     * Load helper
     *
     * @desc    hàm load config, tham số truyền vào là tên của config
     * @param $config
     * @return bool
     */
    public function load($config)
    {
        if (file_exists('app/Controller/Admin/config/' . $config . '.php')){
            $config = include_once 'app/Controller/Admin/config/' . $config . '.php';
            if ( !empty($config) ){
                foreach ($config as $key => $item){
                    $this->config[$key] = $item;
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Get item config
     *
     *  @desc    hàm get config item, tham số truyền vào là tên của item và tham số mặc định
     * @param $key
     * @param string $default_val
     * @return mixed|string
     */
    public function item($key, $default_val = '')
    {
        return isset($this->config[$key]) ? $this->config[$key] : $default_val;
    }

    /**
     * Set item config
     *
     * @param   string
     * @param   string
     * @desc    hàm set config item, tham số truyền vào là tên của item và giá trị của nó
     */
    public function set_item($key, $val){
        $this->config[$key] = $val;
    }

}