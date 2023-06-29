<?php
 require_once('../inc/connect.php');
 session_start();
 ?>
<!DOCTYPE html>
<html>
  <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="style">
    <title>تحديث إعدادات الموقع</title>
  </head>
  <body>
    <!-- style -->
   <style>
    html {
        overflow:scroll;
    }
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

.di{
    ma
}

.con > label {
    text-align: center;
    flex:1;
}

.container-form input[type=text],
.container-form input[type=date],
.container-form textarea[name=shipping_info],
.container-form textarea[name="dsd"],
.container-form textarea[name="dss"]
{
    margin: 20px 0;
    flex: 2;
    width: 100%;
    font-family: 'Tajawal', sans-serif;
    font-size: 14px;
    background-color: #efefef;
    padding: 10px 15px;
    display: block;
    border-radius: 5px;
    font-size:17px;
}

.container-form{
    margin: 20px auto;
    width: 80%;
    font-size: 17px;
    font-weight: 500;
}

.container-form input[type=text],
.container-form input[type=date],
.container-form textarea[name=shipping_info],
.container-form textarea[name="dsd"],
.container-form textarea[name="dss"]:focus{
    outline: none;
}
   </style>
    <!-- end style -->
    <!--  -->
    <div class="container-form">
    <?php
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
          // بيانات المدير 
          $admin_user= htmlspecialchars($_POST['admin-userr']);
          $admin_pass= htmlspecialchars($_POST['admin-passs']);

      
          // إجراء التحقق من المدخلات وإضافة البيانات إلى قاعدة البيانات
          if (!empty($web_name2) && !empty($whatsup_number2) && !empty($header_text2) && !empty($web_desc) &&
              !empty($google_analtix2) && !empty($fb_pixl2) && isset($_FILES['web-logo']) && !empty($admin_user) 
              && !empty($admin_pass)) {
            // إضافة المستخدم الجديد إلى جدول المستخدمين
            $webLogo = $_FILES['web-logo']['name'];
            $tmpName = $_FILES['web-logo']['tmp_name'];
          // المجلد الذي سيتم حفظ الملف فيه
          $uploadsDir = 'C:/xampp/htdocs/ecomweb/assets/pg/admin/main_logo/';
          $targetFile = $uploadsDir . $webLogo;
          if (move_uploaded_file($tmpName, $targetFile)) {
            // $sql2 = "INSERT INTO web_settings (web_name, whatsup_num,header_txt,web_desc,fb_pixel,gl_analytics,web_logo) VALUES ('$web_name2', '$whatsup_number2', '$header_text2', '$web_desc', '$fb_pixl2', '$google_analtix2','$webLogo')";
           // فحص ما إذا كان الجدول فارغاً
$result = mysqli_query($conn, "SELECT COUNT(*) FROM web_settings");
$row = mysqli_fetch_row($result);
if(empty($row[0])) {
    // إذا كان الجدول فارغًا، تنفيذ INSERT INTO
    // $sql2 = "INSERT INTO web_settings (web_name, whatsup_num, header_txt, web_desc, fb_pixel, gl_analytics, web_logo)
    //     VALUES ('$web_name2', '$whatsup_number2', '$header_text2', '$web_desc', '$fb_pixl2', '$google_analtix2', '$webLogo')";
    $sql2 = "INSERT INTO web_settings (web_name, whatsup_num, header_txt, web_desc, fb_pixel, gl_analytics, web_logo)
    VALUES ('$web_name2', '$whatsup_number2', '$header_text2', '$web_desc', '$fb_pixl2', '$google_analtix2', '$webLogo')";
    
   $sql3="INSERT INTO admin_login (admin_user,admin_pass) VALUES ('$admin_user', '$admin_pass')";
} else {
    // إذا كان الجدول غير فارغ، تنفيذ UPDATE
    // $sql2 = "UPDATE web_settings SET web_name='$web_name2', whatsup_num='$whatsup_number2', header_txt='$header_text2', web_desc='$web_desc', fb_pixel='$fb_pixl2', gl_analytics='$google_analtix2', web_logo='$webLogo'";
    $sql2 = "UPDATE web_settings SET web_name='$web_name2', whatsup_num='$whatsup_number2', header_txt='$header_text2', web_desc='$web_desc', fb_pixel='$fb_pixl2', gl_analytics='$google_analtix2', web_logo='$webLogo'";

$sql3 = "UPDATE admin_login SET admin_user='$admin_user', admin_pass='$admin_pass'";
  }
  $result2 = mysqli_query($conn, $sql2);
  $result3 = mysqli_query($conn, $sql3);
            if (mysqli_affected_rows($conn) > 0 && file_exists($targetFile)) {
              // echo "تم اضافة الشعار بنجاح.";
            } else {
              // echo "حدث خطأ أثناء اضافة الشعار.";
            }
            if ($result2) {
            //   echo "<div style='margin:20px; font-size:18px; padding: 10px 15px; background-color:#e6fff5;'> لقد تم تحديث الاعدادات بنجاح</div>";
              header("Location:index");

            } else {
              echo "حدث خطأ أثناء تحديث الاعدادات : " . mysqli_error($conn);
            }
          } else {
            echo "<div style='margin:20px; color:red; font-size:18px; padding: 10px 15px; background-color:#ffe6e6;'>الرجاء ملئ الفراغات</div>";
          }
        }else{
          echo "<div style='margin:20px; color:red; font-size:18px; padding: 10px 15px; background-color:#ffe6e6;'>الرجاء ملئ الفراغات</div>";
        }
      
        // إجراء التحقق من تحميل ملف الشعار وإضافته إلى قاعدة البيانات
      }
    }
    ?>
    </div>
    <!--  -->
    <div class="container-form" style="padding-left:22px;">
    <h3>قم بملا بيانات الموقع الرئيسيه:</h3>
     <form action="" method="POST" enctype="multipart/form-data" name="myForm">
          <!-- 1 -->
          <div class="con">
                    <label for="website-name">اسم الموقع:</label>
                    <input type="text" name="website-name" id="website-name" placeholder="اسم الموقع">
               </div>
               <!-- اسم المدير -->
               <div class="con">
                    <label for="admin-name"> اسم المدير :</label>
                    <input type="text" name="admin-userr" id="admin-name" placeholder="اسم المدير">
               </div>
               <!-- اسم المدير نهايه-->
               <div class="con">
                    <label for="admin-pass"> باسوورد المدير  :</label>
                    <input type="text" name="admin-passs" id="admin-pass" placeholder="باسوورد المدير ">
               </div>
               <!-- الباسوورد الخاص بالمدير -->
               
               <!--  نهايه الباسوورد الخاص بالمدير -->
               <!-- 2 -->
               <div class="con">
                    <label for="whatsup-number">رقم الواتس اب:</label>
                    <input type="text" name="whatsup-number" id="whatsup-number" placeholder="رقم الواتس">
               </div>
               <!-- 3 -->
          <div class="con">
                    <label for="header-text">نص الهيدر:</label>
                    <input type="text" name="header-text" id="header-text" placeholder="نص الهيدر">
               </div>
               <!-- 4 -->
          <div class="con">
                    <label for="about-website">وصف الموقع:</label>
                    <input type="text" name="about_website" id="about-website" placeholder="وصف الموقع">
          </div>
          <!-- 6 -->
          <div class="con">
                    <label for="fb-pixel">فيسبوك بيكسل:</label>
                    <textarea name="dsd" id="fb-pixel" style="height:100px;" cols="" placeholder="فيسبوك بكسل"></textarea>
               </div>
               <!-- 7 -->
          <div class="con">
                    <label for="google-analytics">جوجل اناليتكس:</label>
                    <textarea name="dss" id="google-analytics" style="height:100px;" cols="" rows="" placeholder="جوجل اناليتكس"></textarea>
          </div>
          <!-- 8 -->
          <div class="con">
                    <label for="web-logo" style="flex:.4 !important;">شعار الموقع:</label>
                    <input type="file" name="web-logo" multiple id="web-logo" style="display:none;">
                    <div class="di">
                       <button type="button" class="file_btn" onclick="document.getElementById('web-logo').click();" style="font-size:15px;">تحميل</button>
                       <input type="submit" name="submit" value="حفظ" style="border-radius:0; font-size:15px;">
                    </div>
          </div>
          
     </form>
</div>
<!--  -->
  </body>
</html>