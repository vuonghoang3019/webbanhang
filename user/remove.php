<?php 
    include "../autoload/autoload.php";
    $id = intval(getInputedit("id"));
    unset($_SESSION['cart'][$id]);
    unset($_SESSION['tongtien']);
    $_SESSION['success'] = "Xóa thành công";
    header("location: cart.php");

?>