<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/css/webslidemenu-effect.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/css/webslidemenu.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-5-select/css/bootstrap-select.min.css') }}"
    type="text/css" />
@yield('plugins_style')
<link rel="stylesheet" href="{{ asset('user/plugins/sweetalert2/sweetalert2.min.css') }}" />
<!-- Custom styles for this template -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css" />
<!-- Custom Fonts -->
<link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-N0CQYZ7B0Q"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-N0CQYZ7B0Q');
</script>
<style>
    .icon-footer {
        width: 30px;
        border-radius: 30px;
    }

    .box-footer .footer-copyright ul.-social.right {
        position: fixed;
        bottom: 70px;
        right: 0px;
        z-index: 10;
    }

    .box-footer .footer-copyright ul.-social.right li {
        display: block;
        padding: 6px;
    }

    .box-footer .footer-copyright ul.-social.right li .icon-footer {
        width: 50px;
        border-radius: 50px;
    }
</style>
