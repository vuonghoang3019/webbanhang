<?php
    include "Classes/PHPExcel.php";
    include "../autoload/autoload.php";
    $conn = mysqli_connect("localhost","root","","webbanhang") or die ();
    mysqli_set_charset($conn ,"utf8");
    if(isset($_POST['btn-export']))
    {
        $excel = new PHPExcel();
        $excel -> setActiveSheetIndex(0);
        $sheet = $excel->getActiveSheet()->setTitle('Sheet1');
        $rowCount = 1;
        $sheet -> setCellValue('A'.$rowCount,'name');
        $sheet -> setCellValue('B'.$rowCount,'address');
        $sheet -> setCellValue('C'.$rowCount,'email');
        $sheet -> setCellValue('D'.$rowCount,'phone');
        $sheet -> setCellValue('E'.$rowCount,'status');
        $sheet -> setCellValue('F'.$rowCount,'level');
        $sheet -> getColumnDimension("A") -> setAutoSize(true);
        $sheet -> getColumnDimension("B") -> setAutoSize(true);
        $sheet -> getStyle('A1:F1') -> getAlignment() -> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet -> getStyle('A1:F1') -> getFill() -> setFillType(\PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setARGB('00ffff00');
        $sql_admin = "SELECT * FROM admin";
        $result = mysqli_query($conn ,$sql_admin) or die("Lỗi  truy vấn sql " .mysqli_error($conn));
        $data = [];
        if($result)
        {
            while ($num = mysqli_fetch_array($result))
            {
                $data[] = $num;
                $rowCount++;
                $sheet -> setCellValue('A'.$rowCount,$num['name']);
                $sheet -> setCellValue('B'.$rowCount,$num['address']);
                $sheet -> setCellValue('C'.$rowCount,$num['email']);
                $sheet -> setCellValue('D'.$rowCount,$num['phone']);
                $sheet -> setCellValue('E'.$rowCount,$num['status']);
                $sheet -> setCellValue('F'.$rowCount,$num['level']);
                

            }
        }
        $sheet -> setCellValue('E'.($rowCount+1),"=SUM(E2:E$rowCount)/COUNT(E2:E$rowCount)");
        $sheet -> setCellValue('A'.($rowCount+1),"Điểm trung bình: ");
        $sheet -> getStyle('A'.($rowCount+1)) -> getFont() -> setBold(true);
        $styleArray = array(
            'borders'=> array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $sheet -> getStyle('A1:' .'F'.($rowCount+1))->applyFromArray($styleArray);
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data</title>
</head>
<body>
    <form action="" method="POST">
    <button type="submit" name="btn-export">Export</button>
    </form>
</body>
</html>