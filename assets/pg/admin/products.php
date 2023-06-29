<?php
require_once("./inc/connect.php");
$sql17="SELECT * FROM web_settings";
$result17=$conn->query($sql17);
$row17=$result17->fetch_assoc();
SESSION_START();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style">
    <title><?php echo $row17['web_name'];?>| products</title>
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
                <div class="url-path">المنتوجات </div>
                <button onclick="window.open('add_product','_self');">اضف منتوج جديد</button>
            </div>
            <table class="table table-bordered" role="tble">
                <thead>
                    <tr>
                        <th width="2%">#</th>
                        <th class="text-right" width="15%">عنوان المنتج</th>
                        <th class="text-right" width="15%">السعر الاصلي</th>
                        <th class="text-right" width="10%">السعر بعد التخفيض</th>
                        <th class="text-right" width="10%">عددالمبيعات</th>
                        <th class="text-right" width="10%">عددالتقييمات</th>
                        <th class="text-right" width="10%">عددالتقييمات بانتظار التاكيد</th>
                        <th class="text-right" width="15%">التحكم</th>
                    </tr>
                </thead>
                <tbody style='background-color:#ECF0F1; text-align:center;'>

                    <?php
                    $sql="SELECT * FROM products";
                    $result=$conn->query($sql);

                    while($row=$result->fetch_assoc()){
                        echo "<tr> 
                        <td><span class='badge'>".$row['id']."</span></td>
                        <td>".$row['title']."</td>
                        <td>".$row['old_price']." SDG</td>
                        <td>".$row['price']." SDG</td>
                        <td>1</td>
                        <td><a style='text-decoration: none; color:black;' href='http://localhost/ecom/home/show/4' target='_blank'>0</a></td>
                        <td style='padding:12px;'><a style='text-decoration: none; color:black;' href='http://localhost/ecom/home/show/4' target='_blank'>0</a></td>
                        <td data-title='التحكم' class='text-center'>
                        <a style='text-decoration: none; color:black; background-color:#95A5A6; padding:3px 10px; border-radius:3px; font-weight:500px; ' href='edit_product.php?prd_id=".$row['id']."&prd_name=".$row['title']."' class='btn btn-default btn-xs' target='_blank'>تعديل</a>                         
                        <a href='#' onclick=\"confirmDelete('delete_product.php?del_id=".$row['title']."&id=".$row['id']."')\" style='text-decoration: none; color:black; background-color:#E74C3C; padding:3px 10px; border-radius:3px; font-weight:500px; ' target='_self'>حذف</a>                        </td>
                      </tr>";
                    }

                     ?>
                </tbody>
            </table>
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
    <!-- سكريبت رساله الحزف -->
    <script>
  function confirmDelete(url) {
    var result = confirm("هل أنت متأكد من حذف هذا المنتج؟");
    if (result) {
      window.location.href = url;
    } else {
      window.location.href = "products.php";
    }
  }
</script>
</body>
</html>