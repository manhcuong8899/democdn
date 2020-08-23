<div class="header-wsmenu clearfix">
    <div class="nav-main">
        <a id="wsnavtoggle" class="animated-arrow"><span></span></a>
        <nav class="wsmenu clearfix">
            <?php if(array_key_exists("menutop",$menus)): ?>
            <ul class="mobile-sub wsmenu-list">
                <?php foreach($menus['menutop'] as $key=>$value): ?>
                <li>
                    <a href="<?php echo e(url($value->link)); ?>"><?php echo e($value->name); ?></a>

                    <?php if($value->children->count()!=0): ?>
                    <div class="megamenu clearfix">
                        <div class="container">
                            <ul class="col-lg-3 col-md-3 col-xs-12 link-list nav-ow right-line">
                                <li><a href="<?php echo e(url($value->link.'/san-pham-co-san')); ?>">SẢN PHẨM CÓ SẴN</a></li>
                                <li><a href="<?php echo e(url($value->link.'/san-pham-ban-chay')); ?>">SẢN PHẨM BÁN CHẠY</a></li>
                                <li><a href="<?php echo e(url($value->link.'/san-pham-noi-bat')); ?>">SẢN PHẨM NỔI BẬT</a></li>
                            </ul>
                            <?php foreach($value->children as $child): ?>
                            <ul class="col-lg-2 col-md-2 col-xs-12 link-list">
                                <li class="title">
                                        <a href="<?php echo e(url($child->link)); ?>"><?php echo e(mb_strtoupper($child->name, 'UTF-8')); ?></a>
                                </li>
                                <?php if($child->children->count()!=0): ?>
                                    <?php foreach($child->children as $chil): ?>
                                            <li><a href="<?php echo e(url($chil->link)); ?>"><?php echo e($chil->name); ?></a></li>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                            </ul>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>
                <?php endif; ?>
        </nav>
    </div>
    <div class="search-navbar">
        <form action="<?php echo e(url('seach/text')); ?>"  method="get" class="search-form">
            <input type="text" name="seach" class="form-control" placeholder="Tìm Kiếm">
            <button type="submit" class="form-control-submit"></button>
        </form>
    </div>
</div><!-- /.header-wsmenu -->