-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
-- Host: localhost:3306
-- Generation Time: Dec 1, 2024 at 08:00 AM
-- Server version: 8.0.37
-- PHP Version: 7.4.33

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
time_zone = "+00:00";

SET NAMES utf8mb4;

-- Database: `order_food_web`

-- --------------------------------------------------------

-- Table structure for table `clients`
CREATE TABLE `clients`
(
    `client_id`    int          NOT NULL AUTO_INCREMENT,
    `client_name`  varchar(50)  NOT NULL,
    `client_phone` varchar(50)  NOT NULL,
    `client_email` varchar(100) NOT NULL,
    PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table `clients`
INSERT INTO `clients` (`client_name`, `client_phone`, `client_email`)
VALUES ('Nguyễn Văn A', '0901234567', 'nguyenvana@gmail.com'),
       ('Trần Thị B', '0912345678', 'tranthib@gmail.com'),
       ('Lê Văn C', '0923456789', 'levanc@gmail.com'),
       ('Phạm Văn D', '0934567890', 'phamvand@gmail.com'),
       ('Hoàng Thị E', '0945678901', 'hoangthie@gmail.com'),
       ('Võ Văn F', '0956789012', 'vovanf@gmail.com'),
       ('Đặng Thị G', '0967890123', 'dangthig@gmail.com'),
       ('Phan Văn H', '0978901234', 'phanvanh@gmail.com'),
       ('Bùi Thị I', '0989012345', 'buithii@gmail.com'),
       ('Lý Văn J', '0990123456', 'lyvanj@gmail.com');

-- --------------------------------------------------------

-- Table structure for table `image_gallery`
CREATE TABLE `image_gallery`
(
    `image_id`   int          NOT NULL AUTO_INCREMENT,
    `image_name` varchar(30)  NOT NULL,
    `image`      varchar(255) NOT NULL,
    PRIMARY KEY (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table `image_gallery`
INSERT INTO `image_gallery` (`image_name`, `image`)
VALUES ('Món ăn 1', 'images/monan1.jpg'),
       ('Món ăn 2', 'images/monan2.jpg'),
       ('Món ăn 3', 'images/monan3.jpg'),
       ('Món ăn 4', 'images/monan4.jpg'),
       ('Món ăn 5', 'images/monan5.jpg'),
       ('Món ăn 6', 'images/monan6.jpg'),
       ('Món ăn 7', 'images/monan7.jpg'),
       ('Món ăn 8', 'images/monan8.jpg'),
       ('Món ăn 9', 'images/monan9.jpg'),
       ('Món ăn 10', 'images/monan10.jpg');

-- --------------------------------------------------------

-- Table structure for table `menu_categories`
CREATE TABLE `menu_categories`
(
    `category_id`   int         NOT NULL AUTO_INCREMENT,
    `category_name` varchar(50) NOT NULL,
    PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table `menu_categories`
INSERT INTO `menu_categories` (`category_name`)
VALUES ('Món khai vị'),
       ('Món chính'),
       ('Tráng miệng'),
       ('Đồ uống'),
       ('Combo tiết kiệm'),
       ('Món chay'),
       ('Hải sản'),
       ('Thịt nướng'),
       ('Ăn nhẹ'),
       ('Bánh ngọt');

-- --------------------------------------------------------

-- Table structure for table `menus`
CREATE TABLE `menus`
(
    `menu_id`          int           NOT NULL AUTO_INCREMENT,
    `menu_name`        varchar(100)  NOT NULL,
    `menu_description` varchar(255)  NOT NULL,
    `menu_price`       decimal(6, 2) NOT NULL,
    `menu_image`       varchar(255)  NOT NULL,
    `category_id`      int           NOT NULL,
    PRIMARY KEY (`menu_id`),
    FOREIGN KEY (`category_id`) REFERENCES `menu_categories` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table `menus`
INSERT INTO `menus` (`menu_name`, `menu_description`, `menu_price`, `menu_image`, `category_id`)
VALUES ('Gỏi cuốn', 'Gỏi cuốn tươi ngon với tôm và rau sống', 35000, 'images/goicuon.jpg', 1),
       ('Phở bò', 'Phở bò truyền thống với hương vị đậm đà', 60000, 'images/phobo.jpg', 2),
       ('Chè đậu xanh', 'Món chè tráng miệng mát lạnh', 20000, 'images/che.jpg', 3),
       ('Cà phê sữa', 'Cà phê sữa đá thơm ngon', 25000, 'images/cafe.jpg', 4),
       ('Combo tiết kiệm', 'Phần ăn gồm cơm, canh và thịt kho', 80000, 'images/combo.jpg', 5),
       ('Rau củ luộc', 'Rau củ luộc chấm mắm kho', 40000, 'images/raucu.jpg', 6),
       ('Tôm hấp bia', 'Tôm tươi hấp bia', 150000, 'images/tomhap.jpg', 7),
       ('Sườn nướng', 'Sườn nướng mật ong', 130000, 'images/suonuong.jpg', 8),
       ('Khoai tây chiên', 'Khoai tây chiên giòn rụm', 30000, 'images/khoaitay.jpg', 9),
       ('Bánh bông lan', 'Bánh bông lan mềm mại', 35000, 'images/banh.jpg', 10);

-- --------------------------------------------------------

-- Table structure for table `placed_orders`
CREATE TABLE `placed_orders`
(
    `order_id`            int          NOT NULL AUTO_INCREMENT,
    `order_time`          datetime     NOT NULL,
    `client_id`           int          NOT NULL,
    `delivery_address`    varchar(255) NOT NULL,
    `delivered`           tinyint(1) NOT NULL DEFAULT 0,
    `canceled`            tinyint(1) NOT NULL DEFAULT 0,
    `cancellation_reason` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`order_id`),
    FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table `placed_orders`
INSERT INTO `placed_orders` (`order_time`, `client_id`, `delivery_address`, `delivered`, `canceled`,
                             `cancellation_reason`)
VALUES ('2024-11-30 08:00:00', 1, '123 Đường A, Quận B', 1, 0, NULL),
       ('2024-11-30 08:30:00', 2, '456 Đường C, Quận D', 1, 0, NULL),
       ('2024-11-30 09:00:00', 3, '789 Đường E, Quận F', 0, 0, NULL),
       ('2024-11-30 09:30:00', 4, '101 Đường G, Quận H', 0, 1, 'Khách hủy đơn hàng'),
       ('2024-11-30 10:00:00', 5, '202 Đường I, Quận J', 1, 0, NULL),
       ('2024-11-30 10:30:00', 6, '303 Đường K, Quận L', 0, 1, 'Không có người nhận'),
       ('2024-11-30 11:00:00', 7, '404 Đường M, Quận N', 0, 0, NULL),
       ('2024-11-30 11:30:00', 8, '505 Đường O, Quận P', 1, 0, NULL),
       ('2024-11-30 12:00:00', 9, '606 Đường Q, Quận R', 0, 1, 'Địa chỉ không tồn tại'),
       ('2024-11-30 12:30:00', 10, '707 Đường S, Quận T', 1, 0, NULL);

-- --------------------------------------------------------

-- Table structure for table `reservations`
CREATE TABLE `reservations`
(
    `reservation_id`      int      NOT NULL AUTO_INCREMENT,
    `date_created`        datetime NOT NULL,
    `client_id`           int      NOT NULL,
    `selected_time`       datetime NOT NULL,
    `nbr_guests`          int      NOT NULL,
    `table_id`            int      NOT NULL,
    `liberated`           tinyint(1) NOT NULL DEFAULT 0,
    `canceled`            tinyint(1) NOT NULL DEFAULT 0,
    `cancellation_reason` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`reservation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table `reservations`
INSERT INTO `reservations` (`date_created`, `client_id`, `selected_time`, `nbr_guests`, `table_id`, `liberated`,
                            `canceled`, `cancellation_reason`)
VALUES ('2024-11-29 08:00:00', 1, '2024-12-01 18:00:00', 4, 1, 0, 0, NULL),
       ('2024-11-29 08:15:00', 2, '2024-12-01 19:00:00', 2, 2, 0, 0, NULL),
       ('2024-11-29 08:30:00', 3, '2024-12-01 20:00:00', 6, 3, 0, 0, NULL),
       ('2024-11-29 08:45:00', 4, '2024-12-01 21:00:00', 8, 4, 0, 1, 'Hủy do bận công việc'),
       ('2024-11-29 09:00:00', 5, '2024-12-02 18:00:00', 10, 5, 0, 0, NULL),
       ('2024-11-29 09:15:00', 6, '2024-12-02 19:00:00', 3, 6, 0, 1, 'Khách báo không đến'),
       ('2024-11-29 09:30:00', 7, '2024-12-02 20:00:00', 7, 7, 0, 0, NULL),
       ('2024-11-29 09:45:00', 8, '2024-12-02 21:00:00', 5, 8, 0, 0, NULL),
       ('2024-11-29 10:00:00', 9, '2024-12-03 18:00:00', 4, 9, 0, 1, 'Hủy do sai thời gian đặt'),
       ('2024-11-29 10:15:00', 10, '2024-12-03 19:00:00', 2, 10, 0, 0, NULL);

COMMIT;
