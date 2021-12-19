
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/customer.php';  ?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách khách hàng</h2>
        <div class="block">
        <form>
<label>Tìm kiếm khách hàng</label>
<input name="search" type="text"/>
<input type="submit"/>
</form>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Mã bưu điện</th>
                        <th>Thành phố</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $user = new customer();
                    if(isset($_GET['search']))
					{
						$search=$_GET['search'];
					}
					else
					{
$search="";
					}

                    $get_user = $user->show_all_customers($search);
                    if ($get_user) {
                        $i = 0;
                        foreach ($get_user as $result) {
                            $i++;

                    ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['name']; ?></td>
                                <td><?php echo $result['address']; ?></td>
                                <td><?php echo $result['phone']; ?></td>
                                <td><?php echo $result['email']; ?></td>
                                <td><?php echo $result['zipcode']; ?></td>
                                <td><?php echo $result['city']; ?></td>
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
    $(document).ready(function() {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>