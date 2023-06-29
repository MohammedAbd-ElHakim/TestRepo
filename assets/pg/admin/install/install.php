<!DOCTYPE html>
<html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="main_style">
     <title><?php echo "Ecomweb";?> | لوحه التحكم</title>
 </head>
  <body>
   <div class="countainer2">
      <?php
       $conn_inc="../inc/connect.php";
       $serv_imc="server.inc.ecomweb";
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
      if (file_exists($serv_imc)) {
    if(is_writable($serv_imc)){
        echo "<p>
               <div class='co'>ملف server.inc.ecomweb قابل للكتابة.</div>
              </p>";
    }else{
        if(chmod($serv_imc, 0644)){
            echo "<p>
                    <div class='co'>تم جعل ملف server.inc.ecomweb قابل للكتابة بنجاح.</div>
                  </p>";
        }else{
            echo "<p>
                    <div class='err'>لا يمكن جعل ملف server.inc.ecomweb قابل للكتابة.</div>
                  </p>";
        }
    }
} else {
    if (touch($serv_imc)) {
       if(is_writable($table)){
        echo "<p>
               <div class='co'>ملف table.inc قابل للكتابه .</div>
              </p>";
   }else{
    echo "<p>
            <div class='err'>ملف table.inc غير قابل للكتابه .</div>
          </p>";
   }
    } else {
        echo "<p>
                <div class='err'>لا يمكن إنشاء ملف server.inc.ecomweb.</div>
              </p>";
    }
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
      <button class="btn_style" style="cursor:pointer;"  onclick="window.location.href='database?check=2';">بدء التنصيب</button>
      <div style="text-align:center; margin:15px; font-family: 'Tajawal', sans-serif; font-weight:bold;"> by <span style="color:#0088ff;">mohammed abd elhakim</span></div>
   </div>
    <style>
      body{
        background-color:#f5f5f5;
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