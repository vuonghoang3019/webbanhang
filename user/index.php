<?php
   include "../autoload/autoload.php";
   $sqlHomecate =  "SELECT * FROM categories WHERE home = 1 ORDER BY updated";
   $categoryhome = $db -> fetchsql($sqlHomecate);
   $data = [];
   
   foreach ($categoryhome as $item)
   {
      $cateID = intval($item['id']);
      $sql = "SELECT * FROM products WHERE category_id = $cateID";
      $productHome = $db -> fetchsql($sql);
      $data[$item['name']] = $productHome;
   }

?>
<?php include "../layouts/header.php"; ?>
               <div class="col-md-9 bor">
                  <section id="slide" class="text-center" >
                     <img src="../css_layout/images/s6.png" class="img-thumbnail" style="width:825px; height:425px">
                     
                     </section>
                  
                  <section class="box-main1">
                     <?php foreach($data as $key => $value): ?>
                     <h3 class="title-main"><a href="javascript:void(0)"><?php echo $key ?> </a> </h3>
                        <div class="showitem">                            
                           <?php foreach($value as $item): ?>
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
                                 <p><a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><i class="fa fa-search"></i></a></p>
                                 <p><a href=""><i class="fa fa-heart"></i></a></p>
                                 <p><a href="addcart.php?id=<?php echo $item['id'] ?>"><i class="fa fa-shopping-basket"></i></a></p>
                              </div>
                           </div>      
                           <?php endforeach ?>                                                    
                        </div>
                     <?php endforeach ?>
                     
                  </section>
               </div>
            </div>
<?php include "../layouts/footer.php" ?>        