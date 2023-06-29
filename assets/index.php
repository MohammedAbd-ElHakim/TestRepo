<?php
 require_once('./pg/admin/inc/connect.php');
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
    <link rel="stylesheet" href="main_style ">
    <title><?php echo $row17['web_name'];?>  | بيع جميع انواع السلع</title>
</head>
<body>
  <!--  -->
  <!-- google analytics -->
  <!-- end google analytics -->
  <!-- facebook pixel -->
  <!-- end facebook pixel -->
  <!--  -->
    <div class="header-bar">
    <?php echo $row17['header_txt'];?>
    </div>
   
    <header>
        <div class="center-bar" style="display:flex; align-items: center;">
    <p>
        <span class="ecom">web</span><span class="web">Ecom</span>
        <?php
         $sql = "SELECT * FROM category ORDER BY cat_name ASC"; // ترتيب الفئات بالترتيب الأبجدي
         $result = $conn->query($sql);
         if ($result->num_rows > 0) { // التأكد من وجود صفوف في النتيجة المستردة
             echo '<ul style="display:flex; gap:15px; margin-right:15px; font-size:17px; padding:10px;">'; // بدء عنصر القائمة الغير مرتبط
             while ($row = $result->fetch_assoc()) {
              echo '<li class="dep" onclick="window.open(\'sp_cat?cat_name=' . $row["cat_name"] . '\', \'_self\')">' . $row["cat_name"] . '</li>';                 // عرض اسم الفئة كعنصر في القائمة
             }
             echo "</ul>"; // إغلاق عنصر القائمة الغير مرتبط
         } 
          ?>
    </p>
    
    <button onclick="window.location.href='coupon';">التخفيضات</button>
          </div>
        <!--  -->
    </header>
    <!-- content -->
    <div class="title_content">جديد المنتجات</div>
    <div class="title2_content">احدث المنتجات المضافه مؤخرا الي الموقع </div>

    <!-- container of content -->
    
    <div class="content">
  <div class="product-container">
    <!-- get data from database -->
    <?php
      $sql="SELECT * FROM products";
      $result=$conn->query($sql);
      while($row=$result->fetch_assoc()){
        if(isset($row['id'])){
          $id=$row['id'];
        }
    ?>
    <div class='product-pack' style="background-color:#f0f0f0;">
      <div class='product-img'>
        <?php
          $mypath=getcwd()."/pg/admin/products_image/".$row['title'];
          if(is_dir(($mypath))){
            //echo "yes it is dir";
          }else{
            echo("no it is not dir");
          }
                      
          foreach (scandir($mypath) as $file) {
            $count=0;

            if(isset($row['title'])){
              $dir2=$row['title'];
            }else{
              echo "it is not set yet";
            }
            #check file
            # chekname
            if($file == '.' || $file == '..'){
              continue;
            }
                         
            #check if not exist
            if(!file_exists($mypath . '/' . $file)){
              echo "the file it is not found";
              echo "<br>the file is " . $file;
              break;
            }

            #check size
            if(filesize($mypath . '/' . $file)> 500000){
              echo 'it is large file sorry';
              continue;
            }
                         
            #check extensions
            $extension_array=['png','jpg','gif','jpeg'];
            $ext=pathinfo($file);
                                   
            if(in_array($ext['extension'],$extension_array)){
              // echo " المشكله ما في الامتداد ";
            }else{
              echo "الامتداد غير موجود";
              continue;
            }   
                                  
            #show img
            echo "<img src='http://localhost/ecomweb/assets/pg/admin/products_image/$dir2/$file'>";
            break;
          }
        ?>
        <div class='product-title'><?php echo $row['title'];?></div>
        <div class="container-pr" style="margin-right:5px;">
         <div class='product-price'>
           <span class='orginal-price'><?php echo $row['old_price'] ."USD"; ?></span>
           <span class='old-price'><s><?php echo $row['price']."USD";?></s></span>
         </div>
         <!-- button -->
         <div class="show-more" style="margin-bottom:15px; display: flex; margin-bottom: 15px; justify-content: end; margin-left: 15px;">
           <a href="./assets/pg/show_product.php?prd_id=<?php echo $row['id']; ?>"style="padding:5px; background-color:#7ec855;color:white; border-radius: 3px;"><button style=" cursor:pointer; background-color:#7ec855;color:white;">عرض المزيد</button></a>
         </div>
        </div>
      </div>
    </div>
    <!-- close product image -->
    <?php   
      }
    ?>
  <!-- close product-pack -->
  </div>
  <!-- close product-container -->
</div>
<!-- close content -->
    </div>
    <!-- footer -->
    <footer class="title-footer" style="bottom: 0; position:absolute;"> جميع الحقوق محفوظه &copy;  <?php echo date('Y');  echo " " . $row17['web_name'];?>  smsm@me.com </footer>
    <!--  -->
    <style>
      .dep:hover{
        color:#0088ff;
        cursor:pointer;
      }
    </style>
    <script>
  document.getElementById("year").innerHTML = new Date().getFullYear();
</script>
</body>
</html>