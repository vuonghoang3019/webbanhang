<?php include "../autoload/autoload.php";
    unset($_SESSION['cart']);
    unset($_SESSION['total']);

?>
<?php include "../layouts/header.php" ?>
               <div class="col-md-9 bor">
                  <section class="box-main1">
                   <h3 class="title-main">Thông báo thanh toán</h3>
                   <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <?php echo $_SESSION['success'];unset($_SESSION['success']) ?>
                    </div>
                   <?php endif ?>
                   <a href="index.php" class="btn btn-success">Tiếp tục mua hàng</a>
                  </section>
               </div>
            </div>
<?php include "../layouts/footer.php" ?>        