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
     <title><?php echo $row17['web_name'];?>| لوحه التحكم</title>
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
                 <div class="url-path active-path">الاقسام </div>
                 <div class="url-path slash">/</div>
                 <div class="url-path"> اضافه قسم </div>
              </div>
              <!--  -->
              <?php
            if (isset($_POST['cat_sub'])) {
                if (!isset($_POST['cat_name']) || empty(trim($_POST['cat_name']))) {
                    echo "<div style='margin:20px; color:red; font-size:18px; padding: 10px 15px; background-color:#ffe6e6;'>الرجاء ادخال قيمة</div>";
                } else {
                    // يتم إدخال القيمة في قاعدة البيانات
                    $cat_name = $_POST['cat_name'];
                    $sql9 = "SELECT MAX(id) AS last_id, MAX(list_num) AS last_num FROM category";
                    $result9 = $conn->query($sql9);
                    if ($result9->num_rows > 0) {
                        $row9 = $result9->fetch_assoc();
                        $num_count = $row9['last_id'] + 1;
                        $list_num = $row9['last_num'] + 1;
                    } else {
                        $num_count = 1;
                        $list_num = 1;
                    }
                    //   
                    $sql5="INSERT INTO category SET id=$num_count, cat_name='$cat_name', list_num=$list_num";
                    if($conn->query($sql5) === TRUE){
                        echo "<div style='margin:20px; font-size:18px; padding: 10px 15px; background-color:#e6fff5;'>لقد تم اضافه القسم بنجاح</div>";
                    } else {
                        echo "<div style='margin:20px; color: red; font-size:20px; padding:10px 15px; background-color:#e6fff5;'>لقد حدث خطا عند اضافه القسم</div>";
                    }
                }
            }
              ?>
               <!--  -->
               <div class="discount">
                 <div class="container-form" style="padding: 20px;">
                      <form action="" method="POST">
                          <div class="sub-data">
                             <p>الاسم</p>
                             <input type="text" name="cat_name" id="" placeholder="الاسم">
                          </div>
                             <input  class="save" name="cat_sub" type="submit" value="حفظ" style="margin-right:16.5%">
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