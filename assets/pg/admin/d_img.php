<?php
require_once("./inc/connect.php");
session_start();
if($_GET['dir_id'] !== null && $_GET['id_img'] !== null){
    
    $search_dir=$_GET['dir_id'];
    $search_img=trim($_GET['id_img']);
    // ده الاي دي الحنرجعبيو لصفحه التعديل
    chdir('products_image');
    $old_files=scandir($search_dir);
    // chdir($search_dir);
    // طلب استدعاء ولي امر لاحضار قيمه الاي دي للمنتج او الطالب الذي يحمل قيمه تايتل معلومه لدينا
    $sql="SELECT * FROM products WHERE title='".$search_dir."'";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    // echo  "<br>row type is " . var_dump($row) . "<br>";
    $id_prd=$row['id'];
    function delete_directory($dir){
      if(!file_exists($dir)){
           return true;
      }

      if(!is_dir($dir)){
        return unlink($dir);
      }

      foreach (scandir($dir) as $item) {
        if($item === '.' || $item === '..'){
            continue;
        }

        if(!delete_directory($dir . 'DIRECTORY_SEPARATOR' . $item)){
            return false;
        }else{
            rmdir($dir);
        }

      }
    }
    $new_files=array();
    foreach ($old_files as $file) {
        # code...
        if($file !== $search_img && $file !== '.' && $file !== '..'){
           array_push($new_files , $file); 
        }
    } 
    $del_path=getcwd() . "/". $search_dir . "/" . $search_img;
    $isdelete=delete_directory($del_path);
    if($isdelete){
        echo "seccessfully deleteed";

        header("Location:edit_product.php?prd_id=".$row['id']." & prd_name=".$row['title']."");
    }else{
        echo "failed delete";
    }
}
?>