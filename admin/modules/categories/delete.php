<?php
    include "../../autoload/autoload.php";
    $id = intval(getInputedit('id'));
    $EditCategory = $db->fetchID("categories",$id);
    if(empty($EditCategory))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("categories");
    }
    $check = $db->fetchOne("products"," category_id = $id ");
    if($check == null)
    {
        $num = $db->delete("categories",$id);
        if($num > 0)
        {
            $_SESSION['success'] = 'Xóa thành công';
            redirectAdmin("categories");
        }
        else
        {
            $_SESSION['error'] = 'Xóa thất bại';
            redirectAdmin("categories");
        }
    }
    else
    {
        $_SESSION['error'] = 'Danh mục có sản phẩm không xóa được!';
        redirectAdmin("categories");
    }
    

?>
