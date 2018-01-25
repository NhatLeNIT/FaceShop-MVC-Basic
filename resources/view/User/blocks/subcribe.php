<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 28-May-17
 * Time: 18:16
 */
?>
<div class="subscribe-area">
    <div class="container">
        <div class="subscribe-title">
            <h3><span>Đăng ký</span>để nhận thông tin khuyến mãi hoặc sản phẩm mới nhất</h3>
            <p>Thông tin này sẽ được bảo mật trên hệ thống Shop<br>
                Hệ thống sẽ tự động gửi thông tin khuyến mãi hoặc sản phẩm mới nhất về thời trang nam về email mà bạn đã đăng ký</p>
            <form action="{!! route('postSubscribe') !!}" method="post" id="form-input">
                <div class="subscribe-form">
                    <input type="text" name="txtEmail" required placeholder="Nhập địa chỉ email của bạn ........." />
                    <button type="submit" class="btn">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>
</div>
