<?php $__env->startSection('title', 'Lista de usuários'); ?>
<?php $__env->startSection('content'); ?>

<link href="<?php echo e(URL::asset('vendor/datatables/buttons.bootstrap4.min.css')); ?>" rel="stylesheet">

<script src="<?php echo e(URL::asset('vendor/datatables/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('vendor/datatables/buttons.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('vendor/datatables/jszip.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('vendor/datatables/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('vendor/datatables/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('vendor/datatables/moment.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('vendor/datatables/datetime-moment.js')); ?>"></script>

<?php
@session_start();
if (@$_SESSION['level'] != 'admin') {
  echo "<script language='javascript'> window.location='./' </script>";
}
if (!isset($id)) {
  $id = "";
}
?>
<h2 class="mb-4"><i>Lista de usuários cadastrados no Moodle <?php echo e($moodle); ?></i></h2>
<a href="<?php echo e(route('moodle.ignorados')); ?>" type="button" class="mb-3 btn btn-primary">Voltar para lista</a>
<div class="card shadow mb-4">
  <div class="card-body">
  <div class="table-responsive">
    <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
              <th>Nome</th>
              <th>Usuário</th>
              <th>E-mail</th>
              <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php for($i=0; $i < count($results); $i++): ?> 
          <tr>
            <td><?php echo e($results[$i]->firstname); ?> <?php echo e($results[$i]->lastname); ?></td>
              <td><?php echo e($results[$i]->username); ?></td>
              <td><?php echo e($results[$i]->email); ?> </td>
              <td>
                <form action="<?php echo e(route('moodle.add')); ?>" method="get">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="user_id" value="<?php echo e($results[$i]->id); ?>">
                  <input type="hidden" name="username" value="<?php echo e($results[$i]->username); ?>">
                  <input type="hidden" name="firstname" value="<?php echo e($results[$i]->firstname); ?>">
                  <input type="hidden" name="lastname" value="<?php echo e($results[$i]->lastname); ?>">
                  <input type="hidden" name="email" value="<?php echo e($results[$i]->email); ?>">
                  <input type="hidden" name="moodle" value="<?php echo e($moodle); ?>">
                  <button title="Adicionar na lista"  class="btn btn-primary" type="submit">Adicionar</button>
                  
                </form>                                  
                
            </td>
          </tr>
        <?php endfor; ?>
        </tbody>
    </table>
  </div>
</div>
</div>   

<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.template-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/midias.faculdadesensu.edu.br/midias/resources/views/painel-admin/moodle/users.blade.php ENDPATH**/ ?>