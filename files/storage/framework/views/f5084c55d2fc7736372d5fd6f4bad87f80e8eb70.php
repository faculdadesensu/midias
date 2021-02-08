
<?php $__env->startSection('title', 'Bloqueio e Desbloqueio Moodle'); ?>
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

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 d-flex justify-content-center btn-group">
          <a type="button" href="<?php echo e(route('moodle.lock')); ?>" class="btn btn-sm btn-primary btn-margin-responsive">Bloquear</a>
        </div>
        <div class="col-md-6 d-flex justify-content-center btn-group">
          <a type="button" href="<?php echo e(route('moodle.unlock')); ?>" class="btn btn-sm btn-primary">Desbloquear</a>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-12" id="position-buttons">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="results-table" class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Usuário</th>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Hora do bloqueio/desbloqueio</th>
                  <th>Instituição</th>
                </tr>
              </thead>
              <tbody>
                <?php for($i=0; $i < count($results); $i++): ?> <tr>
                  <td><?php echo e($results[$i]->username); ?></td>
                  <td><?php echo e($results[$i]->firstname); ?> <?php echo e($results[$i]->lastname); ?></td>
                  <td><?php echo e($results[$i]->email); ?> </td>
                  <td><?php echo e($results[$i]->time); ?></td>
                  <td><?php echo e($results[$i]->institution == "" ? "Cadastro incompleto" : $results[$i]->institution); ?></td>
                  </tr>
                  <?php endfor; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Cria um formato de data pt-br para ser utilizada no datatable.
  $.fn.dataTable.moment('DD/MM/YYYY HH:mm:ss');

  var table = $('#results-table').DataTable({
    responsive: true,
    order: [
      [4, "desc"]
    ],
    buttons: [{
        extend: 'excel',
        text: 'Excel',
        className: 'btn-sm',
      },
      {
        extend: 'print',
        text: 'Imprimir',
        className: 'btn-sm',
      },
    ],
    language: {
      search: "Buscar:",
      lengthMenu: "Mostrar _MENU_ Registros",
      zeroRecords: "Nenhum registro encontrado",
      info: "Mostrar _PAGE_ de _PAGES_ de _TOTAL_ Registros",
      infoEmpty: "Nenhum registro disponível",
      infoFiltered: "(filtrando de _MAX_ resultados)",
      loadingRecords: "Carregando...",
      processing: "Processando...",
      paginate: {
        next: "Próxima",
        previous: "Anterior"
      },
    }
  });
  table.buttons().containers().appendTo('#position-buttons');
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.template-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/midias.faculdadesensu.edu.br/midias/files/resources/views/painel-admin/moodle/index.blade.php ENDPATH**/ ?>