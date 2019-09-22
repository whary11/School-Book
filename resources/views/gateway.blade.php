<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/appcolegios.min.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

</head>
    <body class="sidebar-lg-show header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show brand-minimized sidebar-minimized">
       <div id="app" class="app">

        {{-- Componente principal --}}
        <index/>
    
        {{-- <footer class="app-footer">
             <div>
                 <!-- <a href="https://coreui.io">{{config('app.name', 'Laravel')}}</a> -->
                 <span>&copy; 2019 dev.</span>
             </div>
             <div class="ml-auto">
                 <span>Hecho por</span>
                 <!-- <a href="https://coreui.io">{{config('app.name', 'Laravel')}}</a> -->
             </div>
         </footer> --}}
       </div>
        <script src="{{asset('js/appcolegios.min.js')}}"></script>
    </body>



</html>