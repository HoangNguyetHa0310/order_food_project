<!-- PHP INCLUDES -->

<?php

include "connect.php";
include 'Includes/functions/functions.php';
include "Includes/templates/header.php";
include "Includes/templates/navbar.php";


//Getting website settings

$stmt_web_settings = $con->prepare("SELECT * FROM website_settings");
$stmt_web_settings->execute();
$web_settings = $stmt_web_settings->fetchAll();

$restaurant_name = "";
$restaurant_email = "";
$restaurant_address = "";
$restaurant_phonenumber = "";

foreach ($web_settings as $option)
{
    if($option['option_name'] == 'restaurant_name')
    {
        $restaurant_name = $option['option_value'];
    }

    elseif($option['option_name'] == 'restaurant_email')
    {
        $restaurant_email = $option['option_value'];
    }

    elseif($option['option_name'] == 'restaurant_phonenumber')
    {
        $restaurant_phonenumber = $option['option_value'];
    }
    elseif($option['option_name'] == 'restaurant_address')
    {
        $restaurant_address = $option['option_value'];
    }
}

?>

<!-- HOME SECTION -->

<section class="home-section" id="home">
    <div class="container">
        <div class="row" style="flex-wrap: nowrap;">
            <div class="col-md-6 home-left-section">
                <div style="padding: 100px 0px; color: white;">
                    <h1>
                        VINCENT PIZZA.
                    </h1>
                    <h2>
                        LÀM CHO MỌI NGƯỜI HẠNH PHÚC
                    </h2>
                    <hr>
                    <p>
                        Pizza Ý với cà chua bi và húng quế xanh
                    </p>
                    <div style="display: flex;">
                        <a href="order_food.php" target="_blank" class="bttn_style_1" style="margin-right: 10px; display: flex;justify-content: center;align-items: center;">
                            Đặt hàng ngay
                            <i class="fas fa-angle-right"></i>
                        </a>
                        <a href="#menus" class="bttn_style_2" style="display: flex;justify-content: center;align-items: center;">
                            XEM THỰC ĐƠN
                            <i class="fas fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- OUR QUALITIES SECTION -->

<section class="our_qualities" style="padding:100px 0px;">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="our_qualities_column">
                    <img src="Design/images/quality_food_img.png" >
                    <div class="caption">
                        <h3>
                            Thực phẩm chất lượng
                        </h3>
                        <p>
                            Sit amet, consectetur adipiscing elit quisque eget maximus velit,
                            non eleifend libero curabitur dapibus mauris sed leo cursus aliquetcras suscipit.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="our_qualities_column">
                    <img src="Design/images/fast_delivery_img.png" >
                    <div class="caption">
                        <h3>
                            Thực phẩm chất lượng
                        </h3>
                        <p>
                            Sit amet, consectetur adipiscing elit quisque eget maximus velit,
                            non eleifend libero curabitur dapibus mauris sed leo cursus aliquetcras suscipit.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="our_qualities_column">
                    <img src="Design/images/original_taste_img.png" >
                    <div class="caption">
                        <h3>
                            Thực phẩm chất lượng
                        </h3>
                        <p>
                            Sit amet, consectetur adipiscing elit quisque eget maximus velit,
                            non eleifend libero curabitur dapibus mauris sed leo cursus aliquetcras suscipit.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- OUR MENUS SECTION -->

