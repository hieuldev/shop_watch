<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/cart.php');
	include_once ($filepath.'/../helpers/format.php');
 ?>
<?php  ?>
 <?php
    $ct = new cart();
    if(isset($_GET['shiftid'])){
    	$id = $_GET['shiftid'];
    	$shifted = $ct->shifted($id);
    }

    if(isset($_GET['delid'])){
    	$id = $_GET['delid'];
    	$del_shifted = $ct->del_shifted($id);
    }
 
  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Đơn hàng</h2>
                <div class="block">
                <?php 
                if (isset($shifted)) {
                	echo $shifted;
                }
                 ?> 
                <?php 
                if (isset($del_shifted)) {
                	echo $del_shifted;
                }
                 ?>         
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Ngày đặt</th>
							<th>Khách hàng</th>
                            <th>Thông tin khách hàng</th>
                            <th>Chi tiết đơn hàng</th>
							<th>Xử lý</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$ct = new cart();
						$fm = new Format();
						$get_inbox_cart = $ct -> get_inbox_cart();
						if ($get_inbox_cart) {
							$i=0;
							while ($result = $get_inbox_cart->fetch_assoc()) {
								$i++;
							
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $fm->FormatDate($result['date_order']); ?></td>
							<td><?php echo $result['customer_id'] ?></td>
							<td><a href="customer.php?customerid=<?php echo $result['customer_id'] ?>">Xem khách hàng</a></td>
                            <td><a href="orderdetails.php?id_detail=<?php echo $result['id'] ?>">Xem chi tiết đơn hàng</a></td>
							<td>
								<?php 
								if($result['StatusId']==0){
								 ?>

								<a href="?shiftid=<?php echo $result['id'] ?>">Đang chờ xử lý
								<?php 
								}elseif($result['StatusId']==1) {
								 ?>

								<?php 
								echo 'Đang giao hàng...';
								 ?>
								 
								<?php 
								}else if($result['StatusId']==2) {

								 ?>
								<a href="?delid=<?php echo $result['id'] ?>">Xóa đơn</a>
								 <?php 
								}
								 ?>
							</td>
						</tr>
						<?php 
						}
						}
						 ?>
					</tbody>
				</table>
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
