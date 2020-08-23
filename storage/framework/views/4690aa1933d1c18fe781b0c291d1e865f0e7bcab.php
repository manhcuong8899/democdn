<div class="container">
    <div class="footer">
        <div class="row">
            <div class="col-sm-3 text-center">
                <div class="logo-f">
                    <a href="/"><img src="<?php echo e(url('public/images/logo/'.$settings['images'])); ?>" class="imgresponsive_logo hvr-forward" width="90px"></a>
                </div>
            </div>
            <div class="col-sm-2 f-cols f-nav">
                <?php foreach($menus['menuduoi'] as $key=>$value): ?>
                <h3><?php echo e($value->name); ?></h3>
                    <?php if($value->children->count()!=0): ?>
                <ul class="list-unstyled">
                    <?php foreach($value->children as $child): ?>
                    <li><a href="<?php echo e(url($child->link)); ?>"><?php echo e($child->name); ?></a></li>
                    <?php endforeach; ?>
                </ul>
                    <?php endif; ?>
                    <?php endforeach; ?>
            </div>
            <div class="col-sm-3 f-cols f-social">
                <h3>Tư vấn/Fanpage</h3>
                <ul class="list-inline clearfix">
                    <li><a href="<?php echo $settings['linkfanpage']; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                   <?php /* <li><a href="<?php echo $settings['instagram']; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>*/ ?>
                    <li><a href="skype:<?php echo e($settings['skype']); ?>?chat"><i class="fa fa-skype"></i></a></li>
                    <li><a href="mailto:<?php echo e($settings['email']); ?>"><i class="fa fa-envelope-o"></i></a></li>
                </ul>
            </div>
            <div class="col-sm-4 f-cols clearfix">
                <div class="footer-newletter">
                    <h3>Đăng ký nhận khuyến mãi</h3>
                    <form action="<?php echo e(url('emails')); ?>" method="post">
                        <?php echo csrf_field(); ?>

                    <div class="input-group newletter">

							<span class="input-newletter">
								<input  class="form-control" placeholder="Email" type="text" name="email">
							</span>
							<span class="input-group-btn">
								<button type="submit" class="ch4_btnOrange btn-newletter">Đăng ký</button>
							</span>
                    </div>
                        </form>
                </div>
            </div>
        </div>

        <div id="cfacebook">
            <a href="javascript:;" class="chat_fb" onclick="javascript:fchat();"><i class="fa fa-comments"></i> Để lại tin nhắn cho chúng tôi</a>
            <div id="fchat" class="fchat">
                <?php echo $settings['chatfacebook']; ?>

            </div>
            <input type="hidden" id="tchat" value="0">
        </div>

    </div><!-- /.footer -->
    <div class="copyright">Copyright 2020 NHÓM BÀI TẬP LỚN MÔN WEB 3.0 rights reserved</div>

</div><!-- /.container -->