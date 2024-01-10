<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME')}} - @yield('title')</title>

    @include('layouts.headerstyle')

    <style>
        .invalid {
            color: red;
        }
    </style>
</head>

<body class="dashboard dashboard_2">
    <div class="full_container">
        <div class="inner_container">
            <!-- Navbar -->
            @include('layouts.sidebar')
            <!-- /.navbar -->

            <!-- Content Wrapper. Contains page content -->
            <div id="content">
                <div class="content-wrapper">
                    @include('layouts.navbar')
                    @yield('content')
                </div>
                <!-- Navbar -->
                
                <!-- /.navbar -->
                <!-- /.content-wrapper -->

            </div>
        </div>
        @include('layouts.footerscript')
        @yield('js')
    </div>
</body>

</html>