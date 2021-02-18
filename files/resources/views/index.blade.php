<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Faculdade SENSU">

    <title>Midias Faculdade Sensu</title>

    <link href="{{ URL::asset('css/style_index.css')}}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ URL::asset('img/logo_sig.png')}}" type="image/x-icon">
    <link rel="icon" href="{{ URL::asset('img/logo_sig.png')}}" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <div class="col-total">
        <div class="col-botton">
            <img class="img-logo" src="{{ URL::asset('img/Asset 9@3x.png')}}">
            <?php

            use App\Models\Link;

            $links = Link::orderby('id', 'desc')->paginate();
            // Variável contador para verificar quando é a ultima linha.
            $count = 0;
            ?>
            @foreach ($links as $item)
            <?php $count++; ?>
            @if($links->count() != $count)
            <p><a class="btn" href="{{$item->link}}" target="_blank">{{$item->title}}</a></p>
            <hr size=1px>
            @else
            <p><a id="btn-botton" class="btn" href="{{$item->link}}" target="_blank">{{$item->title}}</a></p>
            @endif
            @endforeach
            <div class="icon">
                <a class="icon-social" id="whatsapp" href="https://api.whatsapp.com/send?phone=556239334450" target="_blank">.....</a>
                <a class="icon-social" id="instagram" href="https://www.instagram.com/faculdade_sensu/" target="_blank">.....</a>
                <a class="icon-social" id="facebook" href="https://www.facebook.com/faculdadesensu" target="_blank">.....</a>
                <a class="icon-social" id="youtube" href="https://www.youtube.com/channel/UCS2qho79tP4hznASgyOFb0A?view_as=subscriber" target="_blank">.....</a>
                <a class="icon-social" id="linkdin" href="https://br.linkedin.com/company/faculdadesensu" target="_blank">.....</a>
                <a class="icon-social" id="twitter" href="https://twitter.com/FaculdadeSensu" target="_blank">.....</a>
            </div>
        </div>
    </div>
    <footer class="footer1">
        <div class="footer">
            <small class="d-block mb-3 text-muted">&copy; Powered by: FAS - 2020</small>
        </div>
    </footer>
</body>
<script type="text/javascript" async src="https://d335luupugsy2.cloudfront.net/js/loader-scripts/d2db8af8-3ac5-4b11-962e-abf1a30aa282-loader.js"></script>

</html>