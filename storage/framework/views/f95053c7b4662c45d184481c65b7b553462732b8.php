<?php $__env->startSection('content'); ?>
<div class="login-box">
	<div class="login-logo">

	</div><!-- /.login-logo -->
	<div class="login-box-body">

		<p class="login-box-msg"><b>TRANG ĐĂNG NHẬP</b></p>
		<?php echo $__env->make('includes.flash-standalone', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<form role="form" method="POST" action="<?php echo e(url('/admin/login')); ?>">
			<?php echo csrf_field(); ?>


			<div class="form-group<?php echo e($errors->has('login') ? ' has-error' : ' has-feedback'); ?>">
				<input type="text" class="form-control" placeholder="<?php echo e(trans('VNPCMS.forms.placeholders.emailorusername')); ?>" name="login" value="<?php echo e(old('login')); ?>">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				
				<?php if($errors->has('login')): ?>
				<span class="help-block">
					<strong><?php echo e($errors->first('login')); ?></strong>
				</span>
				<?php endif; ?>
			</div>

			<div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ' has-feedback'); ?>">
				<input type="password" class="form-control" placeholder="<?php echo e(trans('VNPCMS.forms.placeholders.password')); ?>" name="password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>

				<?php if($errors->has('password')): ?>
				<span class="help-block">
					<strong><?php echo e($errors->first('password')); ?></strong>
				</span>
				<?php endif; ?>
			</div>

			<div class="row">
				<div class="col-xs-8">
					<div class="checkbox icheck">
						<label>
							<input type="checkbox" name="remember"> <?php echo e(trans('VNPCMS.forms.checkboxes.rememberme')); ?>

						</label>
					</div>
				</div><!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-btn fa-sign-in"></i> Login</button>
				</div><!-- /.col -->
			</div>
		</form>
		<?php if( crminfo('enable_registration') == 1): ?>
		<a href="<?php echo e(url('/admin/register')); ?>"><?php echo e(trans('VNPCMS.forms.labels.register')); ?></a><br>
		<?php endif; ?>
		<a href="<?php echo e(url('/admin/password/reset')); ?>"><?php echo e(trans('VNPCMS.forms.labels.forgotpassword')); ?></a><br>

	</div><!-- /.login-box-body -->
</div><!-- /.login-box -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.standalone', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>