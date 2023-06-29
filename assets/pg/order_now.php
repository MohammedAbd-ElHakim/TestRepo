<?php
      require_once('./admin/inc/connect.php');
      $sql17="SELECT * FROM web_settings";
      $result17=$conn->query($sql17);
      $row17=$result17->fetch_assoc();
      session_start();
    //   $prd_id=$_GET['$prd_id'];
      ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- style css -->
    <link rel="stylesheet" href="http://localhost/ecomweb/assets/css/style.css"> 
    <!--bootstrab-->
    <link rel="stylesheet" href="http://localhost/ecomweb/assets/pg/admin/bootstrab/bootstrap-5.0.2-dist/css/bootstrap.css"> 
      <!--bootstrab min css -->
    <link rel="stylesheet" href="http://localhost/ecomweb/assets/pg/admin/bootstrab/bootstrap-5.0.2-dist/css/bootstrap.min.css"> 
    <!--bootstrab js -->
    <script src="http://localhost/ecomweb/assets/pg/admin/bootstrab/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
    <!--bootstrab jquery -->
    <script src="http://localhost/ecomweb/assets/pg/admin/bootstrab/bootstrap-5.0.2-dist/jquery.js"></script>
    <!--bootstrab min js -->
    <script src="http://localhost/ecomweb/assets/pg/admin/bootstrab/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <title><?php echo $row17['web_name'];?>  | order</title>
</head>
<body>
   <div class="header-bar">
   <?php echo $row17['header_txt'];?>    </div>
    </div>
   
    <header>
        <div class="center-bar">
    <p>
        <span class="ecom" onclick="window.open('http://localhost/ecomweb/index','_self')" style="cursor:pointer;">web</span><span class="web" onclick="window.open('http://localhost/ecomweb/index','_self')" style="cursor:pointer;" >Ecom</span>
    </p>
        <button> التخفيضات</button>
        </div>
    </header>
    <div class="show_prd" style="padding:15px; border:0;">
    <!-- first box -->
        <div style="margin-left:15px;">
            <?php
             $sql='SELECT * FROM products WHERE id=' . $_GET["prd_id"];
             $result=$conn->query($sql);
             $row=$result->fetch_assoc();
            ?>
             <!-- order now box -->
             <div class="order_now_box">
                 <div class="order_now_img">
                     <?php
                 // تحديد مسار المجلد الذي توجد به الصور
                 $dir = $_SERVER['DOCUMENT_ROOT'] . '/ecomweb/assets/pg/admin/products_image/' . $row['title'] . '/';
                 // جلب جميع الصور الموجودة في المجلد
                 $images = glob($dir."*.{jpg,jpeg,png,gif}", GLOB_BRACE);
                 // عرض الصور داخل Carousel
                 for ($i=0; $i < count($images) ; $i++) { 
                     $image_name = basename($images[$i]); 
                     if ($i == 0) {
                          // الصورة الأولى تكون فعالة بالبداية
                          echo '<div class="carousel-item active" style="border:1px solid #ccc;">';
                     } else {
                          echo '<div class="carousel-item">';
                     }
                     echo '<img src="http://localhost/ecomweb/assets/pg/admin/products_image/' . $row['title'] . '/' . $image_name . '" class="d-block w-100" alt="' . $image_name . '">';
                     echo '</div>';
                 }
                 ?>
                 </div>
                 <div class="order_now_title">
                     <div style="font-size:18px; font-weight:500;">
                        <?php echo $row["title"]; ?>
                     </div>
                 </div>
                 <div class="order_now_price">
                  <div>
                    <?php echo $row["old_price"]."EGP "; ?> 
                  </div>
                 </div>
              </div>
              <hr style="border:none; border-top:1px solid #ccc; margin-top:20px;">
              <!-- مصاريف الشحن -->
              <div style="margin-top:15px;">
                 <div style="display:flex; position:relative; align-items: center;"> 
                     <div style="font-size:18px; font-weight:500">
                     الكميه :
                      </div> 
                     <div style="position:absolute; left:20px; top:0; color:#cc0000; font-size:24px;">
                   </div>
               </div>

               <div style="display:flex; position:relative; align-items: center;"> 
                   <div style="font-size:18px; font-weight:500">
                      مصاريف الشحن :
                   </div> 
                   <div style="position:absolute; left:20px; top:0; color:#cc0000; font-size:24px;">
                        <?php echo $row["shipping"];?> EGP
                   </div>
               </div>
               <!-- المصاريف الواجب اداؤوها -->
               <div  style="display:flex; position:relative; align-items: center; margin-top:10px;">
                    <div style="font-size:18px; font-weight:500">
                    المبلغ الواجب اداؤوه :
                    </div>
                    <div style="position:absolute; left:20px; top:0; font-size:24px; color:#cc0000;">
                      <?php echo intval($row["shipping"]) + intval($row["old_price"]);?> EGP
                   </div>
              </div>

              </div>            
        </div>    
           <!-- second box-->
           <div>
            <h5>المرجو ملا الاستماره لاتمام الطلب :</h5>
            <form name="myForm" action="http://localhost/ecomweb/assets/pg/thanks.php?prd_id=<?php echo urlencode($_GET["prd_id"]); ?>" method="POST" onsubmit="return validateForm()">
    <div class="con">
        <span>الاسم :</span>
        <input type="text" placeholder="الاسم بالكامل" name="fullname" class="lx-applycoupon">
    </div>
    <!-- phone -->
    <div class="con">
        <span>الهاتف :</span>
        <input type="text" placeholder="رقم الهاتف" name="phone" class="lx-applycoupon">
    </div>
    <!-- address -->
    <div class="con">
        <span>العنوان :</span>
        <input class="lx-applycoupon"  type="text" placeholder="العنوان" name="address">
    </div>
    <!-- city -->
    <div class="con">
        <span>المدينه :</span>
        <input class="lx-applycoupon" type="text" placeholder="المدينه" name="city">
    </div>
    <!-- كود التخفيض -->
    <div class="con">                                          
        <span>كود التخفيض :</span>
        <input class="lx-applycoupon" placeholder="كود التخفيض" type="text" name="coupon" id="coupon">
    </div> 
    <!-- confirm -->
    <input type="submit" value="تأكيد الطلب">
