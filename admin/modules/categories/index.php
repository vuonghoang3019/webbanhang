<?php
     include "../../autoload/autoload.php";
    if(!isset($_SESSION['name_id1']))
    {
        $_SESSION['matb'] = 1;
        echo "<script>location.href='/backend/webbanhang/admin/thongbao.php' ;</script>";
    }
    $category = $db->fetchAll("categories");
    if(isset($_GET['page']))
    {
        $p = $_GET['page'];
    }
    else
    {
        $p = 1;
    }
    $sql = "SELECT * FROM categories";
     $category = $db->fetchJone('categories',$sql,$p,10,true);
     if(isset($category['page']))
     {
         $sotrang = $category['page'];
         unset($category['page']);
     }

?>
<?php include "../../layout/header.php" ?>                  
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Quản lý danh mục
                            <a href="add.php" class="btn btn-success">Thêm mới</a>
                            </h1>                                                                                
                       </div>
                        <!-- CONTENT TABLE -->
                        <div class="clearfix"></div>
                            <?php if(isset($_SESSION['success'])) :?>
                                <div class="alert alert-success">
                                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                                </div>
                            <?php endif; ?>
                            <?php if(isset($_SESSION['error'])) :?>
                                <div class="alert alert-danger">
                                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                                </div>
                            <?php endif; ?>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="dataTables_length" id="dataTable_length">
                                                    <label>
                                                        Show 
                                                        <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                                                            <option value="10">10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                        </select>
                                                        entries
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                                    <tbody>                         
                                                    <tr>
                                                            <th rowspan="1" colspan="1">STT</th>
                                                            <th rowspan="1" colspan="1">NAME</th>
                                                            <th rowspan="1" colspan="1">SLUG</th>
                                                            <th rowspan="1" colspan="1">HOME</th>
                                                            <th rowspan="1" colspan="1">Created</th>
                                                            <th rowspan="1" colspan="2">ACTION</th>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <?php 
                                                            $stt = 1;
                                                            foreach($category as $item):
                                                        ?> 
                                                        <tr role="row" class="even">
                                                                <td><?php echo $stt ?></td>
                                                                <td><?php echo $item['name'] ?></td>
                                                                <td><?php echo $item['slug'] ?></td>
                                                                <td>
                                                                    <a href="home.php?id=<?php echo $item['id'] ?>" class="btn btn-xs <?php echo $item['home'] == 1 ? 'btn-info': 'btn-secondary' ?> ">
                                                                    <?php echo $item['home'] == 1 ? 'Hiển thị' : 'Không' ?>
                                                                    </a>
                                                                </td>
                                                                <td><?php echo $item['created'] ?></td>
                                                                <td>
                                                                    <a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $item['id']; ?>"> <i class="fa fa-edit"></i> Sửa</a>                                                                   
                                                                </td>
                                                                <td>                                                                    
                                                                    <a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['id']; ?>"><i class="fa fa-times"></i> Xóa</a>
                                                                </td>
                                                            </tr>
                                                        <?php $stt++; endforeach ?>                                                    
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                  
                                    <div class="row" style="float:right">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination">
                                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                                <?php for($i =1 ; $i<=$sotrang ; $i++): ?>
                                                    <?php 
                                                        if(isset($_GET['page']))
                                                        {
                                                            $p = $_GET['page'];
                                                        }
                                                        else
                                                        {
                                                            $p = 1;
                                                        }
                                                    ?>
                                                    <?php endfor ?>
                                                    <li class="<?php echo ($p=$i) ? 'active':'' ?>">
                                                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                    </li>
                                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                            </ul>
                                            </nav>
                                    </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>  
           
<?php include "../../layout/footer.php" ?>