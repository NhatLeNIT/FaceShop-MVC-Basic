<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 27-May-17
 * Time: 15:24
 */
class CategoryModel extends N_Model
{
    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    /**
     * Lấy danh sách loại
     * @return array
     */
    public function getListCate() {
        $sql = "SELECT * FROM `fs_category`";
        $this->execute($sql);
        return $this->getResult();
    }


    /**
     * Lấy danh sách loại phân trang
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getListCateLimit($page = 1, $limit = 10) {
        $pos = ($page - 1) * $limit;
        $sql = "SELECT * FROM `fs_category` ORDER BY `id` DESC LIMIT $pos,$limit";
        $this->execute($sql);
        return $this->getResult();
    }

    /**
     * Lấy danh sách loại theo id cha
     * @param $id
     * @return array
     */
    public function getListCateById($id) {
        $sql = "SELECT * FROM `fs_category` WHERE `id_parent` = $id";
        $this->execute($sql);
        return $this->getResult();
    }

    /**
     * Lấy danh sách loại theo id cha phân trang
     * @param $id
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function getListCateLimitById($id, $page = 1, $limit = 10) {
        $pos = ($page - 1) * $limit;
        $sql = "SELECT * FROM `fs_category` WHERE `id_parent` = $id ORDER BY `id` DESC LIMIT $pos,$limit";
        $this->execute($sql);
        return $this->getResult();
    }

    /**
     * Lấy danh sách các loại cha
     * @return array
     */
    public function getListCateParent() {
        $sql = "SELECT * FROM `fs_category` WHERE `id_parent` = 0";
        $this->execute($sql);
        return $this->getResult();
    }

    /**
     * Lấy loại sản phẩm theo tên
     * @param $name
     */
    public function getCateByName($name) {
        $sql = "SELECT * FROM `fs_category` WHERE `name` = '$name'";
        $this->execute($sql);
    }

    /**
     * Lấy loại sản phẩm theo id
     * @param $id
     * @return array
     */
    public function getCateById($id) {
        $sql = "SELECT * FROM `fs_category` WHERE `id` = '$id'";
        $this->execute($sql);
        return $this->getResult();
    }

    /**
     * Lấy danh sách loại theo id cha
     * @param $idParent
     * @return array
     */
    public function getListCateByIdParent($idParent) {
        $sql = "SELECT * FROM `fs_category` WHERE `id_parent` = $idParent";
        $this->execute($sql);
        return $this->getResult();
    }

    /**
     * //Lấy danh sách các id loại thuộc id cha nào đó
     * @param $idParent
     * @return array
     */
    public function getListIdCateByIdParent($idParent) {
        $sql = "SELECT `id` FROM `fs_category` WHERE `id_parent` = $idParent";
        $this->execute($sql);
        return $this->getResult();
    }

    /**
     * Lấy tên loại theo id
     * @param $id
     * @return array
     */
    public function getNameCateById($id) {
        $sql = "SELECT `id`, `name`, `id_parent` FROM `fs_category` WHERE `id` = $id";
        $this->execute($sql);
        return $this->getResult();
    }

    public function getNameCateByIdParent($id) {
        $sql = "SELECT `id`, `name` FROM `fs_category` WHERE `id_parent` = $id";
        $this->execute($sql);
        return $this->getResult();
    }
}