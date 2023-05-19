<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="shortcut icon" href="../images/favicon.png" type="image/png">-->

    <title>Login Admin</title>

    <link rel="stylesheet" href="{{asset('admin/themes/lib/fontawesome/css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{asset('admin/themes/css/quirk.css')}}">

    <script src="{{asset('admin/themes/lib/modernizr/modernizr.js')}}"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>

    <![endif]-->
</head>

<body class="signwrapper">

<div class="sign-overlay"></div>
<div class="signpanel"></div>

<div class="panel signin">
    <div class="panel-heading">
        <h1>Lienketso</h1>
        <h4 class="panel-title">Xin chào, vui lòng đăng nhập</h4>
    </div>
    <div class="panel-body">

        @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <strong>Error !</strong>
                @foreach ($errors->all() as $e)
                    <div>{{$e}}</div>
                @endforeach
            </div>
        @endif

        <form method="post" action="">
            {{ csrf_field() }}
            <div class="form-group mb10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" name="email" value="<?= old('email') ?>" placeholder="Email đăng nhập" required>
                </div>
            </div>
            <div class="form-group nomargin">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required>
                </div>
            </div>
            <div><a href="mailto:thanhan1507@gmail.com" class="forgot">Quên mật khẩu ?</a></div>
            <div class="form-group">
                <button class="btn btn-success btn-quirk btn-block">Đăng nhập</button>
            </div>
        </form>
        <hr class="invisible">
        <div class="form-group">
            <a href="#" target="_blank" class="btn btn-default btn-quirk btn-stroke btn-stroke-thin btn-block btn-sign">Không phải thành viên </a>
        </div>
    </div>
</div><!-- panel -->

</body>
</html>
