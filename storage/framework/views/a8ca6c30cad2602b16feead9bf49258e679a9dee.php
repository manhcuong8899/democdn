<div class="list-col-left">
    <div class="nav-left">
        <div class="nav-group">
            <?php if($cate->parent_id!=0): ?>
            <h3><?php echo e($cate->parent->name); ?></h3>
            <ul>
                <?php foreach($cate->parent->children as $key=>$value): ?>
                <li><a href="<?php echo e(url($value->slug)); ?>"><?php echo e($value->name); ?></a></li>
                <?php endforeach; ?>
            </ul>
                <?php else: ?>
                <h3><?php echo e($cate->name); ?></h3>
                <ul>
                    <?php foreach($cate->children as $key=>$value): ?>
                        <li><a href="<?php echo e(url($value->slug)); ?>"><?php echo e($value->name); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div><!-- /.list-col-left -->