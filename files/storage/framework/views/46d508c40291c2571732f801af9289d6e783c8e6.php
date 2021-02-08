
<?php $__env->startSection('title', 'Lista de Ignorados'); ?>
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
<h2 class="mb-4"><i>Lista de usuários que serão ignorados no bloqueio</i></h2>

<a href="<?php echo e(route('moodle.listA')); ?>" type="button" class=" mb-3 btn btn-primary">Adicionar Novo - Moodle A</a>
<a href="<?php echo e(route('moodle.listB')); ?>" type="button" class="mb-3 btn btn-primary">Adcionar Novo - Moodle B</a>

<div class="card shadow mb-4">
  <div class="card-body">
  <div class="table-responsive">
    <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
              <th>Nome</th>
              <th>Usuário</th>
              <th>E-mail</th>
              <th>Moodle</th>
              <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php for($i=0; $i < count($results); $i++): ?> 
          <tr>
              <td><?php echo e($results[$i]->firstname); ?> <?php echo e($results[$i]->lastname); ?></td>
              <td><?php echo e($results[$i]->username); ?></td>
              <td><?php echo e($results[$i]->email); ?> </td>
              <td><?php echo e($results[$i]->moodle); ?> </td>
              <td>
                <form action="<?php echo e(route('moodle.delete', $results[$i]->id)); ?>" method="post">
                  <?php echo csrf_field(); ?>
                  <?php echo method_field('delete'); ?>
                  <button title="Adicionar na lista" class="btn btn-primary" type="submit">Excluir</button>
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
<?php echo $__env->make('template.template-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\midias\files\resources\views/painel-admin/moodle/lista-users.blade.php ENDPATH**/ ?>