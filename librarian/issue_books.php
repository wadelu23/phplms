<?php
session_start();
if (!isset($_SESSION["librarian"])) {
    ?>
    <script type="text/javascript">
    window.location="login.php";
    </script>


    <?php
}
include "header.php";
include "connection.php";
date_default_timezone_set("Asia/Taipei");
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
                                <h2>Issue Books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form action="" name="form1" method="POST">
                                    <table>
                                        <tr>
                                            <td><select class="form-control selectpicker" name="enr" id="">
                                                
                                                <?php
                                                    $res=mysqli_query($link,"SELECT enrollment FROM student_registration");
                                                    while ($row=mysqli_fetch_array($res)) {
                                                        echo "<option>";
                                                        echo $row["enrollment"];
                                                        echo "</option>";
                                                    }

                                                ?>
                                            </select></td>
                                            <td><input type="submit" name="submit1" class="form-control btn btn-default" value="search"  style="margin-top: 5px;"></td>
                                        </tr>
                                    </table>                    
                               

                                <?php
                                    if (isset($_POST[submit1])) 
                                    {
                                        //echo $_POST[enr];
                                        $res5=mysqli_query($link,"SELECT * FROM student_registration WHERE enrollment='$_POST[enr]'");
                                        while ($row5=mysqli_fetch_array($res5)) 
                                        {
                                            $firstname=$row5["firstname"];
                                            $lastname=$row5["lastname"];
                                            $username=$row5["username"];
                                            $email=$row5["email"];
                                            $contact=$row5["contact"];
                                            $sem=$row5["sem"];
                                            $enrollment=$row5["enrollment"];
                                            $_SESSION[enrollment]=$enrollment;
                                            $_SESSION[username]=$username;
                                        }
                                        ?>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td><input type="text" class="form-control" placeholder="enrollment-NO." name="enrollment" disabled="" value="<?php echo $enrollment; ?>" /></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" placeholder="studentname" name="studentname" required="" value="<?php echo $firstname.' '.$lastname ; ?>"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" placeholder="studentSem" name="studentsem" required="" value="<?php echo $sem; ?>"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" placeholder="studentcontact" name="studentcontact" required="" value="<?php echo $contact; ?>"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" placeholder="studentemail" name="studentemail" required="" value="<?php echo $email; ?>"/></td>
                                            </tr>
                                            <tr>
                                                <td><select name="booksname" id="" class="form-control selectpicker">
                                                    <?php
                                                    $res=mysqli_query($link,"SELECT books_name FROM add_books");
                                                    while ($row=mysqli_fetch_array($res)) {
                                                        echo "<option>";
                                                        echo $row['books_name'];
                                                        echo "</option>";
                                                    }
                                                                                                        
                                                    ?>
                                                </select></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" placeholder="bookissuedate" name="bookissuedate" required="" value="<?php echo date("d-m-Y"); ?>" /></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" placeholder="studentusername" name="studentusername" disabled="" value="<?php echo $username; ?>"/></td>
                                            </tr>
                                            <tr>
                                                <td><input type="submit" class="form-control btn btn-primary"  name="submit2" value="Issue Books"  /></td>
                                            </tr>
                                            
                                        </table>

                                        <?php
                                        
                                    }
                                ?>
                                </form>
            
                                <?php
                                if (isset($_POST['submit2'])) {
                                    $qty=0;
                                    $res=mysqli_query($link,"SELECT * FROM add_books WHERE books_name='$_POST[booksname]'");
                                    while ($row=mysqli_fetch_array($res)) {
                                        $qty=$row["available_qty"];
                                    }
                                    if ($qty==0) {
                                        ?>
                                        <div class="alert alert-danger col-lg-6 col-lg-push-3">
                                        <strong >This Books are Not avaliable</strong>
                                        </div>
                                        
                                        <?php
                                    }else{

                                   mysqli_query($link,"INSERT INTO issue_books VALUES (null,'$_SESSION[enrollment]','$_POST[studentname]','$_POST[studentsem]','$_POST[studentcontact]','$_POST[studentemail]','$_POST[booksname]','$_POST[bookissuedate]','','$_SESSION[username]')");
                                   mysqli_query($link,"UPDATE add_books SET available_qty=available_qty-1 WHERE books_name='$_POST[booksname]'");
                                   ?>
                                    <script type="text/javascript">
                                        alert("books issue success");
                                        window.location.href=window.location.href;
                                    </script>

                                    <?php
                                    }
                                }


                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

<?php
include "footer.php";
?>
        
