<?php
require_once("./inc/connect.php");
session_start();
$admin_id = $_GET['admin_id']; 
// استخراج قيمة cat_id من العنوان الذي تم تمريره

// إجراء الاستعلام لحذف الصف المطابق للمعرف المحدد
$sql = "DELETE FROM admin_login WHERE admin_id =$admin_id";

// تنفيذ الاستعلام
if(mysqli_query($conn, $sql)) {
 header("Location:directors.php");
 exit();  
} else {
  echo "حدث خطأ أثناء حذف الصف: " . mysqli_error($conn);
  header("directors.php");
 exit();;
}
?>