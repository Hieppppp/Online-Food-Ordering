<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('/admin')}}/vendor/bootstrap/css/bootstrap.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

        <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{asset('/admin')}}/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="{{asset('/admin')}}/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="{{asset('/admin')}}/https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('/admin')}}/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('/admin')}}/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('/admin')}}/img/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
    @include('BackEnd.include.header')

    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('BackEnd.include.slider')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    @yield('content')

                </div>
            </div>
        </div>
    </div>

    @include('BackEnd.include.fooder')
    <!-- JavaScript files-->
    <script src="{{asset('/admin')}}/vendor/jquery/jquery.min.js"></script>
    <script src="{{asset('/admin')}}/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="{{asset('/admin')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{asset('/admin')}}/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="{{asset('/admin')}}/vendor/chart.js/Chart.min.js"></script>
    <script src="{{asset('/admin')}}/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{asset('/admin')}}/js/charts-home.js"></script>
    <script src="{{asset('/admin')}}/js/front.js"></script>
    <script src="{{asset('/admin')}}/https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="{{asset('/admin')}}/https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="{{asset('/admin')}}/https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function(){
            $(document).on('click','#delete', function(e){
                e.preventDefault();
                var link = $(this).attr("href");
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                        }).then(()=>{
                            window.location.href = link;
                        });
                    }
                });
            });
        });
    </script>


    <!-- <script src="https://cdn.tiny.cloud/1/yhznnk9buaq5y1f7mljdtf2dzgg7efaiq1lx56bsp6d8m9k3/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        try {
            tinymce.init({
                selector: 'textarea[name="blogdetail_detail"]',
                plugins: 'advlist autolink lists link image charmap print preview anchor',
                toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image',
                height: 400
            });
        } catch (error) {
            console.error('Error initializing TinyMCE:', error);
        }
    </script> -->

  

    
 
</body>

</html>