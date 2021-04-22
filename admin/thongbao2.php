<?php 
    include "../autoload/autoload.php";
    $link = "../user/login.php";

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Web bán hàng</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Elegant Error Page template Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <link href="../css_layout/css/thongbao.css" rel="stylesheet" type="text/css" media="all" />
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    </head>
    <body>  
        <div class="agileits-main">
            <div class="agileinfo-row">
                <div class="w3layouts-errortext">
                    <h2>4<span>0</span>4</h2>
                    <?php if($_SESSION['matb'] == 1):?>
                     <h1> <?php echo 'Bạn cần đăng nhập quay về trang đăng nhập tại'." <a href='$link'>đây</a>" ?></h1> 
                    <?php endif ?>
                   
                </div>
            </div>
        </div>
    </body>
</html>