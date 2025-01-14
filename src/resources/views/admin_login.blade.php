<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
        .text-alert {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h2 class="text-center">Admin Login</h2>
            <?php
                use Illuminate\Support\Facades\Session;
                $message = Session::get('message');
                if($message){    
                    echo '<span class="text-alert">' .$message. '</span>';
                    Session::put('message', null);
                }
            ?>
            <form action="{{URL::to('/admin-dashboard')}}" method="post">
                {{ csrf_field()}}
                <div class="form-group">
                    <label for="admin_email">Email</label>
                    <input type="email" class="form-control" id="admin_email" name="admin_email" placeholder="Nhập email" required>
                </div>
                <div class="form-group">
                    <label for="admin_password">Password</label>
                    <input type="password" class="form-control" id="admin_password" name="admin_password" placeholder="Nhập password" required>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember_me">
                    <label class="form-check-label" for="remember_me">Ghi nhớ đăng nhập</label>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                <div class="text-center mt-3">
                    <a href="#">Quên mật khẩu?</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
