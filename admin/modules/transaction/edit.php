<?php include "../../autoload/autoload.php";
    $id = intval(getInputedit('id'));
    $EditProduct = $db -> fetchID("transactions",$id);

    if(empty($EditProduct))
    {
        $_SESSION['error'] = "Dữ liệu ko tồn tại";
        redirectAdmin("transantion");
    }

?>
<?php include "../../layout/header.php";?>
<div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">SỬA ĐƠN HÀNG
                            </h1>                           
                            
                        </div>
                        <!-- CONTENT TABLE -->
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                                    
                                <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Danh mục sản phẩm</label>
                                        <div class="col-sm-8">
                                            <select name="category_id"  class="form-control col-md-8">
                                                <option value="">---Mời bạn chọn danh mục hiển thị---</option>
                                                <?php foreach($categories as $item): ?>
                                                    <option value="<?php echo $item['id'] ?>"<?php echo $EditProduct['category_id'] == $item['id'] ? "selected = 'selected'" : '' ?>><?php echo $item['name'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <?php
                                                if(isset($erorr['category'])):
                                            ?>
                                            <p class="text-danger"><?php echo $erorr['category'] ?></p>                                          
                                            <?php
                                            endif
                                            ?>                                           
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Tên sản phẩm</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="name" placeholder="Tên sản phẩm " name="name" value="<?php echo $EditProduct['name'] ?>">
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
                                        <label for="inputEmail3" class="col-sm-2 control-label">giá sản phẩm</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="price" placeholder="Giá sản phẩm " name="price" value="<?php echo $EditProduct['price'] ?>">
                                            <?php
                                                if(isset($erorr['price'])):
                                            ?>
                                            <p class="text-danger"><?php echo $erorr['price'] ?></p>                                   
                                            <?php
                                            endif
                                            ?>                                           
                                        </div>
                                    </div>  

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Số lượng</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="price" placeholder="Giá sản phẩm " name="number" value="<?php echo $EditProduct['number'] ?>">
                                            <?php
                                                if(isset($erorr['number'])):
                                            ?>
                                            <p class="text-danger"><?php echo $erorr['number'] ?></p>                                   
                                            <?php
                                            endif
                                            ?>                                           
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



<?php include "../../layout/footer.php"; ?>