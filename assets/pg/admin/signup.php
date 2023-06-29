<?php 
require ("./inc/connect.php");
session_start();
$sql17="SELECT * FROM web_settings";
$result17=$conn->query($sql17);
$row17=$result17->fetch_assoc();

if(isset($_SESSION["admin_user"])){
    header('Location:home');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style">

    <title><?php echo $row17['web_name'];?> | تسجيل</title>
</head>
<body 
style="background-color: #333;
       color: white;
       background-image: url('bg1');
       background-size: cover;
       background-repeat: no-repeat;">

    <div class="login-box">
        <div class="login-title" style="font-size: 27px !important;">تسجيل مستخدم جديد</div>
 <?php
//  مستخدم موجود بالفعل
  if (isset($_POST['login-sub'])) {
    header("Location: admin");
    exit();
    }
 // التحقق من إرسال نموذج التسجيل
if (isset($_POST['sign-sub'])) {
    $username = $_POST['user-log'];
    $password = $_POST['pass-log'];
    $confirm_password = $_POST['repass-log'];
  
    // التحقق من عدم وجود مستخدم مسجل بنفس اسم المستخدم
    $check_user_query = "SELECT * FROM admin_login WHERE admin_user='$username'";
    $check_user_result = mysqli_query($conn, $check_user_query);
  
    if (mysqli_num_rows($check_user_result) > 0) {
      echo "اسم المستخدم مسجل مسبقًا. يرجى المحاولة مرة أخرى باستخدام اسم مستخدم مختلف.";
    } else if ($password != $confirm_password) {
      echo "كلمتي المرور غير متطابقتين. يرجى المحاولة مرة أخرى.";
    } else {
      // إضافة المستخدم الجديد إلى جدول المستخدمين
      $add_user_query = "INSERT INTO admin_login (admin_user, admin_pass) VALUES ('$username', '$password')";
      $add_user_result = mysqli_query($conn, $add_user_query);
  
      if ($add_user_result) {
        echo "تم تسجيل المستخدم بنجاح.";
      } else {
        echo "حدث خطأ أثناء تسجيل المستخدم: " . mysqli_error($conn);
      }
    }
  }
  
  // إغلاق اتصال قاعدة البيانات
  mysqli_close($conn);
 ?>
 <div class="login-form">
    <form action="" method="POST">
        <input type="text" name="user-log" id=""  placeholder="اسم المستخدم">
        <input type="password" name="pass-log" id=""  placeholder="كلمه المرور">
        <input type="password" name="repass-log" id=""  placeholder=" اعاده كلمه المرور">
        <input type="submit" name="sign-sub" id=""  value="تسجيل">
        <div>
        <p>هل لديك حساب بالفعل؟</p>
        <input type="submit" name="login-sub" id=""  value=" تسجيل الدخول ">
    </div>
    </form>
   
 </div>
    </div>
</body>
</html>