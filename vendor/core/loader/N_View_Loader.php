<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 25-May-17
 * Time: 14:54
 */
class N_View_Loader
{
    /**
     * @desc biến lưu trữ các view đã load
     * @var array
     */
    private $content = array();

    /**
     * Load view
     *
     * @param   string
     * @param   array  thư mục chứa view
     * @param   string
     * @desc    hàm load view, tham số truyền vào là tên của view và dữ liệu truyền qua view
     */
    public function load($view, $path, $data = array())
    {
        // Chuyển mảng dữ liệu thành từng biến
        extract($data);

        // Chuyển nội dung view thành biến thay vì in ra bằng cách dùng ob_start()
        ob_start();
        $pathBase = explode('/', $path);
        $pathBase = $pathBase[0];
        require_once 'resources/view/' . $pathBase . '/master.layout.php';
        $content = ob_get_contents();
        ob_end_clean();

        // Gán nội dung vào danh sách view đã load
        $this->content[] = $content;
    }

    /**
     * Load view
     *
     * @param   string
     * @param   array  thư mục chứa view
     * @param   string
     * @desc    hàm load view, tham số truyền vào là tên của view và dữ liệu truyền qua view
     */
    public function loadNoMaster($view, $path, $data = array())
    {
        // Chuyển mảng dữ liệu thành từng biến
        extract($data);

        // Chuyển nội dung view thành biến thay vì in ra bằng cách dùng ob_start()
        ob_start();
        require_once 'resources/view/' . $path . '/' . $view . '.php';
        $content = ob_get_contents();
        ob_end_clean();

        // Gán nội dung vào danh sách view đã load
        $this->content[] = $content;
    }

    /**
     * Show view
     *
     * @desc    Hàm hiển thị toàn bộ view đã load, được dùng ở controller
     */
    public function show()
    {
        foreach ($this->content as $html) {
            echo $html;
        }
    }
}