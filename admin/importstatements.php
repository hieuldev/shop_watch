<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/cart.php';  ?>
<?php include '../classes/brand.php';  ?> 
<?php include '../classes/product.php';  ?>
<?php require_once '../helpers/format.php'; ?>
<?php require_once 'PHPExcel.php';?>

<?php
$date = getdate();
    $pd = new product();   
    if(isset($_GET['month']))
    {
        $month=$_GET['month'];
    }
else
{
    $month=$date['mon'];
}
//if(isset($_GET['btnExport']))
//{
//    
//    $objExcel=new PHPExcel();
//    $objExcel->setActiveSheetIndex(0);
//    $sheet=$objExcel->getActiveSheet()->setTitle('BÁO CÁO THỐNG KÊ NHẬP');
//    $rowCount=1;
//    $sheet->setCellValue('A'.$rowCount,'Code sản phẩm');
//    $sheet->setCellValue('B'.$rowCount,'Tên sản phẩm');
//    $sheet->setCellValue('C'.$rowCount,'Số lượng nhập');
//    $sheet->setCellValue('D'.$rowCount,'Đơn giá');
//    $sheet->setCellValue('E'.$rowCount,'Thành tiền');
//    $pdlist = $pd->importstatements($month);
//        if($pdlist){				
//            while ($result = $pdlist->fetch_array()){
//               $rowCount++;
//                  $sheet->setCellValue('A'.$rowCount,$result['product_code']);
//    $sheet->setCellValue('B'.$rowCount,$result['productName']);
//    $sheet->setCellValue('C'.$rowCount,$result['sl_nhap']);
//    $sheet->setCellValue('D'.$rowCount,$result['unit_price'] );
//    $sheet->setCellValue('E'.$rowCount,$result['unit_price']*$result['sl_nhap']);  
//            }}
//
//PHPExcel_IOFactory::createWriter($sheet, 'Excel2007')->save('data.xlsx');
//    
//	
//}
 ?> 

        <div class="grid_10">
            <div class="box round first grid">
                <h2>THỐNG KÊ NHẬP</h2>
                <form action="importstatements.php" >
                <lable >Chọn tháng   </lable>
                        <select id="select" name="month">
                            <option selected value=<?php echo $date['mon'];?>> <?php echo $date['mon'];?></option>
                            <option value=1> 1</option>
                            <option value=2> 2</option>
                            <option value=3> 3</option>
                            <option value=4> 4</option>
                            <option value=5> 5</option>
                            <option value=6> 6</option>
                            <option value=7> 7</option>
                            <option value=8> 8</option>
                            <option value=9> 9</option>
                            <option value=10> 10</option>
                            <option value=11> 11</option>
                            <option value=11> 12</option>
                        </select>
                    <input type="submit" value="Chọn">
                    <button name="btnExport">Xuất file</button>
                </form>

                <div class="block">       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
					<th>No.</th>
                    
					<th>Code sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th>Số lượng nhập</th>
					<th>Đơn giá</th>
                    <th>Thành tiền</th>
	
				</tr>
					</thead>
					<tbody>
						<?php 
				
				$pdlist = $pd->importstatements($month);
				$i = 0;
                $tongnhap=0;
                        $tongtien=0;
							
					if($pdlist){
					
							while ($result = $pdlist->fetch_assoc()){
								$i++;
                                $tongnhap+=$result['sl_nhap'];
                                $tongtien+=$result['unit_price']*$result['sl_nhap'];
                                
				 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
					<td><?php echo $result['product_code'] ?></td>
					<td><?php echo $result['productName'] ?></td>
					
				
					<td>
						<?php echo $result['sl_nhap'] ?>

					</td>
					<td>
						<?php echo $result['unit_price'] ?>

					</td>
                    <td>
						<?php echo $result['unit_price']*$result['sl_nhap'] ?>

					</td>
					
						</tr>
						<?php 
							}
						}
						 ?>
					</tbody>
				</table>
                    <div>Tổng số lượng nhập:<?php echo $tongnhap ?></div>
                    <div>Tổng tiền:<?php echo $tongtien ?></div>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

