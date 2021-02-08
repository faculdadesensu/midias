<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Administrador</title>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            background: radial-gradient(ellipse at center, #4a8dba 1%, #125591 70%);
            height: calc(100vh);
            font: 87.5%/1.5em 'Open Sans', sans-serif;
        }

        .logo {
            display: inline-block;
            height: 175px;
        }

        .fa {
            color: #000;
            font-size: 23px;
        }

        #logo-mobile {
            padding-bottom: 25px;
            text-align: center;
        }

        /* Responsividade descktop > 576px*/
        @media(min-width:576px) {
            .container {
                left: 50%;
                position: fixed;
                top: 50%;
                transform: translate(-50%, -50%);
            }

            #btn-entrar {
                text-align: right;
            }

            #login {
                border-right: 1px solid #fff;
            }
        }

        /* Responsividade mobile < 576px*/
        @media(max-width:576px) {
            .container {
                position: fixed;
                top: 20%;
            }

            #btn-entrar {
                text-align: center;
            }
        }
    </style>
</head>

<script>
    $(document).ready(function() {
        atualizaResponsividade();
    });

    $(window).resize(function() {
        atualizaResponsividade();
    });

    // Atualiza a posição da logo de acordo com a resolução da tela.
    function atualizaResponsividade() {
        var width = $(window).width();
        if (width < 576) {
            $("#logo-mobile").attr('hidden', false);
            $("#logo-desktop").attr('hidden', true);
        } else {
            $("#logo-mobile").attr('hidden', true);
            $("#logo-desktop").attr('hidden', false);
        }
    }
</script>

<body>
    <div class="main">
        <div class="container">
            <div class="row">
                <div id="login" class="offset-sm-2 col-sm-4 offset-1 col-10">
                    <div id="logo-mobile" class="col-sm-6" hidden>
                        <img class="logo" src="<?php echo e(URL::asset('img/Asset 9@3x.png')); ?>">
                    </div>
                    <form action="<?php echo e(route('login')); ?>" method="post">
                        <?php echo csrf_field(); ?>

                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text fa fa-user" id="input-group1"></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Usuário" name="username" aria-label="username" aria-describedby="input-group1" required>
                        </div>

                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text fa fa-lock" id="input-group2"></span>
                            </div>
                            <input type="password" class="form-control" placeholder="Senha" name="password" aria-label="password" aria-describedby="input-group2" required>
                        </div>
                        <div id="btn-entrar">
                            <input class="btn btn-lg btn-dark" type="submit" value="Entrar"></span>
                        </div>
                    </form>
                </div>
                <div id="logo-desktop" class="col-sm-6">
                    <img class="logo" src="<?php echo e(URL::asset('img/Asset 9@3x.png')); ?>">
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html><?php /**PATH C:\xampp\htdocs\midias\files\resources\views/login/index.blade.php ENDPATH**/ ?>