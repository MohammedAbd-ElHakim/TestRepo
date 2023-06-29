<?php
require_once("./inc/connect.php");
session_start();
$cat_id = $_GET['cat_id']; 
// استخراج قيمة cat_id من العنوان الذي تم تمريره

// إجراء الاستعلام لحذف الصف المطابق للمعرف المحدد
$sql = "DELETE FROM category WHERE id = $cat_id";

// تنفيذ الاستعلام
if(mysqli_query($conn, $sql)) {
 header("Location:cat.php");
 exit();  
} else {
  echo "حدث خطأ أثناء حذف الصف: " . mysqli_error($conn);
  header("Location:cat.php");
 exit();;
}

?>