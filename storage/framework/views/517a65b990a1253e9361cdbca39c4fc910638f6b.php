<?php $__env->startSection('page_title'); ?>
    Trang chủ
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <div class="container">
        <div class="product-detail">
            <div class="row">
                <div class="col-sm-7">
                    <div class="product-img clearfix">
                        <div class="easyzoom easyzoom--adjacent easyzoom--with-thumbnails">
                            <a href="<?php echo e(asset('public/images/products/'.$detailproduct->model.'/'.$detailproduct->images)); ?>">
                                <img src="<?php echo e(asset('public/images/products/'.$detailproduct->model.'/'.$detailproduct->images)); ?>" alt="" class="imgresponsive"/>
                            </a>
                        </div>
                    </div>
                    <ul id="thumblist" class="thumbnails clearfix" >
                        <?php foreach($files_images as $key=>$url): ?>
                        <li <?php if($key==0): ?>class="active" <?php endif; ?>>
                            <a href='<?php echo e(asset('public/images/'.$url)); ?>' data-standard="<?php echo e(asset('public/images/'.$url)); ?>" >
                                <img src='<?php echo e(asset('public/images/'.$url)); ?>'>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-sm-5">
                    <h1 class="product-title"><?php echo e($detailproduct->name); ?></h1>
                    <?php if($detailproduct->cates->parent!=null): ?>
                    <h2 class="product-subtitle"><?php echo e($detailproduct->cates->parent->name); ?>-<?php echo e($detailproduct->cates->name); ?></h2>
                    <?php else: ?>
                        <h2 class="product-subtitle"><?php echo e($detailproduct->cates->name); ?></h2>
                    <?php endif; ?>

                        <div class="price">Giá bán: <?php if($detailproduct->listprice!=0): ?><span class="old"><?php echo e(number_format($detailproduct->listprice,'0',',','.')); ?></span><?php endif; ?><span class="new"><?php echo e(number_format($detailproduct->price,'0',',','.')); ?></span> (Chưa bao gồm VAT)</div>
                    <div class="product-button">
                        <select class="p-btn btn-qty select2-style" title="Vui lòng chọn số lượng." id="quantity">
                            <option value="1">1</option>
                            <?php
                                    $n=10;
                                ?>
                            <?php for($i=2; $i<=$n; $i++): ?>
                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                            <?php endfor; ?>
                        </select>
                        <button class="p-btn add-to-cart" id="add_cart" value="<?php echo e($detailproduct->id); ?>">THÊM VÀO GIỎ</button>
                    </div>
                    <div class="product-links">
                        <a href="<?php echo $settings['linkfanpage']; ?>" class="facebook" TARGET="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="<?php echo $settings['instagram']; ?>" TARGET="_blank"><i class="fa fa-instagram"></i></a>
                    </div>
                    <div class="product-shipping"> <?php echo $detailproduct->short; ?></div>
                </div><!--/.col-->
            </div><!-- /.row-->

            <div class="product-info-more">
                <div class="row">
                    <div class="col-sm-4">
                        <img src="<?php echo e(asset('public/images/products/'.$detailproduct->model.'/'.$detailproduct->images)); ?>" alt="" class="imgresponsive"/>
                    </div>
                    <div class="col-sm-8">
                        <h3 class="product-title"><?php echo e($detailproduct->name); ?></h3>
                        <div class="pi-pdpmainbody">
                            <?php echo $detailproduct->long; ?>

                        </div>
                    </div><!--/.col-->
                </div><!--/row-->
            </div><!--/.product-info-more-->
        </div><!-- /.page-view -->

        <div class="product-more list-products">
            <h3 class="product-title">SẢN PHẨM TƯƠNG TỰ</h3>
            <div class="product-more-content">
                <div class="row">
                    <?php foreach($alsolikes as $key=>$list): ?>
                    <div class="col-xs-6 col-sm-3">
                        <div class="item">
                            <div class="cover"><a href="<?php echo e(url($list->slug)); ?>"><img src="<?php echo e(asset('public/images/products/'.$list->model.'/'.$list->images)); ?>" alt="<?php echo e($list->name); ?> " class="imgresponsive"></a></div>
                            <div class="info-product">
                                <div class="info-color">
                                    <div class="number-of-colors"> <a href="<?php echo e(url($list->slug)); ?>"><?php echo e($list->name); ?></a></div>
                                </div>
                                <h3><a href="<?php echo e(url($list->slug)); ?>"><?php echo e($list->name); ?></a></h3>
                                <div class="price"><span> Giá bán: <?php echo e(number_format($list->price,'0',',','.')); ?></span><span class="old"> (Chưa bao gồm VAT)</span></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div><!--/.row-->
            </div><!--/.product-more-content-->
        </div><!--/.product-more-->

    </div><!-- /.container -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-script'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('themes.productsdetail', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>