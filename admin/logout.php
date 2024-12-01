<?php
// Bắt đầu phiên làm việc
session_start();

// Kiểm tra nếu người dùng đã bấm quay lại trang chủ
if (isset($_GET['logout'])) {
    // Hủy tất cả các biến phiên
    session_unset();

    // Hủy phiên
    session_destroy();

    // Hiển thị thông báo đăng xuất thành công
    $_SESSION['message'] = "Đăng xuất thành công!";
    header('Location: ../index.php');  // Chuyển hướng về trang chủ
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cảm ơn và Đăng xuất thành công</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
        .message {
            font-size: 18px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .thank-you-icon {
            font-size: 50px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="thank-you-icon">
        <i class="fas fa-sign-out-alt"></i>
    </div>
    <div class="message">
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            echo "Bạn đã đăng xuất thành công!";
        }
        ?>
    </div>
    <a href="?logout=true" class="button">Quay lại trang chủ</a>
</div>

</body>
</html>
