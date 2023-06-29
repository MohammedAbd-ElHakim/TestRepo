
<?php 
require_once("./inc/connect.php");
session_start();
    // تم تأكيد حذف المنتج
if(isset($_GET["del_id"])){
    $filename=$_GET["del_id"];
    // الملف المراد حذفه
    $filepath='products_image/' . $filename;
    if(is_dir($filepath)){
        // delete file
        echo "it is a dir";
        // حذف الملفات داخل المجلد
        array_map('unlink', glob("$filepath/*.*"));
        // حذف المجلد نفسه
        if(rmdir($filepath)){
            echo "تم حذف االمجلد بنجاح";
        }else{
            echo "حدث خطأ أثناء حذف المجلد";
        }
    }
    else {
        echo "المجلد غير موجود";
    }
}else{
    echo "لسسسسسسسسسسسه";
}

// حزف الصف من قاعده البيانات
if(isset($_GET["id"])){
    $id_del=$_GET["id"];
    $sql="DELETE FROM products WHERE id=$id_del";
    if(mysqli_query($conn,$sql)){
        echo "تم حزف المنتج بنجاح";
    }else{
        echo "حدث خطا اثناء حذف المنتج";
    }
}
else {
header("Location:products.php");
}
mysqli_close($conn);
header("Location:products.php");

?>