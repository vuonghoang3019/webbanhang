<?php
    include "../../autoload/autoload.php";
    $id = intval(getInputedit('id'));
    $EditAdmin = $db -> fetchID("admin",$id);
    if(empty($EditAdmin))
    {
        $_SESSION['error'] = "Dữ liệu ko tồn tại";
        redirectAdmin("admin");
    }
    $admin = $db->fetchAll("admin");
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $data = [
            "name" => postInput('name'),
            "address" => postInput('address'),
            "email" => postInput('email'),
            "password" => md5(postInput("password")),
            "phone" => postInput("phone"),
            "level" => postInput("level")
        ];
        $erorr = [];
        if(postInput('name') == '')
        {
            $erorr['name'] = "Mời bạn nhập tên tài khoản";
        }
        if(postInput('address') == '')
        {
            $erorr['address'] = "Mời bạn nhập địa chỉ";
        }
        if(postInput("password") != NULL && postInput("re_password") != NULL)
        {
            if(postInput("password") != postInput("re_password"))
            {
                $erorr['re_password'] = "Mật khẩu bạn nhập không trùng khớp";
            }
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
                    $part = "../../../uploads/admin/";
                    $data['avatar'] = $file_name;
                }
           }  
           else
           {
                $file_name = $EditAdmin['avatar'] ;
           }
           $id_update = $db->update("admin",$data,array("id"=>$id));
           
           if($id_update > 0)
           {
                $movefile = move_uploaded_file($file_tmp,$part.$file_name);
                $_SESSION['success'] = "Cập nhật thành công";
                redirectAdmin("admin");          
           }
           else
           {
                $_SESSION['error'] = "Cập nhật thất bại";
           }         
        } 
       
    }
    


?>
<?php include ("../../layout/header.php");   ?>
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Thêm tài khoản quản trị
                            </h1>                           
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                            
                        </div>
                        <!-- CONTENT TABLE -->
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                                    
         
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Tên tài khoản</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="name" placeholder="Tên tài khoản" name="name" value="<?php echo $EditAdmin['name'] ?>" >
                                            <?php
                                                if(isset($erorr['name'])):
                                            ?>
                                            <p class="text-danger"><?php echo $erorr['name'] ?></p>                                          
                                            <?php
                                            endif
                                            ?>                                           
                                        </div>
                                    </div>    

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" id="password" placeholder="*******" name="password"   >
                                            <?php
                                                if(isset($erorr['password'])):
                                            ?>
                                            <p class="text-danger"><?php echo $erorr['password'] ?></p>                                   
                                            <?php
                                            endif
                                            ?>                                           
                                        </div>
                                    </div>  

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Confirm Password</label>
                                        <div class="col-sm-8">
                                            <input type="password"  placeholder="*******" class="form-control" id="re_password" name="re_password" >
                                            <?php
                                                if(isset($erorr['re_password'])):
                                            ?>
                                            <p class="text-danger"><?php echo $erorr['re_password'] ?></p>                                   
                                            <?php
                                            endif
                                            ?>                                           
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Địa chỉ</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="address" placeholder="Địa chỉ" name="address" value="<?php echo $EditAdmin['address'] ?>" >
                                            <?php
                                                if(isset($erorr['address'])):
                                            ?>
                                            <p class="text-danger"><?php echo $erorr['address'] ?></p>                                   
                                            <?php
                                            endif
                                            ?>                                           
                                        </div>
                                    </div>

                                    <div class="form-group">                                  
                                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="abc@gmail.com" required="Email" value="<?php echo $EditAdmin['email'] ?>">  
                                            <?php
                                                if(isset($erorr['email'])):
                                            ?>
                                            <p class="text-danger"><?php echo $erorr['email'] ?></p>                                   
                                            <?php
                                            endif
                                            ?>                                                                    
                                        </div>
                                    </div> 

                                    <div class="form-group">                                  
                                        <label for="inputEmail3" class="col-sm-2 control-label">Số điện thoại</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="phone" name="phone" placeholder="0123456789" value="<?php echo $EditAdmin['phone'] ?>">  
                                            <?php
                                                if(isset($erorr['phone'])):
                                            ?>
                                            <p class="text-danger"><?php echo $erorr['phone'] ?></p>                                   
                                            <?php
                                            endif
                                            ?>                                                                    
                                        </div>
                                    </div> 

                                    <div class="form-group">                                  
                                        <label for="inputEmail3" class="col-sm-2 control-label">Quyền</label>
                                        <div class="col-sm-8">
                                            <select name="level" id="" class="form-control" value="<?php echo $EditAdmin['level']?>">
                                                <option value="1">Admin</option>
                                                <option value="2">NHân viên</option>
                                                <option value="3"> Khách hàng </option>                                          
                                            </select> 
                                            <?php
                                                if(isset($erorr['level'])):
                                            ?>
                                            <p class="text-danger"><?php echo $erorr['level'] ?></p>                                   
                                            <?php
                                            endif
                                            ?>                                                                    
                                        </div>
                                    </div> 

                                    <div class="form-group">                                  
                                        <label for="inputEmail3" class="col-sm-2 control-label">Hình Ảnh</label>
                                        <div class="col-sm-3">
                                            <input type="file" class="form-control" id="avatar" name="avatar" value="<?php echo $EditAdmin['avatar'] ?>">                                                  
                                            <?php
                                                if(isset($erorr['avatar'])):
                                            ?>
                                            <p class="text-danger"><?php echo $erorr['avatar'] ?></p>                                   
                                            <?php
                                            endif
                                            ?>                                                                                                         
                                        </div>                                       
                                        <label for="" class="col-md-2 control-label"> Ảnh </label>
                                        <div class="col-md-3">
                                            <img src="<?php echo upload() ?>/admin/<?php echo $EditAdmin['avatar'] ?>" alt="" height="100px" width="100px">                                                   
                                        </div>  
                                    </div>                                    
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-success">Lưu</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>                 
                    </div>
<?php include "../../layout/footer.php";  ?>