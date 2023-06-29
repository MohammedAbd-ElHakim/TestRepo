<?php
require_once("./inc/connect.php");
session_start();
$sql = "DELETE FROM coupon WHERE id = " . $_GET["coupon_id"];
if (mysqli_query($conn, $sql)) {
    // رسالة تأكيد الحذف
    echo "تم حذف الكوبون بنجاح.";
    // إغلاق الاتصال بقاعدة البيانات
    mysqli_close($conn);
    // إعادة توجيه المستخدم إلى صفحة الديسكاونت بعد الحذف
    header('Location: http://localhost/ecomweb/discount');
    exit();
} else {
    header('Location: http://localhost/ecomweb/discount');
    exit();
}
?>