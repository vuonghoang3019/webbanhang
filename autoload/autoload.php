<?php
    session_start();
    include "/xampp/htdocs/backend/webbanhang/libraries/Database.php";
    include "/xampp/htdocs/backend/webbanhang/libraries/function.php";  
    $db = new Database();
    $category = $db -> fetchAll("categories");
    $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 3 ";
    $product = $db -> fetchsql($sql); 
    $sql_hot = "SELECT * FROM products ORDER BY pay DESC LIMIT 3";
    $product_hot = $db -> fetchsql($sql_hot); 
?>