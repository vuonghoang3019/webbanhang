<?php 
   include "../autoload/autoload.php"; 
   $id = intval(getInputedit('id'));
   $idcaterogy = $db -> fetchID("categories",$id);
   if(isset($_GET['page']))
   {
      $p = $_GET['page'];
   }
   else
   {
      $p = 1;
   }
   $sql = "SELECT * FROM products WHERE category_id = $id";
   $count = count($db->fetchsql($sql));
   $product = $db->fetchJones("products",$sql,$count,$p,10,true);

      $sotrang = $product['page'];
      unset($product['page']);

   $path = $_SERVER['SCRIPT_NAME'];
?>
<?php include "../layouts/header.php" ?>
               <div class="col-md-9 bor">
                  <section class="box-main1">
                  <h3 class="title-main"><a href="javascript:void(0)"><?php echo $idcaterogy['name'] ?> </a> </h3>
                  <div class="showitem clearfix">
                     <?php foreach($product as $item): ?>
                        <div class="col-md-3 item-product bor">
                           <a href="chi-tiet-san-pham.php?id=<?php echo $item['id']?>"><img src="<?php echo upload() ?>products/<?php echo $item['img']?>" class="" width="100%" height="180"></a>
                           <div class="info-item">
                              <a href="chi-tiet-san-pham.php?id=<?php echo $item['id']?>"><?php echo $item['name'] ?></a>
                                 <p><strike class="sale"><?php echo formatPrice($item['price']) ?> đ</strike> <b class="price"><?php echo formatpriceSale($item['price'] ,$item['sale']) ?></b></p>
                           </div>
                           <div class="hidenitem">
                              <p><a href=""><i class="fa fa-search"></i></a></p>
                              <p><a href=""><i class="fa fa-heart"></i></a></p>
                              <p><a href="addcart.php?id=<?php echo $item['id'] ?>"><i class="fa fa-shopping-basket"></i></a></p>
                           </div>
                        </div>                    
                     
                     <?php endforeach ?>
                     </div>

                     <div class="row" style="text-align:center">
                        <nav aria-label="Page navigation">
                              <ul class="pagination">
                                 <?php for($i = 1; $i <= $sotrang; $i++): ?>
                                    <?php 
                                       if(isset($_GET['page']))
                                       {
                                          $p = $_GET['page'];
                                       } 
                                       else
                                       {
                                          $p = 1;
                                       }
                                       ?>
                                       <li class="<?php echo isset($_GET['page']) && $_GET['page'] == $i ? 'active' :'' ?>">
                                          <a class="page-link" href="<?php echo $path; ?>?id=<?php echo $id ?>&&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                       </li>
                                 <?php endfor ?>
                              </ul>
                           </nav>
                        </div>

                  </section>
               </div>
            </div>
<?php include "../layouts/footer.php" ?>        