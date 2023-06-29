<?php
require_once("./inc/connect.php");
$sql17="SELECT * FROM web_settings";
$result17=$conn->query($sql17);
$row17=$result17->fetch_assoc();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="style">
     <title><?php echo $row17['web_name'];?> | لوحه التحكم</title>
 </head>
  <body>
       <div class="header">
          <div class="header-title">لوحه التحكم</div>
          <div class="side-menu">
             <div class="menu-item">اعدادات الموقع</div>
             <div class="menu-item" style="color:#E74C3C;" onclick="window.open('logout','_self');">تسجيل الخروج</div>
          </div>
       </div>

       <div class="content">
           <div class="side-bar">
              <div class="item-bar" onclick="window.open('home','_Self');">الصفحة الرئيسية</div>
              <div class="item-bar" onclick="window.open('products', '_self');">المنتوجات</div>
              <div id="req1" class="item-bar" onclick="sub_menu_open();">الطلبات</div>           
            <div id="req2" class="item-bar" onclick="sub_menu_close();">الطلبات</div>           

          <div id="sub-menu" class="sub-menu">
               <div onclick="window.open('requests','_self');">  الكل </div>
               <div onclick="window.open('req1','_self');"> بانتظار التاكيد</div>
               <div onclick="window.open('req2','_self');">  بانتظار الشحن</div>
               <div onclick="window.open('req3','_self');">  تم الارسال</div>
               <div onclick="window.open('req4','_self');">  تم الغاء الطلب</div>
               <div onclick="window.open('req5','_self')">  تم الاستلام</div>
         </div>
           <div class="item-bar" onclick="window.open('discount','_self');">الخصومات</div>
            <div class="item-bar" onclick="window.open('cat','_self')";>الاقسام</div>
            <div class="item-bar"  onclick="window.open('directors','_self')">المدراء</div>
            <div class="item-bar"  onclick="window.open('settings','_self')">إعدادات الموقع</div>
           </div>
         <div class="content-bar">
             <div class="path-bar">
                 <div class="url-path active-path">الرئيسيه</div>
                 <div class="url-path slash">/</div>
                 <div class="url-path active-path">المدراء </div>
                 <div class="url-path slash">/</div>
                 <div class="url-path"> اضافه مدير </div>
              </div>
              <!--  -->
              <?php
 // التحقق من إرسال نموذج التسجيل
if (isset($_POST['sub_admin'])) {
  if(!empty($_POST['admin_name']) && !empty($_POST['admin_pass']) && !empty($_POST['admin_repass'])){
    $username = $_POST['admin_name'];
    $password = $_POST['admin_pass'];
    $confirm_password = $_POST['admin_repass'];
  
    // التحقق من عدم وجود مستخدم مسجل بنفس اسم المستخدم
    $check_user_query = "SELECT * FROM admin_login WHERE admin_user='$username'";
    $check_user_result = mysqli_query($conn, $check_user_query);
  
    if (mysqli_num_rows($check_user_result) > 0) {
      echo "اسم المدير مسجل مسبقًا. يرجى المحاولة مرة أخرى باستخدام اسم مدير مختلف.";
    } else if ($password != $confirm_password) {
      echo "كلمتي المرور غير متطابقتين. يرجى المحاولة مرة أخرى.";
    } else {
      // إضافة المستخدم الجديد إلى جدول المستخدمين
      $add_user_query = "INSERT INTO admin_login (admin_user, admin_pass) VALUES ('$username', '$password')";
      $add_user_result = mysqli_query($conn, $add_user_query);
  
      if ($add_user_result) {
        echo "تم اضافه المدير الجديد بنجاح.";
      } else {
        echo "حدث خطأ أثناء اضافه المدير الجديد: " . mysqli_error($conn);
      }
    }
  }else{
    echo "<div style='margin:20px; color:red; font-size:18px; padding: 10px 15px; background-color:#ffe6e6; text-align: start;'>الرجاء ملاء الفراغات</div>";

  }
}
  
  // إغلاق اتصال قاعدة البيانات
  mysqli_close($conn);
 ?>
               <!--  -->
               <div class="discount">
                 <div class="container-form" style="padding: 20px;">
                      <form action="" method="POST">
                      <div class="sub-data">
                             <p>اسم المستخدم :</p>
                             <input type="text" name="admin_name" id="" placeholder="ادخل اسم المستخدم ">
                          </div>

                          <div class="sub-data">
                             <p> كلمه السر :</p>
                             <input type="text" name="admin_pass" id="" placeholder= "اكتب كلمه السر ">
                          </div>

                          <div class="sub-data">
                             <p> تاكيد كلمه السر :</p>
                             <input type="text" name="admin_repass" id="" placeholder= "اكتب كلمه السر ">
                          </div>
                             <input  class="save" type="submit" name="sub_admin" value="اضف الان" style="margin-right:16.5%">
                       </form>
                 </div>
              </div>
         </div>
      </div>
     <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
     <script>
             function sub_menu_open(){
                 document.getElementById("req1").style.display="none";
                 document.getElementById("req2").style.display="block";
                 document.getElementById("sub-menu").style.height="275px";
                }
                function sub_menu_close(){
                 document.getElementById("req1").style.display="block";
                 document.getElementById("req2").style.display="none";
                 document.getElementById("sub-menu").style.height="0px";
                }
          </script>
   </body>
</html>