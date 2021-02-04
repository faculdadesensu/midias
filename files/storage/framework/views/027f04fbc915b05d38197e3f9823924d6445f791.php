
<?php $__env->startSection('title', 'Editar Usuário'); ?>
<?php $__env->startSection('content'); ?>
<h6 class="mb-4"><i> EDITAR USUÁRIO</i></h6>
<hr>
<form method="POST" action="<?php echo e(route('users.editar', $item)); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('put'); ?>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Nome</label>
                <input value="<?php echo e($item->name); ?>" type="text" class="form-control" placeholder="Digite seu nome" id="name" name="name" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Usuário</label>
                <input value="<?php echo e($item->username); ?>" type="text" class="form-control" placeholder="Ex: administrador" name="username" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">E-mail</label>
                <input value="<?php echo e($item->email); ?>" type="email" class="form-control" placeholder="Ex: exemplo@faculdadesensu.edu.br" name="email" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Senha</label>
                <input value="<?php echo e($item->password); ?>" type="password" class="form-control" placeholder="Digite a Senha" name="password">
            </div>
        </div>
    </div>
    <div class="float-right">
        <input value="<?php echo e($item->username); ?>" type="hidden" name="oldUsername">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.template-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/midias.faculdadesensu.edu.br/midias/resources/views/painel-admin/users/edit.blade.php ENDPATH**/ ?>