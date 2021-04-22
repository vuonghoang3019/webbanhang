<?php
    include "../../autoload/autoload.php";
    $id = intval(getInputedit('id'));
    $EditCategory = $db->fetchID("categories",$id);
    if(empty($EditCategory))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("categories");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $data = [
            "name" => postInput('name'),
            "slug" => to_slug(postInput('name'))
        ];
        $erorr = [];
        if(postInput('name') == '')
        {
            $erorr['name'] = "Mời bạn nhập đầy đủ tên danh mục";
        }
        if(empty($erorr))
        {
            // if($EditCategory['name'] != $data['name'])
            // {
                $check = $db->fetchOne("categories","name = '".$data['name']."' ");
                if(count($check))
                {
                    $_SESSION['error'] = "Tên danh mục đã tồn tại!";
                    redirectAdmin("categories");
                }
                else
                {
                    $id_update = $db->update("categories",$data,array("id"=>$id));
                    if($id_update > 0)
                    {
                        $_SESSION['success'] = "Cập nhật thành công";
                        redirectAdmin("categories");
                    }
                    else
                    {
                        $_SESSION['error'] = "Cập nhật thất bại";
                        redirectAdmin("categories");
                    }
                }
            // }
            // else
            // {
            //     $id_update = $db->update("categories",$data,array("id"=>$id));
            //         if($id_update > 0)
            //         {
            //             $_SESSION['success'] = "Cập nhật thành công";
            //             redirectAdmin("categories");
            //         }
            //         else
            //         {
            //             $_SESSION['error'] = "Cập nhật thất bại";
            //             redirectAdmin("categories");
            //         }
            // }
            
            
        }
        
        
    }
?>
<?php include "../../layout/header.php" ?>                  
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Thêm danh mục
                            </h1>
                            
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                            
                        </div>
                        <!-- CONTENT TABLE -->
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" action="" method="POST">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Tên danh mục</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="name" placeholder="Tên danh mục" name="name" value="<?php echo$EditCategory['name'] ?>">
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
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-success">Lưu</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                   
                    </div>
<?php include "../../layout/footer.php" ?>