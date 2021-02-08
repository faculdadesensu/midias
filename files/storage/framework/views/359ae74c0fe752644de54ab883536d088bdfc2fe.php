
<?php $__env->startSection('title', 'Bloqueio e Desbloqueio Moodle'); ?>
<?php $__env->startSection('content'); ?>

<link href="<?php echo e(URL::asset('vendor/datatables/buttons.bootstrap4.min.css')); ?>" rel="stylesheet">

<script src="<?php echo e(URL::asset('vendor/datatables/dataTables.buttons.min.js')); ?>?<?php echo e($version); ?>"></script>
<script src="<?php echo e(URL::asset('vendor/datatables/buttons.bootstrap4.min.js')); ?>?<?php echo e($version); ?>"></script>
<script src="<?php echo e(URL::asset('vendor/datatables/jszip.min.js')); ?>?<?php echo e($version); ?>"></script>
<script src="<?php echo e(URL::asset('vendor/datatables/buttons.html5.min.js')); ?>?<?php echo e($version); ?>"></script>
<script src="<?php echo e(URL::asset('vendor/datatables/buttons.print.min.js')); ?>?<?php echo e($version); ?>"></script>
<script src="<?php echo e(URL::asset('vendor/datatables/moment.min.js')); ?>?<?php echo e($version); ?>"></script>
<script src="<?php echo e(URL::asset('vendor/datatables/datetime-moment.js')); ?>?<?php echo e($version); ?>"></script>

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
    "responsive": true,
    "processing": true,
    "serverSide": true,
    "autoWidth": true,
    "ajax": {
      url: "<?php echo e(route('moodle.index')); ?>",
      error: function(data) {
          alert("Erro desconhecido!");
        },
    },
    "order": [
      [3, "desc"]
    ],
    "buttons": [{
        "extend": 'excel',
        "text": 'Excel',
        "className": 'btn-sm',
      },
      {
        "extend": 'print',
        "text": 'Imprimir',
        "className": 'btn-sm',
      },
    ],
    "language": {
      "search": "Buscar:",
      "lengthMenu": "Mostrar _MENU_ Registros",
      "zeroRecords": "Nenhum registro encontrado",
      "info": "Mostrar _PAGE_ de _PAGES_ de _TOTAL_ Registros",
      "infoEmpty": "Nenhum registro disponível",
      "infoFiltered": "(filtrando de _MAX_ resultados)",
      "loadingRecords": "Carregando...",
      "processing": "Processando...",
      "paginate": {
        "next": "Próxima",
        "previous": "Anterior"
      },
    },

    "columns": [{
        "data": "username",
        "name": "username",
      },
      {
        "data": function(data) {
          return data.firstname + " " + data.lastname;
        },
        "name": "nome",
      },
      {
        "data": "email",
        "name": "email",
      },
      {
        "data": "time",
        "name": "time",
        "render": function(data, type, row) {
          return moment(data).format('DD/MM/YYYY HH:mm:ss');
        },
      },
      {
        "data": function(data) {
          if (data.institution === "" || data.institution === null) {
            return "Cadastro incompleto";
          } else {
            return data.institution;
          }
        },
        "name": "institution",
      }
    ],
    "initComplete": function() {
      var input = $('.dataTables_filter input').unbind();
      self = this.api();

      // Realiza a pesquisa sempre que pressionado Enter dentro do input de pesquisa. 
      $('.dataTables_filter input').keyup(function(e) {
        if (e.keyCode == 13) {
          self.search($(this).val()).draw();
        }
      });

      // Cria o botão de pesquisa com a função respectiva.
      $searchButton = $('<button class="btn btn-sm btn-primary ml-2" style="margin-top: -1px;"><i class="fas fa-search">').click(function() {
        self.search(input.val()).draw();
      });

      // Adiciona o botão de pesquisa ao filtro da tabela 
      $('.dataTables_filter').append($searchButton);
    },
  });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.template-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\midias\files\resources\views/painel-admin/moodle/index.blade.php ENDPATH**/ ?>