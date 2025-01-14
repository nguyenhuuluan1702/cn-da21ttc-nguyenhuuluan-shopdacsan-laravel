@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->  
    <style>
        .contact-container {
            margin-top: 50px;
        }
        .contact-header {
            background-color: #f8f9fa;
            padding: 20px;
            border-bottom: 1px solid #dee2e6;
        }
        .contact-info {
            margin-top: 20px;
        }
        .contact-info h3 {
            margin-bottom: 15px;
        }
        .contact-info p {
            margin-bottom: 10px;
        }
        .contact-map {
            margin-top: 20px;
        }
    </style>
    <div class="container contact-container">
        <div class="row contact-info">
            <div class="col-md-6">
                <h3>Thông tin liên hệ</h3>
                <p><strong>Địa chỉ:</strong> 126 Nguyễn Thiện Thành, khóm 7, phường 5, TP.Trà Vinh, tỉnh Trà Vinh.</p>
                <p><strong>Số điện thoại:</strong> 0303837323</p>
                <p><strong>Email:</strong> info@example.com</p>
                <p><strong>Giờ làm việc:</strong> Thứ 2 - Thứ 6: 8:00 - 17:00</p>
            </div>
            <div class="col-md-6">
                <h3>Gửi tin nhắn cho chúng tôi</h3>
                <form action="{{URL::to('/send-mail')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Tên của bạn</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên của bạn" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email của bạn</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Tin nhắn</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Nhập tin nhắn của bạn" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi tin nhắn</button>
                </form>
            </div>
        </div>
        <div class="contact-map">
            <h3>Bản đồ</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3930.1260734410666!2d106.34394437426135!3d9.923456874348688!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0175ea296facb%3A0x55ded92e29068221!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBUcsOgIFZpbmg!5e0!3m2!1svi!2s!4v1736517692666!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</div>
@endsection