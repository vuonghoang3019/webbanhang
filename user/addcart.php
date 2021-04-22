<?php
    include "../autoload/autoload.php";
    $id = getInputedit('id');
    $product = $db -> fetchID("products",$id);
    if(isset($_SESSION['name_id']) && $product['number'] > 0 )
    {
        echo "<script>alert('Mua hàng thành công')</script>";
    }
    elseif($product['number'] < 0)
    {
        echo "<script>alert('Sản phẩm đã hết');location.href='index.php' ;</script>'"; 
    }
    if($product['number'] > 0)
    {
        if(!isset($_SESSION['cart'][$id]))
        {
            // tạo mới giỏ hàng
            $_SESSION['cart'][$id]['name']   = $product['name'];
            $_SESSION['cart'][$id]['number'] = 1;
            $_SESSION['cart'][$id]['img']    = $product['img']; 
            $_SESSION['cart'][$id]['price']  = ((100 - $product['sale']) * $product['price']) / 100;
            echo "<script>alert('Thêm sản phẩm thành công');location.href='cart.php' ;</script>'";
    
        }   
        else
        {
            //Cập nhật lại giỏ hàng
            $_SESSION['cart'][$id]['number'] += 1;
            echo "<script>alert('Thêm sản phẩm thành công');location.href='cart.php' ;</script>'"; 
    
        }
     }
     else
     {
        echo "<script>alert('Sản phẩm đã hết');location.href='index.php' ;</script>'"; 
     }

   

?>