<?php
session_start();
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
                                <h2>Return Books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form name="form1" action="" method="POST">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>
                                                <select name="enr" id="" class="form-control">
                                                    <?php 
                                                    $res=mysqli_query($link,"SELECT student_enrollment FROM issue_books WHERE books_return_date=''");
                                                    while ($row=mysqli_fetch_array($res)) {
                                                        echo "<option>";
                                                        echo "$row[student_enrollment]";
                                                        echo "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="submit" name="submit1"
                                                class="form-control btn btn-primary" value="search" >
                                            </td>
                                        </tr>
                                    </table>
                                    
                                </form>
                                <?php 
                                if(isset($_POST["submit1"])){
                                    $res=mysqli_query($link,"SELECT * FROM issue_books WHERE student_enrollment='$_POST[enr]'");
                                    echo "<table class='table table-bordered'>";
                                    echo "<tr>";
                                    echo "<th>"; echo "student_enrollment"; echo "</th>";
                                    echo "<th>"; echo "student_name"; echo "</th>";
                                    echo "<th>"; echo "student_sem"; echo "</th>";
                                    echo "<th>"; echo "student_contact"; echo "</th>";
                                    echo "<th>"; echo "student_email"; echo "</th>";
                                    echo "<th>"; echo "books_name"; echo "</th>";
                                    echo "<th>"; echo "books_issue_date"; echo "</th>";
                                    echo "<th>"; echo "Return_books"; echo "</th>";
                                    echo "</tr>";
                                    while ($row=mysqli_fetch_array($res)) {
                                        echo "<tr>";
                                    echo "<td>"; echo $row["student_enrollment"]; echo "</td>";
                                    echo "<td>"; echo $row["student_name"]; echo "</td>";
                                    echo "<td>"; echo $row["student_sem"]; echo "</td>";
                                    echo "<td>"; echo $row["student_contact"]; echo "</td>";
                                    echo "<td>"; echo $row["student_email"]; echo "</td>";
                                    echo "<td>"; echo $row["books_name"]; echo "</td>";
                                    echo "<td>"; echo $row["books_issue_date"]; echo "</td>";
                                    echo "<td>";?> <a href="return.php?id=<?php echo $row[id]; ?>">Return Books</a> <?php echo "</td>";
                                    echo "</tr>";

                                    }
                                    echo "</table>";
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
        
