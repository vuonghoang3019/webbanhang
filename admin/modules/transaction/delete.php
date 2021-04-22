<?php 
    include "../../autoload/autoload.php";
    $id = intval(getInputedit('id'));
    $EditProduct = $db->fetchID("transactions",$id);
    if(empty($EditProduct))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("transactions");
    }
    $num = $db->delete("transactions",$id);
        
    $_SESSION['success'] = $num > 0 ? 'Xóa thành công' : 'Xóa thất bại';
    redirectAdmin("transaction");

?>