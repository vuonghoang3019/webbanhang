<?php 
    include "../../autoload/autoload.php";
    $id = getInputedit("id");
    $DeleteAbout = $db->fetchID("about",$id);
    if(empty($DeleteAbout))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("about");
    }
    $delete = $db -> delete("about",$id);
    if($delete > 0)
    {
        $_SESSION['success'] = "Xóa thành công";
        redirectAdmin("about");
    }
    else
    {
        $_SESSION['error'] = "Xóa thất bại";
        redirectAdmin("about");
    }

?>