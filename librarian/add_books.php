<?php
session_start();
// 如果sesseion沒有管理者帳號則跳轉到登入頁
if (!isset($_SESSION["librarian"])) {
    ?>
    <script type="text/javascript">
    window.location="login.php";
    </script>


    <?php
}
include "connection.php";
include "header.php";
?>

        <!-- page content area main -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3></h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Add Books Info</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <!-- enctype="multipart/form-data" 上傳包含非文本的內容，如圖片或者mp3 -->
                                <form name="form1" action="" method="POST" class="col-lg-6" enctype="multipart/form-data">
                                <table class="table table-bordered">
                                    <tr>
                                        <td><input type="text" class="form-control" placeholder="books name" name="booksname" required=""></td>
                                    </tr>                                                                 <tr>
                                        Books Image
                                        <td><input type="file"  name="f1" required=""></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" class="form-control" placeholder="books author name" name="bauthorname" required=""></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" class="form-control" placeholder="publication name" name="pname" required=""></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" class="form-control" placeholder="books purchase date" name="bpurchasedt" required=""></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" class="form-control" placeholder="books price" name="bprice" required=""></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" class="form-control" placeholder="books quantity" name="bqty" required=""></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" class="form-control" placeholder="avalilable quantity" name="aqty" required=""></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" class="btn btn-default-submit"  name="submit1" value="insert book details" style="background-color: blue;color: white"></td>
                                    </tr>

                                </table>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
<?php
if(isset($_POST["submit1"]))
{
    $tm=md5(time());
    // $_FILES["file"]["name"]：上傳檔案的原始名稱
    $fnm=$_FILES["f1"]["name"];
    $dst="./books_images/".$tm.$fnm;
    $dst1="books_images/".$tm.$fnm;
    // $_FILES["file"]["tmp_name"]：上傳檔案後的暫存資料夾位置

    // move_uploaded_file(source file, target file);
    move_uploaded_file($_FILES["f1"]["tmp_name"],$dst);
    $sql="INSERT INTO add_books VALUES (null,'$_POST[booksname]','$dst1','$_POST[bauthorname]','$_POST[pname]','$_POST[bpurchasedt]','$_POST[bprice]','$_POST[bqty]','$_POST[aqty]','$_SESSION[librarian]')";
    if (mysqli_query($link, $sql)) {

        ?> 
            <script type="text/javascript">
            alert("books insert successfully");
            console.log("books insert successfully");
            </script> 
        <?php
        
        //echo "New record created successfully";
    } else {
        ?>
        <script  type="text/javascript">
            console.log("Error: " . $sql . "<br>" . mysqli_error($conn));
        </script>
        
        <?php
        //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


}

?>

<?php
include "footer.php";
?>
        
