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
    <title><?php echo $row17['web_name'];?> | products</title>
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
            <?php 
            date_default_timezone_set('Africa/Casablanca');
            echo "<div style='position:relative; margin-top:15px'><h2 style='margin-right:20px; font-size:32px; font-weight:lighter'>التحكم الرئيسيه</h2> <div style='background-color:#2C3E50;color:white; position:absolute; top:0; left:20px; border-radius: 12px; padding:5px 15px;'>".date("d/m/Y")."</div></div>";
            ?>
          <div class="path-bar">
                <div class="url-path active-path">الرئيسيه</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الاقسام</div>
                <button onclick="window.open('add_cat','_self');">اضف قسم جديد</button>
            </div>
            <?php
            $sql="SELECT * FROM category";
            $result=$conn->query($sql);
            while($row=$result->fetch_assoc()){
                echo "<div style='padding:12px 20px; display:flex; justify-content:space-between; width:94%; background-color:white; margin:10px 20px 10px 0 ; border:1px solid #ccc; border-radius:6px;'>";
                echo $row['cat_name'];
                echo "<div style='display:flex; gap:10px;>";
                echo "<td data-title='التحكم' class='text-center' style='display:flex; position: relative; top:-1px; justify-content:center; gap:20px;'>
                        <a style='text-decoration: none; color:black; background-color:#95A5A6; padding:3px 10px; border-radius:3px; font-weight:500px; ' href='edit_cat.php?cat_id=".$row['id']."' class='btn btn-default btn-xs' target='_blank'>تعديل</a>                         
                        <a href='#' onclick=\"confirmDelete('del_cat.php?cat_id=".$row['id']."')\" style='text-decoration: none; color:black; background-color:#E74C3C; padding:3px 10px; border-radius:3px; font-weight:500px; ' target='_self'>حذف</a>                        </td>
                        </td>";
                echo "</div>";
                echo "</div>";

            }
            ?>
            <script>
              function confirmDelete(url) {
              var result = confirm("هل أنت متأكد من حذف هذا القسم؟");
              if (result) {
                           window.location.href = url;
              } else {
                           window.location.href = "del_cat.php";
              }
             }
          </script>
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