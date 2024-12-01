<!DOCTYPE html>
<html lang="en">

<head>
    <title>Khôi phục mật khẩu | Website quản trị v2.0</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../public/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../public/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../public/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="../public/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="../public/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../public/css/util.css">
    <link rel="stylesheet" type="text/css" href="../public/css/main.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="Design/image/fg-img.png" alt="IMG">
              </div>
                <form class="login100-form validate-form">
                    <span class="login100-form-title">
                        <b>KHÔI PHỤC MẬT KHẨU</b>
                    </span>
                    <form action="#">
                        <div class="wrap-input100 validate-input"
                            data-validate="Bạn cần nhập đúng thông tin như: ex@abc.xyz">
                            <input class="input100" type="text" placeholder="Nhập email" name="emailInput"
                                id="emailInput" value="" />
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class='bx bx-mail-send' ></i>
                            </span>
                        </div>
                        <div class="container-login100-form-btn">
                            <input type="button" onclick="return RegexEmail('emailInput')" value="Lấy mật khẩu" />
                        </div>

                        <div class="text-center p-t-12">
                            <a class="txt2" href="index.php">
                                Trở về đăng nhập
                            </a>
                        </div>
                    </form>
                    <div class="text-center p-t-70 txt2">
                        Phần mềm quản lý bán hàng <i class="far fa-copyright" aria-hidden="true"></i>
                        <script type="text/javascript">document.write(new Date().getFullYear());</script> <a
                            class="txt2" href="https://www.facebook.com/profile.php?id=100051796620892"> Dev by @Phan Hoang </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
   <!--===============================================================================================-->
   <script src="public/js/main.js"></script>
   <!--===============================================================================================-->
   <script src="public/vendor/jquery/jquery-3.2.1.min.js"></script>
   <!--===============================================================================================-->
   <script src="public/vendor/bootstrap/js/popper.js"></script>
   <!--===============================================================================================-->
   <script src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
   <!--===============================================================================================-->
   <script src="public/vendor/select2/select2.min.js"></script>
   <!--===============================================================================================-->
   
</body>
</html>