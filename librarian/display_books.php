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
                                <h2>Display & Search Books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form name="form1" method="POST" action="">
                                    <input type="text" name="t1" class="form-control" placeholder="enter books name">
                                    <input type="submit" name="submit1" value="search books" class="btn btn-default" >
                                </form>
                                <?php
                                if(isset($_POST["submit1"]))
                                {
                                    $res=mysqli_query($link,"SELECT * FROM add_books WHERE books_name LIKE ('%$_POST[t1]%')");
                                echo "<table class='table table-bordered'>";
                                echo "<tr>";
                                echo "<th>"; echo "Books Image"; echo "</th>";
                                echo "<th>"; echo "Books Title"; echo "</th>"; 
                                echo "<th>"; echo "Author name"; echo "</th>";
                                echo "<th>"; echo "publication_name"; echo "</th>";
                                echo "<th>"; echo "purchase_date"; echo "</th>";
                                echo "<th>"; echo "books price"; echo "</th>";
                                echo "<th>"; echo "books quantity"; echo "</th>";
                                echo "<th>"; echo "avaliable quantity"; echo "</th>";
                                echo "<th>"; echo "Delete Books"; echo "</th>";
                                echo "</tr>";

                                while ($row=mysqli_fetch_array($res)) {
                                echo "<tr>";
                                echo "<td>"; ?>  <img src="<?php echo $row["books_image"] ?> " height="100" width="100" alt="">    <?php echo "</td>";    
                                echo "<td>"; echo $row["books_name"]; echo "</td>";
                                echo "<td>"; echo $row["books_author_name"]; echo "</td>";
                                echo "<td>"; echo $row["books_publication_name"]; echo "</td>";
                                echo "<td>"; echo $row["books_purchase_date"]; echo "</td>";
                                echo "<td>"; echo $row["books_price"]; echo "</td>";
                                echo "<td>"; echo $row["books_qty"]; echo "</td>";
                                echo "<td>"; echo $row["available_qty"]; echo "</td>";
                                echo "<td>";?><a href="delete_books.php?id=<?php echo $row["id"]; ?>">delete books</a>  <?php echo "</td>";
                                echo "</tr>";
                                }

                                echo "</table>";
                                }
                                else
                                {    
                                $res=mysqli_query($link,"SELECT * FROM add_books");
                                echo "<table class='table table-bordered'>";
                                echo "<tr>";
                                echo "<th>"; echo "Books Image"; echo "</th>";
                                echo "<th>"; echo "Books Title"; echo "</th>"; 
                                echo "<th>"; echo "Author name"; echo "</th>";
                                echo "<th>"; echo "publication_name"; echo "</th>";
                                echo "<th>"; echo "purchase_date"; echo "</th>";
                                echo "<th>"; echo "books price"; echo "</th>";
                                echo "<th>"; echo "books quantity"; echo "</th>";
                                echo "<th>"; echo "avaliable quantity"; echo "</th>";
                                echo "<th>"; echo "Delete Books"; echo "</th>";
                                echo "</tr>";

                                while ($row=mysqli_fetch_array($res)) {
                                echo "<tr>";
                                echo "<td>"; ?>  <img src="<?php echo $row["books_image"] ?> " height="100" width="100" alt="">    <?php echo "</td>";    
                                echo "<td>"; echo $row["books_name"]; echo "</td>";
                                echo "<td>"; echo $row["books_author_name"]; echo "</td>";
                                echo "<td>"; echo $row["books_publication_name"]; echo "</td>";
                                echo "<td>"; echo $row["books_purchase_date"]; echo "</td>";
                                echo "<td>"; echo $row["books_price"]; echo "</td>";
                                echo "<td>"; echo $row["books_qty"]; echo "</td>";
                                echo "<td>"; echo $row["available_qty"]; echo "</td>";
                                echo "<td>";?><a href="delete_books.php?id=<?php echo $row["id"]; ?>">delete books</a>  <?php echo "</td>";
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
        
