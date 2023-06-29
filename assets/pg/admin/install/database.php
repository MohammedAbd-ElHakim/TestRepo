<!DOCTYPE html>
<html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="main_style">
     <link rel="stylesheet" href="style">
     <title><?php echo "Ecomweb";?> | لوحه التحكم</title>
 </head>
  <body>
   <div class="countainer2 container-form">
      <?php
      $pass2='empty';
       if($_GET['check'] == '2'){
        if (isset($_POST['server-sub'])) {
            if(!empty($_POST['server-host']) && !empty($_POST['server-user']) &&
             !empty($_POST['server-pass']) && !empty($_POST['server-db'])){
                // $host=htmlspecialchars($_POST['server-sub']);
                // $user=htmlspecialchars($_POST['server-user']);
                // $pass2==htmlspecialchars($_POST['server-pass']);            
                // $db=htmlspecialchars($_POST['server-db']);
                $host=$_POST['server-host'];
                $user=$_POST['server-user'];
                $pass2=$_POST['server-pass'];            
                $db=$_POST['server-db'];                //
                if(!empty($host) && !empty( $user) &&
                !empty($pass2) && !empty( $db))
                $server_data= $host . ",". $user . ",". $pass2 . ",". $db ;
                if(file_exists('server.inc.ecomweb')){
                  $server_post_data = file_put_contents('server.inc.ecomweb', $server_data);
                  header('Location: table');
              } else {
                  $filename = 'server.inc.ecomweb';
                  $file_data = $server_data; // يمكن تغيير محتوى الملف هنا
                  if (file_put_contents($filename, $file_data, FILE_APPEND) !== false) {
                      header('Location:table ');
                  } else {
                      echo "<div style='margin:20px; color:red; font-size:18px; padding: 10px 15px; background-color:#ffe6e6; text-align: start;'>لا يمكن إنشاء الملف server.inc.ecomweb.</div>";
                      exit();
                  }
              }  
                if( $server_post_data){


                }else{

                }
                
             }else{
                echo "<div style='margin:20px; color:red; font-size:18px; padding: 10px 15px; background-color:#ffe6e6; text-align: start;'>الرجاء ملاء الفراغات</div>";
            }
          
        }
        
        // معلومات قاعده البيانات
        ?>
        <h2 style="margin-bottom: 15px;">معلومات قاعده البيانات :</h2>
        <form action="" method="POST">
            <div class="box">
        <label>هوست القاعده :</label>
        <input type="text" name="server-host" placeholder="هوست القاعده">
        </div>
        <!--  -->
        <div class="box">
        <label>اسم المستخدم :</label>
        <input type="text" name="server-user" placeholder="اسم المستخدم">
        </div>
        <!--  -->
        <div class="box">
        <label>كلمه السر :</label>
        <input type="text" name="server-pass" placeholder="كلمه السر">
        </div>
        <!--  -->
        <div class="box">
        <label>اسم القاعده :</label>
        <input type="text" name="server-db" placeholder="اسم القاعده">
        </div>
        <!-- submit -->
        <div class="box" style="justify-content: center;">
        <input type="submit" name="server-sub" class="btn_style" value="انشاء الجداول" style="background-color:#5cb85c;">
        </div>
        </form>
        <!--  -->
        <?php
       }else{
        $conn_inc="../inc/connect.php";
        $serv_imc="../inc/server.inc.ecomweb";
        $table="../inc/table.php";
        if(is_writable($conn_inc)){
             echo "<p>
                    <div class='co'>ملف connect.php قابل للكتابه .</div>
                   </p>";
        }else{
         echo "<p>
                 <div class='err'>ملف connect.php  غير قابل للكتابه .</div>
               </p>";
        }
       //  serv_imc
        if(is_writable($serv_imc)){
             echo "<p>
                    <div class='co'>ملف server.inc.ecomweb قابل للكتابه .</div>
                   </p>";
        }else{
         echo "<p>
                 <div class='err'>ملف server.inc.ecomweb  غير قابل للكتابه .</div>
               </p>";
        }
       //  table
       if(is_writable($table)){
         echo "<p>
                <div class='co'>ملف table.inc قابل للكتابه .</div>
               </p>";
    }else{
     echo "<p>
             <div class='err'>ملف table.inc غير قابل للكتابه .</div>
           </p>";
    }
       ?>
       <button class="btn_style" style="cursor:pointer;">بدء التنصيب</button>
       <?php
       }      
       ?>
      
      <div style="text-align:center; margin:15px; font-family: 'Tajawal', sans-serif; font-weight:bold;"> by <span style="color:#0088ff;">mohammed abd elhakim</span></div>
   <div style="text-align:center; margin:15px; font-family: 'Tajawal', sans-serif; font-weight:bold;">هذه المرحله تاخذ بعض الوقت الرجاء الانتظار...</div>
       
    </div>

    <style>
      body{
        background-color:#f5f5f5;
      }

      .box{
        display: flex;
        flex-direction: row;
        align-items: center;
        text-align: center;
      }

      .btn_style{
        color:white;
        border:1px solid #4cae4c;
        border-radius:6px;
        background-color:#5cb85c;
        padding:8px 15px;
        font-family: 'Tajawal', sans-serif;
        font-size:13px;
        margin:10px 0;
        font-weight:bold;
      }

      .countainer2 input[type="text"]{
        background-color:#f5f5f5;

      }

      .countainer2  label{
        width: calc(100% / 3);
        font-weight:500;
      }
      .countainer2{
        margin:50px auto;
        background-color:#ffffff;
        width:500px;
        height:auto;
        padding:20px;
        border:1px solid #d9d9d9;
        border-radius:6px;
        text-align:center;

      }
      .co {
        background-color:#dff0d8;
        border:1px solid #d9d9d9;
        padding:15px 20px;
        width:100%;
        border-radius:6px;
        margin:20px auto;
        color:#93b489;
        font-weight:bold;
        text-align:right;
      }

      .err{
        text-align:right;
        background-color:#f2dede;
        border:1px solid #d9d9d9;
        padding:15px 20px;
        width:100%;
        border-radius:6px;
        margin:20px auto;
        color:#c46868;
        font-weight:bold;
      }
    </style>
</body>
</html>