<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="loader_pack">
    <div class="loader"></div>
     <span>...يتم انشاء الجداول الان المرجو الانتظار</span>
    </div>
    <style>
        .loader_pack{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50% ,-50%);
            display: flex;
            flex-direction: column;
            align-items: center;    
            font-size:20px;   
        }

        .loader{
            margin:0 auto 20px auto;
            border-radius:50%;
            border-top:8px solid #db3470d4;
            width:50px;
            height:50px;
            -webkit-animation:spin 2s linear infinite;
            animation:spin 2s linear infinite;
            
        }

        @-webkit-keyframes spin {
            0%{
                -webkit-transform:rotate(0deg);
            }
            100%{
                -webkit-transform:rotate(360deg);
            }
        }

        @keyframes spin {
           0%{transform:rotate(0deg);}
            100%{transform:rotate(360deg);}
        }
    </style>
</body>
</html>
<?php
require_once("connect.php");
session_start();
// error_reporting();

// التحقق من وجود الجداول المطلوبة
$table1 = 'admin_login';
$table2 = 'category';
$table3 = 'coupon';
$table4 = 'orders';
$table5 = 'products';
$table6 = 'web_settings';

$tables = array($table1, $table2, $table3, $table4, $table5, $table6);

$missing_tables = array();

foreach ($tables as $table) {
    $result = $conn->query("SHOW TABLES LIKE '$table'");
    if ($result->num_rows == 0) {
        // إضافة الجدول المفقود إلى القائمة
        $missing_tables[] = $table;
    }
}

// إنشاء الجداول المفقودة
if (!empty($missing_tables)) {
    $sql="CREATE TABLE `admin_login` (
        `admin_id` int(255) NOT NULL AUTO_INCREMENT,
        `admin_user` varchar(255) NOT NULL,
        `admin_pass` varchar(255) NOT NULL,
        PRIMARY KEY (`admin_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
    //create category
    $sql2="CREATE TABLE `category` (
        `id` int(55) NOT NULL AUTO_INCREMENT,
        `cat_name` varchar(255) NOT NULL,
        `list_num` int(11) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
    // create coupon table
    $sql3="CREATE TABLE `coupon` (
        `id` int(22) NOT NULL AUTO_INCREMENT,
        `coupon_name` varchar(255) NOT NULL,
        `date` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
    // create orders table
    $sql4="CREATE TABLE `orders` (
        `id` int(22) NOT NULL AUTO_INCREMENT,
        `products_id` int(22) NOT NULL,
        `name` varchar(255) NOT NULL,
        `phone` varchar(255) NOT NULL,
        `address` varchar(255) NOT NULL,
        `city` varchar(255) NOT NULL,
        `coupon` varchar(255) NOT NULL,
        `price` varchar(255) NOT NULL,
        `shipping` varchar(255) NOT NULL,
        `date` varchar(255) NOT NULL,
        `status` varchar(255) NOT NULL,
        `quantity` int(255) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
    // create products table
    $sql5="CREATE TABLE `products` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(255) NOT NULL,
        `disc` varchar(255) NOT NULL,
        `price` varchar(255) NOT NULL,
        `old_price` varchar(255) NOT NULL,
        `shipping` varchar(255) NOT NULL,
        `shipping_info` varchar(255) NOT NULL,
        `category` varchar(255) DEFAULT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
    // create web_settings table
    $sql6="CREATE TABLE `web_settings` (
        `id` int(22) NOT NULL AUTO_INCREMENT,
        `web_name` varchar(255) NOT NULL,
        `whatsup_num` varchar(255) NOT NULL,
        `header_txt` varchar(255) NOT NULL,
        `web_desc` varchar(255) NOT NULL,
        `fb_pixel` varchar(255) NOT NULL,
        `gl_analytics` varchar(255) NOT NULL,
        `web_logo` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";

    // تنفيذ جميع الاستعلامات والتحقق من نجاحها
    $success = true;
    if ($conn->query($sql) !== true) {
        $success = false;
    }
    if ($conn->query($sql2) !== true) {
        $success = false;
    }
    if ($conn->query($sql3) !== true) {
        $success = false;
    }
    if ($conn->query($sql4) !== true) {
        $success = false;
    }
    if ($conn->query($sql5) !== true) {
        $success = false;
    }
    if ($conn->query($sql6) !== true) {
        $success = false;
    }

    if ($success) {
        // توجيه المستخدم إلى صفحة الإعدادات
        header("Location:update_settings");
        exit();
    } else {
        // عرض رسالة الخطأ المناسبة
        echo "Error creating tables: " . $conn->error;
    }

} else {
    // توجيه المستخدم إلى صفحة الإعدادات
    header("Location:update_settings");
    exit();
}
?>