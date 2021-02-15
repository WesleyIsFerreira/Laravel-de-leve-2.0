<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('cute-alert-master/style.css') }}">
    <style>
        body{
            margin-top: 20px;
        }
    </style>
</head>
<body style="background-image: url('{{ asset('img/stampa2.jpg') }}');">
    <div class="container">
        <main role="main">
            @hasSection ('body')
                @yield('body')
            @endif
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('cute-alert-master/cute-alert.js') }}" type="text/javascript"></script>

    @hasSection ('javascript')
        @yield('javascript')  
    @endif

</body>
</html>