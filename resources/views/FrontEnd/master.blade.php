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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('/frontend')}}/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="{{asset('/frontend')}}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('/frontend')}}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('/frontend')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('/frontend')}}/css/blog.css" rel="stylesheet">

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
    <script src="{{asset('/frontend')}}/js/profileupdate.js"></script>

    <!-- <script src="{{ asset('frontend/cart.js') }}"></script> -->
    <!-- <script src="{{ asset('js/cart.js') }}"></script> -->

    <!-- Template Javascript -->
    <script src="{{asset('/frontend')}}/js/main.js"></script>
    <script>
        // Tự động đóng thông báo sau 3 giây
        window.setTimeout(function () {
            $("#autoCloseAlert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 3000);
    </script>
    @kropifyScripts

    <script>
        $(document).ready(function () {
            $('.add-to-cart').on('click', function (e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                var token = "{{ csrf_token() }}";
                $.ajax({
                    type: 'POST',
                    url: '/add-to-cart/' + productId,
                    data: {
                        _token: token
                    },
                    success: function (response) {
                        // Hiển thị thông báo thành công
                        showAlert(response.message, 'success');
                        // Cập nhật số lượng sản phẩm trong biểu tượng giỏ hàng
                        updateCartQuantity(response.cart_count);

                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText); // Hiển thị lỗi nếu có
                    }
                });
            });
        });

        //Xóa sản phẩm
        $(document).ready(function(){
            $('.cart_remove').on('click',function(e){
                e.preventDefault();
                var productId = $(this).data('id');
                var token = "{{ csrf_token() }}";

                $.ajax({
                    type:'POST',
                    url:'/remove-cart/' +productId,
                    data:{
                        id:productId,
                        _token:token
                    },
                    success:function(response){
                        showAlert(response.message, 'success');
                        $('.cart-quantity').text(response.cart_count);
                        $('tr[data-id="' + productId + '"]').remove();
                    },
                    error:function(xhr,status,error){
                        console.error(xhr.responseText);
                    }

                })
            })
        });


        function showAlert(message, type) {
            var alertClass = 'alert-success'; // Mặc định là alert-success
            if (type === 'error') {
                alertClass = 'alert-danger';
            }
            var alertHtml = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                '<strong>' + message + '</strong>' +
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                '</div>';
            $('.alert-container').html(alertHtml); // Chèn thông báo vào phần tử có class alert-container
        }

        function updateCartQuantity(quantity) {
            $('.cart-quantity').text(quantity); // Cập nhật số lượng sản phẩm trong biểu tượng giỏ hàng
        }

        // $(document).ready(function(){
        //     // Xử lý sự kiện khi nhấn nút "Thêm"
        //     $('.btn-plus').on('click', function(e){
        //         e.preventDefault();
        //         var inputQuantity = $(this).closest('.input-group').find('input[name="quantity"]');
        //         var quantity = parseInt(inputQuantity.val());
        //         inputQuantity.val(quantity + 1);
        //         updateSubtotal(inputQuantity);
        //         updateTotal();
        //     });

        //     // Xử lý sự kiện khi nhấn nút "Bớt"
        //     $('.btn-minus').on('click', function(e){
        //         e.preventDefault();
        //         var inputQuantity = $(this).closest('.input-group').find('input[name="quantity"]');
        //         var quantity = parseInt(inputQuantity.val());
        //         if (quantity > 1) {
        //             inputQuantity.val(quantity - 1);
        //             updateSubtotal(inputQuantity);
        //             updateTotal();
        //         }
        //     });

        //     // Xử lý sự kiện khi gửi form cập nhật giỏ hàng
        //     $('#update-cart-form').on('submit', function(e){
        //         e.preventDefault();
        //         var formData = $(this).serialize();
        //         var url = $(this).attr('action');
                
        //         $.ajax({
        //             type: 'POST',
        //             url: url,
        //             data: formData,
        //             success: function(response) {
        //                 // Xử lý phản hồi thành công
        //                 console.log(response);
        //             },
        //             error: function(xhr, status, error) {
        //                 // Xử lý lỗi
        //                 console.error(xhr.responseText);
        //             }
        //         });
        //     });

        //     // // Hàm cập nhật tổng số tiền cho mỗi sản phẩm
        //     // function updateSubtotal(inputQuantity) {
        //     //     var quantity = parseInt(inputQuantity.val());
        //     //     var price = parseFloat(inputQuantity.closest('tr').find('.price').text().replace('.', '').replace(' VNĐ', '').replace(',000', ''));
        //     //     var subtotal = quantity * price * 1000; // Nhân với 1000 để chuyển đổi thành VNĐ
        //     //     inputQuantity.closest('tr').find('.subtotal').text(subtotal.toLocaleString('vi-VN') + ' VNĐ');
        //     // }

        //     // // Hàm cập nhật tổng số tiền của giỏ hàng
        //     // function updateTotal() {
        //     //     var total = 0;
        //     //     $('.subtotal').each(function() {
        //     //         var subtotal = parseFloat($(this).text().replace('.', '').replace(' VNĐ', '').replace(',000', ''));
        //     //         total += subtotal;
        //     //     });
        //     //     $('#total').text(total.toLocaleString('vi-VN') + ' VNĐ');
        //     // }


        // });

    </script>



</body>

</html>
