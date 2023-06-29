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
     <script src="./assets/pg/admin/ckeditor/ckeditor.js"></script> 
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
                 <div class="url-path active-path">المنتوجات </div>
                 <div class="url-path slash">/</div>
                 <div class="url-path"> اضافه منتوج جديد</div>
              </div>

              <?php
              if (isset($_POST["sub_form"])) {      
                $_SESSION["title"]=htmlspecialchars($_POST["product_title"]);
                $product_title=htmlspecialchars($_POST["product_title"]);
                $orginal_price=htmlspecialchars($_POST["orginal_price"]);
                $old_price=htmlspecialchars($_POST["old_price"]);
                $shipping_price=htmlspecialchars($_POST["shipping_price"]);
                $description=mysqli_real_escape_string($conn,$_POST["editor1"]);
                $shipping_info=htmlspecialchars($_POST["shipping_info"]);
                $category=htmlspecialchars($_POST["category"]);

                // $product_images=$_POST["product_images"];

                if(empty($product_title) ||
                   empty($orginal_price) ||
                   empty($old_price) ||
                   empty($description) ||
                   empty($shipping_info) ||
                   empty($category)) {
                   echo "<div style='margin:20px; font-size:18px; padding: 10px 15px; background-color:#ffe6e6;'>املا الفراغات </div>";
                   }
                   else{
                    $sql="INSERT INTO products(title,disc,price,old_price,shipping,shipping_info,category) VALUES ('$product_title','$description','$orginal_price','$old_price','$shipping_price','$shipping_info','$category')";
                    $sql2="SELECT * FROM products";
                    $result2=$conn->query($sql2);
                    $row2=$result2->fetch_assoc();
                    // if($result2->num_rows === "0"){
                    //     $product_id="1";
                    // }else{
                    //     $product_id=$row2["id"];
                    // }
                    // نجيب الاي دي بتاع اخر منتج
                    $sqlId="SELECT id FROM products ORDER BY id DESC LIMIT 1";
                    $resultId=mysqli_query($conn,$sqlId);
                    if(mysqli_num_rows($resultId) > 0){
                        $rowId=mysqli_fetch_assoc($resultId);
                        $product_id=$rowId['id'];
                         
                    }
                    
                    $path='products_image/'. $product_title;
 
                    if(!file_exists($path)){
                    mkdir('products_image/'. $product_title,0777,true);
                    chmod('products_image/'. $product_title,0777);
                    }

                    $files_count=count($_FILES["product_images"]["name"]);
                    for ($i=0; $i <  $files_count; $i++) { 

                       $product_images=$_FILES["product_images"]["tmp_name"][$i];   
                       $file_name=$_FILES["product_images"]["name"][$i];
                       move_uploaded_file($product_images,'products_image/' .  $product_title.'/' . $file_name);
                    }

                    if($conn->query($sql) === TRUE){
                       echo "<div style='margin:20px; font-size:18px; padding: 10px 15px; background-color:#e6fff5;'> لقد تم اضافه المنتوج</div>";
                    //    echo "row = ". $row2['id']."<br>";
                    }
                    else{
                   echo "<div style='margin:20px; font-size:18px; padding: 10px 15px; background-color:#ffe6e6;'>هناك خطأ $conn -> error</div>" ;

                    }
                   }
              }
              ?>
              <!--  -->
              <div class="container-form">
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="text" name="product_title" id="" placeholder="عنوان المنتج">
    <input type="text" name="orginal_price" id="" placeholder=" السعر الاصلي">
    <input type="text" name="old_price" id="" placeholder="السعر بعد التخفيض">
    <input type="text" name="shipping_price" id="" placeholder="سعر الشحن">
    <textarea name="editor1" id="editor1"></textarea>
    <textarea style="height:100px;" name="shipping_info" placeholder="معلومات الشحن والتسليم"></textarea>
    <!-- إضافة حقل القسم هنا -->
    <select name="category"> 
        <?php
        $sql5="SELECT * FROM category";
        $result5=$conn->query($sql5);
        while($row5=$result5->fetch_assoc()){
            echo '<option value="' . $row5['cat_name'] . '">' . $row5['cat_name'] . '</option>';        }
        ?>
    </select>
    <input type="file" name="product_images[]" multiple id="files">
    <input type="button" class="file_btn" value="اضف صور للمنتوج" onclick="document.getElementById('files').click();">
    <p>
      <input type="submit" value="حفظ" name="sub_form">
    </p>
  </form>
</div>
              <!-- <div class="container-form">
                  <form action="" method="POST" enctype="multipart/form-data">
                     <input type="text" name="product_title" id="" placeholder="عنوان المنتج">
                     <input type="text" name="orginal_price" id="" placeholder=" السعر الاصلي">
                     <input type="text" name="old_price" id="" placeholder="السعر بعد التخفيض">
                     <input type="text" name="shipping_price" id="" placeholder="سعر الشحن">

                     <textarea name="editor1" id="editor1"></textarea>
                     <textarea style="height:100px;" name="shipping_info" placeholder="معلومات الشحن والتسليم"></textarea>

                     <input type="file" name="product_images[]" multiple id="files">
                     <input type="button" class="file_btn" value="اضف صور للمنتوج" onclick="document.getElementById('files').click();">
                     <p>
                        <input type="submit" value="حفظ" name="sub_form">
                     </p>
                 </form>
             </div> -->
             <!--  -->
         </div>
     </div>
     <script src="ckeditor"></script>
    <script>
    window.onload = function() {
        // replace textarea1 with ckeditor
        CKEDITOR.replace("editor1");
        CKEDITOR.editorConfig = function(config) {
            config.language = 'ar';
            config.uiColor = '#F7B42C';
            config.height = 300;
            config.toolbarCanCollapse = true;
        };
    }
</script>
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
