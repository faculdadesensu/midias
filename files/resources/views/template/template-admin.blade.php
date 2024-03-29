<?php

use Illuminate\Support\Facades\DB;

@session_start();
$id_usuario = @$_SESSION['id_user'];
$usuario = DB::select('select * from users where id =' . $id_usuario);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Faculdade SENSU">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ URL::asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ URL::asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('vendor/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Global custom scripts -->
    <script src="{{ URL::asset('js/global.js') }}?{{$version}}"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ URL::asset('vendor/jquery/jquery.min.js') }}?{{$version}}"></script>
    <script src="{{ URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}?{{$version}}"></script>

    <link rel="shortcut icon" href="{{ URL::asset('img/logo_sig.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ URL::asset('img/logo_sig.png') }}" type="image/x-icon">

    <!-- Page level plugins -->
    <script src="{{ URL::asset('vendor/datatables/jquery.dataTables.min.js') }}?{{$version}}"></script>
    <script src="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.js') }}?{{$version}}"></script>
    <script src="{{ URL::asset('vendor/datatables/dataTables.responsive.min.js') }}?{{$version}}"></script>
    <script src="{{ URL::asset('vendor/datatables/responsive.bootstrap4.min.js') }}?{{$version}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ URL::asset('js/demo/datatables-demo.js') }}?{{$version}}"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">

                <div class="sidebar-brand-text mx-3">Administrador</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Cadastros
            </div>
            @if ($_SESSION['level'] == 'admin')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users"></i>
                    <span> Cadastro Pessoas</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('users.index')}}">Usuários</a>
                    </div>
                </div>

            </li>
            @endif
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-link"></i>
                    <span>Cadastro de Links</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('links.index')}}">Links</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}" target="_blank">
                    <i class="fas fa-home fa-chart"></i>
                    <span>Pagina Principal</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('chart')}}">
                    <i class="fas fa-chart-line"></i>
                    <span>Gráfico</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            @if ($_SESSION['level'] == 'admin')
            <!-- Heading -->
            <div class="sidebar-heading">
                MOODLE
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOperacoes" aria-expanded="true" aria-controls="collapseOperacoes">
                    <i class="fas fa-wrench"></i>
                    <span> Ações</span>
                </a>
                <div id="collapseOperacoes" class="collapse" aria-labelledby="headingOperacoes" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('moodle.index')}}">Bloqueio/Desbloqueio</a>
                        <a class="collapse-item" href="{{ route('moodle.ignorados')}}">Lista de liberações</a>
                    </div>

                </div>
            </li>
            @endif
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div align="right" class="mr-2">v{{ $version }}</div>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$usuario[0]->name}}</span>
                                <img class="img-profile rounded-circle" src="{{ URL::asset('img/sem-foto.jpg') }}">

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ModalPerfil">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-primary"></i>
                                    Editar Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('users.logout')}}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                    Sair
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="alert alert-success alert-position" role="alert" id="success-alert" hidden>
                        <span id="success-msg"></span>
                    </div>

                    <div class="alert alert-danger" role="alert" id="danger-alert" hidden>
                        <span id="danger-msg"></span>
                    </div>

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!--  Modal Perfil-->
    <div class="modal fade" id="ModalPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form id="form-perfil" method="POST" action="{{ route('admin.edit', $id_usuario) }}">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nome</label>
                            <input value="{{$usuario[0]->name}}" type="text" class="form-control" name="name" placeholder="Nome">
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input value="{{$usuario[0]->username}}" type="text" class="form-control cpf" name="username" placeholder="Usuário">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input value="{{$usuario[0]->email}}" type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" class="form-control" id="senha" name="password" placeholder="Senha">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="btn-salvar-perfil" id="btn-salvar-perfil" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(\Session::has('success'))
    <script>
        $(document).ready(function() {
            alertMsg('success', "{{utf8_decode(\Session::get('success'))}}");
        });
    </script>
    @elseif(\Session::has('error'))
    <script>
        $(document).ready(function() {
            alertMsg('error', "{{utf8_decode(\Session::get('error'))}}");
        });
    </script>
    @endif

    <!-- Core plugin JavaScript-->
    <script src="{{ URL::asset('vendor/jquery-easing/jquery.easing.min.js') }}?{{$version}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ URL::asset('js/sb-admin-2.min.js') }}?{{$version}}"></script>

    <!-- Page level plugins -->
    <script src="{{ URL::asset('vendor/chart.js/Chart.min.js') }}?{{$version}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ URL::asset('js/demo/chart-area-demo.js') }}?{{$version}}"></script>
    <script src="{{ URL::asset('js/demo/chart-pie-demo.js') }}?{{$version}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('js/mascaras.js') }}?{{$version}}"></script>
</body>

</html>