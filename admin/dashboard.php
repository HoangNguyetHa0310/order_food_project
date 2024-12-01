<?php

//Start session
session_start();

//Set page title
$pageTitle = 'Bảng điều khiển';

//PHP INCLUDES
include 'connect.php';
include 'Includes/functions/functions.php';
include 'Includes/templates/header.php';

//TEST IF THE SESSION HAS BEEN CREATED BEFORE

if(isset($_SESSION['username_restaurant_qRewacvAqzA']) && isset($_SESSION['password_restaurant_qRewacvAqzA']))
{
    include 'Includes/templates/navbar.php';

    ?>

    <script type="text/javascript">

        var vertical_menu = document.getElementById("vertical-menu");


        var current = vertical_menu.getElementsByClassName("active_link");

        if(current.length > 0)
        {
            current[0].classList.remove("active_link");
        }

        vertical_menu.getElementsByClassName('dashboard_link')[0].className += " active_link";

    </script>

    <!-- TOP 4 CARDS -->

    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-green ">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-3">
                            <i class="fa fa-users fa-4x"></i>
                        </div>
                        <div class="col-sm-9 text-right">
                            <div class="huge"><span><?php echo countItems("client_id","clients")?></span></div>
                            <div>Tổng số khách hàng</div>  
                        </div>
                    </div>
                </div>
                <a href="clients.php">
                    <div class="panel-footer">
                        <span class="pull-left">Xem chi tiết</span>  
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-3">
                            <i class="fas fa-utensils fa-4x"></i>
                        </div>
                        <div class="col-sm-9 text-right">
                            <div class="huge"><span><?php echo countItems("menu_id","menus")?></span></div>
                            <div>Tổng số thực đơn</div>  
                        </div>
                    </div>
                </div>
                <a href="menus.php">
                    <div class="panel-footer">
                        <span class="pull-left">Xem chi tiết</span>  
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class=" col-sm-6 col-lg-3">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-3">
                            <i class="far fa-calendar-alt fa-4x"></i>
                        </div>
                        <div class="col-sm-9 text-right">
                            <div class="huge"><span>32</span></div>
                            <div>Tổng số bàn được đặt trước</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Xem chi tiết</span>  
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class=" col-sm-6 col-lg-3">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-3">
                            <i class="fas fa-pizza-slice fa-4x"></i>
                        </div>
                        <div class="col-sm-9 text-right">
                            <div class="huge"><span><?php echo countItems("order_id","placed_orders")?></span></div>
                            <div>Tổng số đơn hàng</div>  
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Xem chi tiết</span>  
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- START ORDERS TABS -->

    <div class="card" style = "margin: 20px 10px">

        <!-- TABS BUTTONS -->

        <div class="card-header tab" style="padding:0px;">
            <button class="tablinks_orders active" onclick="openTab(event, 'recent_orders','tabcontent_orders','tablinks_orders')">Đơn hàng gần đây</button>  
            <button class="tablinks_orders" onclick="openTab(event, 'completed_orders','tabcontent_orders','tablinks_orders')">Đơn hàng đã hoàn thành</button>  
            <button class="tablinks_orders" onclick="openTab(event, 'canceled_orders','tabcontent_orders','tablinks_orders')">Đơn hàng đã hủy</button>  
        </div>

        <!-- TABS CONTENT -->

        <div class="card-body">
            <div class='responsive-table'>

                <!-- RECENT ORDERS -->

                <table class="table X-table tabcontent_orders" id="recent_orders" style="display:table">
                    <thead>
                    <tr>
                        <th>
                            Thời gian tạo đơn hàng 
                        </th>
                        <th>
                            Món ăn đã được chọn
                        </th>
                        <th>
                            Tổng giá 
                        </th>
                        <th>
                            Khách hàng 
                        </th>
                        <th>
                            Quản lý 
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $stmt = $con->prepare("SELECT * 
                                                    FROM placed_orders po , clients c
                                                    where 
                                                        po.client_id = c.client_id
                                                    and canceled = 0
                                                    and delivered = 0
                                                    order by order_time;
                                                    ");
                    $stmt->execute();
                    $placed_orders = $stmt->fetchAll();
                    $count = $stmt->rowCount();


                    if($count == 0)
                    {

                        echo "<tr>";
                        echo "<td colspan='5' style='text-align:center;'>";
                        echo "Danh sách đơn hàng gần đây của bạn sẽ được hiển thị ở đây";  
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                    else
                    {

                        foreach($placed_orders as $order)
                        {
                            echo "<tr>";
                            echo "<td>";
                            echo $order['order_time'];
                            echo "</td>";
                            echo "<td>";

                            $stmtMenus = $con->prepare("SELECT menu_name, quantity, menu_price
                                                            from menus m, in_order in_o
                                                            where m.menu_id = in_o.menu_id
                                                            and order_id = ?");
                            $stmtMenus->execute(array($order['order_id']));
                            $menus = $stmtMenus->fetchAll();

                            $total_price = 0;

                            foreach($menus as $menu)
                            {
                                echo "<span style = 'display:block'>".$menu['menu_name']."</span>";

                                $total_price += ($menu['menu_price']*$menu['quantity']);
                            }

                            echo "</td>";
                            echo "<td>";
                            echo $total_price."$";
                            echo "</td>";
                            echo "<td>";
                            ?>
                            <button class="btn btn-info btn-sm rounded-0" type="button" data-toggle="modal" data-target="#<?php echo "client_".$order['client_id']; ?>" data-placement="top">
                                <?php echo $order['client_id']; ?>
                            </button>

                            <!-- Client Modal -->

                            <div class="modal fade" id="<?php echo "client_".$order['client_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Chi tiết khách hàng</h5>  
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>
                                                <li><span style="font-weight: bold;">Họ và tên đầy đủ: </span> <?php echo $order['client_name']; ?></li>  
                                                <li><span style="font-weight: bold;">Số điện thoại: </span><?php echo $order['client_phone']; ?></li>  
                                                <li><span style="font-weight: bold;">Email: </span><?php echo $order['client_email']; ?></li>  
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            echo "</td>";

                            echo "<td>";

                            $cancel_data = "cancel_order".$order["order_id"];
                            $deliver_data = "deliver_order".$order["order_id"];
                            ?>
                            <ul class="list-inline m-0">

                                <!-- Deliver Order BUTTON -->

                                <li class="list-inline-item" data-toggle="tooltip" title="Giao hàng">  
                                    <button class="btn btn-info btn-sm rounded-0" type="button" data-toggle="modal" data-target="#<?php echo $deliver_data; ?>" data-placement="top">
                                        <i class="fas fa-truck"></i>
                                    </button>

                                    <!-- DELIVER MODAL -->
                                    <div class="modal fade" id="<?php echo $deliver_data; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $deliver_data; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Giao hàng</h5>  
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Đánh dấu đơn hàng là đã giao?  
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>  
                                                    <button type="button" data-id = "<?php echo $order['order_id']; ?>" class="btn btn-info deliver_order_button">
                                                        Có  
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </li>

                                <!-- CANCEL BUTTON -->

                                <li class="list-inline-item" data-toggle="tooltip" title="Hủy đơn hàng">  
                                    <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal" data-target="#<?php echo $cancel_data; ?>" data-placement="top">
                                        <i class="fas fa-calendar-times"></i>
                                    </button>

                                    <!-- CANCEL MODAL -->
                                    <div class="modal fade" id="<?php echo $cancel_data; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $cancel_data; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Hủy đơn hàng</h5>  
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Lý do hủy</label>  
                                                        <textarea class="form-control" id="cancellation_reason_order_<?php echo $order['order_id'] ?>" required="required"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>  
                                                    <button type="button" data-id = "<?php echo $order['order_id']; ?>" class="btn btn-danger cancel_order_button">
                                                        Hủy đơn hàng  
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                            </ul>
                            <?php
                            echo "</td>";
                            echo "</tr>";
                        }
                    }

                    ?>

                    </tbody>
                </table>

                <!-- COMPLETED ORDERS -->

                <table class="table X-table tabcontent_orders" id="completed_orders">
                    <thead>
                    <tr>
                        <th>
                            Thời gian tạo đơn hàng 
                        </th>
                        <th>
                            Thực đơn 
                        </th>
                        <th>
                            Khách hàng 
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $stmt = $con->prepare("SELECT * 
                                                    FROM placed_orders po , clients c
                                                    where 
                                                        po.client_id = c.client_id
                                                        and
                                                        delivered = 1
                                                        and
                                                        canceled = 0
                                                    order by order_time;
                                                    ");
                    $stmt->execute();
                    $rows = $stmt->fetchAll();
                    $count = $stmt->rowCount();



                    if($count == 0)
                    {

                        echo "<tr>";
                        echo "<td colspan='5' style='text-align:center;'>";
                        echo "Danh sách đơn hàng đã hoàn thành của bạn sẽ được hiển thị ở đây";  
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                    else
                    {

                        foreach($rows as $row)
                        {
                            echo "<tr>";
                            echo "<td>";
                            echo $row['order_time'];
                            echo "</td>";
                            echo "<td>";

                            $stmtMenus = $con->prepare("SELECT menu_name, quantity
                                                            from menus m, in_order in_o
                                                            where m.menu_id = in_o.menu_id
                                                            and order_id = ?");
                            $stmtMenus->execute(array($order['order_id']));
                            $menus = $stmtMenus->fetchAll();
                            foreach($menus as $menu)
                            {
                                echo "<span style = 'display:block'>".$menu['menu_name']."</span>";
                            }

                            echo "</td>";
                            echo "<td>";
                            echo $row['client_name'];
                            echo "</td>";

                            echo "</tr>";
                        }
                    }

                    ?>

                    </tbody>
                </table>

                <!-- CANCELED ORDERS -->

                <table class="table X-table tabcontent_orders" id="canceled_orders">
                    <thead>
                    <tr>
                        <th>
                            Thời gian tạo đơn hàng 
                        </th>
                        <th>
                            Khách hàng 
                        </th>
                        <th>
                            Lý do hủy 
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $stmt = $con->prepare("SELECT * 
                                                    FROM placed_orders po , clients c
                                                    where 
                                                        po.client_id = c.client_id
                                                    and 
                                                        canceled = 1
                                                    order by order_time;
                                                    ");
                    $stmt->execute();
                    $rows = $stmt->fetchAll();
                    $count = $stmt->rowCount();

                    if($count == 0)
                    {

                        echo "<tr>";
                        echo "<td colspan='5' style='text-align:center;'>";
                        echo "Danh sách đơn hàng đã hủy của bạn sẽ được hiển thị ở đây";  
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                    else
                    {

                        foreach($rows as $row)
                        {
                            echo "<tr>";
                            echo "<td>";
                            echo $row['order_time'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['client_name'];
                            echo "</td>";
                            echo "<td>";

                            echo $row['cancellation_reason'];

                            echo "</td>";
                            echo "</tr>";
                        }
                    }

                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

   <!-- KẾT THÚC THẺ ĐƠN HÀNG -->

    <!-- BẮT ĐẦU CÁC THẺ ĐẶT PHÒNG -->

    <div class="card" style = "margin: 20px 10px">

       <!-- CÁC NÚT THẺ -->

        <div class="card-header tab" style="padding:0px;">
            <button class="tablinks_reservations active" onclick="openTab(event, 'recent_reservations','tabcontent_reservations','tablinks_reservations')">Đặt bàn gần đây</button>  
            <button class="tablinks_reservations" onclick="openTab(event, 'completed_reservations','tabcontent_reservations','tablinks_reservations')">Đặt bàn đã hoàn thành</button>  
            <button class="tablinks_reservations" onclick="openTab(event, 'canceled_reservations','tabcontent_reservations','tablinks_reservations')">Đặt bàn đã hủy</button>  
        </div>

       <!-- NỘI DUNG THẺ -->

        <div class="card-body">
            <div class='responsive-table'>

               <!-- ĐẶT PHÒNG GẦN ĐÂY -->

                <table class="table X-table tabcontent_reservations" id="recent_reservations" style="display:table">
                    <thead>
                    <tr>
                        <th>
                            Thời gian tạo đặt bàn 
                        </th>
                        <th>
                            Ngày và giờ đặt bàn 
                        </th>
                        <th>
                            Số lượng khách 
                        </th>
                        <th>
                            ID bàn 
                        </th>
                        <th>
                            Quản lý 
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $stmt = $con->prepare("SELECT * 
                                                    FROM reservations
                                                    where 
                                                        selected_time > ? and canceled = 0
                                                    ");
                    $timestamp = time();
                    $formatted_time = date('y-m-d h:i:s', $timestamp);
                    $stmt->execute(array($formatted_time));
                    $reservations = $stmt->fetchAll();
                    $count = $stmt->rowCount();


                    if($count == 0)
                    {

                        echo "<tr>";
                        echo "<td colspan='5' style='text-align:center;'>";
                        echo "Danh sách đặt bàn sắp tới của bạn sẽ được hiển thị ở đây";  
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                    else
                    {

                        foreach($reservations as $reservation)
                        {
                            echo "<tr>";
                            echo "<td>";
                            echo $reservation['date_created'];
                            echo "</td>";
                            echo "<td>";
                            echo $reservation['selected_time'];
                            echo "</td>";
                            echo "<td>";
                            echo $reservation['nbr_guests'];
                            echo "</td>";
                            echo "<td>";
                            echo $reservation['table_id'];
                            echo "</td>";
                            echo "<td>";

                            $cancel_data_reservation = "cancel_reservation".$reservation["reservation_id"];
                            $liberate_data = "liberate_table".$reservation["reservation_id"];
                            ?>
                            <ul class="list-inline m-0">

                                <!-- Liberate Table BUTTON -->

                                <li class="list-inline-item" data-toggle="tooltip" title="Giải phóng bàn">  
                                    <button class="btn btn-info btn-sm rounded-0" type="button" data-toggle="modal" data-target="#<?php echo $liberate_data; ?>" data-placement="top">
                                        <i class="far fa-check-circle"></i>
                                    </button>

                                    <!-- LIBERATE MODAL -->
                                    <div class="modal fade" id="<?php echo $liberate_data; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $liberate_data; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Giải phóng bàn</h5>  
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Giải phóng bàn này?  
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>  
                                                    <button type="button" data-id = "<?php echo $reservation['reservation_id']; ?>" class="btn btn-info liberate_table_button">
                                                        Có  
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </li>

                                <!-- CANCEL BUTTON -->

                                <li class="list-inline-item" data-toggle="tooltip" title="Hủy đặt bàn">  
                                    <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal" data-target="#<?php echo $cancel_data_reservation; ?>" data-placement="top">
                                        <i class="fas fa-calendar-times"></i>
                                    </button>

                                    <!-- CANCEL MODAL -->
                                    <div class="modal fade" id="<?php echo $cancel_data_reservation; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $cancel_data_reservation; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Hủy đặt bàn</h5>  
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Lý do hủy</label>  
                                                        <textarea class="form-control" id="cancellation_reason_reservation_<?php echo $order['order_id'] ?>" required="required"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>  
                                                    <button type="button" data-id = "<?php echo $reservation['reservation_id']; ?>" class="btn btn-danger cancel_reservation_button">  <!--Note change here-->
                                                        Hủy đặt bàn  
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                            </ul>
                            <?php
                            echo "</td>";
                            echo "</tr>";
                        }
                    }

                    ?>

                    </tbody>
                </table>

                <!-- COMPLETED RESERVATIONS -->

                <table class="table X-table tabcontent_reservations" id="completed_reservations">
                    <thead>
                    <tr>
                        <th>
                            Ngày tạo đặt bàn 
                        </th>
                        <th>
                            Ngày đặt bàn 
                        </th>
                        <th>
                            ID bàn 
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $stmt = $con->prepare("SELECT * 
                                                    FROM reservations
                                                    where 
                                                        selected_time < ?
                                                        and
                                                        canceled = 0
                                                    order by selected_time;
                                                    ");
                    $timestamp = time();
                    $formatted_time = date('y-m-d h:i:s', $timestamp);
                    $stmt->execute(array($formatted_time));
                    $rows = $stmt->fetchAll();
                    $count = $stmt->rowCount();



                    if($count == 0)
                    {

                        echo "<tr>";
                        echo "<td colspan='5' style='text-align:center;'>";
                        echo "Danh sách đặt bàn đã hoàn thành của bạn sẽ được hiển thị ở đây";  
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                    else
                    {

                        foreach($rows as $row)
                        {
                            echo "<tr>";
                            echo "<td>";
                            echo $row['date_created'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['selected_time'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['table_id'];
                            echo "</td>";
                            echo "</tr>";
                        }
                    }

                    ?>

                    </tbody>
                </table>

                <!-- ĐẶT PHÒNG HỦY -->

                <table class="table X-table tabcontent_reservations" id="canceled_reservations">
                    <thead>
                    <tr>
                        <th>
                            Ngày tạo đặt bàn 
                        </th>
                        <th>
                            Lý do hủy 
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $stmt = $con->prepare("SELECT * 
                                                    FROM reservations
                                                    where 
                                                        canceled = 1
                                                    order by date_created;
                                                    ");
                    $stmt->execute();
                    $rows = $stmt->fetchAll();
                    $count = $stmt->rowCount();

                    if($count == 0)
                    {

                        echo "<tr>";
                        echo "<td colspan='5' style='text-align:center;'>";
                        echo "Danh sách đặt bàn đã hủy của bạn sẽ được hiển thị ở đây";  
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                    else
                    {

                        foreach($rows as $row)
                        {
                            echo "<tr>";
                            echo "<td>";
                            echo $row['date_created'];
                            echo "</td>";
                            echo "<td>";
                            echo $row['cancellation_reason'];
                            echo "</td>";
                            echo "</tr>";
                        }
                    }

                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- KẾT THÚC THẺ ĐẶT PHÒNG -->

    <?php

    include 'Includes/templates/footer.php';

}
else
{
    header("Location: index.php");
    exit();
}

?>

<!-- JS SCRIPTS -->

<script type="text/javascript">

    //KHI NHẤP VÀO NÚT ĐẶT HÀNG GIAO HÀNG

    $('.deliver_order_button').click(function()
    {

        var order_id = $(this).data('id');
        var do_ = 'Deliver_Order';

        $.ajax({
            url: "ajax_files/dashboard_ajax.php",
            type: "POST",
            data:{do_:do_,order_id:order_id,},
            success: function (data)
            {
                $('#deliver_order'+order_id).modal('hide');
                swal("Đơn hàng đã được giao","Đơn hàng đã được đánh dấu là đã giao", "success").then((value) =>  
                {
                    window.location.replace("dashboard.php");
                });

            },
            error: function(xhr, status, error)
            {
                alert('Đã xảy ra lỗi khi cố gắng xử lý yêu cầu của bạn!');  
            }
        });
    });

    //KHI NHẤP VÀO NÚT HỦY ĐẶT HÀNG

    $('.cancel_order_button').click(function()
    {

        var order_id = $(this).data('id');
        var cancellation_reason_order = $('#cancellation_reason_order_'+order_id).val();

        var do_ = 'Cancel_Order';


        $.ajax(
            {
                url: "ajax_files/dashboard_ajax.php",
                type: "POST",
                data:{order_id:order_id, cancellation_reason_order:cancellation_reason_order, do_:do_},
                success: function (data)
                {
                    $('#cancel_order'+order_id).modal('hide');
                    swal("Đơn hàng đã bị hủy","Đơn hàng đã bị hủy thành công", "success").then((value) =>  
                    {
                        window.location.replace("dashboard.php");
                    });
                },
                error: function(xhr, status, error)
                {
                    alert('Đã xảy ra lỗi khi cố gắng xử lý yêu cầu của bạn!');  
                }
            });
    });

</script>