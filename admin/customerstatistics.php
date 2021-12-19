<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/customer.php';  ?>
<?php $id = $_GET['id']; ?>

<div class="grid_10">
    <div class="box round first grid">
        <?php 
        if($id==0)
        {
        echo '<h2>Danh sách khách hàng thân thiết</h2>';
        }
        else if($id==1)
        {
            echo '<h2>Danh sách khách hàng đặc biệt</h2>';
        }
        else
        {
            echo '<h2>Danh sách khách hàng thông thường</h2>';
        }
        ?>
        
        
        <div class="block">
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
                    
                    if ($id == 0) {
                        $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:8000/loyal_customer',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  
));

$response = curl_exec($curl);

curl_close($curl);
                        $link = "C:\\xampp\\htdocs\\shop_watch\\classes\\Cluster-API\\customer\\KhachHangThanThiet.csv";
                    } else if ($id == 1) {
                        $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:8000/special_customer',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  
));

$response = curl_exec($curl);

curl_close($curl);
                        $link = "C:\\xampp\\htdocs\\shop_watch\\classes\\Cluster-API\\customer\\KhachHangDacBiet.csv";
                    } else {
                        $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:8000/regular_customer',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  
));

$response = curl_exec($curl);

curl_close($curl);
                        $link = "C:\\xampp\\htdocs\\shop_watch\\classes\\Cluster-API\\customer\\KhachHangThongThuong.csv";
                    }
                    $i = 0;
                    if (($handle = fopen($link, "r")) !== FALSE) {
                        
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            if ($i > 0) {
                    ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data[1]; ?></td>
                                    <td><?php echo $data[5]; ?></td>
                                    <td><?php echo $data[7]; ?></td>
                                    <td><?php echo $data[4]; ?></td>
                                    <td><?php echo $data[3]; ?></td>
                                    <td><?php echo $data[2]; ?></td>
                                </tr>
                    <?php
                            }
                            $i++;
                        }

                        fclose($handle);
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