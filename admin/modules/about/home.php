<?php 
    include  "../../autoload/autoload.php";
    $id = getInputedit("id");
    $ID = $db -> fetchID("about",$id);
    if(empty($ID))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("about");
    }
    $status = $ID['status'] == 0 ? 1 : 0;
    $update = $db->update("about",array("status"=>$status),array("id"=>$id));
    if($update > 0)
    {
        $_SESSION['succes'] = "Cập nhật thành công";
        redirectAdmin("about");
    }
    else
    {
        $_SESSION['error'] = "Cập nhật thất bại";
        redirectAdmin("about");
    }

?>