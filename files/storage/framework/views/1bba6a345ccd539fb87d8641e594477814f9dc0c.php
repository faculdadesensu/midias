
<?php $__env->startSection('title', 'Cadastro de Usuários'); ?>
<?php $__env->startSection('content'); ?>
<h6 class="mb-4"><i>CADASTRO DE USUÁRIOS</i></h6>
<hr>
<form method="POST" action="<?php echo e(route('users.insert')); ?>">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <label for="exampleInputEmail1">Nome</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome" required>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleInputEmail1">Usuário</label>
                <input type="text" class="form-control" name="username" placeholder="Ex: paula" required>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">E-mail</label>
                <input type="email" class="form-control" name="email" placeholder="Ex: exemplo@faculdadesensu.edu.br" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Tipo de Perfil</label>
                <select class="form-control" name="level">
                    <option value="admin">Administrador</option>
                    <option value="user">Usuário</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Senha</label>
                <input type="password" class="form-control" name="password" placeholder="Digite a Senha" required>
            </div>
        </div>
    </div>
    <div class="float-right">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.template-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/midias.faculdadesensu.edu.br/midias/resources/views/painel-admin/users/create.blade.php ENDPATH**/ ?>