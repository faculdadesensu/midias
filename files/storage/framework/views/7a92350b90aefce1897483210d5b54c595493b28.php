
<?php $__env->startSection('title', 'Editar Link'); ?>
<?php $__env->startSection('content'); ?>
<h6 class="mb-4"><i> EDITAR LINK</i></h6><hr>
<form method="POST" action="<?php echo e(route('links.editar', $item)); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('put'); ?>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleInputEmail1">Titulo</label>
                <input value="<?php echo e($item->title); ?>" type="text" class="form-control" name="title" placeholder="Digite o Titulo" required>
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group">
                <label for="exampleInputEmail1">Link</label>
                <input value="<?php echo e($item->link); ?>" type="text" class="form-control" name="link" placeholder="Digite o link de redirecionamento." required>
            </div>
        </div>
    </div>
    <div class="float-right">
        <input value="<?php echo e($item->link); ?>" type="hidden" name="oldLink">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>

</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.template-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/midias.faculdadesensu.edu.br/midias/resources/views/painel-admin/links/edit.blade.php ENDPATH**/ ?>