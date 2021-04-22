<?php 
    include "../../autoload/autoload.php";
    $id = intval(getInputedit("id"));
    $EditStatus = $db -> fetchID("transactions",$id);
    if(empty($EditStatus))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("transaction");
    }
    if($EditStatus['status'] == 1)
    {
        $_SESSION['error'] = "Đơn hàng đã được xử lý";
        redirectAdmin("transaction");
    }
    $status = 1;
    $update = $db -> update("transactions",array("status" => $status),array("id"=>$id));
    if($update > 0)
    {
        $_SESSION['success'] = "Cập nhật dữ liệu thành công";

        $sql = "SELECT product_id,number FROM orders WHERE transaction_id = $id";
        $Order = $db -> fetchsql($sql);
        foreach($Order as $item)
        {
            $product_id = intval($item['product_id']);
            $product = $db -> fetchID("products",$product_id);
            $number = $product['number'] - $item['number'];
            $update_num = $db -> update("products",array("number"=>$number,"pay"=>$product['pay']+1),array("id"=>$product_id));
           
        }
        redirectAdmin("transaction");
    }
    else
    {
        $_SESSION['error'] = "Cập nhật dữ liệu thất bại";
        redirectAdmin("transaction");
    }
    
?>