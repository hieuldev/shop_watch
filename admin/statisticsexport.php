<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/cart.php';  ?>
<?php include '../classes/brand.php';  ?> 
<?php include '../classes/product.php';  ?>
<?php require_once '../helpers/format.php'; ?>
<?php
$date = getdate();
    $pd = new cart();   
    if(isset($_GET['month']))
    {
        $month=$_GET['month'];
    }
else
{
    $month=$date['mon'];
}
 ?> 

        <div class="grid_10">
            <div class="box round first grid">
                <h2>THỐNG KÊ XUẤT</h2>
                <form action="importstatements.php" >
                <lable >Chọn tháng   </lable>
                        <select id="select" name="month">                 
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
                    
                </form>
                
                <div class="block">       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
					<th>No.</th>
                    
					<th>Code sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th>Số lượng bán</th>
					<th>Đơn giá</th>
                    <th>Thành tiền</th>
	
				</tr>
					</thead>
					<tbody>
						<?php 
				
				$pdlist = $pd->statisticsexport($month);
				$i = 0;
                $tongnhap=0;
                        $tongtien=0;
							
					if($pdlist){
					
							while ($result = $pdlist->fetch_assoc()){
								$i++;
                                $tongnhap+=$result['quantity'];
                                $tongtien+=$result['price']*$result['quantity'];
                                
				 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
					<td><?php echo $result['productId'] ?></td>
					<td><?php echo $result['productName'] ?></td>
					
				
					<td>
						<?php echo $result['quantity'] ?>

					</td>
					<td>
						<?php echo $result['price'] ?>

					</td>
                    <td>
						<?php echo $result['price']*$result['quantity'] ?>

					</td>
					
						</tr>
						<?php 
							}
						}
						 ?>
					</tbody>
				</table>
                    <div>Tổng số lượng bán:<?php echo $tongnhap ?></div>
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

