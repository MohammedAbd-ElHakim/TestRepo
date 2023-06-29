<?php 
require_once('./inc/connect.php');
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
    <title><?php echo $row17['web_name'];?>  | بيع جميع انواع السلع</title>
</head>
<body>
<div class="header-bar">
<?php echo $row17['header_txt'];?>    </div>
    <header>
        <div class="center-bar">
    <p>
        <span class="ecom" onclick="window.open('http://localhost/ecomweb/index','_self')" style="cursor:pointer;">web</span><span class="web" onclick="window.open('http://localhost/ecomweb/index','_self')" style="cursor:pointer;" >Ecom</span>
    </p>
        </div>
    </header>
    <div class="title_content" style="font-size:38px; color:green;"> كوبونات التخفيض</div>

    <div class="coupon_page">
        <div class="coupon_text">
        <table class="table table-bordered" role="tble" style="width:80%; margin:20px auto;">
                <thead>
                    <tr  style="text-align:center;">
                        <th width="2%">#</th>
                        <th class="text-right" width="50%" style="color:green;">كود التخفيض</th>
                        <th class="text-right" width="50%" style="color:green;">تاريخ انتهاء الخصم </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql5="SELECT * FROM coupon";
                    $result5=$conn->query($sql5);

                    while($row5=$result5->fetch_assoc()){
                        echo "<tr> 
                        <td><span class='badge'>".$row5['id']."</span></td>
                        <td style='text-align:center;'>".$row5['coupon_name']."</td>
                        <td style='text-align:center;'>".$row5['date']." </td>
                      </tr>";
                    }

                     ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer class="title-footer" style="bottom: 0; position:absolute;"> جميع الحقوق محفوظه &copy;  <?php echo date('Y');  echo " " . $row17['web_name'];?>  smsm@me.com </footer>

    <style>

.thnx_page{
    position:absolute;
    top:50%;
    left:50%;
    margin: 40px auto;
    width: 80%;
    border: 1px solid #ccc;
    text-align: center;
    transform: translate(-50%, -50%);
    padding-bottom:20px;
    border-radius:5px;
}

.thnx_icon > p {
  
}
a{
    text-decoration:none;
    color:#333;
    padding:10px;
    background:#efefef;
    padding:10px;
    border-radius:5px;
}

a:hover{
    color:#333;
}

.thnxs_icon{
  background-image:url('http://localhost/ecomweb/assets/logo/check.png');
  width:100px;
  height:100px;
  background-repeat: no-repeat;
  margin:auto;
  background-position:center;
}
    </style>

    
</body>
</html>

<?php
// 
$sql='SELECT * FROM products WHERE id=' . $_GET["prd_id"];
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$price=$row["old_price"];
$shipping=$row["shipping"];
$date=date("d/m/y");
$status='1';

if (isset($_POST['fullname']) ||  isset($_POST['phone']) || isset($_POST['address']) || isset($_POST['city'])) {
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $product_id = $_GET['prd_id'];
    $quan= $_SESSION['count'];
    if(isset($_POST['coupon'])){
        $coupon=$_POST['coupon'];
    }

    // إضافة البيانات إلى جدول الطلبات
    $sql3 = "INSERT INTO orders (products_id, name, phone, address, city,quantity,price,shipping,date,status,coupon) VALUES ('".$product_id."', '".$fullname."', '".$phone."', '".$address."', '".$city."', '".$quan."', '".$price."', '".$shipping."', '".$date."', '".$status."', '".$coupon."')";
    if ($conn->query($sql3) === TRUE) {
        // الكود الذي يتم تنفيذه إذا تمت العملية بنجاح
        // echo "تمت إضافة البيانات بنجاح.";
    } else {
        // الكود الذي يتم تنفيذه إذا حدث خطأ
        // echo "حدث خطأ أثناء إضافة البيانات: " . $conn->error;
    }
    
}else{
    // echo "nooooooooooooooooooooooo";
}
?>