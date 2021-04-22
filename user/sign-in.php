<?php include "../autoload/autoload.php";  
    if(isset($_SESSION['name_id']))
    {
        echo "<script>alert('Bạn đã có tài khoản, không thể đăng ký');location.href='index.php' ;</script>'"; 
    }
    if($_SERVER['REQUEST_METHOD'] == "POST")   
    {
        $data = [
            "user" => postInput('user'),
            "address" => postInput('address'),
            "email" => postInput('email'),
            "password" => md5(postInput("password")),
            "phone" => postInput("phone"),
            "avatar" => postInput("avatar"),
            "name" => postInput("name")
        ];
        $error = [];
        if(postInput('user') == '')
        {
            $erorr['user'] = "Mời bạn nhập tên tài khoản";
        }
        else
        {
            $check_user = $db->fetchOne("users","user = '".$data['user']."' ");
            if($check_user != null)
            {
                $erorr['user'] = "Tài khoản đã bị trùng, mời bạn sử dụng tài khoản khác";
            }
        }
        if(postInput('address') == '')
        {
            $erorr['address'] = "Mời bạn nhập địa chỉ";
        } 
        if(postInput('name') == '')
        {
            $erorr['name'] = "Mời bạn nhập địa chỉ";
        }
        if(postInput('password') == '')
        {
            $erorr['password'] = "Mời bạn nhập Password";
        }
        if(postInput("password") != postInput("re_password"))
        {
            $erorr['re_password'] = "Mật khẩu bạn nhập không trùng khớp";
        }
        if(postInput('phone') == '')
        {
            $erorr['phone'] = "Mời bạn nhập số điện thoại";
        }
        if(postInput('email') == '')
        {
            $erorr['email'] = "Mời bạn nhập Email";
        }
        else
        {
            $check = $db->fetchOne("users", " email = '".$data['email']."' ");
            if($check != null)
            {
                $erorr['email'] = "Email bạn nhập đã tồn tại";
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
           $id_insert = $db->insert("users",$data); 
           if($id_insert)
           {
                $movefile = move_uploaded_file($file_tmp,$part.$file_name);
                $_SESSION['success'] = "Đăng ký tài khoản thành công";    
                header("location: login1.php");   
           }
           else
           {
                $_SESSION['error'] = "Đăng ký tài khoản thất bại";
           }
        } 
    }

?>
<?php include "../layouts/header.php" ?>
               <div class="col-md-9 bor">
                  <section class="box-main1">
                   <form action="" class="form-horizontal" role="form" method="POST" style="margin-top:20px" enctype="multipart/form-data">
                        <div class="form-group">                           
                                <label for="" class="col-md-2 control-label"> Tài khoản</label>
                                <div class="col-md-8">
                                    <input type="text" name="user" placeholder="vuong" class="form-control">
                                    <?php if(isset($erorr['user'])): ?>
                                        <p class="text-danger"><?php echo $erorr['user'] ?></p>
                                    <?php endif ?>
                                    
                                </div>
                                
                        </div>
                        <div class="form-group">                    
                                <label for="" class="col-md-2 control-label"> Pass</label>
                                <div class="col-md-8">
                                    <input type="password" name="password" placeholder="********" class="form-control">
                                    <?php if(isset($erorr['password'])): ?>
                                        <p class="text-danger"> <?php echo $erorr['password'] ?> </p>
                                    <?php endif ?>
                                </div>
                                
                        </div>
                        <div class="form-group">                      
                           <label for="" class="col-md-2 control-label"> Nhập lại pass</label>
                           <div class="col-md-8">
                               <input type="password" name="re_password" placeholder="********" class="form-control">
                               <?php if(isset($erorr['re_password'])): ?>
                                <p class="text-danger"><?php echo $erorr['re_password'] ?></p>
                                <?php endif ?>
                           </div>                          
                        </div>
                        <div class="form-group">                      
                           <label for="" class="col-md-2 control-label"> Nhập Họ Tên</label>
                           <div class="col-md-8">
                               <input type="text" name="name" placeholder="Hoàng Vương" class="form-control">
                               <?php if(isset($erorr['name'])): ?>
                                <p class="text-danger"><?php echo $erorr['name'] ?></p>
                                <?php endif ?>
                           </div>                          
                        </div>
                        <div class="form-group">                         
                        <label for="" class="col-md-2 control-label"> Email</label>
                        <div class="col-md-8">
                            <input type="text" name="email" placeholder="abc@gmail.com" class="form-control" required="email" >
                            <?php if(isset($erorr['email'])): ?>
                                <p class="text-danger"><?php echo $erorr['email'] ?></p>
                            <?php endif ?>
                        </div>                
                        </div>
                        <div class="form-group">                         
                        <label for="" class="col-md-2 control-label"> Số điện thoại</label>
                        <div class="col-md-8">
                            <input type="number" name="phone" placeholder="0123456789" class="form-control">
                            <?php if(isset($erorr['phone'])): ?>
                                <p class="text-danger"><?php echo $erorr['phone'] ?></p>
                            <?php endif ?>
                        </div>                
                        </div>
                        <div class="form-group">                         
                        <label for="" class="col-md-2 control-label"> Địa chỉ</label>
                        <div class="col-md-8">
                            <input type="text" name="address" placeholder="Tổ 3 - khu 4 - Hà Đông - Hà Nội" class="form-control">
                            <?php if(isset($erorr['address'])): ?>
                                <p class="text-danger"><?php echo $erorr['address'] ?></p>
                            <?php endif ?>
                        </div>                
                        </div>
                        <div class="form-group">                         
                        <label for="" class="col-md-2 control-label"> Ảnh</label>
                        <div class="col-md-8">
                            <input type="file" name="avatar" class="form-control">
                        </div>                
                        </div>
                    <button class="btn btn-success col-md-2 col-md-offset-4" type="submit">Submit</button>

                   </form>
                  </section>
               </div>
            </div>
<?php include "../layouts/footer.php" ?>        