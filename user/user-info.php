<?php include "../autoload/autoload.php";
    $id = intval(getInputedit("id"));
    $EditUser = $db -> fetchID("users",$id);  
    if(isset($_POST['btn_info']))
    {
        $data = [
            "user"  => postInput("user"),
            "name"  => postInput("name"),
            "email" => postInput("email"),
            "phone" => postInput("phone"),
            "address" => postInput("address"),
        ];
        $erorr = [];
        if(postInput('email') == '')
        {
            $erorr['email'] = "Mời bạn nhập Email";
        }
        else
        {
            if(postInput("email") != $EditAdmin['email'])
            {
                $check = $db->fetchOne("admin", " email = '".$data['email']."' ");
                if($check != null)
                {
                    $erorr['email'] = "Email bạn nhập đã tồn tại";
                }
            }         
        }
        if(empty($erorr))
        {
            if(isset($_FILES['avatar']))
            {
                $file_name = $_FILES['avatar']['name'];
                $file_tmp = $_FILES['avatar']['tmp_name'];
                $file_type = $_FILES['avatar']['type'];
                $file_error = $_FILES['avatar']['error'];
                if($file_error == 0)
                {
                    $part = "../uploads/user/";
                    $data['avatar'] = $file_name;
                }
            }
            else
            {
                $file_name = $EditUser['avatar'];
            }
            $is_upadte = $db->update("users",$data,array("id"=>$id));
            if($is_upadte > 0)
            {
                $movefile = move_uploaded_file($file_tmp,$part.$file_name);
                $_SESSION['success'] = "Cập nhật thành công";
               
            }
            else
            {
                $_SESSION['error'] = "Cập nhật thất bại";
               
            }
        }
    }
    if(isset($_POST['btn_pass']))
    {
        $data = [
            "password" => md5(postInput("password")) 
        ];
        $erorr = [];
        if(postInput("password") != NULL && postInput("re_password") != NULL)
        {
            if(postInput("password") != postInput("re_password"))
            {
                $erorr['re_password'] = "Mật khẩu bạn nhập không trùng khớp";
            }
        }
        if(empty($erorr))
        {
            $update = $db -> update("users",$data,array("id"=>$id));
            if($update)
            {
                $_SESSION['success'] = "Đổi pass thành công";
            }
            else
            {
                $_SESSION['erorr'] = "Đổi pass thất bại";
            }
        }
    }
    $sql_info = "SELECT orders.*,transactions.id,transactions.created_at as date,transactions.users_id,users.id,users.user as nameuser
    ,products.id,products.name as productname FROM orders
    JOIN transactions ON transactions.id = orders.transaction_id 
    JOIN products ON products.id = orders.product_id 
    JOIN users ON users.id = transactions.users_id
      WHERE transactions.users_id = $id ORDER BY date DESC";
    $user_info = $db -> fetchsql($sql_info);

