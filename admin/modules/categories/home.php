<?php 
    include  "../../autoload/autoload.php";
    $id = intval(getInputedit('id'));
    $EditCategory = $db -> fetchID("categories",$id);
    if(empty($EditCategory))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("categories");
    }
    $home = $EditCategory['home'] ==0 ? 1: 0;
    $update = $db->update("categories",array("home" => $home),array("id"=>$id));
    if($update > 0)
    {
        $_SESSION['succes'] = "Cập nhật thành công";
        redirectAdmin("categories");
    }
    else
    {
        $_SESSION['error'] = "Cập nhật thất bại";
        redirectAdmin("categories");
    }
    



?>