<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 27-May-17
 * Time: 22:35
 */
class ProductController extends N_Controller
{
    private $data = array();

    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['id_admin']))
            header('location:?c=login');
    }

    /**
     * Action index : browse list product
     */
    public function indexAction()
    {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5;
        $cate = isset($_GET['cate']) ? intval($_GET['cate']) : '';
        $this->model->load("Product");
        $dataObj = new ProductModel();
        $this->helper->load('String');
        $this->data['title'] = 'Danh sách sản phẩm';

        if ($cate == '') {
            $this->data['data'] = $dataObj->getListProductLimit($page, $limit);
            //Tổng số record
            $dataObj->getListProduct();
            $totalRecord = $dataObj->getNumRows();
        } else {
            $this->data['data'] = $dataObj->getListProductLimitByCate($cate, $page, $limit);
            //Tổng số record
            $dataObj->getListProductByCate($cate);
            $totalRecord = $dataObj->getNumRows();
        }
        $this->model->load("Category");
        $dataCateObj = new CategoryModel();
        $this->data['cateList'] = $dataCateObj->getListCateParent();

        //setup config pagination
        $config = array(
            'currentPage' => $page,
            'totalRecord' => $totalRecord,
            'limit' => $limit,
            'group' => 10,
        );

        if($cate != '') {
            $config['linkFull'] = "?c=product&cate=$cate&page={page}";
            $config['linkFirst'] = "?c=product&cate=$cate";
        }
        else {
            $config['linkFull'] = '?c=product&page={page}';
            $config['linkFirst'] = '?c=product';
        }
        //position
        $this->data['position'] = ($page - 1) * $limit;

        //Load library Pagination
        $this->library->load('Pagination');
        $paginationObj = new PaginationLibrary();
        $paginationObj->init($config);
        $this->data['paginate'] = $paginationObj->html();

        //load view
        $this->view->load('product-list', 'Admin/modules/product', $this->data);
    }

    /**
     * View add
     */
    public function addAction()
    {
        $this->data['title'] = 'Thêm sản phẩm mới';

        $this->model->load("Category");
        $dataObj = new CategoryModel();
        $this->data['cateList'] = $dataObj->getListCateParent();
        //Load view
        $this->view->load('product-add', 'Admin/modules/product', $this->data);
    }

    /**
     * Xử lý thêm
     */
    public function addProcessAction()
    {
        if (isset($_POST['txtName'])) {
            $this->model->load('Product');
            $dataObj = new ProductModel();
            $this->helper->load("String");

            $dataObj->name = ucwords(mb_strtolower($_POST['txtName']));
            $dataObj->alias = changeTitle($dataObj->name);
            $dataObj->code = mb_strtoupper($_POST['txtCode']);
            $dataObj->price = $_POST['txtPrice'];
            $dataObj->desc = $_POST['txtDescription'];
            $dataObj->detail = $_POST['txtContent'];
            if (isset($_POST['txtStatus']))
                $dataObj->status = $_POST['txtStatus'];
            else $dataObj->status = 0;

            $dataObj->id_cate = $_POST['txtCategory'];

            $file = $_FILES['txtImage'];
            $filename = time() . "-" . $file['name'];
            $dataObj->image = $filename;

            $this->checkAddRequest($dataObj->name, $dataObj->code, $dataObj->price, $dataObj->desc, $dataObj->detail, $dataObj->status, $dataObj->id_cate, $file);
            if (!empty($this->data))
                $this->addAction();
            else {
                $dataArr = array(
                    'code' => $dataObj->code,
                    'name' => $dataObj->name,
                    'alias' => $dataObj->alias,
                    'image' => $dataObj->image,
                    'price' => $dataObj->price,
                    'status' => $dataObj->status,
                    'desc' => $dataObj->desc,
                    'detail' => $dataObj->detail,
                    'id_cate' => $dataObj->id_cate,
                );
                $result = $dataObj->insert('fs_product', $dataArr);
                if ($result) {
                    $this->library->load('Upload');
                    $imgUploader = new UploadLibrary();
                    $imgUploader->setFileName($dataObj->image);
                    $imgUploader->setDestination('public/images/uploads/products/');
                    $imgUploader->upload($file);

                    if (empty($imgUploader->error)) {
                        $_SESSION['success_msg'] = 'Thêm sản phẩm mới thành công!';
                        header('location:?c=product');
                    } else {
                        $where = "`code` = '" . $dataObj->code . "'";
                        $dataObj->remove('fs_product', $where);

                        $this->data['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                        $this->setDataOld($dataObj->name, $dataObj->code, $dataObj->price, $dataObj->desc, $dataObj->detail, $dataObj->status, $dataObj->id_cate);
                        $this->addAction();
                    }
                } else {
                    $this->data['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                    $this->setDataOld($dataObj->name, $dataObj->code, $dataObj->price, $dataObj->desc, $dataObj->detail, $dataObj->status, $dataObj->id_cate);
                    $this->addAction();
                }
            }
        } else header('location:?c=product&a=add');
    }

    /**
     * View edit
     */
    public function editAction()
    {
        if (isset($_GET['code']) || !empty($this->data)) {
            if (isset($_GET['code']))
                $code = trim($_GET['code']);
            else
                $code = $this->data['code_old'];
            $this->model->load("Product");
            $dataObj = new ProductModel();
            $this->data['title'] = 'Sửa thông tin sản phẩm';
            $this->data['data'] = $dataObj->getProductByCode($code);

            $this->model->load("Category");
            $dataCateObj = new CategoryModel();
            $this->data['cateList'] = $dataCateObj->getListCateParent();

            //Load view
            $this->view->load('product-edit', 'Admin/modules/product', $this->data);
        } else header('location:?c=product');
    }

    /**
     * Xử lý sửa
     */
    public function editProcessAction()
    {
        if (isset($_POST['code'])) {
            $this->model->load('Product');
            $dataObj = new ProductModel();
            $this->helper->load("String");

            $dataObj->code = mb_strtoupper($_POST['code']);
            $dataObj->name = ucwords(mb_strtolower($_POST['txtName']));
            $dataObj->alias = changeTitle($dataObj->name);
            $dataObj->price = $_POST['txtPrice'];
            $dataObj->desc = $_POST['txtDescription'];
            $dataObj->detail = $_POST['txtContent'];
            if (isset($_POST['txtStatus']))
                $dataObj->status = $_POST['txtStatus'];
            else $dataObj->status = 0;

            $dataObj->id_cate = $_POST['txtCategory'];

            $file = $_FILES['txtImage'];

            if (strlen($file['name']) > 0)
                $this->checkEditRequest($dataObj->name, $dataObj->code, $dataObj->price, $dataObj->desc, $dataObj->detail, $dataObj->status, $dataObj->id_cate, $file);
            else $this->checkEditRequest($dataObj->name, $dataObj->code, $dataObj->price, $dataObj->desc, $dataObj->detail, $dataObj->status, $dataObj->id_cate);
            if (!empty($this->data)) {
                $this->data['code_old'] = $dataObj->code;
                $this->editAction();
            } else {
                $dataArr = array(
                    'name' => $dataObj->name,
                    'alias' => $dataObj->alias,
                    'price' => $dataObj->price,
                    'status' => $dataObj->status,
                    'desc' => $dataObj->desc,
                    'detail' => $dataObj->detail,
                    'id_cate' => $dataObj->id_cate,
                );
                if (strlen($file['name']) > 0) {
                    $filename = time() . "-" . $file['name'];
                    $dataObj->image = $filename;
                    $dataArr['image'] = $dataObj->image;
                }

                $where = "`code` = '" . $dataObj->code . "'";

                //neu co hinh moi thi xoa hình cũ rồi up hình mới lên
                if (strlen($file['name']) > 0) {
                    //thuc hien xoa hinh cu va up hinh moi
                    $imageCurrent = $_POST['txtImageCurrent'];
                    $fileDelete = 'public/images/uploads/products/' . $imageCurrent;

                    $this->library->load('Upload');
                    $imgUploader = new UploadLibrary();
                    $imgUploader->delete($fileDelete);

                    if (!empty($imgUploader->error)) {
                        $this->data['error_msg'] = $imgUploader->error;
                        $this->data['code_old'] = $dataObj->code;
                        $this->setDataOld($dataObj->name, $dataObj->code, $dataObj->price, $dataObj->desc, $dataObj->detail, $dataObj->status, $dataObj->id_cate);
                        $this->editAction();
                        return;
                    } else {
                        //tien hanh up hinh moi
                        $imgUploader->setFileName($dataObj->image);
                        $imgUploader->setDestination('public/images/uploads/products/');
                        $imgUploader->upload($file);
                        if (!empty($imgUploader->error)) {
                            $this->data['error_msg'] = $imgUploader->error;
                            $this->data['code_old'] = $dataObj->code;
                            $this->setDataOld($dataObj->name, $dataObj->code, $dataObj->price, $dataObj->desc, $dataObj->detail, $dataObj->status, $dataObj->id_cate);
                            $this->editAction();
                            return;
                        } else {
                            //tien hanh cap nhat trong database
                            $result = $dataObj->update('fs_product', $dataArr, $where);
                        }
                    }
                } else {
                    $result = $dataObj->update('fs_product', $dataArr, $where);
                }
                if ($result) {
                    $_SESSION['success_msg'] = 'Cập nhật  sản phẩm thành công!';
                    header('location:?c=product');
                } else {
                    $this->data['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                    $this->setDataOld($dataObj->name, $dataObj->code, $dataObj->price, $dataObj->desc, $dataObj->detail, $dataObj->status, $dataObj->id_cate);
                    $this->editAction();
                }
            }
        } else header('location:?c=product');
    }

    /**
     * Xử lý xóa
     */
    public function delAction()
    {
        if (isset($_GET['code'])) {
            $code = trim($_GET['code']);
            $this->model->load('Product');
            $dataObj = new ProductModel();
            $dataTemp = $dataObj->getProductByCode($code);
            if ($dataObj->getNumRows()) { // co thi moi xoa
                $fileDelete = 'public/images/uploads/products/' . $dataTemp[0]['image'];

                $this->library->load('Upload');
                $imgUploader = new UploadLibrary();
                $imgUploader->delete($fileDelete);

                $where = "`code` = '" . $code . "'";
                $result = $dataObj->remove('fs_product', $where);

                if ($result) {
                    $_SESSION['success_msg'] = 'Xóa sản phẩm thành công!';
                    header('location:' . $_SERVER['HTTP_REFERER']);
                } else {
                    $_SESSION['error_msg'] = 'Có lỗi xảy ra, vui lòng kiểm tra lại!';
                    header('location:' . $_SERVER['HTTP_REFERER']);
                }
            } else {
                $_SESSION['error_msg'] = 'Không tìm thấy sản phẩm cần xóa, vui lòng kiểm tra lại!';
                header('location:' . $_SERVER['HTTP_REFERER']);
            }


        } else header('location:?c=category');
    }

    /**
     * Kiểm tra add request có hợp lệ không
     * @param $name
     * @param $code
     * @param $price
     * @param $description
     * @param $content
     * @param $status
     * @param $category
     * @param $image
     */
    private function checkAddRequest($name, $code, $price, $description, $content, $status, $category, $image)
    {
        if (empty($name)) {
            $this->data['name'] = 'Tên không được để trống';
            $this->setDataOld($name, $code, $price, $description, $content, $status, $category);
        }
        if (empty($code)) {
            $this->data['code'] = 'Mã sản phẩm không được để trống';
            $this->setDataOld($name, $code, $price, $description, $content, $status, $category);
        } else {
            $this->model->load('Product');
            $dataTemp = new ProductModel();
            $dataTemp->getProductByCode($code);
            if ($dataTemp->getNumRows()) {
                $this->data['code'] = 'Mã sản phẩm này đã tồn tại';
                $this->setDataOld($name, $code, $price, $description, $content, $status, $category);
            }
        }
        if (empty($price)) {
            $this->data['price'] = 'Giá không được để trống';
            $this->setDataOld($name, $code, $price, $description, $content, $status, $category);
        } else if (!is_numeric($price)) {
            $this->data['price'] = 'Giá phải là số';
            $this->setDataOld($name, $code, $price, $description, $content, $status, $category);
        }

        if (empty($content)) {
            $this->data['content'] = 'Thông tin sản phẩm không được để trống';
            $this->setDataOld($name, $code, $price, $description, $content, $status, $category);
        }
        if (empty($category)) {
            $this->data['category'] = 'Loại sản phẩm không được để trống';
            $this->setDataOld($name, $code, $price, $description, $content, $status, $category);
        }

        $this->library->load('Upload');
        $imgUploader = new UploadLibrary();
        $imgUploader->validate($image);
        if (!empty($imgUploader->error)) {
            $this->data['image'] = $imgUploader->error;
            $this->setDataOld($name, $code, $price, $description, $content, $status, $category);
        }
    }

    /**
     * Kiểm tra edit request có hợp lệ không
     * @param $codeCurrent
     * @param $name
     * @param $code
     * @param $price
     * @param $description
     * @param $content
     * @param $status
     * @param $category
     * @param $image
     */
    private function checkEditRequest($name, $code, $price, $description, $content, $status, $category, $image = null)
    {
        if (empty($name)) {
            $this->data['name'] = 'Tên không được để trống';
            $this->setDataOld($name, $code, $price, $description, $content, $status, $category);
        }
        if (empty($price)) {
            $this->data['price'] = 'Giá không được để trống';
            $this->setDataOld($name, $code, $price, $description, $content, $status, $category);
        } else if (!is_numeric($price)) {
            $this->data['price'] = 'Giá phải là số';
            $this->setDataOld($name, $code, $price, $description, $content, $status, $category);
        }

        if (empty($content)) {
            $this->data['content'] = 'Thông tin sản phẩm không được để trống';
            $this->setDataOld($name, $code, $price, $description, $content, $status, $category);
        }
        if (empty($category)) {
            $this->data['category'] = 'Loại sản phẩm không được để trống';
            $this->setDataOld($name, $code, $price, $description, $content, $status, $category);
        }
        if ($image != null) {
            $this->library->load('Upload');
            $imgUploader = new UploadLibrary();
            $imgUploader->validate($image);
            if (!empty($imgUploader->error)) {
                $this->data['image'] = $imgUploader->error;
                $this->setDataOld($name, $code, $price, $description, $content, $status, $category);
            }
        }
    }

    /**
     * set data cũ từ form
     * @param $name
     * @param $code
     * @param $price
     * @param $description
     * @param $content
     * @param $status
     * @param $category
     */
    private function setDataOld($name, $code, $price, $description, $content, $status, $category)
    {
        $this->data['name_old'] = $name;
        $this->data['code_old'] = $code;
        $this->data['price_old'] = $price;
        $this->data['description_old'] = $description;
        $this->data['content_old'] = $content;
        $this->data['status_old'] = $status;
        $this->data['category_old'] = $category;
    }
}