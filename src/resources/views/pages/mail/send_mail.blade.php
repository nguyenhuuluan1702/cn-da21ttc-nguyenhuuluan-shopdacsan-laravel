<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }
        .email-header {
            background-color:rgb(67, 223, 15);
            color: #ffffff;
            padding: 10px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .email-body {
            padding: 20px;
        }
        .email-body h2 {
            color: #333333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .email-body p {
            color: #555555;
            line-height: 1.6;
            margin: 10px 0;
        }
        .email-footer {
            text-align: center;
            padding: 10px;
            color: #777777;
            font-size: 12px;
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ form
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
}
?>
    <div class="email-container">
        <div class="email-header">
            <h1>Thông tin liên hệ từ khách hàng</h1>
        </div>
        <div class="email-body">
            <h2>Thông tin chi tiết</h2>
            <p><strong>Tên:</strong> {{ $name }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Tin nhắn:</strong> {{ $message }}</p>
        </div>
        <div class="email-footer">
            <p>Cảm ơn bạn đã liên hệ với chúng tôi!</p>
        </div>
    </div>
</body>
</html>
