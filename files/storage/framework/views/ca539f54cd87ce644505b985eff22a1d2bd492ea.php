
<?php $__env->startSection('title', 'Cadastro de Links'); ?>
<?php $__env->startSection('content'); ?>
<h6 class="mb-4"><i>CADASTRO DE LINKS</i></h6>
<hr>
<form method="POST" action="<?php echo e(route('links.insert')); ?>">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleInputEmail1">Titulo</label>
                <input type="text" class="form-control" name="title" placeholder="Digite o Titulo" required>
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group">
                <label for="exampleInputEmail1">Link</label>
                <input type="text" class="form-control" name="link" placeholder="Digite o link de redirecionamento." required>
            </div>
        </div>
    </div>
    <div class="float-right">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.template-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\midias\resources\views/painel-admin/links/create.blade.php ENDPATH**/ ?>