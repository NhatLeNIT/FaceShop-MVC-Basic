<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 30-May-17
 * Time: 23:27
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
                    <li class="active">Thông tin đặt hàng</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area start -->
<div class="checkout-area">
    <div class="container">
        <div class="row">
            <form action="?c=order&a=processCheckout" method="post" id="form-input">
                <div class="col-lg-6 col-md-6">
                    <div class="checkbox-form">
                        <h3>Thông tin đơn hàng</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Họ tên người nhận <span class="required">*</span></label>
                                    <input type="text" placeholder="Nhập họ tên" required name="txtName" value="<?php if(isset($name_old)) echo $name_old; else echo $dataUser[0]['name']?>"/>
                                    <?php if(isset($name)) { ?>
                                        <span class="help-block"><strong> <?php echo $name?></strong></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Số điện thoại người nhận <span class="required">*</span></label>
                                    <input type="text" placeholder="Nhập số điện thoại" required name="txtPhone"  value="<?php if(isset($phone_old)) echo $phone_old; else echo $dataUser[0]['mobile']?>" />
                                    <?php if(isset($phone)) { ?>
                                        <span class="help-block"><strong> <?php echo $phone?></strong></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="checkout-form-list">
                                    <label for="txtProvince">Chọn tỉnh/thành</label>
                                    <select name="txtProvince" id="txtProvince">
                                        <?php foreach ($dataProvince as $item) { ?>
                                            <option value="<?= $item['id']?>"><?= $item['name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="checkout-form-list">
                                    <label for="txtDistrict">Chọn quận/huyện</label>
                                    <select name="txtDistrict" id="txtDistrict">
                                        <?php foreach ($dataDistrict as $item) { ?>
                                            <option value="<?= $item['id']?>"><?= $item['name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="checkout-form-list">
                                    <label for="txtWard">Chọn xã/phường</label>
                                    <select name="txtWard" id="txtWard">
                                        <?php foreach ($dataWard as $item) { ?>
                                            <option value="<?= $item['id']?>"><?= $item['name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Địa chỉ người nhận</label>
                                    <input type="text" placeholder="Nhập địa chỉ số nhà, tên đường" required name="txtAddress"  value="<?php if(isset($address_old)) echo $address_old; else echo $dataUser[0]['address']?>"/>
                                    <?php if(isset($address)) { ?>
                                        <span class="help-block"><strong> <?php echo $address?></strong></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="country-select">
                                    <label for="txtDelivery">Loại hình giao hàng</label>
                                    <select name="txtDelivery" id="txtDelivery">
                                        <option value="1">Bưu điện</option>
                                        <option value="2">Chuyển phát nhanh</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="country-select">
                                    <label for="txtPayment">Hình thức thanh toán</label>
                                    <select name="txtPayment" id="txtPayment">
                                        <option value="1">Thanh toán khi nhận hàng</option>
                                        <option value="2">Thánh toán qua Bảo Kim</option>
<!--                                        <option value="3">Thánh toán qua Ngân Lượng</option>-->
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="your-order">
                        <h3>Tóm tắt đơn hàng</h3>
                        <div class="your-order-table table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th class="product-name">Sản Phẩm</th>
                                    <th class="product-total">Thành tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($cartContent as $item) { ?>
                                <tr class="cart_item">
                                    <td class="product-name">
                                        <?=$item['name'] ?> <strong class="product-quantity"> × <?=$item['qty'] ?></strong>
                                    </td>
                                    <td class="product-total">
                                        <span class="amount"><?=number_format($item['price']*$item['qty'], 0, ",", ".") ?><sup>đ</sup></span>
                                    </td>
                                </tr>
                                <?php }?>
                                </tbody>
                                <tfoot>

                                <tr class="order-total">
                                    <th>Tổng cộng</th>
                                    <td><strong><span class="amount"><?= number_format($cartTotal, 0, ",", ".") ?><sup>đ</sup></span></strong>
                                    </td>
                                </tr>
                                <tr class="order-notes">
                                    <td><b>Phí ship: </b></td>
                                    <td id="shipping">1000<sup>đ</sup></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method">

                            <div class="order-button-payment">
                                <input class="btn" type="submit" value="Đặt hàng" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- checkout-area end -->

<script>
    $(document).ready(function () {
        var idWard = $('#txtWard').val();
        var type = $('#txtDelivery').val();
        calShipping(idWard, type);
        $('#txtProvince').change(function () {
            var idProvince = $(this).val();
            $.ajax({
                url : '?c=order&a=getDistrictList',
                type : 'POST',
                cache:false,
                data:{"id":idProvince},
                success:function (data) {
                    $('#txtDistrict').html(data);
                    var idDistrict = $('#txtDistrict').val();
                    callAjaxWard(idDistrict);
                    var idWard = $('#txtWard').val();
                    var type = $('#txtDelivery').val();
                    calShipping(idWard, type)
                }
            })
        });

        $('#txtDistrict').change(function () {
            var idDistrict = $(this).val();
            callAjaxWard(idDistrict);
            var idWard = $('#txtWard').val();
            var type = $('#txtDelivery').val();
            calShipping(idWard, type)
        });

        $('#txtWard').change(function () {
            var idWard = $(this).val();
            var type = $('#txtDelivery').val();
            calShipping(idWard, type);
        });

        $('#txtDelivery').change(function () {
            var idWard = $('#txtWard').val();
            var type = $(this).val();
            console.log(type);
            calShipping(idWard, type);
        });

        function callAjaxWard(idDistrict) {
            $.ajax({
                url : '?c=order&a=getWardList',
                type : 'POST',
                cache:false,
                data:{"id":idDistrict},
                success:function (data) {
                    $('#txtWard').html(data);
                    var idWard = $('#txtWard').val();
                    var type = $('#txtDelivery').val();
                    calShipping(idWard, type)
                }
            })
        }
        function calShipping(idWard, type) {
            $.ajax({
                url : '?c=order&a=getShipping',
                type : 'POST',
                cache:false,
                data:{"id":idWard, "type":type},
                success:function (data) {
                    $('#shipping').html(data);
                }
            })
        }
    });
</script>
<!-- /Parsley -->
