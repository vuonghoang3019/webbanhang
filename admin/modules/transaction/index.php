<?php
     include "../../autoload/autoload.php";
     include "../../Classes/PHPExcel.php";
     if(!isset($_SESSION['name_id1']))
     {
         $_SESSION['matb'] = 1;
         echo "<script>location.href='/backend/webbanhang/admin/thongbao.php' ;</script>";
     }
     else if($_SESSION['level'] != 1)
     {
         $_SESSION['matb'] = 2;
         header("location: ../../thongbao.php");
     }
     $transaction = $db->fetchAll("transactions");
    if(isset($_GET['page']))
    {
        $p = $_GET['page'];
    }
    else
    {
        $p = 1;
    }
    $sql = "SELECT  transactions.*,users.user as nameuser,users.phone as phone,users.email as email,users.address as address 
    FROM transactions LEFT JOIN users ON users.id = transactions.users_id ORDER BY id DESC";
    $transaction = $db->fetchJone('transactions',$sql,$p,5,true);
    if(isset($transaction['page']))
    {
        $sotrang = $transaction['page'];
        unset($transaction['page']);
    }
    $conn = mysqli_connect("localhost","root","","webbanhang") or die ();
    mysqli_set_charset($conn ,"utf8");
    if(isset($_POST['submit']))
    {
        $excel = new PHPExcel();
        $excel -> setActiveSheetIndex(0);
        $sheet = $excel->getActiveSheet()->setTitle('Sheet1');
        $rowCount = 1;
        $sheet -> setCellValue('A'.$rowCount,'username');
        $sheet -> setCellValue('B'.$rowCount,'productname');
        $sheet -> setCellValue('C'.$rowCount,'number');
        $sheet -> setCellValue('D'.$rowCount,'price');
        $sheet -> setCellValue('E'.$rowCount,'created_at');
        $sheet -> getColumnDimension("A") -> setAutoSize(true);
        $sheet -> getColumnDimension("B") -> setAutoSize(true);
        $sheet -> getColumnDimension("D") -> setAutoSize(true);
        $sheet -> getColumnDimension("E") -> setAutoSize(true);
        $sheet -> getStyle('A1:E1') -> getAlignment() -> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet -> getStyle('A1:E1') -> getFill() -> setFillType(\PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setARGB('00ffff00');
        $sql_admin = "SELECT orders.*,transactions.id,transactions.users_id,users.id,users.user as username,
        products.id,products.name as productname FROM orders
        JOIN transactions ON transactions.id = orders.transaction_id 
        JOIN products ON products.id = orders.product_id 
        JOIN users ON users.id = transactions.users_id ORDER BY transactions.id DESC";
        $result = mysqli_query($conn ,$sql_admin) or die("Lỗi  truy vấn sql " .mysqli_error($conn));
        $data = [];
        if($result)
        {
            while ($num = mysqli_fetch_array($result))
            {
                $data[] = $num;
                $rowCount++;
                $sheet -> setCellValue('A'.$rowCount,$num['username']);
                $sheet -> setCellValue('B'.$rowCount,$num['productname']);
                $sheet -> setCellValue('C'.$rowCount,$num['number']);
                $sheet -> setCellValue('D'.$rowCount,$num['price']);
                $sheet -> setCellValue('E'.$rowCount,$num['created_at']);
            }
        }
        // $sheet -> setCellValue('E'.($rowCount+1),"=SUM(E2:E$rowCount)/COUNT(E2:E$rowCount)");
        // $sheet -> setCellValue('A'.($rowCount+1),"Điểm trung bình: ");
        // $sheet -> getStyle('A'.($rowCount+1)) -> getFont() -> setBold(true);
        $styleArray = array(
            'borders'=> array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $sheet -> getStyle('A1:' .'E'.($rowCount))->applyFromArray($styleArray);
        $writer = new PHPExcel_Writer_Excel2007($excel);
        $file_name = 'data.xlsx';
        $writer->save($file_name);
        header('Content-Disposition: attachment; filename="'.$file_name.'"');
        header("Content-Type: application/vnd.openxmlformatsofficedoccument.spreadsheetml.sheet");
        header('Content-Length: '. filesize($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: no-cache');
        readfile($file_name);
        return;      
    }

    
?>
<?php include "../../layout/header.php" ?>                  
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Quản lý đơn hàng</h1>                       
                            <form action="" method="POST">
                            <button type="submit" name="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</button>
                            </form>                  
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
                                                <div id="dataTable_filter" class="dataTables_filter">
                                                    <label>Search:
                                                        <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable">
                                                        
                                                    </label>
                                                    <button class="btn btn-primary">Tìm kiếm</button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                                    <tbody>                         
                                                    <tr>
                                                            <th rowspan="1" colspan="1">STT</th>
                                                            <th rowspan="1" colspan="1">NAME</th>  
                                                            <th rowspan="1" colspan="1">GIÁ</th>  
                                                            <th rowspan="1" colspan="1">PHONE</th>
                                                            <th rowspan="1" colspan="1">EMAIL</th> 
                                                            <th rowspan="1" colspan="1">ADDRESS</th> 
                                                            <th rowspan="1" colspan="1">STATUS</th>                                                        
                                                            <th rowspan="1" colspan="2">ACTION</th>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <?php 
                                                            $stt = 1;
                                                            foreach($transaction as $item):
                                                        ?> 
                                                        <tr role="row" class="even">
                                                                <td><?php echo $stt ?></td>
                                                                <td><?php echo $item['nameuser'] ?></td>
                                                                <td><?php echo formatPrice($item['amout']) ?> Đ</td>
                                                                <td><?php echo ($item['phone']) ?> </td>                                                                
                                                                <td><?php echo $item['email'] ?> </td>
                                                                <td><?php echo $item['address'] ?> </td>
                                                                <td> 
                                                                <a href="status.php?id=<?php echo $item['id'] ?>" class="<?php echo $item['status'] == 0 ?'btn btn-danger' : 'btn btn-info' ?>"><?php echo $item['status'] == 0 ? 'Chưa xử lý' : 'Đã xử lý' ?></a>
                                                                </td>
                                                           
                                                                    <!-- <td>
                                                                        <a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $item['id']; ?>"> <i class="fa fa-edit"></i> Sửa</a>                                                                   
                                                                    </td> -->
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
                                                    <?php for($i = 1; $i <= $sotrang; $i++): ?>
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
                                                        <li class="<?php echo ($i==$p) ? 'active' :'' ?>">
                                                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                        </li>
                                                    <?php endfor ?>
                                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                </ul>
                                                </nav>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                    </div>  
<?php include "../../layout/footer.php" ?>