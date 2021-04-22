<?php include "../autoload/autoload.php";
    $product_all = $db->fetchAll("products");
    if(isset($_GET['page']))
    {
        $p = $_GET['page'];
    }
    else
    {
        $p = 1;
    }
    $sql = "SELECT products.*,categories.name as categoryname FROM products LEFT JOIN categories on categories.id = products.category_id";
    $product_all = $db->fetchJone('products',$sql,$p,8,true);
    if(isset($product_all['page']))
    {
        $sotrang = $product_all['page'];
        unset($product_all['page']);
    }

?>
<?php include "../layouts/header.php" ?>
                    <div class="col-md-9 ">      
                            <div class="col-md-12">
                                <?php foreach($product_all as $item): ?>
                                <div class="col-md-6 bor detail">
                                    <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>">
                                    <img src="<?php echo upload(); ?>products/<?php echo $item['img'] ?>" class="img-responsive pull-left " width="160" height="160">                         
                                    <div class="info post a">
                                    <p>
                                        <?php echo $item['name'] ?>
                                    </p>
                                    <p class="sale">
                                        <?php echo formatPrice($item['price'])  ?> Đ
                                    </p>
                                    <p class="price">
                                        <?php echo formatpriceSale($item['price'],$item['sale'] )?> Đ
                                    </p>
                                    <span class="view"><i class="fa fa-eye"></i> <?php echo $item['view'] ?> <i class="fa fa-heart-o"></i> <?php echo $item['head'] ?> </span>
                                    <p class="name">
                                        <?php echo $item['content'] ?>
                                    </p>
                                        <span class="view"><i class="fa fa-clock-o"></i> <?php echo $item['created_at'] ?></span>
                                    </div>
                                    </a>
                                </div>       
                                <?php endforeach ?>         
                            </div>
                            <div class="row">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
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
                                                <li class="<?php echo ($i==$p) ? 'active' :'' ?>">
                                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                </li>
                                                <?php endfor ; ?>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </div>
                 
                    </div>
            </div>
<?php include "../layouts/footer.php" ?>        