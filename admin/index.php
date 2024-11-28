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

    <!-- LOGIN FORM -->

    <div class="login">
        <form class="login-container validate-form" name="login-form" action="index.php" method="POST" onsubmit="return validateLoginForm()">
			<span class="login100-form-title p-b-32">
				Đăng nhập quản trị
			</span>
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

            <!-- USERNAME INPUT -->

            <div class="form-input">
                <span class="txt1">Tên người dùng</span>
                <input type="text" name="username" class = "form-control username" oninput="document.getElementById('username_required').style.display = 'none'" id="user" autocomplete="off">
                <div class="invalid-feedback" id="username_required">Tên người dùng là bắt buộc!</div>
            </div>

            <!-- PASSWORD INPUT -->

            <div class="form-input">
                <span class="txt1">Mật khẩu</span>
                <input type="password" name="password" class="form-control" oninput="document.getElementById('password_required').style.display = 'none'" id="password" autocomplete="new-password">
                <div class="invalid-feedback" id="password_required">Mật khẩu là bắt buộc!</div>
            </div>

            <!-- SIGNIN BUTTON -->

            <p>
                <button type="submit" name="admin_login" >Đăng nhập</button>
            </p>

            <!-- FORGOT PASSWORD PART -->

            <span class="forgotPW">Quên mật khẩu? <a href="#">Đặt lại mật khẩu tại đây.</a></span>

        </form>
    </div>

<?php include 'Includes/templates/footer.php'; ?>