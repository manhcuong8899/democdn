<?php $__env->startSection('page_title'); ?>
Trang chủ
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <?php foreach($group as $gp): ?>
    <div class="cols-list-auto list-01">
            <div class="name-box">
                <h2><a href="<?php echo e(url('nhom-san-pham/'.$gp->slug)); ?>"> <?php echo e($gp->name); ?></a> </h2>
            </div>
            <div class="cols-list-content">
                <div class="owl-carousel">
                    <?php foreach(viewProduct($gp->id) as $list): ?>
                        <div class="item">
                            <div class="cover"><a href="<?php echo e(url($list->slug)); ?>"><img src="<?php echo e(asset('public/images/products/'.$list->model.'/'.$list->images)); ?>"alt="<?php echo e($list->name); ?>" class="imgresponsive"></a></div>
                            <div class="info-color">
                                <div class="number-of-colors">
                                    <a href="<?php echo e(url($list->slug)); ?>"><?php echo e($list->name); ?></a>
                                </div>
                            </div>
                            <h3><a href="<?php echo e(url($list->slug)); ?>">Mã sản phẩm: <?php echo e($list->code); ?></a></h3>
                            <div class="price"><span>Giá bán: <?php echo e(number_format($list->price,'0',',','.')); ?></span><span class="old">(Chưa bao gồm VAT)</span></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
    </div><!-- /.block-products -->
    <?php endforeach; ?>
<?php if($countpview >0): ?>
    <div class="cols-list-auto list-01">
        <div class="name-box">
            <h2><a href="#"> SẢN PHẨM ĐÃ XEM</a> </h2>
        </div>
        <div class="cols-list-content">
            <div class="owl-carousel">
                <?php foreach($pview as $index=>$alist ): ?>
                    <div class="item">
                        <div class="cover"><a href="<?php echo e(url($alist->options->slug)); ?>"><img src="<?php echo e(asset('public/images/products/'.$alist->options->model.'/'.$alist->options->images)); ?>"alt="<?php echo e($alist->name); ?>" class="imgresponsive"></a></div>
                        <div class="info-color">
                            <div class="number-of-colors">
                                <a href="<?php echo e(url($alist->options->slug)); ?>"><?php echo e($alist->name); ?></a>
                            </div>
                        </div>
                        <h3><a href="<?php echo e(url($alist->options->slug)); ?>">Mã sản phẩm: <?php echo e($alist->options->code); ?></a></h3>
                        <div class="price"><span>Giá bán: <?php echo e(number_format($alist->price,'0',',','.')); ?></span><span class="old">(Chưa bao gồm VAT)</span></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div><!-- /.block-products -->
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-script'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('themes.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>