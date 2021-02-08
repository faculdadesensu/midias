
<?php $__env->startSection('title', 'Links'); ?>
<?php $__env->startSection('content'); ?>
<?php 
@session_start();
if(@$_SESSION['level'] != 'admin' && @$_SESSION['level'] != 'user'){ 
  echo "<script language='javascript'> window.location='./' </script>";
}
if(!isset($id)){
  $id = "";
}
?>
<a href="<?php echo e(route('links.inserir')); ?>" type="button" class="mt-4 mb-4 btn btn-primary">Novo</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          <th>Titulo</th>
          <th>Link</th>
          <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($item->title); ?></td>
                <td><?php echo e($item->link); ?></td>
                <td>
                <a href="<?php echo e(route('links.edit', $item)); ?>"><i class="fas fa-edit text-info mr-1"></i></a>
                <a title="Deletar conteúdo" href="<?php echo e(route('links.modal', $item->id)); ?>"><i class="fas fa-trash text-danger mr-1"></i></a>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deletar Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Deseja Realmente Excluir este Registro?        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <form method="POST" action="<?php echo e(route('links.delete', $id)); ?>">
          <?php echo csrf_field(); ?>
          <?php echo method_field('delete'); ?>
          <button type="submit" class="btn btn-danger">Excluir</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php 
if(@$id != ""){
  echo "<script>$('#exampleModal').modal('show');</script>";
}
?>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('template.template-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\midias\files\resources\views/painel-admin/links/index.blade.php ENDPATH**/ ?>