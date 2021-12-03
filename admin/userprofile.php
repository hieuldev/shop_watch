<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/customer.php';?>
<div class="grid_10">
            <div class="box round first grid">
                <h2>Hồ sơ người dùng</h2>  
                <?php
      $user=new customer();
      $get_user=$user->show_all_customers();
        if ($get_user) {
            $i=0;
            while ($result = $get_user->fetch_assoc()) {
                $i++;

        ?>    
               <div style="width: 500px;
    margin: 10px auto;
    padding-left: 200px;
    border: 2px solid #1B548D;
" class="block copyblock"> 
               <table >
               <tr><b style="font-size: 20px; color:#1B548D;">Hồ sơ người dùng:<?php echo $i;?></b></tr>
                <tr>
                    <td>Tên</td>
                    <td>:</td>
                    <td><?php echo $result['name']; ?></td>
                </tr>
                <tr>
                    <td>Thành Phố</td>
                    <td>:</td>
                    <td><?php echo $result['city']; ?></td>
                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td>:</td>
                    <td><?php echo $result['phone']; ?></td>
                </tr>
                <tr>
                    <td>Mã bưu điện</td>
                    <td>:</td>
                    <td><?php echo $result['zipcode']; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $result['email']; ?></td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td>:</td>
                    <td><?php echo $result['address']; ?></td>
                </tr>
               
       
    </table>
                </div>
                <?php
            }
        }
        ?>
         <div style="text-align: center;" class="page">
          <?php
            $user_all=$user->show_all_customers();
            $user_count=mysqli_num_rows($user_all);
            $user_button=ceil($user_count/10);//ceil làm tròn
            $i=1;
            echo '<p>Trang</p>';
            for($i=1;$i<=$user_button;$i++)
            {
                echo '<a href="userprofile.php?page='.$i.'">'.$i.'</a>';
            }
            ?>  
        </div>
            </div>
            
        </div>
       
 



<?php include 'inc/footer.php'; ?>