</form>
           </div>
           <!--  -->
           <script>
function validateForm() {
  var name = document.forms["myForm"]["fullname"].value;
  var phone = document.forms["myForm"]["phone"].value;
  var address = document.forms["myForm"]["address"].value;
  var city = document.forms["myForm"]["city"].value;
  if (name == "" || phone == "" || address == "" || city == "") {
    alert("يرجى تعبئة جميع الحقول المطلوبة!");
    return false;
  }
}
</script>
<style>
input[type="submit"] {
  background-color: #18BC9C;
  border: none;
  color: white;
  padding: 12px 24px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
  background-color: #159e82;
}

.con{
    display:flex;
    align-items:center;
}

.con > span {
    text-align: center;
    flex:1;
}

.lx-applycoupon:focus {
  outline: none;
  border: none;
}

div > label > span  {
    font-size:15px;

}

h5{
    font-size:19px !important;
    font-weight:500 !important;
}
input{
 margin: 20px 0;
 flex:2;
 width: 100%;
 font-family: 'Tajawal', sans-serif;
 font-size: 14px;
 background-color: #efefef;
 padding: 10px 15px;
 display: block;
 border-radius:5px;
}

.order_now_box{
 width:100%;
 display:flex;
}

.order_now_img{
    width:100%;
    height:100%;
}

.order_now_title{
    width:calc(100% - 200px);
    height:100px;
}
.order_now_title > div{
    margin:10px;
    font-size:19px;
    color:#333;
}

.order_now_price > div{
    margin:10px;
    font-size:24px;
    color:#cc0000;
}

.order_now_img{
    width:100px;
    height:100px;
}
.col-md-6 .row.justify-content-end {
    position: relative;
    height: 100%;
    width: 100%;
    max-width:100%;
    margin:auto;
    flex-flow: row-reverse;
    flex-wrap: wrap;
    margin-top:25px;
}

.h1,h2{
    font-size:1rem !important;
}
.row{
    margin-left:0;
    margin-right:0;
}
.col-md-6 .row.justify-content-end::before {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    right: 100%;
    width: 10px;
    background-color: #fff;
}
.col-md-6 .row.justify-content-end .col-3 {
    /* max-width: 100%;
    max-height: 100%;
    overflow: hidden;
    margin-top:10px; */
    padding: 0;
    max-width: 100%;
    max-height: 100%;
    overflow: hidden;
    margin-top: 10px;
    width: 55px !important;
    height: 55px !important;
    overflow: hidden;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin: 2px;
    cursor: pointer;
}
.col-md-6 .row.justify-content-end img {
    width: 100%;
    height: auto;
    transition: all 0.2s ease;
}
.col-md-6 .row.justify-content-end img:hover {
    transform: scale(1.1);
}
.carousel-control-prev, .carousel-control-next {
    display: none;
}

@media (min-width: 768px){
.col-md-6 {
    flex: 0 0 auto;
    width: 80% !important;
}
}

@media (max-width:680px){
    .show_prd{
        display: flex;
        flex-direction: column;
        align-items: center;   
    }

    .title_product{
        font-size:20px;
    }
    
    .price_product{
        font-size:17px;

    }

    .old_price_product{
        font-size:15px;
    }

    .order-now{
        margin-top:15px;

    }

    .quantity_box{
        margin-top:3px !important;
    }

    .row{
        flex-direction: column;
        order: -1;
        display: flex;
        align-items: center;
        width:100% !important;
    }

    .col-md-6 .row.justify-content-end .col-3{
        width:40px !important;
        height:40px !important;
    }

    .show_prd > div{
        width:100% !important;
    }

    .show_prd > div:first-child{
        width:100% !important;
        padding-right:12px;
    }

    .row > *{
        width:100% !important;
    }

    .smax{
        width:100% !important;
    }
}
</style>
</div>
       </div>
    </div>
    <footer class="title-footer"> جميع الحقوق محفوظه &copy;  <?php echo date('Y');  echo " " . $row17['web_name'];?>  smsm@me.com </footer>

</body>
</html>