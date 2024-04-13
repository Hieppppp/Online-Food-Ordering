<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{asset('/frontend')}}/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="{{asset('/frontend')}}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{asset('/frontend')}}/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{asset('/frontend')}}/css/style.css" rel="stylesheet">
        <style>
            .alert-container {
                position: fixed;
                top: 20px; /* Điều chỉnh khoảng cách từ mép trên của màn hình */
                right: 20px; /* Điều chỉnh khoảng cách từ mép phải của màn hình */
                z-index: 10000; /* Đảm bảo thông báo hiển thị trên tất cả các phần tử khác */
            }
            .StripeElement {
            box-sizing: border-box;

            height: 40px;

            padding: 10px 12px;

            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
            }

            .StripeElement--focus {
                box-shadow: 0 1px 3px 0 #cfd7df;
            }

            .StripeElement--invalid {
                border-color: #fa755a;
            }

            .StripeElement--webkit-autofill {
                background-color: #fefde5 !important;
            }
        </style>
        @kropifyStyles 
    </head>

    <body>

		@include('FrontEnd.include.header')

		@include('FrontEnd.include.banner')

        
		@yield('content')

        @include('FrontEnd.include.footer')



        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/frontend')}}/lib/easing/easing.min.js"></script>
    <script src="{{asset('/frontend')}}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{asset('/frontend')}}/lib/lightbox/js/lightbox.min.js"></script>
    <script src="{{asset('/frontend')}}/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{asset('/frontend')}}/js/main.js"></script>
    <script>
    // Tự động đóng thông báo sau 3 giây
        window.setTimeout(function() {
            $("#autoCloseAlert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 3000);
    </script>
    @kropifyScripts
 
    <script src="{{asset('js/profileupdate.js')}}"></script>
    </body>
</html>