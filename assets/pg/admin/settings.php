<?php
require_once("./inc/connect.php");
session_start();
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
                <div class="url-path">اعدادات الموقع</div>
            </div>
            <!--  -->
            <?php 
            // $web_name = 'لسه';
            // $whatsup_num = 'لسه';
            // $header_txt = 'لسه';
            // $web_desc = 'لسهلسه';
            // $fb_pixel = 'لسه';
            // $gl_analytics = 'لسه';
             //   استخراج بيانات الموقع الحالي
             if (!empty($_POST)) {
              // التحقق من إرسال نموذج التسجيل
              if (isset($_POST['submit'])) {
                // استخراج البيانات المرسلة من النموذج
                $web_name2 = htmlspecialchars($_POST['website-name']);
                $whatsup_number2 = htmlspecialchars($_POST['whatsup-number']);
                $header_text2 = htmlspecialchars($_POST['header-text']);
                $web_desc = htmlspecialchars($_POST['about_website']);
                $google_analtix2 = htmlspecialchars($_POST['dss']);
                $fb_pixl2 = htmlspecialchars($_POST['dsd']);
            
                // إجراء التحقق من المدخلات وإضافة البيانات إلى قاعدة البيانات
                if (!empty($web_name2) && !empty($whatsup_number2) && !empty($header_text2) && !empty($web_desc) &&
                    !empty($google_analtix2) && !empty($fb_pixl2) && isset($_FILES['web-logo'])) {
                  // إضافة المستخدم الجديد إلى جدول المستخدمين
                  $webLogo = $_FILES['web-logo']['name'];
                $tmpName = $_FILES['web-logo']['tmp_name'];
                // المجلد الذي سيتم حفظ الملف فيه
                $uploadsDir = 'C:/xampp/htdocs/ecomweb/assets/pg/admin/main_logo/';
                $targetFile = $uploadsDir . $webLogo;
                if (move_uploaded_file($tmpName, $targetFile)) {
                  // $sql2 = "INSERT INTO web_settings (web_name, whatsup_num,header_txt,web_desc,fb_pixel,gl_analytics,web_logo) VALUES ('$web_name2', '$whatsup_number2', '$header_text2', '$web_desc', '$fb_pixl2', '$google_analtix2','$webLogo')";
                  $sql2 = "UPDATE web_settings SET web_name='$web_name2', whatsup_num='$whatsup_number2', header_txt='$header_text2', web_desc='$web_desc', fb_pixel='$fb_pixl2', gl_analytics='$google_analtix2', web_logo='$webLogo' WHERE id=(SELECT MAX(id) FROM web_settings)";
                  $result2 = mysqli_query($conn, $sql2);
                  if (mysqli_affected_rows($conn) > 0 && file_exists($targetFile)) {
                    // echo "تم اضافة الشعار بنجاح.";
                  } else {
                    // echo "حدث خطأ أثناء اضافة الشعار.";
                  }
                  if ($result2) {
                    echo "<div style='margin:20px; font-size:18px; padding: 10px 15px; background-color:#e6fff5;'> لقد تم تحديث الاعدادات بنجاح</div>";
                  } else {
                    echo "حدث خطأ أثناء تحديث الاعدادات : " . mysqli_error($conn);
                  }
                } else {
                  echo "<div style='margin:20px; color:red; font-size:18px; padding: 10px 15px; background-color:#ffe6e6;'>الرجاء ملئ الفراغات</div>";
                }
              }
            
              // إجراء التحقق من تحميل ملف الشعار وإضافته إلى قاعدة البيانات
            }
          }
            
            // 3- يمكنك إزالة الأمر `session_start()` إذا لم تستخدم الجلسات في هذا الكود.
            
            // 4- يمكنك استخدام استعلام واحد فقط لإدخال الإعدادات والشعار إلى قاعدة البيانات، على سبيل المثال:
            // إغلاق قاعدة البيانات بعد الانتهاء من استخدامها
            function getWebSettings($conn) {
              $sql = "SELECT * FROM web_settings WHERE id = (SELECT MAX(id) FROM web_settings)";
              $result = $conn->query($sql);
              $row = $result->fetch_assoc();
              return $row;
            }
            
            // استخدام الدالة للحصول على بيانات الموقع
            $webSettings = getWebSettings($conn);
            // استخدام البيانات المستردة لعرض محتوى الموقع
 
            ?>
            <!--  -->
            <div class="discount">
                 <div class="container-form" style="padding: 20px;">
                      <form action="" method="POST" enctype="multipart/form-data" name="myForm" onsubmit="return validateForm()">
                          <div class="sub-data">
                             <p>اسم الموقع</p>
                             <input type="text" name="website-name" id="" placeholder="<?php echo $webSettings['web_name'];?>">
                          </div>
                          <div class="sub-data">
                             <p> ادخل رقم الواتس اب</p>
                             <input type="text" name="whatsup-number" id="" placeholder="<?php echo $webSettings['whatsup_num'] ;?>">
                          </div>
                          <div class="sub-data">
                             <p>  نص الهيدر </p>
                             <input type="text" name="header-text" id="" placeholder="<?php echo $webSettings['header_txt'];?>">
                          </div>
                          <div class="sub-data">
                             <p> وصف الموقع  </p>
                             <input type="text" name="about_website" id="" placeholder="<?php echo $webSettings['web_desc'];?>">
                          </div>
                          <div class="sub-data">
                             <p> فيسبوك بيكسل</p>
                             <textarea name="dsd" style="height:100px;" id="" cols="" placeholder="<?php echo $webSettings['fb_pixel'];?>"></textarea>
                            </div>
                          <div class="sub-data">
                             <p> جوجل اناليتكس</p>
                              <textarea name="dss" id="" style="height:100px;"  cols="" rows="" placeholder="<?php echo $webSettings['gl_analytics'];?>"></textarea>
                            </div>
                            <!--logo -->
                            <div class="logo">
                              <?php
                              echo '<img src=http://localhost/ecomweb/assets/pg/admin/main_logo/'. $webSettings["web_logo"].">";
                              ?>
                               </div>
                            <!-- <input type="file" name="website-logo" multiple id="files" class="file_btn" style="margin-right:16.5%;"> -->
                            <input type="file" name="web-logo"  multiple id="web-logo" style="display:none;">
                            <input type="button" class="file_btn" value="شعار الموقع" style="margin-right:16.5%;" onclick="document.getElementById('web-logo').click();">                            <p>
                            <input type="submit" name="submit" value="حفظ" style="margin-right:16.5%;">
                            </p>
                        </form>
                 </div>
              </div>
              <!--  -->
              <!-- validate form -->
              <!--  -->
              <style>
                .logo{
                  height: 100px;
    width: calc(100% - 140px);
    margin-right:152px;
    display: flex;
    margin-bottom: 15px;
    padding: 6px;
                }
                .logo > img{
                  width: 100px;
    height: 100%;
                }
              </style>
              <!--  -->
              <script>
    function validateForm() {
        var web_name = document.forms["myForm"]["web_name"].value;
        var whatsup_num = document.forms["myForm"]["whatsup_num"].value;
        var header_txt = document.forms["myForm"]["header_txt"].value;
        var web_desc = document.forms["myForm"]["web_desc"].value;
        var fb_pixel = document.forms["myForm"]["fb_pixel"].value;
        var gl_analytics = document.forms["myForm"]["gl_analytics"].value;
        
        // التحقق من ملء كل الحقول المطلوبة
        if (web_name == "" || whatsup_num == "" || header_txt == "" || web_desc == "" || fb_pixel == "" || gl_analytics == "") {
            alert("يرجى ملء جميع الحقول المطلوبة");
            return false;
        }
        
        // التحقق من عدم وجود فراغات زائدة في الحقول
        if (web_name.trim() == "" || whatsup_num.trim() == "" || header_txt.trim() == "" || web_desc.trim() == "" || fb_pixel.trim() == "" || gl_analytics.trim() == "") {
            alert("يرجى تعبئة الحقول بشكل صحيح");
            return false;
        }
    }
    
    // إيقاف إعادة تقديم النموذج عند إعادة تحميل الصفحة
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
</script>
              <!--  -->
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