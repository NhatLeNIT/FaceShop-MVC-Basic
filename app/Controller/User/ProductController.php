<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 30-May-17
 * Time: 09:45
 */
class ProductController extends BaseController
{
    /**
     * Hiển thị danh sách sản phẩm theo loại
     */
    public function getListProductAction()
    {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 30;

            $price_from = (isset($_GET['price_from']) && $_GET['price_from'] != '') ? intval($_GET['price_from']) : 0;
            $price_to = (isset($_GET['price_to']) && $_GET['price_to'] != '') ? intval($_GET['price_to']) : 999999999;

            $sort_array_field = array(1 => "`created_at`", 2 => "`view`", 3 => "`sold`", 4 => "`price`", 5 => "`price`");
            $sort_array = array(1 => "DESC", 2 => "DESC", 3 => "DESC", 4 => "DESC", 5 => "ASC");

            $num_sort = isset($_GET['sort']) ? intval($_GET['sort']) : 1;

            $sort_field = $sort_array_field[$num_sort];
            $sort_value = $sort_array[$num_sort];


            $where = " AND `price` >= $price_from AND `price` <= $price_to";
            $this->model->load('Category');
            $this->model->load('Product');
            $cateObj = new CategoryModel();
            $productObj = new ProductModel();

            $dataTemp = $cateObj->getListCateByIdParent($id);
            if ($dataTemp != null) {//Loại sản phẩm có loại con
                $this->data['data'] = $productObj->getListProductByIdCateParentLimit($id, $where, $sort_field, $sort_value, $page, $limit);
                //Tổng số record
                $productObj->getListProductByIdCateParent($id, $where);
                $totalRecord = $productObj->getNumRows();

                //lấy tên loại
                $this->data['cateName'] = $cateObj->getNameCateById($id)[0]['name'];
                $this->data['cateNameParent'] = '';

                //Lấy các loại tương tự
                $this->data['cateList'] = $cateObj->getListCateByIdParent($id);
            } else { //Loại sản phẩm không có loại con
                $this->data['data'] = $productObj->getListProductLimitByIdCate($id, $where, $sort_field, $sort_value, $page, $limit);
                //Tổng số record
                $productObj->getListProductByIdCate($id, $where);
                $totalRecord = $productObj->getNumRows();

                //lấy tên loại
                $dataTemp = $cateObj->getNameCateById($id);
                $this->data['cateName'] = $dataTemp[0]['name'];
                $this->data['cateNameParent'] = $cateObj->getNameCateById($dataTemp[0]['id_parent']);

                //Lấy các loại tương tự
                $this->data['cateList'] = $cateObj->getListCateByIdParent($this->data['cateNameParent'][0]['id']);
            }
            //setup config pagination
            $config = array(
                'currentPage' => $page,
                'totalRecord' => $totalRecord,
                'limit' => $limit,
                'group' => 10
            );

            //custom link
            if (isset($_GET['price_from']) || isset($_GET['price_to'])) {
                if ($num_sort != 1) {
                    $config['linkFull'] = "?c=product&a=getListProduct&id=$id&price_from=$price_from&price_to=$price_to&sort=$num_sort&page={page}";
                    $config['linkFirst'] = "?c=product&a=getListProduct&id=$id&price_from=$price_from&price_to=$price_to&sort=$num_sort";
                } else {
                    $config['linkFull'] = "?c=product&a=getListProduct&id=$id&price_from=$price_from&price_to=$price_to&page={page}";
                    $config['linkFirst'] = "?c=product&a=getListProduct&id=$id&price_from=$price_from&price_to=$price_to";
                }
            } else {
                if ($num_sort != 1) {
                    $config['linkFull'] = "?c=product&a=getListProduct&id=$id&sort=$num_sort&page={page}";
                    $config['linkFirst'] = "?c=product&a=getListProduct&id=$id&sort=$num_sort";
                } else {
                    $config['linkFull'] = "?c=product&a=getListProduct&id=$id&page={page}";
                    $config['linkFirst'] = "?c=product&a=getListProduct&id=$id";
                }
            }
            //position and totalRow
            $this->data['position'] = ($page - 1) * $limit;
            $this->data['totalRow'] = $totalRecord;
            $this->data['lastItem'] = $this->data['position'] + $limit;
            if ($this->data['lastItem'] > $this->data['totalRow'])
                $this->data['lastItem'] = $this->data['totalRow'];

            //Load library Pagination
            $this->library->load('Pagination');
            $paginationObj = new PaginationLibrary();
            $paginationObj->init($config);
            $this->data['paginate'] = $paginationObj->html();

            $this->helper->load('String');

            $this->data['title'] = "Sản phẩm " . $this->data['cateName'];
            //load view
            $this->view->load('list-product', 'User/modules', $this->data);
        } else header('location:?c=home');
    }

    /**
     * Hiển thị chi tiết sản phẩm
     */
    public function detailAction()
    {
        if(isset($_GET['code'])) {
            $code = trim(addslashes($_GET['code']));
            $this->model->load('Product');
            $dataObj = new ProductModel();
            //update số lần xem
            $dataObj->updateView($code);
            //get data
            $this->data['data'] = $dataObj->getProductByCode($code);

            //get product random
            $this->data['dataRandom'] = $dataObj->getListProductRandom(0, 10);

            //get cate name
            $this->model->load('Category');
            $cateObj = new CategoryModel();
            $this->data['cate'] = $cateObj->getCateById($this->data['data'][0]['id_cate']);
            $this->data['title'] = $this->data['data'][0]['name'];
            //load view
            $this->view->load('product-detail', 'User/modules', $this->data);
        } else header('location:?c=home');
    }

    /**
     * Hiển thị kết quả tìm kiếm
     */
    public function searchAction()
    {
        if (isset($_GET['keyword'])) {
            $keyword = addslashes($_GET['keyword']);
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 30;

            $price_from = (isset($_GET['price_from']) && $_GET['price_from'] != '') ? intval($_GET['price_from']) : 0;
            $price_to = (isset($_GET['price_to']) && $_GET['price_to'] != '') ? intval($_GET['price_to']) : 999999999;

            $sort_array_field = array(1 => "`created_at`", 2 => "`view`", 3 => "`sold`", 4 => "`price`", 5 => "`price`");
            $sort_array = array(1 => "DESC", 2 => "DESC", 3 => "DESC", 4 => "DESC", 5 => "ASC");

            $num_sort = isset($_GET['sort']) ? intval($_GET['sort']) : 1;

            $sort_field = $sort_array_field[$num_sort];
            $sort_value = $sort_array[$num_sort];


            $where = " AND `price` >= $price_from AND `price` <= $price_to";
            $this->model->load('Category');
            $this->model->load('Product');
            $productObj = new ProductModel();

            $this->data['data'] = $productObj->getListProductLimitBySearch($keyword, $where, $sort_field, $sort_value, $page, $limit);
            //Tổng số record
            $productObj->getListProductBySearch($keyword, $where);
            $totalRecord = $productObj->getNumRows();

            //setup config pagination
            $config = array(
                'currentPage' => $page,
                'totalRecord' => $totalRecord,
                'limit' => $limit,
                'group' => 10
            );

            //custom link
            if (isset($_GET['price_from']) || isset($_GET['price_to'])) {
                if ($num_sort != 1) {
                    $config['linkFull'] = "?c=product&a=getListProduct&keyword=$keyword&price_from=$price_from&price_to=$price_to&sort=$num_sort&page={page}";
                    $config['linkFirst'] = "?c=product&a=getListProduct&keyword=$keyword&price_from=$price_from&price_to=$price_to&sort=$num_sort";
                } else {
                    $config['linkFull'] = "?c=product&a=getListProduct&keyword=$keyword&price_from=$price_from&price_to=$price_to&page={page}";
                    $config['linkFirst'] = "?c=product&a=getListProduct&keyword=$keyword&price_from=$price_from&price_to=$price_to";
                }
            } else {
                if ($num_sort != 1) {
                    $config['linkFull'] = "?c=product&a=getListProduct&keyword=$keyword&sort=$num_sort&page={page}";
                    $config['linkFirst'] = "?c=product&a=getListProduct&keyword=$keyword&sort=$num_sort";
                } else {
                    $config['linkFull'] = "?c=product&a=getListProduct&keyword=$keyword&page={page}";
                    $config['linkFirst'] = "?c=product&a=getListProduct&keyword=$keyword";
                }
            }
            //position and totalRow
            $this->data['position'] = ($page - 1) * $limit;
            $this->data['totalRow'] = $totalRecord;
            $this->data['lastItem'] = $this->data['position'] + $limit;
            if ($this->data['lastItem'] > $this->data['totalRow'])
                $this->data['lastItem'] = $this->data['totalRow'];

            //Load library Pagination
            $this->library->load('Pagination');
            $paginationObj = new PaginationLibrary();
            $paginationObj->init($config);
            $this->data['paginate'] = $paginationObj->html();

            $this->helper->load('String');
            $this->data['keyword'] = $keyword;
            $this->data['title'] = "Tìm kiếm với từ khóa " . $keyword;
            //load view
            $this->view->load('search', 'User/modules', $this->data);
        } else header('location:?c=home');
    }
}