<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 30-May-17
 * Time: 21:58
 */
?>
<div id="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a>
                    </li>
                    <li class="active">Giỏ hàng chi tiết</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area start -->
<div class="cart-main-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="?c=cart&a=update" method="post" name="formCart">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                            <tr>
                                <th class="product-thumbnail">STT</th>
                                <th class="product-thumbnail">Hình</th>
                                <th class="product-name">Tên Sản Phẩm</th>
                                <th class="product-price">Giá</th>
                                <th class="product-quantity">Số Lượng</th>
                                <th class="product-subtotal">Thành Tiền</th>
                                <th class="product-remove">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!$count) { ?>
                            <tr>
                                <td colspan="7" align="center">Không có sản phẩm nào trong giỏ hàng
                                </td>
                            </tr>
                            <?php }
                            $i = 0;
                            foreach($content as $item) {
                            ?>
                            <tr>
                                <td width="28"><?=$i+1?></td>
                                <td class="product-thumbnail"><a href="#"><img src="public/images/uploads/products/<?=$item['image']?>" alt="" /></a></td>
                                <td class="product-name"><a href="#"><?=$item['name']?></a></td>
                                <td class="product-price"><span class="amount"><?= number_format($item['price'], 0, ",", ".")?><sup>đ</sup></span></td>
                                <td class="product-quantity"><input type="number" name="qty<?=$i?>" value="<?=$item['qty']?>" /></td>
                                <td class="product-subtotal"><?=number_format($item['price']*$item['qty'], 0, ",", ".") ?><sup>đ</sup></td>
                                <td class="product-remove">
                                    <button type="button" value="<?=$i++?>" data-toggle="tooltip" data-placement="bottom" title="Xóa" class="btn btn-danger btn-xs delete-item"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                          <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-sm-7 col-xs-12">
                            <div class="buttons-cart">
                                <a href="javascript:history.back()">Tiếp tục mua hàng</a>
                                <?php if($count) { ?>
                                <a href="javascript:document.formCart.submit()">Cập nhật</a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-5 col-xs-12">
                            <div class="cart_totals">
                                <h2>Tổng cộng</h2>
                                <table>
                                    <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Sản phẩm: </th>
                                        <td><span class="amount"><?=$count ?></span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Tổng cộng</th>
                                        <td>
                                            <strong><span class="amount"><?=number_format($total, 0, '.', '.') ?><sup>đ</sup></span></strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="clearfix"></div>
                                <div class="wc-proceed-to-checkout">
                                    <?php if($count) { ?>
                                    <a href="?c=order&a=checkout">Đặt hàng</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->
<!-- SweetAlert -->
<link href="public/vendors/sweetalert2/sweetalert2.min.css" rel="stylesheet" >
<script src="public/js/myscript.js"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<script>
    $(document).ready(function () {
        $('.delete-item').click(function () {
            var parent = $(this).parent().parent();
            if(xacnhanxoa('Bạn có muốn xóa sản phẩm này ra khỏi giỏ hàng?')) {
                var rowid = $(this).val();

                $.ajax({
                    url:'?c=cart&a=delete',
                    type:'POST',
                    cache:false,
                    data:{"id":rowid},
                    success:function (data) {
                        console.log(data);
                        if(data === 'success') {
                            console.log(rowid);
                            $(parent).fadeOut({
                                durarion: 300,
                                done: function () {
                                    $(this).remove();
                                    issetItem();
                                }
                            });
                        }
                    }
                });
            }
        });
    });
    function issetItem() {
        //Kiểm tra xem còn class này không, nếu không tức là không còn thẻ <tr>
        var tag_tr = $.find(".delete-item");
        if(tag_tr == '') {//Nếu không còn thì chèn thông báo
            $("tbody").html("<tr><td colspan='7' class='text-center'>Không có sản phẩm nào trong giỏ hàng</td></tr>");
            $(".contact").remove();
        }
    }
</script>
<?php if(isset($_SESSION['success_msg'])) {?>
    <script>
        $(document).ready(function () {
            swal("Thành Công!", "<?php echo $_SESSION['success_msg']?>", "success");
        });
    </script>
<?php }
unset($_SESSION['success_msg']);
?>
<?php if(isset($_SESSION['error_msg'])) {?>
    <script type="text/javascript">
        $(document).ready(function () {
            sweetAlert("Oops...", "<?php echo $_SESSION['error_msg']?>", "error");
        });
    </script>
<?php }
unset($_SESSION['error_msg']);
?>