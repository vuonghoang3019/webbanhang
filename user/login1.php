<?php include "../autoload/autoload.php";  
    if($_SERVER['REQUEST_METHOD'] == "POST")   
    {
        $data = [
            "user" => postInput('user'),
            "password" => postInput("password"),
        ];
        $error = [];
        if(postInput('user') == '')
        {
            $erorr['user'] = "Mời bạn nhập tên tài khoản";
        }
        if(postInput('password') == '')
        {
            $erorr['password'] = "Mời bạn nhập Password";
        }
        if(empty($erorr))
        {
            
            $check = $db -> fetchOne("users","user = '".$data['user']."'AND password = '".md5($data['password'])."'");
            if($check != NULL)
            {
                $_SESSION['name_user'] = $check['user'];
                $_SESSION['name_id'] = $check['id'];
                echo "<script>alert('Đăng nhập thành công');location.href='index.php' ;</script>'"; 
            }
            else
            {
                $_SESSION['error'] = 'Mật khẩu và tài khoản không đúng';
            }
        }
        
    }

?>
<?php include "../layouts/header.php" ?>
               <div class="col-md-9 bor">
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
                                                                                
                    <button class="btn btn-success col-md-2 col-md-offset-4" type="submit">Submit</button>

                   </form>
                  </section>
               </div>
            </div>
<?php include "../layouts/footer.php" ?>        