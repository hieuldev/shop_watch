<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/news.php' ?>

<?php
$news = new news();
$id = $_GET['newsID'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateNews = $news->update_news($_POST, $_FILES, $id);
}

?>
<div class="grid_10">
    <div class="box round first grid">

        <h2>Sửa tin tức</h2>
        <?php if (isset($updateNews)) {

            echo $updateNews;
        }
        ?>
        <div class="block">

            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <?php
                    $getnewsid = $news->getnewsId($id);
                    if ($getnewsid) {
                        while ($result = $getnewsid->fetch_assoc()) {
                            # code...

                    ?>
                            <tr>
                                <td>
                                    <label>Tiêu đề</label>
                                </td>
                                <td>
                                    <input name="newsTitle" type="text" value="<?php echo $result['newsTitle'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Hình ảnh</label>
                                </td>
                                <td>
                                    <img src="uploads/<?php echo $result['newsImg'] ?> with=100px">
                                    <input name="newsImg" type="file" class="medium" />
                                </td>
                            </tr>


                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Nội dung</label>
                                </td>
                                <td>
                                    <textarea name="newsContent" class="tinymce"><?php echo $result['newsContent'] ?></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Loại tin tức</label>
                                </td>
                                <td>
                                    <select id="select" name="newsType">
                                        <option>Lựa chọn loại tin tức</option>
                                        <?php
                                        if ($result['newsType'] == 0) {
                                        ?>
                                            <option selected value="0">Tin thường</option>
                                            <option value="1">Tin mới</option>
                                            <option value="2">Tin hot</option>
                                        <?php
                                        } else if ($result['newsType'] == 1) {
                                        ?>
                                            <option value="0">Tin thường</option>
                                            <option selected value="1">Tin mới</option>
                                            <option value="2">Tin hot</option>
                                        <?php } else {
                                        ?>
                                            <option value="0">Tin thường</option>
                                            <option value="1">Tin mới</option>
                                            <option selected value="2">Tin hot</option>
                                        <?php
                                        }
                                        ?>


                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Lưu" />
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>