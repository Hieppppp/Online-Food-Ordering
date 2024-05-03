
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   
    <style>
        div.login-form{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            width: 400px;
        }
        .text-alert {
            color: red;
            text-align: center;
            font-size: 17px;
            width: 100%;
            font-weight: bold;
            display: block; /* Ensure the span takes up the full width */
            margin-top: 10px; /* Add some space above the message */
        }

    </style>
</head>
<body class="bg-light">
    <div class="login-form text-center bg-white overflow-hidden rounded shadow">
        <?php
            $message = session()->get('message');
            if($message){
                echo '<span id="message" class="text-alert"><i class="bi bi-exclamation-triangle"> '.$message.'</i></span>';
                echo '<script>
                    setTimeout(function(){
                        document.getElementById("message").style.display = "none";
                    }, 2000); // 2000 milliseconds = 2 seconds
                </script>';
                session()->put('message',null);
            }
        ?>
        <form class="form" action="{{route('check_admindashboard')}}" method="post">
            @csrf
            <h4 class="bg-dark text-white py-3">ADMIN LOGIN</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_email" required type="text" class="form-control shadow-none text-center" placeholder="Admin Login">
                </div>
                <div class="mb-4">
                    <input name="admin_password" required type="password" class="form-control shadow-none text-center" placeholder="Password">
                </div>
                <button name="login" type="submit" class="btn text-white custom-bg shadow-none">LOGIN</button>
            </div>
        </form>
    </div>

  

</body>
</html>