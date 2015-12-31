<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $title or "EMPsuite" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <script src="{{ asset("/assets/libraries/jQuery/jQuery-2.1.4.min.js") }}"></script>
    @if((isset($additionalLibs)) and (count($additionalLibs)>0))
        @foreach($additionalLibs as $additionalLib)
            <script src="{{ asset("/assets/".$additionalLib)}}"></script>
        @endforeach
    @endif

    <link href="{{ asset("/assets/libraries/bootstrap/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/assets/theme/backend/default/dist/css/AdminLTE.css")}}" rel="stylesheet" type="text/css" />
    @if((isset($additionalCsss)) and (count($additionalCsss)>0))
        @foreach($additionalCsss as $additionalCss)
    <link href="{{ asset("/assets/".$additionalCss) }}" rel="stylesheet" type="text/css" media="all" />
        @endforeach
    @endif
    <link href="{{ asset("/assets/theme/backend/default/dist/css/skins")}}/{{$skin or "skin-blue-light"}}.min.css" rel="stylesheet" type="text/css" />
    <script src="{{ asset("/assets/libraries/sweetalert/dist/sweetalert.min.js") }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset("/assets/libraries/sweetalert/dist/sweetalert.css")}}">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>
<body class="{{$skin or "skin-blue-light"}} sidebar-mini">
<div class="wrapper">

    <!-- Header -->
    @include('backend.default.inc.header')

            <!-- Sidebar -->
    @include('backend.default.inc.sidebar')

            <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{$module['SubTitle'] or "Backend Management"}}
                <small><a href="{{$module['URL'] or "#"}}">{{ $module['Title'] or null }}</a></small>
            </h1>
        </section>
        <section class="content">
            {!! $content or 'hello'!!}
        </section>

    </div><!-- /.content-wrapper -->

    <!-- Footer -->
@include('backend.default.inc.footer')

</div>
@include('sweet::alert')
<script src="{{ asset("/assets/libraries/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/assets/theme/backend/default/dist/js/app.js") }}" type="text/javascript"></script>

</body>
</html>