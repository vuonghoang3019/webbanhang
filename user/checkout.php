<?php include "../autoload/autoload.php";
   $user = $db -> fetchID("users",intval($_SESSION['name_id']));
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
      $data = [
         'amout' => $_SESSION['total'],
         'users_id' => $_SESSION['name_id'],
         'note' => postInput('note')

      ];
      $idtran = $db ->insert("transactions ",$data);
      if($idtran > 0)
      {
         foreach($_SESSION['cart'] as $key => $value)
         {
            $data2 = [
               'transaction_id' =>  $idtran,
               'product_id'     =>  $key,
               'number'         =>  $value['number'],
               'price'          =>  $value['price']
            ];
            $id_insert = $db -> insert("orders",$data2);
         }
         $_SESSION['success'] = "Lưu thông tin đơn hàng thành công ! CHúng tôi sẽ liên hệ với bạn sớm nhất";
         header("location: thongbao.php");
      }
   }


?>
<?php include "../layouts/header.php" ?>
               <div class="col-md-9">
                  <section class="box-main1">
                      <h3 class="title-main">Thanh toán đơn hàng</h3>
                   <!-- Nội dung -->
                   <form action="" class="form-horizontal" role="form" method="POST" style="margin-top:20px">
                        <div class="form-group">                           
                                <label for="" class="col-md-2 control-label"> Tài khoản</label>
                                <div class="col-md-8">
                                    <input type="text" readonly="" name="user" class="form-control" value="<?php echo $user['user'] ?>">
                                                                      
                                </div>                                
                        </div>
                        <div class="form-group">                         
                           <label for="" class="col-md-2 control-label"> Email</label>
                           <div class="col-md-8">
                              <input type="text" name="email" readonly=""  class="form-control" required="email" value="<?php echo $user['email'] ?>" >                  
                           </div>                
                        </div>
                        <div class="form-group">                         
                           <label for="" class="col-md-2 control-label"> Số điện thoại</label>
                           <div class="col-md-8">
                              <input type="number" name="phone"  class="form-control" value="<?php echo $user['phone'] ?>" >                            
                           </div>                
                        </div>
                        <div class="form-group">                         
                           <label for="" class="col-md-2 control-label"> Địa chỉ</label>
                           <div class="col-md-8">
                              <input type="text" name="address" class="form-control" value="<?php echo $user['address'] ?>">                          
                           </div>                
                        </div>
                       
                             
                        <div class="form-group">                         
                           <label for="" class="col-md-2 control-label"> Ghi chú</label>
                           <div class="col-md-8">
                              <textarea name="note" id="note" cols="30" placeholder="Ghi chú những điều bạn cần tại đây" class="form-control" rows="5"></textarea>                        
                           </div>                
                        </div>

                        <div class="form-group">                         
                           <label for="" class="col-md-2 control-label"> Giỏ hàng </label>
                           <div class="col-md-8">
                           <?php if(!isset($_SESSION['tongtien'])): ?>
                                 <li class="list-group-item">
                                    <h3><?php echo "Thông tin giỏ hàng trống" ?></h3>
                                    <label for="" class="col-md-2 control-label"> Giỏ hàng </label>
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
                                 <?php endif ?>                       
                           </div>                
                        </div>                                                  
                   <button class="btn btn-success col-md-2 col-md-offset-4" type="submit">Xác nhận</button>


                   </form>
                  </section>
               
               </div>
            </div>
<?php include "../layouts/footer.php" ?>        