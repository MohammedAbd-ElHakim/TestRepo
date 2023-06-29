<?php
require_once("./inc/connect.php");
session_start();
if(isset($_GET['prd_id'])){
    $prd_id=$_GET['prd_id'];
    $prd_id2 = mysqli_real_escape_string($conn, $prd_id);
        // تحديث الحالة في جدول الطلبات
        $sql7 = "UPDATE orders SET status = 2 WHERE prd_id = '$prd_id2'";
        mysqli_query($conn, $sql7);
}
$sql17="SELECT * FROM web_settings";
$result17=$conn->query($sql17);
$row17=$result17->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style">
    <title><?php echo $row17['web_name'];?>| الطلبات</title>
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
                <div class="url-path">الطلبات/بانتظار التاكيد </div>
            </div>
            
            <table class="table table-bordered" role="tble">
              <thead>
                  <tr>
                     <th width="2%">#</th>
                     <th class="text-right" width="15%">المنتج</th>
                     <th class="text-right" width="15%">اسم المشتري</th>
                     <th class="text-right" width="10%">رقم الهاتف</th>
                     <th class="text-right" width="10%">المدينه</th>
                     <th class="text-right" width="10%">تاريخ الطلب</th>
                     <th class="text-right" width="15%">سعر الطلب</th>
                     <th class="text-right" width="30%">الحاله</th>
                     <th class="text-right" width="30%">التحكم</th>
                  </tr>
                </thead>
                <!--  -->

                <tbody style="background-color:#ECF0F1; text-align:center;">
                    <?php
                    if (isset($_GET['delete_id'])) {
                        // حذف الطلب من قاعدة البيانات
                      $order_id = $_GET['delete_id'];
                      $delete_sql = "DELETE FROM orders WHERE id=$order_id";
                      if (mysqli_query($conn, $delete_sql)) {
                        echo "تم حذف الطلب بنجاح";
                      } else {
                        echo "خطأ في حذف الطلب: " . mysqli_error($conn);
                      }

                      // إغلاق الاتصال بقاعدة البيانات
                      mysqli_close($conn);
                    }

                    $sql="SELECT * FROM orders";
                    $result=$conn->query($sql);
                    while($row=$result->fetch_assoc()){
                        if($row['status'] != '1'){
                          continue;
                        }
                        
                        $sql2='SELECT title FROM products where id='.$row["products_id"];
                        $result2=$conn->query($sql2);
                        $products_name = null;
                        while($row2=$result2->fetch_assoc()){
                            $products_name=$row2["title"];
                        }
                        $quan=$row["quantity"];
                        echo "<tr> 
                        <td>".$row['id']."</td>
                        <td><span class='badge'>". $products_name . "/". $row["quantity"]."</span></td>
                        <td>".$row['name']."</td>
                        <td>".$row['phone']."</td>
                        <td>".$row['city']."</td>
                        <td>".$row['date']."</td>
                        <td>".$row['price']."</td>
                        <td>";
                              
                        // طلب ملغي 
                        if($row['status'] === '0') {
                            echo "طلب ملغي ";
                        }
                        // بانتظار التاكيد
                        if($row['status'] === '1') {
                            echo "بانتظار التاكيد";
                        }
                        // بانتظار الشحن
                        if($row['status'] === '2') {
                            echo "بانتظار الشحن";
                        }
                        //  تم الارسال
                        if($row['status'] === '3') {
                            echo "تم الارسال ";
                        }
                        // تم الغاء الطلب
                        if($row['status'] === '4') {
                            echo "تم الغاء الطلب ";
                        }
                        // تم الاستلام
                        if($row['status'] === '5') {
                            echo "تم الاستلام ";
                        }
                        $product_id=$row['id'];
                        echo "</td>
                        <td data-title='التحكم' class='text-center' style='display:flex; flex-direction:column;'>
                        <a style='text-decoration: none; color:black; background-color:#95A5A6; padding:3px 10px; margin-bottom:3px; border-radius:3px; font-weight:500px; ' href='http://localhost/ecomweb/dtail_Ofreq1?prd_id=$product_id&&prd_name=$products_name&&prd_quantity=$quan ' class='btn btn-default btn-xs' target='_blank'>التفاصيل</a>                         
                        <a href='?delete_id=" . $row["id"] . "' onclick='return confirm(\"هل أنت متأكد من حذف الطلب؟\")' style='text-decoration: none; color:black; background-color:#E74C3C; padding:3px 10px; border-radius:3px; font-weight:500px; '>الغاء الطلب</a>
                    </td>
                </tr>";
                    }
                    ?>
                </tbody>
            </table>
            
            <form action="http://localhost/ecomweb/detail_order" method="POST">
              <input type="hidden" name="prduct_name" value="<?php
                 echo $product_name; ?>">
           </form>
            
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