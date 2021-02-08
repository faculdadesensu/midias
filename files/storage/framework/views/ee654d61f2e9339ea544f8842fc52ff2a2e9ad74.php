
<?php $__env->startSection('title', 'Administrador'); ?>
<?php $__env->startSection('content'); ?>
<?php 
@session_start();

if(@$_SESSION['level'] != 'admin' && @$_SESSION['level'] != 'user' ){ 
  echo "<script language='javascript'> window.location='./' </script>";
}
use App\Models\Link;
$links = link::orderby('id', 'desc')->get();
?>
<h3 class="mb-5"><i>MONITORAMENTO DE LINKS</i></h3>
<div class="row ml-2">
  <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="mr-5 mb-5" style="box-shadow: 0 0 1em rgb(0,0,0, 0.2); border-radius: 10px">
    <div class="card" style="width:300px">
      <div class="embed-responsive embed-responsive-1by1">
        <iframe src="<?php echo e($item->link); ?>"></iframe>
      </div>
      <div class="card-body mr-2">
        <h4 class="card-title"><?php echo e($item->title); ?></h4>
        <a href="<?php echo e($item->link); ?>" class="btn btn-primary" target="_blank">Acessar Link</a>
      </div>
    </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.template-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\midias\files\resources\views/painel-admin/index.blade.php ENDPATH**/ ?>