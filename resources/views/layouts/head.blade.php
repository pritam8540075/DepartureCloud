<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<!-- Fonts -->
<!-- <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/> -->
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/authentication/form-2.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('plugins/editors/markdown/simplemde.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/dt-global_style.css')}}">
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />


<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css



">
<!-- END GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.css')}}">
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
<!-- <script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script> -->
<script src="https://code.jquery.com/jquery-3.2.0.min.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="{{asset('jquery-ui/jquery-ui-min.js')}}"> -->
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
