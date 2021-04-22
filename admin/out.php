<?php 
    session_start();
    unset($_SESSION['name_admin']);
    unset($_SESSION['avatar_admin']);
    unset($_SESSION['name_id']);
    unset($_SESSION['level']);
    header("location: /backend/webbanhang/user/login.php ");


?>