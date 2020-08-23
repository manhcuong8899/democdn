<?php if(count($errors) > 0): ?>
    <div class="alert alert-danger">
        <strong>Thông báo!:</strong> <br><br>
        <ul>
            <?php foreach($errors->all() as $error): ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if(Session::has('flash_message')): ?>
    <div class="alert alert-success">
        <?php echo e(Session::get('flash_message')); ?>

    </div>
<?php endif; ?>
<?php if(session('status')): ?>
    <div class="alert alert-success">
        <?php echo e(session()->get('status')); ?>

    </div>
<?php endif; ?>