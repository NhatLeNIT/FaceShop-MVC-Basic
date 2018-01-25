<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 25-May-17
 * Time: 13:44
 */
class PaginationLibrary
{
    /**
     * Mảng chứa tham số cấu hình phân trang
     * @var array
     */
    protected $config = array(
        'currentPage' => 1,
        'totalRecord' => 1,
        'totalPage' => 1,
        'limit' => 10,
        'position' => 0,
        'group' => 10,
        'first' => 1,
        'last' => 1,
        'prevGroup' => 1,
        'nextGroup' => 1,
        'linkFull' => '',
        'linkFirst' => ''
    );

    /**
     * Hàm khởi tạo để sử dụng phân trang
     * @param array $config
     */
    function init($config = array())
    {
        /*
         * Lặp qua từng phần tử config truyền vào và gán vào config của đối tượng
         * trước khi gán vào thì phải kiểm tra thông số config truyền vào có nằm
         * trong hệ thống config không, nếu có thì mới gán
         */
        foreach ($config as $key => $val) {
            if (isset($this->config[$key])) {
                $this->config[$key] = $val;
            }
        }

        /*
         * Kiểm tra thông số limit truyền vào có nhỏ hơn 0 hay không?
         * Nếu nhỏ hơn thì gán cho limit = 0
         */
        if ($this->config['limit'] < 0) {
            $this->config['limit'] = 0;
        }

        /*
         * Tính total page, công tức tính tổng số trang như sau:
         * total_page = ciel(total_record/limit).
         */
        $this->config['totalPage'] = ceil($this->config['totalRecord'] / $this->config['limit']);

        /*
         * Sau khi có tổng số trang ta kiểm tra xem nó có nhỏ hơn 0 hay không
         * nếu nhỏ hơn 0 thì gán nó băng 1 ngay. Vì mặc định tổng số trang luôn bằng 1
         */
        if (!$this->config['totalPage']) {
            $this->config['totalPage'] = 1;
        }

        /*
        * Trang hiện tại sẽ rơi vào một trong các trường hợp sau:
        *  - Nếu người dùng truyền vào số trang nhỏ hơn 1 thì ta sẽ gán nó = 1
        *  - Nếu trang hiện tại người dùng truyền vào lớn hơn tổng số trang
        *    thì ta gán nó bằng tổng số trang
        */
        if ($this->config['currentPage'] < 1) {
            $this->config['currentPage'] = 1;
        }

        if ($this->config['currentPage'] > $this->config['totalPage']) {
            $this->config['currentPage'] = $this->config['totalPage'];
        }

        /*
         * Tính position
         * áp dụng công tức position = (current_page - 1)*limit
        */
        $this->config['position'] = ($this->config['currentPage'] - 1) * $this->config['limit'];

        /*
         * Tinh prevGroup, nextGroup
         */
        $this->config['prevGroup']= floor(($this->config['currentPage']-1)/$this->config['group']) * $this->config['group'] +1 -$this->config['group'];
        $this->config['nextGroup']= floor(($this->config['currentPage']-1)/$this->config['group']) * $this->config['group'] +1 + $this->config['group'];
        /*
         * Tính first, last
         */
        $this->config['first'] = floor((($this->config['currentPage'] - 1) / $this->config['group'])) * $this->config['group'] + 1;
        $this->config['last'] = $this->config['first'] + $this->config['group'] - 1;

        if ($this->config['last'] > $this->config['totalPage'])
            $this->config['last'] = $this->config['totalPage'];
    }


    /**
     * Hàm lấy link theo trang
     * @param $page
     * @return mixed
     */
    public function getLink($page)
    {
        // Nếu trang < 1 thì ta sẽ lấy link first
        if ($page <= 1 && $this->config['linkFirst']) {
            return $this->config['linkFirst'];
        }
        // Ngược lại ta lấy link_full
        // Link full có dạng domain.com/?c=ctrlName&a=actName&p={page}.
        // Trong đó {page} là nơi bạn muốn số trang sẽ thay thế vào
        return str_replace('{page}', $page, $this->config['linkFull']);
    }

    public function html()
    {
        $result = '';

        // Kiểm tra tổng số trang lớn hơn 1 mới phân trang
        if ($this->config['totalRecord'] > $this->config['limit']) {
            $result = '<ul class="pagination">';

            // Nút prev và first
            if ($this->config['currentPage'] > 1) {
                $result .= '<li><a href="' . $this->getLink(1) . '" title="trang đầu">First</a></li>';
                if($this->config['currentPage'] > $this->config['group'])
                    $result .= '<li><a href="' . $this->getLink($this->config['prevGroup']) . '" rel="prevGroup" title="nhóm trước"><span class="fa fa-chevron-left"></span></a></li>';
                $result .= '<li><a href="' . $this->getLink($this->config['currentPage'] - 1) . '" rel="prev" title="trang trước"><span>«</span></a></li>';
            }

            //chèn dấu ... vào phía trước
            if($this->config['currentPage'] > $this->config['group'])
                $result .= '<li class="disabled"><span class="fa fa-ellipsis-h"></span></li>';

            // lặp trong khoảng cách giữa min và max để hiển thị các nút
            for ($i = $this->config['first']; $i <= $this->config['last']; $i++) {
                // Trang hiện tại
                if ($this->config['currentPage'] == $i) {
                    $result .= '<li class="active"><span>' . $i . '</span></li>';
                } else {
                    $result .= '<li><a href="' . $this->getLink($i) . '">' . $i . '</a></li>';
                }
            }
            //chèn dấu ... vào phía sau
            if($this->config['nextGroup'] <= $this->config['totalPage'])
                $result .= '<li class="disabled"><span class="fa fa-ellipsis-h"></span></li>';

            // Nút last và next
            if ($this->config['currentPage'] < $this->config['totalPage']) {
                $result .= '<li><a href="' . $this->getLink($this->config['currentPage'] + 1) . '" rel="next"><span>»</span></a></li>';
                if($this->config['nextGroup'] <= $this->config['totalPage'])
                    $result .= '<li><a href="' . $this->getLink($this->config['nextGroup']) . '" rel="nextGroup"><span class="fa fa-chevron-right"></span></a></li>';
                $result .= '<li><a href="' . $this->getLink($this->config['totalPage']) . '">Last</a></li>';
            }

            $result .= '</ul>';
        }

        return $result;
    }
}