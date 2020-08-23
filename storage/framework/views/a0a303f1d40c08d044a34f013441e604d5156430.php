<?php $__env->startSection('page_title'); ?>
Trang chủ
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <div class="list-col-right">
        <div class="list-products">
            <div class="row">
<?php foreach($listproducts as $key=>$list): ?>
                    <div class="col-5">
                        <div class="grid-item hot-product">
                            <div class="item-box">
                                <div class="cover"><a href="<?php echo e(url($list->slug)); ?>"><img src="<?php echo e(asset('public/images/products/'.$list->model.'/'.$list->images)); ?>" alt="<?php echo e($list->name); ?>" class="imgresponsive"></a></div>
                                <div class="info-product">
                                    <div class="info-color">
                                        <div class="number-of-colors"> <a href="<?php echo e(url($list->slug)); ?>"><?php echo e($list->name); ?></a></div>
                                    </div>
                                    <h3><a href="<?php echo e(url($list->slug)); ?>">Mã sản phẩm: <?php echo e($list->code); ?></a></h3>
                                    <div class="price"><span>Giá bán: <?php echo e(number_format($list->price,'0',',','.')); ?></span><span class="old">(Chưa bao gồm VAT)</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php endforeach; ?>
            </div>
        </div>
        <?php if($page=='list'): ?>
        <div align="center">
            <?php echo $listproducts->render(); ?>

        </div>
            <?php endif; ?>

        <?php if($page=='order'): ?>
            <div align="center">
                <?php echo $listproducts->appends([$page => $curl])->render(); ?>

            </div>
        <?php endif; ?>

        <?php if($page=='seach'): ?>
            <div align="center">
                <?php if($pageSize!=null && $pageColor==null): ?>
                <?php echo $listproducts->appends(['seach' => 'true','size'=>$pageSize])->render(); ?>

                <?php endif; ?>

                    <?php if($pageSize==null && $pageColor!=null): ?>
                        <?php echo $listproducts->appends(['seach' => 'true','color'=>$pageColor])->render(); ?>

                    <?php endif; ?>

                    <?php if($pageSize!=null && $pageColor!=null): ?>
                        <?php echo $listproducts->appends(['seach' => 'true','size'=>$pageSize,'color'=>$pageColor])->render(); ?>

                    <?php endif; ?>
            </div>
        <?php endif; ?>


    </div><!-- /.list-col-right -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-script'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('themes.products', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>