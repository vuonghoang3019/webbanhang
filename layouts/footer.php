<div class="container">
               <div class="col-md-4 bottom-content">
                  <a href=""><img src="../css_layout/images/free-shipping.png"></a>
               </div>
               <div class="col-md-4 bottom-content">
                  <a href=""><img src="../css_layout/images/guaranteed.png"></a>
               </div>
               <div class="col-md-4 bottom-content">
                  <a href=""><img src="../css_layout/images/deal.png"></a>
               </div>
            </div>
            <div class="container-pluid">
               <section id="footer">
                  <div class="container">
                     <div class="col-md-3" id="shareicon">
                        <ul>
                           <li>
                              <a href=""><i class="fa fa-facebook"></i></a>
                           </li>
                           <li>
                              <a href=""><i class="fa fa-twitter"></i></a>
                           </li>
                           <li>
                              <a href=""><i class="fa fa-google-plus"></i></a>
                           </li>
                           <li>
                              <a href=""><i class="fa fa-youtube"></i></a>
                           </li>
                        </ul>
                     </div>
                     <div class="col-md-8" id="title-block">
                        <div class="pull-left">
                        </div>
                        <div class="pull-right">
                        </div>
                     </div>
                  </div>
               </section>
               <section id="footer-button">
                  <div class="container-pluid">
                     <div class="container">
                        <div class="col-md-3" id="ft-about">
                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                              quis nostrud exercitation ullamco 
                           </p>
                        </div>
                        <div class="col-md-3 box-footer" >
                           <h3 class="tittle-footer">my accout</h3>
                           <ul>
                              <li>
                                 <i class="fa fa-angle-double-right"></i>
                                 <a href=""><i></i> Giới thiệu</a>
                              </li>
                              <li>
                                 <i class="fa fa-angle-double-right"></i>
                                 <a href=""><i></i> Liên hệ </a>
                              </li>
                              <li>
                                 <i class="fa fa-angle-double-right"></i>
                                 <a href=""><i></i>  Contact </a>
                              </li>
                              <li>
                                 <i class="fa fa-angle-double-right"></i>
                                 <a href=""><i></i> My Account</a>
                              </li>
                              <li>
                                 <i class="fa fa-angle-double-right"></i>
                                 <a href=""><i></i> Giới thiệu</a>
                              </li>
                           </ul>
                        </div>
                        <div class="col-md-3 box-footer">
                           <h3 class="tittle-footer">my accout</h3>
                           <ul>
                              <li>
                                 <i class="fa fa-angle-double-right"></i>
                                 <a href=""><i></i> Giới thiệu</a>
                              </li>
                              <li>
                                 <i class="fa fa-angle-double-right"></i>
                                 <a href=""><i></i> Liên hệ </a>
                              </li>
                              <li>
                                 <i class="fa fa-angle-double-right"></i>
                                 <a href=""><i></i>  Contact </a>
                              </li>
                              <li>
                                 <i class="fa fa-angle-double-right"></i>
                                 <a href=""><i></i> My Account</a>
                              </li>
                              <li>
                                 <i class="fa fa-angle-double-right"></i>
                                 <a href=""><i></i> Giới thiệu</a>
                              </li>
                           </ul>
                        </div>
                        <div class="col-md-3" id="footer-support">
                           <h3 class="tittle-footer"> Liên hệ</h3>
                           <ul>
                              <li>
                                 <p><i class="fa fa-home" style="font-size: 16px;padding-right: 5px;"></i> Trường ĐH Hạ Long </p>
                                 <p><i class="sp-ic fa fa-mobile" style="font-size: 22px;padding-right: 5px;"></i> 0328741074</p>
                                 <p><i class="sp-ic fa fa-envelope" style="font-size: 13px;padding-right: 5px;"></i> vuongmau199@gmail.com</p>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </section>
               <section id="ft-bottom">
                  <p class="text-center">Hoàng Vương </p>
               </section>
            </div>
         </div>
      </div>
      </div>      
      </div>
      <script  src="../css_layout/js/slick.min.js"></script>
      <script  src="../css_layout/js/jquery-3.2.1.min.js"></script>
      <script  src="../css_layout/js/bootstrap.min.js"></script>
   </body>
</html>
<script type="text/javascript">
   $(function() {
       $hidenitem = $(".hidenitem");
       $itemproduct = $(".item-product");
       $itemproduct.hover(function(){
           $(this).children(".hidenitem").show(100);
       },function(){
           $hidenitem.hide(500);
       })
   })
   $(function(){
      $updatecart = $(".updatecart");
      $updatecart.click(function(e){
         e.preventDefault();
         $number = $(this).parents("tr").find(".number").val();
         $key = $(this).attr("data-key");
         $.ajax(
            {
               url: 'updatecart.php',
               type:'GET',
               data: {'number':$number,'key':$key},
               success:function(data)
               {
                  if(data==1)
                  {
                     alert("Cập nhật giỏ hàng thành công");
                     location.href='cart.php';
                  }
               }
            }
         );


      }
      
      )

   }
   
   
   )

</script>
