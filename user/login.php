<?php include "../autoload/autoload.php";  
    if($_SERVER['REQUEST_METHOD'] == "POST")   
    {
        $data = [
            "name" => postInput('name'),
            "password" => postInput("password"),
        ];
        $error = [];
        if(postInput('name') == '')
        {
            $erorr['name'] = "Mời bạn nhập tên tài khoản";
        }
        if(postInput('password') == '')
        {
            $erorr['password'] = "Mời bạn nhập Password";
        }
        if(empty($erorr))
        {
            
            $check = $db -> fetchOne("admin","name = '".$data['name']."'AND password = '".md5($data['password'])."'");
            if($check != NULL)
            {
				$_SESSION['name_admin'] = $check['name'];
				$_SESSION['avatar_admin'] = $check['avatar'];
				$_SESSION['name_id1'] = $check['id'];
				$_SESSION['level'] = $check['level'];
				
				if($_SESSION['level'] == 1 || $_SESSION['level'] == 2)
				{
					echo "<script>alert('Đăng nhập thành công');location.href='../admin/index.php' ;</script>'"; 
				}	
				else
				{
					$_SESSION['matb'] = 2;
					header("location: ../admin/thongbao.php");
				}
			
               
            }
            else
            {
                $_SESSION['error'] = 'Mật khẩu và tài khoản không đúng';
            }
        }
        
    }

?>

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<link href="../css_layout/css/login.css" rel="stylesheet" type="text/css" media="all"/>
	<link href="../css_layout/css/font-awesome.min.css" rel="stylesheet" type="text/css" >
	<link href="../css_layout/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
	
</head>
<body>
<div class="header">
		<div class="header-main">
		<div class="clearfix"></div>   
		<?php if(isset($_SESSION['success'])): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $_SESSION['success'] ; unset($_SESSION['success']);?>
				</div>
				<?php endif ?>  
				            
			   <h1>Login Now</h1>
			 
			<div class="header-bottom">
				<div class="header-right w3agile">					
					<div class="header-left-bottom agileinfo">						
					 <form action="" method="POST">
						<input type="text"  name="name" placeholder="Username" />
						<?php if(isset($error['name'])): ?>
                            <p class="text-danger"><?php echo $error['name'] ?></p>
						<?php endif ?>			
						<input type="password"  name="password" placeholder="Password" />				
						<?php if(isset($error['password'])): ?>
							<p class="text-danger"><?php echo $error['password'] ?></p>
						<?php endif ?>
						<div class="remember">
			             <span class="checkbox1">
							    <label class="checkbox"><input type="checkbox" name="" checked=""><i> </i>Remember me</label>
						 </span>
						 <div class="forgot">
						 	<h6><a href="#">Forgot Password?</a></h6>
						 </div>
						<div class="clear"> </div>
					  </div>					   
						<button type="submit">login</button>
					</form>	
	
				</div>
				</div>			  
			</div>
		</div>
</div>
    <div class="copyright">
        <p>Hoàng Kế Vương - Viettel - Trường ĐH Hạ Long <a href="#" target="_blank">   </a></p>
    </div>
</body>
<script src="../css_layout/js/jquery-3.2.1.min.js"></script>
</html>