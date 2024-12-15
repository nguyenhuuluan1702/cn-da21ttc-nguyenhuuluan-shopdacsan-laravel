@extends('layout')
@section('content')
<section id="form"><!--form-->
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form" style="border: 1px solid #ddd; padding: 20px; border-radius: 5px;"><!--login form-->
                    <h2>Đăng nhập tài khoản</h2>
                    <form action="{{ URL::to('/login-customer') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" name="email_account" placeholder="Tài khoản" class="form-control" style="margin-bottom: 10px;" />
                        <input type="password" name="password_account" placeholder="Password" class="form-control" style="margin-bottom: 10px;" />
                        <span>
                            <input type="checkbox" class="checkbox">
                            Ghi nhớ đăng nhập
                        </span>
                        <button type="submit" class="btn btn-default" style="margin-top: 10px;">Đăng nhập</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or" style="margin-top: 50%; font-weight: bold;">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form" style="border: 1px solid #ddd; padding: 20px; border-radius: 5px;"><!--sign up form-->
                    <h2>Đăng ký</h2>
                    <form action="{{ URL::to('/add-customer') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" name="customer_name" placeholder="Họ và tên" class="form-control" style="margin-bottom: 10px;" />
                        <input type="email" name="customer_email" placeholder="Địa chỉ email" class="form-control" style="margin-bottom: 10px;" />
                        <input type="password" name="customer_password" placeholder="Mật khẩu" class="form-control" style="margin-bottom: 10px;" />
                        <input type="text" name="customer_phone" placeholder="Phone" class="form-control" style="margin-bottom: 10px;" />
                        <button type="submit" class="btn btn-default" style="margin-top: 10px;">Đăng ký</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection
