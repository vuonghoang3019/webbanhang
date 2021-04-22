<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Web Bán Hàng</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css_admin/css/sb-admin-2.min.css" rel="stylesheet" type="text/css">
    <link href="css_admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    
</head>
<body >
<?php include "../autoload/autoload.php";
       $link = "../user/login.php";
?>
<?php include "layout/header.php"; ?>
  
                <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">CẢNH BÁO!</h4>
                <?php if($_SESSION['matb'] == 1):?>
                     <p> <?php echo 'Bạn cần đăng nhập quay về trang đăng nhập tại'." <a href='$link'>đây</a>" ?></p> 
                    <?php elseif($_SESSION['matb'] == 2): ?>                
                    <p> <?php echo 'Bạn không có quyền vào trang này, xin hãy quay lại'?></p>
                    <?php endif ?>

        </div>
<?php include "layout/footer.php"; ?>
<script src="css_admin/vendor/jquery/jquery.min.js"></script>
<script src="css_admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="css_admin/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="css_admin/js/sb-admin-2.min.js"></script>
<script src="css_admin/vendor/chart.js/Chart.min.js"></script>
</body>
</html>