<!--favicon-->
<link rel="shortcut icon" type="image/png" href="{{ asset('/style/images/favicon.png') }}" sizes="45x31" />
<link href="{{ asset('/style/css/bootstrap.min.css') }}" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
    rel="stylesheet">
<link href="{{ asset('/style/css/webslidemenu-effect.css') }}" rel="stylesheet">
<link href="{{ asset('/style/css/webslidemenu.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('/style/css/slick.css') }}" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100;0,9..40,200;0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;0,9..40,900;0,9..40,1000;1,9..40,100;1,9..40,200;1,9..40,300;1,9..40,400;1,9..40,500;1,9..40,600;1,9..40,700;1,9..40,800;1,9..40,900;1,9..40,1000&display=swap"
    rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
<script src="https://kit.fontawesome.com/403438a92a.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('/style/css/mobiscroll.jquery.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
@yield('style')
<link rel="stylesheet" type="text/css" href="{{ asset('/style/css/style.css') }}">
@if (in_array(Route::currentRouteName(), ['demo.blog.detail', 'demo.destination.detail']))
    <script type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=65dd20dcd41ded001ab5b52f&product=inline-share-buttons&source=platform"
        async="async"></script>
@endif
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
    @media (max-width: 932px) {
        .scroll-to-top {
            display: none !important;
        }

        .call-to-action {
            bottom: 30px !important;
        }

        .wsmenu>.wsmenu-list {
            border-radius: 0px !important;
        }

        .wsmenu>.wsmenu-list>li>a {
            padding: 8px 32px 8px 17px !important;
        }

        .wsmenu>.wsmenu-list>li>a.active {
            border-radius: 50px !important;
        }
    }
</style>
