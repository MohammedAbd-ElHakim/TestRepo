<?php
require_once("./inc/connect.php");
session_start();
error_reporting(E_ALL);

// التحقق من وجود معرف المنتج واسم المنتج في العنوان
// if()
if(isset($_GET['prd_id']) && isset($_GET['prd_name'])) {
    $prd_id = $_GET['prd_id'];
    $prd_id = intval($_GET['prd_id']);
    $prd_name = $_GET['prd_name'];
    echo "id:".$prd_id;

    // تحديث حالة الطلب في جدول الطلبات في قاعدة البيانات
    $sql = "UPDATE orders SET status = 5 WHERE id = $prd_id";
        if(mysqli_query($conn, $sql)) {
        // إذا تم تحديث الحالة بنجاح، يتم توجيه المستخدم إلى صفحة request_wait_ship.php
        header("Location: req3?prd_id=$prd_id&&prd_name=$prd_name&&prd_quantity=$quan");
        exit();
    } else {
        // إذا حدث خطأ أثناء تحديث الحالة، يتم إظهار رسالة خطأ
        echo "حدث خطأ أثناء تحديث الحالة";
    }
} else {
    // إذا لم يتم تمرير معرف المنتج أو اسم المنتج في العنوان، يتم إظهار رسالة خطأ
    echo "حدث خطأ أثناء تحميل الصفحة";
}
?>