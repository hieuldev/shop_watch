<?php
include "inc/header.php";
?>
<?php
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $show_newdetails=$news->show_newdetails($id);
    $result=$show_newdetails->fetch_assoc();
} 
?>
<h3 id="newsTitle"><b><?php echo $result['newsTitle'] ?></b></h3>
<img id="newsImg" src="admin/uploads/<?php echo $result['newsImg'] ?>" alt="" />
<pre><?php echo $result['newsContent'] ?></pre>
<?php
include "inc/footer.php";
?>