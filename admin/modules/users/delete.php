<?php
    include "../../autoload/autoload.php";
    $id = intval(getInputedit('id'));
    $DeleteUser = $db->fetchID("users",$id);
    if(empty($DeleteUser))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("users");
    }
    
    $num = $db->delete("users",$id);
    if($num > 0)
    {
        $_SESSION['success'] = 'Xóa thành công';
        redirectAdmin("users");
    }
    else
    {
        $_SESSION['error'] = 'Xóa thất bại';
        redirectAdmin("users");
    }
?>
