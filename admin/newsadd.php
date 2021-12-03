<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/news.php' ?>

<?php
$news= new news();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
{
    $newsAdd=$news->insert_news($_POST,$_FILES);
}
?>
<div class="grid_10">
    <div class="box round first grid">
    
        <h2>Thêm tin tức</h2>
        <?php
    if(isset($newsAdd))
    {
        echo $newsAdd;
    }
    ?>
        <div class="block">

         <form action="newsadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tiêu đề</label>
                    </td>
                    <td>
                        <input name="newsTitle" type="text" placeholder="Nhập tiêu đề tin tức..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Hình ảnh</label>
                    </td>
                    <td>
                        <input name="newsImg" type="file" placeholder="Nhập hình ảnh..." class="medium" />
                    </td>
                </tr>
                
                
                 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Nội dung</label>
                    </td>
                    <td>
                        <textarea name="newsContent" class="tinymce"></textarea>
                    </td>
                </tr>
                
                <tr>
                <tr>
                    <td>
                        <label>Loại tin tức</label>
                    </td>
                    <td>
                        <select id="select" name="newsType">
                            <option>Chọn</option>
                            <option value="0">Tin thường</option>
                            <option value="1">Tin mới</option>
                            <option value="2">Tin hot</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Lưu" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