?>
<?php include "../layouts/header2.php" ?>     
               <div class="col-md-12" id="tabdetail">
                    <div class="row">
                    <?php if(isset($_SESSION['success'])) :?>
                                <div class="alert alert-success">
                                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                                </div>
                            <?php endif; ?>
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">Thông tin tài khoản </a></li>
                            <li><a data-toggle="tab" href="#menu1">Lịch sử mua hàng </a></li>
                            <li><a data-toggle="tab" href="#menu2">Đổi mật khẩu</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <div class="col-md-12">
                                    <section class="box-main1">               
                                        <form action="" class="form-horizontal" role="form" method="POST" style="margin-top:20px" enctype="multipart/form-data">
                                            <div class="form-group">  
                                            <?php if(isset($_SESSION['success'])): ?>
                                            <div class="alert alert-success" role="alert">
                                                <?php echo $_SESSION['success'] ; unset($_SESSION['success']);?>
                                            </div>
                                            <?php endif ?>  
                                            <?php if(isset($_SESSION['error'])): ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php echo $_SESSION['error'] ; unset($_SESSION['error']);?>
                                            </div>
                                            <?php endif ?>                           
                                            <label for="" class="col-md-2 control-label"> Tên đăng nhập</label>
                                            <div class="col-md-8">
                                                <input type="text" readonly="" name="user" value="<?php echo $EditUser['user'] ?>" class="form-control">
                                                <?php if(isset($erorr['user'])): ?>
                                                    <p class="text-danger"><?php echo $erorr['user'] ?></p>
                                                <?php endif ?>                                                                     
                                                </div>
                                                    
                                            </div>
                                            <div class="form-group">                    
                                                    <label for="" class="col-md-2 control-label"> Họ tên</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="name" value="<?php echo $EditUser['name'] ?>" class="form-control">
                                                        <?php if(isset($erorr['name'])): ?>
                                                            <p class="text-danger"> <?php echo $erorr['name'] ?> </p>
                                                        <?php endif ?>
                                                    </div>                         
                                            </div>
                                            <div class="form-group">                    
                                                    <label for="" class="col-md-2 control-label"> Email</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="email" value="<?php echo $EditUser['email'] ?>" class="form-control">
                                                        <?php if(isset($erorr['email'])): ?>
                                                            <p class="text-danger"> <?php echo $erorr['email'] ?> </p>
                                                        <?php endif ?>
                                                    </div>                         
                                            </div>
                                            <div class="form-group">                    
                                                    <label for="" class="col-md-2 control-label"> Phone</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="phone" value="<?php echo $EditUser['phone'] ?>" class="form-control">
                                                        <?php if(isset($erorr['phone'])): ?>
                                                            <p class="text-danger"> <?php echo $erorr['phone'] ?> </p>
                                                        <?php endif ?>
                                                    </div>                         
                                            </div>
                                            <div class="form-group">                    
                                                    <label for="" class="col-md-2 control-label"> Địa chỉ</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="address" value="<?php echo $EditUser['address'] ?>" class="form-control">
                                                        <?php if(isset($erorr['address'])): ?>
                                                            <p class="text-danger"> <?php echo $erorr['address'] ?> </p>
                                                        <?php endif ?>
                                                    </div>                         
                                            </div>
                                            <div class="form-group">                    
                                                    <label for="" class="col-md-2 control-label">Chọn ảnh</label>
                                                    <div class="col-md-3">
                                                        <input type="file" name="avatar" class="form-control" value="<?php echo $EditUser['avatar'] ?>">
                                                        <?php if(isset($erorr['avatar'])): ?>
                                                            <p class="text-danger"> <?php echo $erorr['avatar'] ?> </p>
                                                        <?php endif ?>
                                                    </div>  
                                                    <label for="" class="col-md-2 control-label"> </label>
                                                    <div class="col-md-3">
                                                        <img src="<?php echo upload(); ?>user/<?php echo $EditUser['avatar'] ?>" alt="dsad" style="width:100px; height:100px">
                                                     
                                                    </div>                          
                                            </div>
                       
                                                                                                    
                                            <button class="btn btn-success col-md-2 col-md-offset-4" name="btn_info" type="submit">Submit</button>

                                        </form>
                                    </section>
                                </div>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <h3> Lịch sử mua hàng </h3>
                                <table class="table">
                                    <thead class="thead-dark">                                
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Ngày đặt</th>                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $stt = 1;
                                        foreach($user_info as $item):
                                    ?> 
                                        <tr>
                                            <th scope="row"><?php echo $stt ?></th>
                                            <td><?php echo $item['productname']   ?></td>
                                            <td><?php echo formatPrice($item['price'])  ?> Đ</td>
                                            <td><?php echo $item['number'] ?></td>
                                            <td><?php echo $item['created_at'] ?></td>

                                        </tr>  
                                     <?php $stt++; endforeach ?>                                  
                                    </tbody>
                                    </table>


                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <h3>Đổi mật khẩu</h3>
                                <div class="col-md-12">
                                    <section class="box-main1">
                                    <form action="" class="form-horizontal" role="form" method="POST" style="margin-top:20px">
                                        <div class="form-group">  
                                        <?php if(isset($_SESSION['success'])): ?>
                                        <div class="alert alert-success" role="alert">
                                            <?php echo $_SESSION['success'] ; unset($_SESSION['success']);?>
                                        </div>
                                        <?php endif ?>  
                                        <?php if(isset($_SESSION['error'])): ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php echo $_SESSION['error'] ; unset($_SESSION['error']);?>
                                        </div>
                                        <?php endif ?>                           
                                                <label for="" class="col-md-2 control-label"> Mật khẩu cũ</label>
                                                <div class="col-md-8">
                                                    <input type="password" readonly="" name="user" value="<?php echo $EditUser['password'] ?>" class="form-control">                                                                                                  
                                                </div>                                               
                                        </div>
                                        <div class="form-group">                    
                                                <label for="" class="col-md-2 control-label"> Mật khẩu mới</label>
                                                <div class="col-md-8">
                                                    <input type="password" name="password" placeholder="********" class="form-control">
                                                    <?php if(isset($erorr['password'])): ?>
                                                        <p class="text-danger"> <?php echo $erorr['password'] ?> </p>
                                                    <?php endif ?>
                                                </div>                                       
                                        </div>

                                        <div class="form-group">                    
                                                <label for="" class="col-md-2 control-label"> Xác nhận mật khẩu mới</label>
                                                <div class="col-md-8">
                                                    <input type="password" name="re_password" placeholder="********" class="form-control">
                                                    <?php if(isset($erorr['re_password'])): ?>
                                                        <p class="text-danger"> <?php echo $erorr['re_password'] ?> </p>
                                                    <?php endif ?>
                                                </div>                                       
                                        </div>
                                                                                                
                                    <button class="btn btn-success col-md-2 col-md-offset-4" name="btn_pass" type="submit">Submit</button>

                                </form>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
            </div>
<?php include "../layouts/footer.php" ?>        