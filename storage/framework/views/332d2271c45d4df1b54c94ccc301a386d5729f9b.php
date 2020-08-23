<div class="navbar-top clearfix">
    <ul class="list-inline left navbar-top-left">
        <li><a href="<?php echo e(($settings['linkfanpage'])); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
        <li><a href="skype:<?php echo e($settings['skype']); ?>?chat"><i class="fa fa-skype"></i></a></li>
        <li><a href="#"><i class="fa fa-phone-square"></i> <?php echo e($settings['hotline']); ?></a></li>
    </ul>

        <ul class="list-inline right navbar-top-right navbar-login">
            <?php if(Auth::guest()): ?>
            <li>
                <span data-toggle="modal" data-target="#myModalSignIn">ĐĂNG NHẬP</span>
                <span>/</span>
                <span data-toggle="modal" data-target="#myModalRegister">ĐĂNG KÝ</span>
            </li>
            <?php else: ?>
                <li class="dropdown">
                    <span id="dropdownMenu1" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo e(Auth::user()->email); ?></span>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="<?php echo e(url('members/orders')); ?>">Lịch sử mua hàng</a></li>
                        <li><a href="<?php echo e(url('members/show')); ?>">Thông tin cá nhân</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myModalChangepass">Đổi mật khẩu</a></li>
                        <li><a href="<?php echo e(url('admin/logout')); ?>">Thoát</a></li>
                    </ul>
                </li>
                <?php endif; ?>
            <li>
                <a class="icon-cart-qty" href="<?php echo e(url('cart')); ?>">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="exp-cart-qty"><?php echo e(Cart::instance('cart')->content()->count()); ?></span>
                </a>
            </li>
        </ul>


</div>
<!-- /.navbar-top -->