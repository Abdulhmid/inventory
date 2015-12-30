<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{!! isset($title) ? $title : "Inventory" !!} | Inventory</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="icon"  href="{!! asset('photo/logo-square.png') !!}"/>
        <link href="{!! asset('plugins/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!! asset('plugins/icon/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!! asset('plugins/icon/ionicons/css/ionicons.min.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!! asset('css/AdminLTE/AdminLTE.min.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!! asset('css/additional.css') !!}" rel="stylesheet" type="text/css" />

        <link href="{!! asset('css/AdminLTE/skins/_all-skins.min.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!! asset('plugins/jquery-image-manipulation/jquery.nailthumb.1.1.min.css') !!}" rel="stylesheet" type="text/css" />

        <style type="text/css">
            .square-thumb {
                width: 20px;
                height: 20px;
                display: block;
            }
        </style>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        @yield('style')

    </head>
    <body class="skin-blue sidebar-mini">
        <div class="wrapper">

            @include('partial.header')
            <!-- Left side column. contains the logo and sidebar -->
            @include('partial.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="min-height:648px">
                <section class="content-header">
                        <h1>{!! $title !!}</h1>
                        <ol class="breadcrumb">
                            <li><a href="{!! url('/') !!}"><i class="fa fa-dashboard"></i> Beranda</a></li>
                            {!! Breadcrumb::render([''.$breadcrumb.'']) !!}
                        </ol>
                </section>
                <!-- Main content -->
                @yield('content')

            </div><!-- /.content-wrapper -->

            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class='control-sidebar-bg'></div>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.3 -->
        <script src="{!! asset('plugins/jQuery/jQuery-2.1.3.min.js') !!}" type="text/javascript"></script>
        <!-- jQuery UI 1.11.2 -->
        <script src="{!! asset('plugins/jQueryUI/jquery-ui.min.js') !!}" type="text/javascript"></script>
        <script src="{!! asset('plugins/jquery-cookies/jquery.cookie.js') !!}" type="text/javascript"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button);</script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="{!! asset('plugins/bootstrap/js/bootstrap.min.js') !!} " type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="{!! asset('js/app.min.js') !!}" type="text/javascript"></script>
        <script type="text/javascript">
            //  jQuery('.nailthumb-container').nailthumb();
            $('.autohide').delay(5000).fadeOut('slow');
        </script>

        @yield('script')

    </body>
</html>
