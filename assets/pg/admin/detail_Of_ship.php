<?php
require_once("./inc/connect.php");
$sql17="SELECT * FROM web_settings";
$result17=$conn->query($sql17);
$row17=$result17->fetch_assoc();
session_start();
if(isset($_GET["prd_id"])){
    $sql="SELECT * FROM orders where id=". $_GET["prd_id"];
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    $prd_id=$_GET["prd_id"];
}

 if(isset($_GET['prd_name'])){
    $product_name=$_GET['prd_name'];
}

if(isset($_GET['prd_quantity'])){
  $prd_quan=$_GET['prd_quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style">
    <title><?php echo $row17['web_name'];?>| تفاصيل الطلب</title>
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
                <div class="url-path">تفاصيل الطلب </div>
            </div>
            <div class="detail_countainer">
                <!-- المنتج -->
               <div class="first_box">
                 <div class="box_product  box">
                 <p class="text">المنتج :</p>
                  <div class="product det">
                     <?php
                     echo $product_name;
                     ?>
                 </div>
                 </div>
                 <!--الكميه-->
                 <div class="box quantity  box">
                 <p class="text">الكميه :</p>
                  <div class="product det">
                     <?php
                     echo $prd_quan;
                     ?>
                 </div>
                 </div>
                 <!--الاسم -->
                 <div class="box_name  box">
                 <p class="text">الاسم الكامل :</p>
                 <div class="name det">
                     <?php
                     echo $row['name']
                     ?>
                 </div>
                 </div>
                 <!-- رقم الهاتف -->
                 <div class="box_phone  box">
                 <p class="text">رقم الهاتف :</p>
                 <div class="phone det">
                     <?php
                     echo " ".$row['phone']
                     ?>
                 </div>
                 </div>
                 <!--  العنوان -->
                 <div class="box_address  box">
                   <p class="text">العنوان :</p>
                   <div class="address det">
                     <?php
                     echo " ".$row["address"]
                     ?>
                  </div>
                 </div> 
                  <!-- button -->
             <div style="display:flex; flex-direction:column; ">
             <form action="http://localhost/ecomweb/ship_to_send?prd_id=<?php echo urlencode($prd_id); ?>&prd_name=<?php echo urlencode($product_name); ?>" method="POST">
                <button class="mbtn" type="submit" name="submit"> ارسال المنتج</button>       
             </form>
               </div>   
               </div>
               
               <!-- second box -->
                <!--  المدينه -->
                <div class="second_box">
                <div class="box_city  box">
                 <p class="text" >المدينه :</p>
                 <div class="city det">
                    <?php
                    echo $row["city"];
                    ?>
                </div>
               </div>
                <!--  الكوبون -->
                <div class="box_coupon  box">
                 <p class="text">كود التخفيض :</p>
                 <div class="coupon det">
                    <?php
                    echo $row['coupon'];
                    ?>
                </div>
               </div>
               <!-- سعر الوحده -->
               <div class="box_price  box">
                 <p class="text">سعر الوحده  :</p>
                 <div class="price det ">
                    <?php
                    echo $row['price'] ;
                    ?>
                    </div>
                </div>
               <!-- سعر الشحن -->
               <div class="box_price  box">
                 <p class="text">سعر الشحن  :</p>
                 <div class="price det ">
                    <?php
                    echo  $row['shipping'];
                    ?>
                    </div>
                </div>
                <!--  السعر الاجمالي -->
                <div class="box_price  box">
                 <p class="text">السعر الاجمالي :</p>
                 <div class="price det ">
                    <?php
                    echo ( $row['price'] + $row['shipping']) * $prd_quan;
                    ?>
                </div>
               </div>
                <!--  حاله الطلب  -->
                <div class="box_status box">
                 <p class="text">حاله الطلب :</p>
                 <div class="status det">
                    <?php
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
                    ?>
                </div>
               </div>
             </div>
             </div>
             
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
     <style> 
           .detail_countainer{
            margin-right:40px;
            display:flex;
           }  
           .first_box{
            flex:1;
           } 
           .second_box{
            flex:1;
           }
           button{
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 2px 10px 0 rgba(0, 0, 0, 0.19);
            margin-right: 5%;
            width:25%;
          }    
        .det{
            font-size:18px;
            padding-right:5px;
        }
        .text{
            color:red;
            font-weight: 500;
            font-size: 18px;
        }

        .box{
            display:flex;
            align-items:center;
        }
     </style>
    </body>
</html>

