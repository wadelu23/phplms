<?php 
include "connection.php";
$id=$_GET["id"];
$date=date("d-m-Y");
$res=mysqli_query($link,"UPDATE issue_books SET books_return_date='$date' WHERE id=$id ");

$bookname="";
$res=mysqli_query($link,"SELECT * FROM issue_books WHERE id=$id ");
while ($row=mysqli_fetch_array($res)) {
	$bookname=$row["books_name"];
}
mysqli_query($link,"UPDATE add_books SET available_qty=available_qty+1 WHERE books_name='$bookname'");
 ?>

<script type="text/javascript">
	window.location="return_book.php";
</script>