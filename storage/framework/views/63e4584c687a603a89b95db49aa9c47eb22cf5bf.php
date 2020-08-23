<?php if(session()->has('status')): ?>
<div class="alert alert-<?php echo e(session('status-type')); ?> <?php echo e(session('status-dismissable') ? 'alert-dismissible alert-fade' : ''); ?>">
	<?php if(session('status-dismissable')): ?>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<?php endif; ?>
	<?php echo e(session('status')); ?>

</div>
<?php endif; ?>