<section class="our_menus" id="menus">
    <div class="container">
        <h2 style="text-align: center;margin-bottom: 30px">KHÁM PHÁ THỰC ĐƠN CỦA CHÚNG TÔI</h2>
        <div class="menus_tabs">
            <div class="menus_tabs_picker">
                <ul style="text-align: center;margin-bottom: 70px">
                    <?php

                    $stmt = $con->prepare("Select * from menu_categories");
                    $stmt->execute();
                    $rows = $stmt->fetchAll();
                    $count = $stmt->rowCount();

                    $x = 0;

                    foreach($rows as $row)
                    {
                        if($x == 0)
                        {
                            echo "<li class = 'menu_category_name tab_category_links active_category' onclick=showCategoryMenus(event,'".str_replace(' ', '', $row['category_name'])."')>";
                            echo $row['category_name'];
                            echo "</li>";

                        }
                        else
                        {
                            echo "<li class = 'menu_category_name tab_category_links' onclick=showCategoryMenus(event,'".str_replace(' ', '', $row['category_name'])."')>";
                            echo $row['category_name'];
                            echo "</li>";
                        }

                        $x++;

                    }
                    ?>
                </ul>
            </div>

            <div class="menus_tab">
                <?php

                $stmt = $con->prepare("Select * from menu_categories");
                $stmt->execute();
                $rows = $stmt->fetchAll();
                $count = $stmt->rowCount();

                $i = 0;

                foreach($rows as $row)
                {

                    if($i == 0)
                    {

                        echo '<div class="menu_item  tab_category_content" id="'.str_replace(' ', '', $row['category_name']).'" style=display:block>';

                        $stmt_menus = $con->prepare("Select * from menus where category_id = ?");
                        $stmt_menus->execute(array($row['category_id']));
                        $rows_menus = $stmt_menus->fetchAll();

                        if($stmt_menus->rowCount() == 0)
                        {
                            echo "<div style='margin:auto'>Không có thực đơn nào cho mục này!</div>";
                        }

                        echo "<div class='row'>";
                        foreach($rows_menus as $menu)
                        {
                            ?>

                            <div class="col-md-4 col-lg-3 menu-column">
                                <div class="thumbnail" style="cursor:pointer">
                                    <?php $source = "admin/Uploads/images/".$menu['menu_image']; ?>

                                    <div class="menu-image">
                                        <div class="image-preview">
                                            <div style="background-image: url('<?php echo $source; ?>');"></div>
                                        </div>
                                    </div>

                                    <div class="caption">
                                        <h5>
                                            <?php echo $menu['menu_name'];?>
                                        </h5>
                                        <p>
                                            <?php echo $menu['menu_description']; ?>
                                        </p>
                                        <span class="menu_price">
	                                                        	<?php echo "$".$menu['menu_price']; ?>
	                                                        </span>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                        echo "</div>";

                        echo '</div>';

                    }

                    else
                    {

                        echo '<div class="menus_categories  tab_category_content" id="'.str_replace(' ', '', $row['category_name']).'">';

                        $stmt_menus = $con->prepare("Select * from menus where category_id = ?");
                        $stmt_menus->execute(array($row['category_id']));
                        $rows_menus = $stmt_menus->fetchAll();

                        if($stmt_menus->rowCount() == 0)
                        {
                            echo "<div class = 'no_menus_div'>Không có thực đơn nào cho mục này!</div>";
                        }

                        echo "<div class='row'>";
                        foreach($rows_menus as $menu)
                        {
                            ?>

                            <div class="col-md-4 col-lg-3 menu-column">
                                <div class="thumbnail" style="cursor:pointer">
                                    <?php $source = "admin/Uploads/images/".$menu['menu_image']; ?>
                                    <div class="menu-image">
                                        <div class="image-preview">
                                            <div style="background-image: url('<?php echo $source; ?>');"></div>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <h5>
                                            <?php echo $menu['menu_name'];?>
                                        </h5>
                                        <p>
                                            <?php echo $menu['menu_description']; ?>
                                        </p>
                                        <span class="menu_price">
	                                                        	<?php echo "$".$menu['menu_price']; ?>
	                                                        </span>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                        echo "</div>";

                        echo '</div>';

                    }

                    $i++;

                }

                echo "</div>";

                ?>
            </div>
        </div>
    </div>
</section>

<!-- IMAGE GALLERY -->

<section class="image-gallery" id="gallery">
    <div class="container">
        <h2 style="text-align: center;margin-bottom: 30px">BỘ SƯU TẬP ẢNH</h2>
        <?php
        $stmt_image_gallery = $con->prepare("Select * from image_gallery");
        $stmt_image_gallery->execute();
        $rows_image_gallery = $stmt_image_gallery->fetchAll();

        echo "<div class = 'row'>";

        foreach($rows_image_gallery as $row_image_gallery)
        {
            echo "<div class = 'col-md-4 col-lg-3' style = 'padding: 15px;'>";
            $source = "admin/Uploads/images/".$row_image_gallery['image'];
            ?>

            <div style = "background-image: url('<?php echo $source; ?>') !important;background-repeat: no-repeat;background-position: 50% 50%;background-size: cover;background-clip: border-box;box-sizing: border-box;overflow: hidden;height: 230px;">
            </div>

            <?php
            echo "</div>";
        }

        echo "</div>";
        ?>
    </div>
</section>

<!-- CONTACT US SECTION -->

<section class="contact-section" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 sm-padding">
                <div class="contact-info">
                    <h2>
                        Liên hệ với chúng tôi &
                        <br>gửi tin nhắn ngay hôm nay!
                    </h2>
                    <p>
                        Saasbiz là một công ty kiến trúc khác biệt. Được thành lập bởi LoganCee vào năm 1991, chúng tôi là một công ty do nhân viên làm chủ, theo đuổi một quy trình thiết kế dân chủ, coi trọng ý kiến ​​đóng góp của mọi người.
                    </p>
                    <h3>
                        <?php echo $restaurant_address; ?>
                    </h3>
                    <h4>
                        <span>Email:</span>
                        <?php echo $restaurant_email; ?>
                        <br>
                        <span>Điện thoại:</span>
                        <?php echo $restaurant_phonenumber; ?>
                    </h4>
                </div>
            </div>
            <div class="col-lg-6 sm-padding">
                <div class="contact-form">
                    <div id="contact_ajax_form" class="contactForm">
                        <div class="form-group colum-row row">
                            <div class="col-sm-6">
                                <input type="text" id="contact_name" name="name" oninput="document.getElementById('invalid-name').innerHTML = ''" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" class="form-control" placeholder="Tên">
                                <div class="invalid-feedback" id="invalid-name" style="display: block">

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="email" id="contact_email" name="email" oninput="document.getElementById('invalid-email').innerHTML = ''" class="form-control" placeholder="Email">
                                <div class="invalid-feedback" id="invalid-email" style="display: block">

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="text" id="contact_subject" name="subject" oninput="document.getElementById('invalid-subject').innerHTML = ''" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" class="form-control" placeholder="Chủ đề">
                                <div class="invalid-feedback" id="invalid-subject" style="display: block">

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea id="contact_message" name="message" oninput="document.getElementById('invalid-message').innerHTML = ''" cols="30" rows="5" class="form-control message" placeholder="Tin nhắn"></textarea>
                                <div class="invalid-feedback" id="invalid-message" style="display: block">

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button id="contact_send" class="bttn_style_2">Gửi tin nhắn</button>
                            </div>
                        </div>
                        <div id="sending_load" style="display: none;">Đang gửi...</div>
                        <div id="contact_status_message"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- OUR QUALITIES SECTION -->

<section class="our_qualities_v2">
    <div class="container">
        <div class="row">
            <div class="col-md-4" style="padding: 10px;">
                <div class="quality quality_1">
                    <div class="text_inside_quality">
                        <h5>Thực phẩm chất lượng</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="padding: 10px;">
                <div class="quality quality_2">
                    <div class="text_inside_quality">
                        <h5>Giao hàng nhanh nhất</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="padding: 10px;">
                <div class="quality quality_3">
                    <div class="text_inside_quality">
                        <h5>Công thức gốc</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WIDGET SECTION / FOOTER -->

<section class="widget_section" style="background-color: #222227;padding: 100px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer_widget">
                    <img src="Design/images/restaurant-logo.png" alt="Logo nhà hàng" style="width: 150px;margin-bottom: 20px;">
                    <p>
                        Nhà hàng của chúng tôi là một trong những nhà hàng tốt nhất, cung cấp các thực đơn và món ăn ngon. Bạn có thể đặt bàn hoặc đặt món ăn.
                    </p>
                    <ul class="widget_social">
                        <li><a href="#" data-toggle="tooltip" title="Facebook"><i class="fab fa-facebook-f fa-2x"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Twitter"><i class="fab fa-twitter fa-2x"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Instagram"><i class="fab fa-instagram fa-2x"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="LinkedIn"><i class="fab fa-linkedin fa-2x"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Google+"><i class="fab fa-google-plus-g fa-2x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer_widget">
                    <h3>Trụ sở chính</h3>
                    <p>
                        <?php echo $restaurant_address; ?>
                    </p>
                    <p>
                        <?php echo $restaurant_email; ?>
                        <br>
                        <?php echo $restaurant_phonenumber; ?>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer_widget">
                    <h3>
                        Giờ mở cửa
                    </h3>
                    <ul class="opening_time">
                        <li>Thứ Hai - Thứ Sáu 11:30 sáng - 2:008 chiều</li>
                        <li>Thứ Hai - Thứ Sáu 11:30 sáng - 2:008 chiều</li>
                        <li>Thứ Hai - Thứ Sáu 11:30 sáng - 2:008 chiều</li>
                        <li>Thứ Hai - Thứ Sáu 11:30 sáng - 2:008 chiều</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer_widget">
                    <h3>Đăng ký nội dung của chúng tôi</h3>
                    <div class="subscribe_form">
                        <form action="#" class="subscribe_form" novalidate="true">
                            <input type="email" name="EMAIL" id="subs-email" class="form_input" placeholder="Địa chỉ Email...">
                            <button type="submit" class="submit">ĐĂNG KÝ</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER BOTTOM  -->

<?php include "Includes/templates/footer.php"; ?>

<script type="text/javascript">

    $(document).ready(function()
    {
        $('#contact_send').click(function()
        {
            var contact_name = $('#contact_name').val();
            var contact_email = $('#contact_email').val();
            var contact_subject = $('#contact_subject').val();
            var contact_message = $('#contact_message').val();

            var flag = 0;

            if($.trim(contact_name) == "")
            {
                $('#invalid-name').text('Trường này bắt buộc!');
                flag = 1;
            }
            else
            {
                if(contact_name.length < 5)
                {
                    $('#invalid-name').text('Độ dài ít hơn 5 ký tự!');
                    flag = 1;
                }
            }

            if(!ValidateEmail(contact_email))
            {
                $('#invalid-email').text('Email không hợp lệ!');
                flag = 1;
            }

            if($.trim(contact_subject) == "")
            {
                $('#invalid-subject').text('Trường này bắt buộc!');
                flag = 1;
            }

            if($.trim(contact_message) == "")
            {
                $('#invalid-message').text('Trường này bắt buộc!');
                flag = 1;
            }

            if(flag == 0)
            {
                $('#sending_load').show();

                $.ajax({
                    url: "Includes/php-files-ajax/contact.php",
                    type: "POST",
                    data:{contact_name:contact_name, contact_email:contact_email, contact_subject:contact_subject, contact_message:contact_message},
                    success: function (data)
                    {
                        $('#contact_status_message').html(data);
                    },
                    beforeSend: function()
                    {
                        $('#sending_load').show();
                    },
                    complete: function()
                    {
                        $('#sending_load').hide();
                    },
                    error: function(xhr, status, error)
                    {
                        alert("Đã xảy ra lỗi, vui lòng thử lại sau!");
                    }
                });
            }

        });
    });

</script>