<?php
    include "../../autoload/autoload.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $data = [
            "title" => postInput('title'),
            "content" => postInput('content'),
            "img" => postInput("img")
        ];
        $erorr = [];
        if(postInput('title') == '')
        {
            $erorr['title'] = "Mời bạn nhập tên tài khoản";
        }
        if(postInput('content') == '')
        {
            $erorr['content'] = "Mời bạn nhập tên tài khoản";
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
                    $part = "../../../uploads/about/";
                    $data['img'] = $file_name;
                }
           }         
           $id_insert = $db->insert("about",$data);
           
           if($id_insert)
           {
                $movefile = move_uploaded_file($file_tmp,$part.$file_name);
                $_SESSION['success'] = "Thêm mới thành công";
                redirectAdmin("about");          
           }
           else
           {
                $_SESSION['error'] = "Thêm mới thất bại";
                redirectAdmin("about");         
           }

        } 
    }
?>
<?php include ("../../layout/header.php");   ?>
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Thêm mới bài giới thiệu
                            </h1>                           
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                            
                        </div>
                        <!-- CONTENT TABLE -->
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                                    
         
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="title" placeholder="Tiêu đề" name="title" >
                                            <?php
                                                if(isset($erorr['title'])):
                                            ?>
                                            <p class="text-danger"><?php echo $erorr['title'] ?></p>                                          
                                            <?php
                                            endif
                                            ?>                                           
                                        </div>
                                    </div>    

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Nội dung</label>
                                        <div class="col-sm-8">
                                            <textarea name="content" id="content" cols="30" placeholder="Viết nội dung tại đây" class="form-control" rows="5"></textarea>
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
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-success">Lưu</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>                 
                    </div>
<?php include "../../layout/footer.php";  ?>