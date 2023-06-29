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
    <title><?php echo $row17['web_name'];?>| products</title>
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
    <div class="show_prd" style="border:1px solid #ccc; padding:15px">
    <!-- first countainer -->
        <div>
            <?php
            $sql='SELECT * FROM products WHERE id=' . $_GET["prd_id"];
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            
            ?>
            <div class="title_product" style="font-size:1rem !important;"><h2  style="font-size:1rem !important;"><?php echo $row['title']?></h2></div>
            <div class="price_product" style="font-size:18px !important;">
                <span class="old_price_product" style="font-size:18px !important;"><s><?php echo $row['price'] ."جنيه";?></s></span>
                <?php echo $row["old_price"] ."جنيه";?>
            </div>
            <div class="quantity_box" style="margin-top:3px;">   
                <p class="qua" style="font-size:15px !important; margin-bottom:0px !important;">الكميه: </p>            
                <div class="quantity" style="display: inline-flex;">
                    <?php
                      if(!isset($_SESSION['count'])) {
                      $_SESSION['count'] = 0;
                      }

                      if(isset($_SESSION['count']) && $_SESSION['count'] > 0) {
                        }

                      if(isset($_POST['increase'])) {
                        $_SESSION['count']++;
                        header('Location: http://localhost/ecomweb/assets/pg/show_product.php?prd_id='.$_GET["prd_id"]); // تحديث الصفحة
                        exit(); // توقف النص الحالي لتحديث الصفحة بشكل صحيح

                      }
                      if(isset($_POST['decrease'])) {
                      if($_SESSION['count'] > 0) {
                        $_SESSION['count']--;
                        header('Location:http://localhost/ecomweb/assets/pg/show_product.php?prd_id='.$_GET["prd_id"]); // تحديث الصفحة
                        exit(); // توقف النص الحالي لتحديث الصفحة بشكل صحيح
                      }
                      }
                     ?>
                     <form method="post">
                         <button type="submit" name="increase" style="width: 20px; margin-left: 0px; font-size:15px;">+</button>
                         <span><input type="text" value="<?php echo $_SESSION['count']; ?> " style="width: 35px; text-align:center; font-size:15px;"> </span>
                         <button type="submit" name="decrease" style="width: 20px; margin-right: 0px; font-size:15px;">-</button>
                     </form>
                </div>
                <!-- order now -->
                <form action="http://localhost/ecomweb/assets/pg/order_now.php?prd_id=<?php echo $_GET['prd_id'];?>" method="post">
                    <input type="hidden" name="count" id="quantity-num" value="<?php echo $_SESSION['count'];?>">
                    <div class="center-btn">
                     <button  name="submit" type="submit" class="order-now" style="font-size:15px !important; margin-top:15px!important;">اطلب الان
                    </button>
                   </div>
                </form>
                <!-- <button class="order-now" style="font-size:15px !important; margin-top:15px!important;">اطلب الان</button> -->
                <div style="font-size:15px; margin:3px 0 0px 0 !important; "><?php echo $row['shipping_info'];?></div>
                <!-- disc -->
                <div style="font-size:12px; margin:13px 0 0px 0 ; border:1px solid #eee; background-color:#efefef; padding:5px 9px; width:80%;"><?php echo $row['disc'];?></div>
            </div>
        </div>         
         <!-- second countainer -->
          <div class="row" style="flex-direction:column;">
              <div class="col-md-6 smax" style="width:80%;" >
              <div id="carouselExampleIndicators" class="carousel slide">
              <div class="carousel-inner">
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
        </div>
    </div>
    <div class="col-md-6" style="width:80%;">
        <div class="row justify-content-end">
            <?php
            // تحديد مسار المجلد الذي توجد به الصور
            $dir = $_SERVER['DOCUMENT_ROOT'] . '/ecomweb/assets/pg/admin/products_image/' . $row['title'] . '/';
            // جلب جميع الصور الموجودة في المجلد
            $images = glob($dir."*.{jpg,jpeg,png,gif}", GLOB_BRACE);
            // عرض الصور في مربع الصور (thumbnails)
            foreach ($images as $image) {
                $image_name = basename($image);
                echo '<div class="col-3 mb-3" max-height:100% !important>';
                echo '<img src="http://localhost/ecomweb/assets/pg/admin/products_image/' . $row['title'] . '/' . $image_name . '" class="d-block w-100" alt="' . $image_name . '" loading="lazy" onclick="changeImage(this)">'; // تعيين العنوان الفرعي (alt) للربط بالصورة الرئيسية وتحميل الصورة الكبيرة مسبقًا
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

<style>
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

<script>
function changeImage(obj) {
    var mainImage = document.querySelector('#carouselExampleIndicators .carousel-inner img');
    mainImage.src = obj.src;
    mainImage.alt = obj.alt; // تغيير العنوان الفرعي (alt) للصورة الرئيسية
}
</script>

<script>
    var myCarousel = document.querySelector('#carouselExampleIndicators');
    var carousel = new bootstrap.Carousel(myCarousel, {
        interval: false
    });
</script>
         <!--  -->
</div>
       </div>
    </div>
    <footer class="title-footer"> جميع الحقوق محفوظه &copy;  <?php echo date('Y');  echo " " . $row17['web_name'];?>  smsm@me.com </footer>
</body>
</html>