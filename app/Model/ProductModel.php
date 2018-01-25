<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 27-May-17
 * Time: 22:32
 */
class ProductModel extends N_Model
{
    public $code, $name, $alias, $image, $price, $status, $desc, $detail, $view, $sold, $id_cate;

    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function getListProduct() {
        $sql = "SELECT * FROM `fs_product`";
        $this->execute($sql);
        return $this->getResult();
    }

    public function getListProductLimit($page = 1, $limit = 10) {
        $pos = ($page - 1) * $limit;
        $sql = "SELECT * FROM `fs_product` LIMIT $pos,$limit";
        $this->execute($sql);
        return $this->getResult();
    }

    public function getListProductByCate($id) {
        $sql = "SELECT `code` FROM `fs_product` WHERE `id_cate` = $id";
        $this->execute($sql);
        return $this->getResult();
    }

    public function getListProductLimitByCate($id, $page = 1, $limit = 10) {
        $pos = ($page - 1) * $limit;
        $sql = "SELECT * FROM `fs_product` WHERE `id_cate` = $id LIMIT $pos,$limit";
        $this->execute($sql);
        return $this->getResult();
    }

    public function getProductByCode($code) {
        $sql = "SELECT * FROM `fs_product` WHERE `code` = '$code'";
        $this->execute($sql);
        return $this->getResult();
    }

    /**
     * Lấy danh sách sản phẩm random
     * @param $position
     * @param $limit
     * @return array
     */
    public function getListProductRandom($position, $limit) {
        $sql = "SELECT `code`, `name`, `image`, `price`, `alias` FROM `fs_product` ORDER BY RAND() LIMIT $position,$limit";
        $this->execute($sql);
        return $this->getResult();
    }

    /**
     * Lấy danh sách sản phẩm mới
     * @param $limit
     * @return array
     */
    public function getListProductNew($limit) {
        $sql = "SELECT `code`, `name`, `image`, `price`, `alias` FROM `fs_product` ORDER BY `created_at` DESC LIMIT 0,$limit";
        $this->execute($sql);
        return $this->getResult();
    }

    /**
     * Lấy danh sách sản phẩm theo số lượng bán giảm dần
     * @param $position
     * @param $limit
     * @return array
     */
    public function getListProductSold($position, $limit) {
        $sql = "SELECT `code`, `name`, `image`, `price`, `alias` FROM `fs_product` ORDER BY `sold` DESC LIMIT $position,$limit";
        $this->execute($sql);
        return $this->getResult();
    }

    /**
     * Lấy danh sách sản phẩm theo view giảm dần
     * @param $position
     * @param $limit
     * @return array
     */
    public function getListProductView($position, $limit) {
        $sql = "SELECT `code`, `name`, `image`, `price`, `alias` FROM `fs_product` ORDER BY `view` DESC LIMIT $position,$limit";
        $this->execute($sql);
        return $this->getResult();
    }

    /**
     * Lấy danh sách sản phẩm theo loại cha có điều kiện
     * @param $id
     * @param $where
     * @return array
     */
    public function getListProductByIdCateParent($id, $where) {
        $sql = "SELECT `code` FROM `fs_product` WHERE `id_cate` IN (SELECT `id` FROM `fs_category` WHERE `id_parent` = $id) $where ORDER BY `created_at` DESC";
        $this->execute($sql);
        return $this->getResult();
    }

    /**
     * Lấy danh sách sản phẩm theo loại cha phân trang có điều kiện
     * @param $id
     * @param $where
     * @param $sort_field
     * @param $sort_value
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getListProductByIdCateParentLimit($id, $where, $sort_field, $sort_value, $page = 1, $limit = 10) {
        $pos = ($page - 1) * $limit;
        $sql = "SELECT `code`, `name`, `price`, `image`, `alias`, `status` , `desc` FROM `fs_product` WHERE `id_cate` IN (SELECT `id` FROM `fs_category` WHERE `id_parent` = $id) $where  ORDER BY $sort_field $sort_value LIMIT $pos,$limit";
        $this->execute($sql);
        return $this->getResult();
    }

    /**
     * Lấy danh sách sản phẩm theo điều kiện
     * @param $id
     * @param $where
     * @return array
     */
    public function getListProductByIdCate($id, $where) {
        $sql = "SELECT `code` FROM `fs_product` WHERE `id_cate` = $id $where";
        $this->execute($sql);
        return $this->getResult();
    }

    /**
     * Lấy danh sách sản phẩm phân trang có điều kiện
     * @param $id
     * @param $where
     * @param $sort_field
     * @param $sort_value
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getListProductLimitByIdCate($id, $where, $sort_field, $sort_value, $page = 1, $limit = 10) {
        $pos = ($page - 1) * $limit;
        $sql = "SELECT `code`, `name`, `price`, `image`, `alias`, `status`, `desc` FROM `fs_product` WHERE `id_cate` = $id $where  ORDER BY $sort_field $sort_value LIMIT $pos,$limit";
        $this->execute($sql);
        return $this->getResult();
    }

    /**
     * Lấy danh sách sản phẩm search
     * @param $keyword
     * @param $where
     * @return array
     */
    public function getListProductBySearch($keyword, $where) {
        $sql = "SELECT `code` FROM `fs_product` WHERE `name` LIKE '%$keyword%' $where";
        $this->execute($sql);
        return $this->getResult();
    }

    /**
     * Lấy danh sách sản phẩm phân trang search
     * @param $keyword
     * @param $where
     * @param $sort_field
     * @param $sort_value
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getListProductLimitBySearch($keyword, $where, $sort_field, $sort_value, $page = 1, $limit = 10) {
        $pos = ($page - 1) * $limit;
        $sql = "SELECT `code`, `name`, `price`, `image`, `alias`, `status`, `desc` FROM `fs_product` WHERE `name` LIKE '%$keyword%' $where  ORDER BY $sort_field $sort_value LIMIT $pos,$limit";
        $this->execute($sql);
        return $this->getResult();
    }

    public function updateView($code) {
        $sql = "UPDATE `fs_product` SET `view` = `view` + 1 WHERE `code` = '$code'";
        $this->execute($sql);
    }

    public function updateSold($code) {
        $sql = "UPDATE `fs_product` SET `sold` = `sold` + 1 WHERE `code` = '$code'";
        $this->execute($sql);
    }

    public function countProduct() {
       $sql = "SELECT count(*) AS sl FROM `fs_product`";
        $this->execute($sql);
        $this->getResult();
    }
}