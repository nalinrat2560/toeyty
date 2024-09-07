<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Narin - Platform Stroe</title>

    <link rel="stylesheet" href="./dist/css/index.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
        <form id="registerForm" method="post">
            <img width="200px" src="imgs/fahup.png">
            <span class="asd">Sign up for an account with email.</span>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <button type="submit">Sign-up</button>
        </form>
    </div>

        <div class="form-container sign-in">
            <form id="loginForm" method="post">
                <img width="200px" src="imgs/fahin.png">
                <span class="asd">Login using your email and password.</span>
                <input type="text" name="identifier" placeholder="Enter your email or username">
                <input type="password" name="password" placeholder="Enter your password">
                <a href="">Forgot your password?</a>
                <button type="submit">Login</button>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <img width="250px" src="imgs/ty1.png">
                    <p>IF YOU ALREADY HAVE AN ACCOUNT, LOG IN HERE !!</p>
                    <button class="hidden" id="login">Login</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h2>DON'T HAVE AN ACCOUNT?</h2>
                    <p>SIGN UP HERE !!</p>
                    <button class="hidden" id="register">Sign-up</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="./dist/js/script.js"></script>

    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: './controller/api/login.php',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: response.info,
                                confirmButtonText: 'ตกลง'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'dashboard.php';
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                text: response.info,
                                confirmButtonText: 'ตกลง'
                            });
                        }
                    }
                });
            });
        });
    </script>

    <script>
            $(document).ready(function() {
                $('#registerForm').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: './controller/api/register.php',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'สำเร็จ',
                                    text: response.info,
                                    confirmButtonText: 'ตกลง'
                                }).then((result) => {
                                    if (result.value) {
                                        window.location.href = './index.php'
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เกิดข้อผิดพลาด',
                                    text: response.info,
                                    confirmButtonText: 'ตกลง'
                                });
                            }
                        },
                        
                    });
                });
            });
        </script>
</body>
</html>