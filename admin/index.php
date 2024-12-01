<?php
session_start();
$pageTitle = 'Đăng nhập quản trị';

if(isset($_SESSION['username_restaurant_qRewacvAqzA']) && isset($_SESSION['password_restaurant_qRewacvAqzA']))
{

    header('Location: dashboard.php');
}
?>

    <!-- PHP INCLUDES -->

<?php include 'connect.php'; ?>
<?php include 'Includes/functions/functions.php'; ?>
<?php include 'Includes/templates/header.php'; ?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Đăng nhập quản trị | Website quản trị v2.0</title>
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
                <img src="./Design/image/team.jpg" alt="IMG">
            </div>

            <!--=====TIÊU ĐỀ======-->
            <div class="login100-form validate-form">
                    <span class="login100-form-title">
                        <b>ĐĂNG NHẬP HỆ THỐNG POS</b>
                    </span>
                <!--=====FORM INPUT TÀI KHOẢN VÀ PASSWORD======-->
                <form  class="login-container validate-form" name="login-form" action="index.php" method="POST" onsubmit="return validateLoginForm()">
                    <?php
                    //Kiểm tra nếu người dùng nhấn vào nút submit
                    if(isset($_POST['admin_login']))
                    {
                        $username = test_input($_POST['username']);
                        $password = test_input($_POST['password']);
                        $hashedPass = sha1($password);

                        //Kiểm tra xem người dùng tồn tại trong cơ sở dữ liệu

                        $stmt = $con->prepare("Select user_id, username, password from users where username = ? and password = ?");
                        $stmt->execute(array($username,$hashedPass));
                        $row = $stmt->fetch();
                        $count = $stmt->rowCount();

                        // Kiểm tra nếu count > 0 có nghĩa là cơ sở dữ liệu chứa một bản ghi về tên người dùng này

                        if($count > 0)
                        {

                            $_SESSION['username_restaurant_qRewacvAqzA'] = $username;
                            $_SESSION['password_restaurant_qRewacvAqzA'] = $password;
                            $_SESSION['userid_restaurant_qRewacvAqzA'] = $row['user_id'];
                            header('Location: dashboard.php');
                            die();
                        }
                        else
                        {
                            ?>
                            <div class="alert alert-danger">
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <div class="messages">
                                    <div>Tên người dùng và/hoặc mật khẩu không chính xác!</div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div class="wrap-input100 validate-input">
                        <input type="text" name="username" placeholder="Tài khoản quản trị"
                               class="form-control username input100"
                               oninput="document.getElementById('username_required').style.display = 'none'" id="user"
                               autocomplete="off">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                                <i class='bx bx-user'></i>
                            </span>
                    </div>
                    <div class="wrap-input100 validate-input">
                        <input type="password" name="password" class="form-control input100"
                               oninput="document.getElementById('password_required').style.display = 'none'"
                               id="password" autocomplete="new-password" placeholder="Mật khẩu">

                        <span toggle="#password-field" class="bx fa-fw bx-hide field-icon click-eye"></span>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                                <i class='bx bx-key'></i>
                            </span>
                    </div>

                    <!--=====ĐĂNG NHẬP======-->
                    <div class="container-login100-form-btn">
                        <input type="submit" name="admin_login" value="Đăng nhập" id="submit" onclick="validate()"/>
                    </div>
                    <!--=====LINK TÌM MẬT KHẨU======-->
                    <div class="text-right p-t-12">
                        <a class="txt2" href="forgot.php">
                            Bạn quên mật khẩu?
                        </a>
                    </div>
                </form>
                <!--=====FOOTER======-->
                <div class="text-center p-t-70 txt2">
                    Phần mềm được phát triển by @HoangNguyetHa - Phan Van Hoang <i class="far fa-copyright"
                                                                                   aria-hidden="true"></i>
                    <script type="text/javascript">document.write(new Date().getFullYear());</script>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Javascript-->
<script src="/js/main.js"></script>
<script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
<script src="../public/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="../public/vendor/bootstrap/js/popper.js"></script>
<script src="../public/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../public/vendor/select2/select2.min.js"></script>
<script type="text/javascript">
    //show - hide mật khẩu
    function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text"
        } else {
            x.type = "password";
        }
    }

    $(".click-eye").click(function () {
        $(this).toggleClass("bx-show bx-hide");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
</body>

</html>