 <?php 
// جلب معلومات قاعده البيانات من الملف
$filename = 'C:\xampp\htdocs\ecomweb\assets\pg\admin\install\server.inc.ecomweb';
$server_file=fopen($filename,'r');
$server_data=fread($server_file,filesize($filename));
$filter_data=explode(',',$server_data);
// 
 $host=$filter_data['0'];
 $user=$filter_data['1'];
 $pass=$filter_data['2'];
 $db=$filter_data['3'];
 
 $conn=new mysqli($host,$user,$pass,$db);
 fclose($server_file);
 if($conn->connect_error){
    die("Connection Error :".$conn->connect_error);
 }else{
   // echo "conected";
 }
//  error_reporting(0);
 ?>