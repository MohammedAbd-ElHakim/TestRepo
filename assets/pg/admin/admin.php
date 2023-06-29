<?php 
require ("./inc/connect.php");
$sql17="SELECT * FROM web_settings";
$result17=$conn->query($sql17);
$row17=$result17->fetch_assoc();
session_start();

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

    <title><?php echo $row17['web_name'];?>| تسجيل الدخول</title>
</head>
<body 
style="background-color: #333;
       color: white;
       background-image: url('bg1');
       background-size: cover;
       background-repeat: no-repeat;">

    <div class="login-box">
        <div class="login-title">تسجيل الدخول</div>
 <?php
    //   تسجيل مستخدم جديد
      if (isset($_POST['signup-log'])) {
      header("Location: signup");
      exit();
      }
    //   تسجيل الدخول
     // تسجيل الدخول
if(isset($_POST['sub-log'])){
    $user_login = htmlspecialchars($_POST['user-log']);
    $user_pass = htmlspecialchars($_POST['pass-log']);

    // استرداد بيانات المستخدم الجديد المعتمدة على اسم المستخدم وكلمة المرور المدخلة
    $sql = "SELECT * FROM admin_login WHERE admin_user='$user_login' AND admin_pass='$user_pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // تسجيل الدخول ناجح
        $_SESSION['admin_user'] = $user_login;
        header("Location:home.php");
    } else {
        // رسالة خطأ في حالة عدم توفر بيانات المستخدم الجديد
        echo "<div style='color:red;font-size:18px;font-weight:500; text-align=center;'>المعلومات التي ادخلت غير صحيحه</div>";
    }
}
 ?>
 <div class="login-form">
    <form action="" method="POST">
        <input type="text" name="user-log" id=""  placeholder="اسم المستخدم">
        <input type="password" name="pass-log" id=""  placeholder="كلمه المرور">
        <input type="submit" name="sub-log" id=""  value="دخول">
        <div style="display:flex; flex-direction: column;">
        <p>هل انت مستخدم جديد؟</p>
        <input type="submit" name="signup-log" id=""  value=" تسجيل مستخدم جديد ">
        </div>
    </form>
 </div>
    </div>
</body>
</html>