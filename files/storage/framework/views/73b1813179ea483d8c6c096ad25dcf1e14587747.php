
<?php $__env->startSection('title', 'Lista de usuários'); ?>
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
<h2 class="mb-4"><i>Lista de usuários cadastrados no Moodle <?php echo e($moodle); ?></i></h2>
<a href="<?php echo e(route('moodle.ignorados')); ?>" type="button" class="mb-3 btn btn-primary">Voltar para lista</a>
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table id="dataTable_users" class="table table-bordered" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Usuário</th>
            <th>E-mail</th>
            <th>Ações</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {

    var route = "";
    if ("<?php echo e($moodle); ?>" === "A") {
      route = "<?php echo e(route('moodle.listA')); ?>"
    } else if ("<?php echo e($moodle); ?>" === "B") {
      route = "<?php echo e(route('moodle.listB')); ?>"
    }

    var dataTable = $('#dataTable_users').DataTable({
      "responsive": true,
      "processing": true,
      "serverSide": true,
      "autoWidth": true,
      "ajax": {
        url: route,
        error: function(data) {
          alert("Erro desconhecido!");
        },
      },
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
          "data": function(data) {
            return data.firstname + " " + data.lastname;
          },
          "name": "nome",
        },
        {
          "data": "username",
          "name": "username",
        },
        {
          "data": "email",
          "name": "email",
        },
        {
          "data": function(data) {
            return '<form action="<?php echo e(route("moodle.add")); ?>" method="get"><?php echo csrf_field(); ?><input type="hidden" name="user_id" value="' + data.id + '"><input type="hidden" name="username" value="' + data.username + '"><input type="hidden" name="firstname" value="' + data.firstname + '"><input type="hidden" name="lastname" value="' + data.lastname + '"><input type="hidden" name="email" value="' + data.email + '"><input type="hidden" name="moodle" value="<?php echo e($moodle); ?>"><button title="Adicionar na lista"  class="btn btn-primary" type="submit">Adicionar</button></form>';
          },
          "name": "acoes",
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
  });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.template-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\midias\files\resources\views/painel-admin/moodle/users.blade.php ENDPATH**/ ?>