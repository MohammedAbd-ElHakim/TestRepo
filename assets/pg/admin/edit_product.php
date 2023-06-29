<?php
require_once("./inc/connect.php");
$sql17="SELECT * FROM web_settings";
$result17=$conn->query($sql17);
$row17=$result17->fetch_assoc();
SESSION_START();
?>
<!DOCTYPE html>
<html lang="en" style=scroll-behavior: ;
>
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="http://localhost/ecomweb/style">
     <!--  -->
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
                 <div class="url-path active-path">المنتوجات </div>
                 <div class="url-path slash">/</div>
                 <div class="url-path"> اضافه منتوج جديد</div>
              </div>
              
              <div>

              <?php
              
              $edit_product_id=$_GET["prd_id"];
              $sql4="SELECT * FROM products WHERE id=$edit_product_id";
              $result4=$conn->query($sql4);
              $row4=$result4->fetch_assoc();
               if (isset($_POST["sub_form"])) {      
                $_SESSION["title"]=$_POST["product_title"];
                $product_title=$_POST["product_title"];
                $orginal_price=$_POST["orginal_price"];
                $old_price=$_POST["old_price"];
                $shipping_price=$_POST["shipping_price"];
                $description=$_POST["editor1"];
                $shipping_info=$_POST["shipping_info"];
                // $product_images=$_POST["product_images"];

                if(empty($product_title) ||
                   empty($orginal_price) ||
                   empty($old_price) ||
                   empty($description) ||
                   empty($shipping_info)) {
                   echo "<div style='margin:20px; font-size:18px; padding: 10px 15px; background-color:#ffe6e6;'>املا الفراغات </div>";
               
                   }
                    
                   else{
                  
               
                    $sql="UPDATE products SET title='$product_title' , disc='$description' , price='$orginal_price' , old_price='$old_price' , shipping='$shipping_price' , shipping_info='$shipping_info' WHERE id='$edit_product_id'";            
                    $sql2="SELECT * FROM products";
                    $result2=$conn->query($sql2);
                    $row2=$result2->fetch_assoc();
                    
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
                       echo "<div style='margin:20px; font-size:18px; padding: 10px 15px; background-color:#e6fff5;'>لقد تم تحديث بيانات المنتوج بنجاح</div>";
                    //    echo "row = ". $row2['id']."<br>";
                    }
                    else{
                      echo "<div style='margin:20px; font-size:18px; padding: 10px 15px; background-color:#ffe6e6;'>هناك خطأ $conn -> error</div>" ;

                    }
                   }
              }

            
        
              ?>
              <div class="container-form">
                  <form action="" method="POST" enctype="multipart/form-data">
                     <input type="text" name="product_title" id="" placeholder="عنوان المنتج" value="<?php echo $row4["title"];?>">
                     <input type="text" name="orginal_price" id="" placeholder=" السعر الاصلي" value="<?php echo $row4["price"];?>">
                     <input type="text" name="old_price" id="" placeholder="السعر بعد التخفيض" value="<?php echo $row4["old_price"];?>">
                     <input type="text" name="shipping_price" id="" placeholder="سعر الشحن" value="<?php echo $row4["shipping"];?>">
         
                     <textarea name="editor1" id="editor1"> <?php echo $row4["disc"];?> </textarea>
                     <textarea style="height:100px;" name="shipping_info" placeholder="معلومات الشحن والتسليم"> <?php echo $row4["shipping_info"];?></textarea>
                     <!-- عرض الصور للتعديل -->
 
                     <!--  -->
                     <div class="container-img">
                     <?php
                    //  هذا هو المجلد الذي تم تحميله عند بناء او عند اضافه منتج جديد
                     if(isset($_GET["prd_name"])){
                        $mdir=$_GET['prd_name'];
                        $dir= "products_image" . "/" .$_GET["prd_name"] . "/";
                        // ده هنا اراي ختينا فيهها الامتدادات الاحنا دايرينها
                        $array_extension=array('jpg','png','jpeg','gif');
                        if(is_dir($dir)){
                            $files=scandir($dir);
                            for ($i=0; $i < count($files) ; $i++) { 
                                if($files[$i] !== '.' && $files[$i] !== '..'){
                                    //name of the file
                                    // echo "vardumb : " . var_dump($files[$i]); //string
                                    $search= $files[$i];
                                    // حنجيب الامتداد بتاع الفايل
                                    $file=pathinfo($files[$i]);
                                    if(isset($file["extension"])){
                                    $extension=$file["extension"];
                                    $rm_dot=str_replace(".","_",$files[$i]);
                                    // فحص الامتداد
                                    if(in_array($extension,$array_extension)){
                                        // عرض الصوره
                                echo "<div class='item-img'>
                                      <div>
                                      <a href='d_img?id_img=$search & dir_id=$mdir'><img src='http://localhost/ecomweb/assets/pg/admin/img/closeicon.jpg' alt=''></a>
                                      </div>     
                                      <img src='http://localhost/ecomweb/assets/pg/admin/products_image/$mdir/$files[$i]' style='width:100%;';>
                                      </div> <br>";
                                    }
                                }else{
                                    break;
                                }
                                }

                            }
                        }
                     }

                     ?>
                     <!-- <input type="text" name="del_imgs" id="dil_imgs"> -->


                     </div>
                     <input type="file" name="product_images[]" multiple id="files">
                     <input type="button" class="file_btn" value="اضف صور للمنتوج" style="margin-top:10px;" onclick="document.getElementById('files').click();">
                    
                     <p>
                        <input type="submit" value="حفظ" name="sub_form">
                     </p>
                 </form>
             </div>
         </div>
     </div>
     
     <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
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
 