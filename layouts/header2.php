<!DOCTYPE html>
<html>
   <head>
      <title>Web Bán Hàng</title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="../css_layout/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="../css_layout/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../css_layout/css/slick.css"/>
      <link rel="stylesheet" type="text/css" href="../css_layout/css/slick-theme.css"/>
      <!--slide-->
      <link rel="stylesheet" type="text/css" href="../css_layout/css/style.css">
      <link rel="stylesheet" type="text/css" href="../css_layout/css/slide.css">

   </head>
   <body>
      <div id="wrapper">
         <!---->
         <!--HEADER-->
         <div id="header">
            <div id="header-top">
               <div class="container">
                  <div class="row clearfix">
                     <div class="col-md-6" id="header-text">
                        <a>SHOP</a><b>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </b>
                     </div>
                     <div class="col-md-6">
                        <nav id="header-nav-top">
                           <ul class="list-inline pull-right" id="headermenu">
                              <?php if(isset($_SESSION['name_user'])): ?>
                                 <li>Xin chào <?php echo $_SESSION['name_user'] ?></li>
                                 <li>
                                    <a href="user-info.php?id=<?php echo $_SESSION['name_id'] ?>"><i class="fa fa-user"></i> My Account <i class="fa fa-caret-down"></i></a>
                                    <ul id="header-submenu">
                                       <li><a href="">Contact</a></li>
                                       <li><a href="cart.php">Cart</a></li>
                                       <li><a href="out.php"><i class="fa fa-share-square-o"></i>Checkout</a></li>
                                    </ul>
                                 </li>
                              <?php else:  ?>
                                 <li>
                                 <a href="login1.php"><i class="fa fa-unlock"></i>Login</a>
                                 </li>
                                 <li>
                                    <a href="sign-in.php"><i class="fa fa-unlock"></i>Sign-in</a>
                                 </li>
                              <?php endif ?>
                           
                          
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
            <div class="container">
               <div class="row" id="header-main">
                  <div class="col-md-5">
                     <form class="form-inline">
                        <div class="form-group">
                           <label>
                              <select name="category" class="form-control">
                                 <option> All Category</option>
                                 <option> Dell </option>
                                 <option> Hp </option>
                                 <option> Asuc </option>
                                 <option> Apper </option>
                              </select>
                           </label>
                           <input type="text" name="keywork" placeholder=" input keywork" class="form-control">
                           <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                     </form>
                  </div>
                  <div class="col-md-4">
                     <a href="">
                     <img src="../css_layout/images/logo-default.png" style="width:161px">
                     </a>
                  </div>
                  <div class="col-md-3" id="header-right">
                     <div class="pull-right">
                        <div class="pull-left">
                           <i class="glyphicon glyphicon-phone-alt"></i>
                        </div>
                        <div class="pull-right">
                           <p id="hotline">HOTLINE</p>
                           <p>0328741074</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--END HEADER-->
         <!--MENUNAV-->
         <div id="menunav">
            <div class="container">
               <nav>
                  <div class="home pull-left">
                     <a href="index.php">Trang chủ</a>
                  </div>
                  <!--menu main-->
                  <ul id="menu-main">
                     <li>
                        <a href="shop.php">Shop</a>
                     </li>

                     <li>
                        <a href="">Contact</a>
                     </li>
                     <li>
                        <a href="about.php">About us</a>
                     </li>
                  </ul>
                  
                 
                  <!-- end menu main-->
                  <!--Shopping-->
                  <ul class="pull-right" id="main-shopping">
                     <li>
                        <a href="cart.php"><i class="fa fa-shopping-basket"></i> My Cart </a>
                     </li>
                  </ul>
                  <!--end Shopping-->
               </nav>
            </div>
         </div>
         <!--ENDMENUNAV-->
         <div id="maincontent">
            <div class="container">
               <div class="col-md-2" >
           
                            
     
               </div>