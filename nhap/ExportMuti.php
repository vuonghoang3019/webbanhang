<?php 
    include "Classes/PHPExcel.php";
    include "../autoload/autoload.php";
    $conn = mysqli_connect("localhost","root","","webbanhang") or die ();
    mysqli_set_charset($conn ,"utf8");
    if(isset($_POST['submit']))
    {
        $excel = new PHPExcel();
        $numSheet = 0;
        $sql_product = "SELECT * FROM categories";
        $result = mysqli_query($conn ,$sql_product) or die("Lỗi  truy vấn sql " .mysqli_error($conn));
        $data = [];
        $data1 = [];
        if($result)
        {
            
            while ($num = mysqli_fetch_assoc($result))
            {
                $data[] = $num;
                $excel -> createSheet();
                $excel -> setActiveSheetIndex($numSheet);
                $sheet = $excel -> getActiveSheet() -> setTitle($num['name']);
                $numRow = 1;
                $sheet->setCellValue("A$numRow",'Tên');
                $sheet->setCellValue("B$numRow",'Giá');
                $sheet->setCellValue("C$numRow",'Giảm giá');
                $sheet->setCellValue("D$numRow",'Pay');
                $sql_product1 = "SELECT name,price,sale,pay FROM products WHERE category_id = $num[id]";
                $result = mysqli_query($conn ,$sql_product1) or die("Lỗi  truy vấn sql " .mysqli_error($conn));
                while ($num1 = mysqli_fetch_assoc($result))
                {
                    $data1[] = $num1;
                    $numRow++;
                    $sheet->setCellValue("A$numRow",$num1['name']);
                    $sheet->setCellValue("B$numRow",$num1['price']);
                    $sheet->setCellValue("C$numRow",$num1['sale']);
                    $sheet->setCellValue("D$numRow",$num1['pay']);
                }
            $numSheet++; 
                

            }
        }
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
    <title>ExportMutiSheet</title>
</head>
<body>
    <form action="" method="POST">
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>