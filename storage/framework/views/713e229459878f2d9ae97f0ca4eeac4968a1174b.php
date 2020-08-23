<div class="section-slider">

    <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php foreach($viewimages['slide'] as $key=>$img): ?>
                <li data-target="#myCarousel" data-slide-to="<?php echo e($key); ?>"  <?php if($key==0): ?>
                    class="active"
                        <?php endif; ?>></li>
            <?php endforeach; ?>
        </ol>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php foreach($viewimages['slide'] as $key=>$img): ?>
                <div class="item
            <?php if($key==0): ?>
            active
            <?php endif; ?>
                        ">
                    <div class="cover"><a href="<?php echo e(url($img->url)); ?>" style="text-decoration: none"><img src="<?php echo e(asset('public/images/images/'.$img->cates->code.'/'.$img->images)); ?>" alt="<?php echo e($img->name); ?>" class="rev-slidebg"></a></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div><!-- /.section-slider -->
