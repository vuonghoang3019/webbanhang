<?php
    include "../../autoload/autoload.php";
    $categories = $db->fetchAll("categories");
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $data = [
            "name" => postInput('name'),
            "slug" => to_slug(postInput('name')),
            "category_id" => postInput('category_id'),
            "price" => postInput("price"),
            "sale" => postInput("sale"),
            "content" => postInput("content"),
            "number" => postInput("number")
        ];
        $erorr = [];
        if(postInput('name') == '')
        {
            $erorr['name'] = "Mời bạn nhập đầy đủ tên sản phẩm";
        }
        if(postInput('category_id') == '')
        {
            $erorr['category_id'] = "Mời bạn chọn tên danh mục";
        }
        if(postInput('price') == '')
        {
            $erorr['price'] = "Mời bạn nhập giá sản phẩm";
        }
        if(postInput('content') == '')
        {
            $erorr['content'] = "Mời bạn nhập nội dung";
        }
        if(postInput('number') == '')
        {
            $erorr['number'] = "Mời bạn nhập số lượng sản phẩm";
        }
        if(!isset($_FILES['img']))
        {
            $erorr['img'] = "Mời bạn chọn hình ảnh";
        }   

        if(empty($erorr))
        {
           if(isset($_FILES['img']))
           {
                $file_name = $_FILES['img']['name'];
                $file_tmp = $_FILES['img']['tmp_name'];
                $file_type = $_FILES['img']['type'];
                $file_error = $_FILES['img']['error'];
                if($file_error == 0)
                {
                    $part = "../../../uploads/products/";
                    $data['img'] = $file_name;
                }
           }         
           $id_insert = $db->insert("products",$data);
           
           if($id_insert)
           {
                $movefile = move_uploaded_file($file_tmp,$part.$file_name);
                $_SESSION['success'] = "Thêm mới thành công";
                redirectAdmin("products");          
           }
           else
           {
                $_SESSION['error'] = "Thêm mới thất bại";
           }

        } 
    }


?>
<?php include ("../../layout/header.php");   ?>
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Thêm sản phẩm
                            </h1>                           
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                            
                        </div>
                        <!-- CONTENT TABLE -->
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                                    
                                <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Danh mục sản phẩm</label>
                                        <div class="col-sm-8">
                                            <select name="category_id" id="category_id" class="form-control col-md-8">
                                                <option value="">---Mời bạn chọn danh mục hiển thị---</option>
                                                <?php foreach($categories as $item): ?>
                                                    <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <?php
                                                if(isset($erorr['category_id'])):
                                            ?>
                                            <p class="text-danger"><?php echo $erorr['category_id'] ?></p>                                          
                                            <?php
                                            endif
                                            ?>                                           
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Tên sản phẩm</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="name" placeholder="Tên sản phẩm " name="name">
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
                                            <input type="number" class="form-control" id="price" placeholder="Giá sản phẩm " name="price">
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
                                        <label for="inputEmail3" class="col-sm-2 control-label">Số lượng sản phẩm</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="number" placeholder="100" name="number">
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
                                        <label for="inputEmail3" class="col-sm-2 control-label">Sale</label>
                                        <div class="col-sm-3">
                                            <input type="number" class="form-control" placeholder="Sale" id="sale" name="sale">                                                                   
                                        </div>
                                        <br>              
                                        <label for="inputEmail3" class="col-sm-2 control-label">Hình Ảnh</label>
                                        <div class="col-sm-3">
                                            <input type="file" class="form-control" id="img" name="img">  
                                            <?php
                                                if(isset($erorr['img'])):
                                            ?>
                                            <p class="text-danger"><?php echo $erorr['img'] ?></p>                                   
                                            <?php
                                            endif
                                            ?>                                                                    
                                        </div>
                                    </div>   
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Nội dung</label>
                                        <div class="col-sm-8">
                                            <textarea name="content" id="" cols="30" rows="4" class="form-control"></textarea>
                                            <?php
                                                if(isset($erorr['content'])):
                                            ?>
                                            <p class="text-danger"><?php echo $erorr['content'] ?></p>                                   
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
<?php include "../../layout/footer.php";  ?>