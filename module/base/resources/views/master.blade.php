<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="shortcut icon" href="images/favicon.png" type="image/png">-->

    <title>Hệ thống quản trị web</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset('admin/themes/lib/Hover/hover.css')}}">
    <link rel="stylesheet" href="{{asset('admin/themes/lib/fontawesome/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('admin/themes/lib/weather-icons/css/weather-icons.css')}}">
    <link rel="stylesheet" href="{{asset('admin/themes/lib/ionicons/css/ionicons.css')}}">
    <link rel="stylesheet" href="{{asset('admin/themes/lib/jquery-toggles/toggles-full.css')}}">
    <link rel="stylesheet" href="{{asset('admin/themes/lib/morrisjs/morris.css')}}">

    <link rel="stylesheet" href="{{asset('admin/themes/css/quirk.css')}}">

    <script src="{{asset('admin/themes/lib/modernizr/modernizr.js')}}"></script>
    <link rel="stylesheet" href="{{asset('admin/libs/confirm/jquery-confirm.css')}}">
    <link rel="stylesheet" href="{{asset('admin/jquery.notify.css')}}">
    <link rel="stylesheet" href="{{asset('admin/fix.css')}}">
{{--    <meta http-equiv="refresh" content="10">--}}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{asset('admin/themes/lib/html5shiv/html5shiv.js')}}"></script>
    <script src="{{asset('admin/themes/lib/respond/respond.src.js')}}"></script>
    <![endif]-->
    @yield('css')
    @stack('css')
</head>

<body>

<header>
    @include('wadmin-dashboard::header')
</header>

<section>

    @include('wadmin-dashboard::sidebar')

    <div class="mainpanel">

        <!--<div class="pageheader">
          <h2><i class="fa fa-home"></i> Dashboard</h2>
        </div>-->

        <div class="contentpanel">
            @yield('content')
        </div><!-- contentpanel -->

    </div><!-- mainpanel -->

</section>

<script src="{{asset('admin/themes/lib/jquery/jquery.js')}}"></script>
<script src="{{asset('admin/themes/lib/jquery-ui/jquery-ui.js')}}"></script>
<script src="{{asset('admin/themes/lib/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{asset('admin/themes/lib/jquery-toggles/toggles.js')}}"></script>

{{--<script src="{{asset('admin/themes/lib/morrisjs/morris.js')}}"></script>--}}
<script src="{{asset('admin/themes/lib/raphael/raphael.js')}}"></script>

{{--<script src="{{asset('admin/themes/lib/flot/jquery.flot.js')}}"></script>--}}
{{--<script src="{{asset('admin/themes/lib/flot/jquery.flot.resize.js')}}"></script>--}}
{{--<script src="{{asset('admin/themes/lib/flot-spline/jquery.flot.spline.js')}}"></script>--}}

<script src="{{asset('admin/themes/lib/jquery-knob/jquery.knob.js')}}"></script>

<script src="{{asset('admin/themes/js/quirk.js')}}"></script>
<script src="{{asset('admin/themes/js/dashboard.js')}}"></script>
<script src="{{asset('admin/libs/ckfinder/ckfinder.js')}}"></script>
<script src="{{asset('admin/libs/confirm/jquery-confirm.js')}}"></script>
<script src="{{asset('admin/notify.js')}}"></script>
<script src="{{asset('admin/ajax.js')}}"></script>

<script type="text/javascript">
    // auto close
    $('.example-p-6').on('click', function(e){
        e.preventDefault();
        let _this = $(e.currentTarget);
        let url = _this.attr('data-url');
        $.confirm({
            title: 'Xác nhận xóa',
            content: 'Bạn có chắc chắn muốn xóa dữ liệu không',
            autoClose: 'cancelAction|10000',
            escapeKey: 'cancelAction',
            buttons: {
                confirm: {
                    btnClass: 'btn-red',
                    text: 'Xóa dữ liệu',
                    action: function(){
                        location.href = url;
                    }
                },
                cancelAction: {
                    text: 'Hủy',
                    action: function(){
                        $.alert('Đã hủy xóa dữ liệu !');
                    }
                }
            }
        });
    });


</script>

<script type="text/javascript">
    var ckfinder_url = "{{asset('admin/libs/ckfinder')}}";
    var  editedField;
    function browseServer(){
        var finder = new CKFinder();
        finder.BasePath = ckfinder_url;
        finder.SelectFunction = SetFileField;
        finder.Popup();
    }
    function SetFileField(fileurl){
        document.getElementById('xFilePath').value = fileurl;
        document.getElementById('imgreview').src = fileurl;
    }
    function browseServerSetting(field){
        editedField = field;
        var finder = new CKFinder();
        finder.BasePath = ckfinder_url;
        finder.SelectFunction =  SetFileFieldSetting;
        finder.Popup();
    }
    function SetFileFieldSetting(field,fileurl){
        document.getElementById(editedField).value = fileurl.fileUrl;
    }

    var button1 = document.getElementById( 'ckfinder-popup-1' );
    button1.onclick = function() {
        selectFileWithCKFinder( 'ckfinder-input-1' );
    };
    var button2 = document.getElementById( 'ckfinder-popup-2' );
    button2.onclick = function() {
        selectFileWithCKFinder( 'ckfinder-input-2' );
    };
    var button3 = document.getElementById( 'ckfinder-popup-3' );
    button3.onclick = function() {
        selectFileWithCKFinder( 'ckfinder-input-3' );
    };
    var button4 = document.getElementById( 'ckfinder-popup-4' );
    button4.onclick = function() {
        selectFileWithCKFinder( 'ckfinder-input-4' );
    };
    var button5 = document.getElementById( 'ckfinder-popup-5' );
    button5.onclick = function() {
        selectFileWithCKFinder( 'ckfinder-input-5' );
    };
    var button6 = document.getElementById( 'ckfinder-popup-6' );
    button6.onclick = function() {
        selectFileWithCKFinder( 'ckfinder-input-6' );
    };
    function selectFileWithCKFinder( elementId ) {
        CKFinder.popup( {
            chooseFiles: true,
            width: 800,
            height: 600,
            onInit: function( finder ) {
                finder.on( 'files:choose', function( evt ) {
                    var file = evt.data.files.first();
                    var output = document.getElementById( elementId );
                    output.value = file.getUrl();
                } );

                finder.on( 'file:choose:resizedImage', function( evt ) {
                    var output = document.getElementById( elementId );
                    output.value = evt.data.resizedUrl;
                } );
            }
        } );
    }
</script>

@yield("js")
@yield("js-init")
@stack("js")
@stack("js-init")

@yield("css")
@yield("css-init")
@stack("css")
@stack("css-init")

</body>
</html>
