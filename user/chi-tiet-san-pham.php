<?php include "../autoload/autoload.php";
   $id = intval(getInputedit('id'));
   $product1 = $db->fetchID("products",$id);
   $cateid = $product1['category_id'];
   $sql = "SELECT * FROM products WHERE category_id = $cateid ORDER BY id DESC LIMIT 4";
   $productAttached = $db -> fetchsql($sql);
   $update_view = "UPDATE products SET view = view + 1 WHERE id = $id";
   $update_view1 = $db -> fetchsql1($update_view);


?>
<?php include "../layouts/header.php" ?>
      <div class="col-md-9 bor">
         <section class="box-main1" >
            <div class="col-md-6 text-center">
                  <img src="<?php echo upload() ?>products/<?php echo $product1['img'] ?>" class="img-responsive bor" id="imgmain" width="100%" height="370" data-zoom-image="images/16-270x270.png">
                  <ul class="text-center bor clearfix" id="imgdetail">
                     <li>
                        <a href="<?php echo upload() ?>products/<?php echo $product1['img'] ?>" target="_blank">
                        <img src="<?php echo upload() ?>products/<?php echo $product1['img'] ?>" class="img-responsive pull-left"  width="80" height="80">
                        </a>
                     </li>
                     <li>
                        <img src="<?php echo upload() ?>products/<?php echo $product1['img'] ?>" class="img-responsive pull-left" width="80" height="80">
                     </li>
                     <li>
                        <img src="<?php echo upload() ?>products/<?php echo $product1['img'] ?>" class="img-responsive pull-left" width="80" height="80">
                     </li>
                     <li>
                        <img src="<?php echo upload() ?>products/<?php echo $product1['img'] ?>" class="img-responsive pull-left" width="80" height="80">
                     </li>
                  </ul>
            </div>
            <div class="col-md-6 bor" style="margin-top: 20px;padding: 30px;">
                  <ul id="right">
                     <li>
                        <h3> <?php echo $product1['name'] ?> </h3>
                     </li>
                     <li>
                        <p> Số lượng: <?php echo $product1['number'] ?> cái. </p>
                     </li>
                     <li>
                        <p>  Lượt xem: <?php echo $product1['view'] ?> </p>
                     </li>
                     <?php if($product1['sale'] > 0) : ?>
                        <li>
                           <p> Khuyến mãi: <?php echo $product1['sale'] ?>%. </p>
                        </li>                  
                        <li>
                           <p><strike class="sale"><?php echo formatPrice($product1['price'])  ?> Đ</strike> <b class="price"><?php echo formatpriceSale($product1['price'],$product1['sale'])  ?> đ</b>
                        </li>
                     <?php else: ?>
                        <li>
                        <p class="sale"><?php echo formatPrice($product1['price'])  ?> Đ
                        </li>
                     <?php endif; ?>              
                     <li><a href="addcart.php?id=<?php echo $product1['id'] ?>" class="btn btn-default"> <i class="fa fa-shopping-basket"></i>Add To Cart</a></li>            
                  </ul>
            </div>
         </section>
         <div class="col-md-12" id="tabdetail">
            <div class="row">
                  <ul class="nav nav-tabs">
                     <li class="active"><a data-toggle="tab" href="#home">Mô tả sản phẩm </a></li>
                     <li><a data-toggle="tab" href="#menu1">Thông tin khác </a></li>
                     <li><a data-toggle="tab" href="#menu2">Bình luận</a></li>
                  </ul>
                  <div class="tab-content">
                     <div id="home" class="tab-pane fade in active">
                        <h3>Nội dung</h3>
                        <p><?php echo $product1['content'] ?></p>
                     </div>
                     <div id="menu1" class="tab-pane fade">
                        <h3> Thông tin khác </h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                     </div>
                     <div id="menu2" class="tab-pane fade">
                        <h3>Menu 2</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                     </div>
                  </div>
            </div>
         </div>
         <div class="col-md-12">
            <div class="showitem">                            
               <?php foreach($productAttached as $item): ?>
                  <div class="col-md-3 item-product bor">
                     <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>">
                        <img src="<?php echo upload() ?>products/<?php echo $item['img'] ?>" class="" width="100%" height="180">
                     </a>
                     <div class="info-item">
                        <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a>
                        <p>
                           <strike class="sale"><?php echo formatPrice($item['price'])  ?> đ</strike>
                           <b class="price"><?php echo formatpriceSale($item['price'],$item['sale'])  ?> đ</b>
                        </p>
                     </div>
                     <div class="hidenitem">
                        <p><a href=""><i class="fa fa-search"></i></a></p>
                        <p><a href=""><i class="fa fa-heart"></i></a></p>
                        <p><a href="addcart.php?id=<?php echo $item['id'] ?>"><i class="fa fa-shopping-basket"></i></a></p>
                     </div>
                  </div>     
               <?php endforeach ?>                                                    
            </div>
         </div>
      </div>
</div>
<script>
   ImageZoom("myimage","myresult");
</script>
<?php include "../layouts/footer.php" ?>        