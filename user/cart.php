<?php include "../autoload/autoload.php";
$sum = 0;
?>
<?php include "../layouts/header.php" ?>
            
               <div class="col-md-9 bor">
               <?php if(isset($_SESSION['success'])): ?>
               <div class="alert alert-success"><?php echo $_SESSION['success'] ;unset($_SESSION['success']) ?></div>
               <?php endif ?>
                  <section class="box-main1">
                   <h3 class="title-main" style="text-align:center">Giỏ hàng</h3>
                   <table class="table table-hover">
                       <thead>
                           <tr>
                               <th>STT</th>
                               <th>Tên sản phẩm</th>
                               <th>Ảnh</th>
                               <th>Giá </th>
                               <th>Số lượng</th>
                               <th>Tổng tiền</th>
                               <th>Thao tác</th>
                           </tr>
                       </thead>
                       <tbody>
                       <?php if(!isset($_SESSION['cart'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo "Giỏ hàng trống, Bạn hãy tiếp tục mua hàng"; ?>
                            </div>
                           <?php else: ?>
                           <?php $stt = 1; foreach($_SESSION['cart'] as $key => $value ): ?>
                                <tr>
                                    <td><?php echo $stt ?></td>
                                    <td><?php echo $value['name'] ?></td>
                                    <td><img src="<?php echo upload() ?>products/<?php echo $value['img'] ?>" alt="" width="50" height="50"></td>
                                    <td><?php echo formatPrice($value['price']) ?> Đ</td>
                                    <td><input id="number" class="form-control number" min="1"  type="number" value="<?php echo $value['number'] ?>"></td>
                                    <td><?php echo formatPrice($value['price'] * $value['number'])  ?> Đ</td>
                                    <td>
                                        <a href="#" class="btn btn-info updatecart" data-key=<?php echo $key ?>><i class="fas fa-pen-square"></i>Sửa</a>
                                        <a href="remove.php?id=<?php echo $key ?>" class="btn btn-danger">Xóa</a>
                                    </td>
                                </tr>     
                                <?php $sum += $value['price'] * $value['number']; $_SESSION['tongtien'] = $sum; ?>
                          <?php $stt++; endforeach ?>   
                        <?php endif ?>      
                       </tbody>
                           
                   </table>
                   <?php if(!isset($_SESSION['tongtien'])): ?>
                   <div class="col-md-5 pull-right">
                       <ul class="list-group">
                            <li class="list-group-item">
                                <h3><?php echo "Thông tin giỏ hàng trống" ?></h3>
                              <?php else: ?>
                                <h3><?php echo "Thông tin giỏ hàng" ?></h3>
                            </li>
                            <li class="list-group-item">
                                <span class="badge"><?php echo formatPrice($_SESSION['tongtien']) ?></span>
                                số tiền
                            </li>
                            <li class="list-group-item">
                            <span class="badge">10%</span>THUẾ VAT
                            </li>
                            <li class="list-group-item">
                            <span class="badge">
                            <?php  $_SESSION['total'] = $_SESSION['tongtien'] * 110/100; 
                            echo formatPrice($_SESSION['total']) .' Đ' ?></span>
                            Tổng tiền thanh toán
                            </li>
                            <li class="list-group-item ">
                                <a href="checkout.php"class="btn btn-success">Thanh toán</a>                                                          
                            </li>
                            
                       </ul>
                   </div>
                   <?php endif ?>
                  </section>
               </div>
            </div>
<?php include "../layouts/footer.php" ?>        