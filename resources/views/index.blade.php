<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Faculdade SENSU">

    <title>Midias Faculdade Sensu</title>

    <!-- Custom fonts for this template-->
    <link href="{{ URL::asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ URL::asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css')}}" rel="stylesheet">
    
    <link href="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <!-- Bootstrap core JavaScript-->
    <script src="{{ URL::asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    
    <link rel="shortcut icon" href="{{ URL::asset('img/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{ URL::asset('img/favicon.ico')}}" type="image/x-icon">

</head>
<body>
    <div class="col-total">     
        <div class="col-botton">
            <img class="img-logo" src="{{ URL::asset('img/Asset 9@3x.png')}}" >
            <?php
              use App\Models\Link;
              $links = Link::orderby('id', 'desc')->paginate();  
            ?>
            @foreach ($links as $item)
            <p><a class="btn2" href="{{$item->link}}">{{$item->title}}</a></p>
            <hr >
            @endforeach
            <div class="icon">
                <a class= "icon-social" id="whatsapp" href="https://api.whatsapp.com/send?phone=556239334450" >.....</a>
                <a class= "icon-social" id="instagram" href="https://www.instagram.com/faculdade_sensu/">.....</a>
                <a class= "icon-social" id="facebook" href="https://www.facebook.com/faculdadesensu">.....</a>
                <a class= "icon-social" id="youtube" href="https://www.youtube.com/channel/UCS2qho79tP4hznASgyOFb0A?view_as=subscriber" >.....</a>
                <a class= "icon-social" id="linkdin" href="https://br.linkedin.com/company/faculdadesensu" >.....</a>
                <a class= "icon-social" id="twitter" href="https://twitter.com/FaculdadeSensu" >.....</a>
            </div>
           </div>
   </div>
    <footer class="footer122">        
         <div class="footer2">
        		<small class="d-block mb-3 text-muted">&copy; Powered by: FAS - 2020</small>
		</div>
	</footer>  
</body>
        <!--<script type="text/javascript" async src="https://d335luupugsy2.cloudfront.net/js/loader-scripts/d2db8af8-3ac5-4b11-962e-abf1a30aa282-loader.js" ></script>-->
        <!-- Core plugin JavaScript-->
        <script src="{{ URL::asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ URL::asset('js/sb-admin-2.min.js')}}"></script>

        <!-- Page level plugins -->
        <script src="{{ URL::asset('vendor/chart.js/Chart.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ URL::asset('js/demo/chart-area-demo.js')}}"></script>
        <script src="{{ URL::asset('js/demo/chart-pie-demo.js')}}"></script>

        <!-- Page level plugins -->
        <script src="{{ URL::asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ URL::asset('js/demo/datatables-demo.js')}}"></script>
        <script src="{{ URL::asset('js/mascaras.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
</html>
