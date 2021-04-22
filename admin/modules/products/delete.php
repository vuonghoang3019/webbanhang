<?php
    include "../../autoload/autoload.php";
    $id = intval(getInputedit('id'));
    $EditProduct = $db->fetchID("products",$id);
    if(empty($EditProduct))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("products");
    }
    
    $num = $db->delete("products",$id);
    if($num > 0)
    {
        $_SESSION['success'] = 'Xóa thành công';
        redirectAdmin("products");
    }
    else
    {
        $_SESSION['error'] = 'Xóa thất bại';
        redirectAdmin("products");
    }
?>
