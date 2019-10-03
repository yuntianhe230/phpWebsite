<?php
ob_start();
session_start();
if((!isset($_SESSION["loggedin"])|| $_SESSION["loggedin"]!=true))
{
    header("location:login.php");
}
?>
<html>
<head><title></title></head>
<link rel="stylesheet" type="text/css" href="style.css">
<br>
<h3 align="center" >Product Details</h3>
<?php
include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$query = "SELECT * FROM product";
$result = $conn->query($query);
?>
<table border="1" align="center">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Purchase price</th>
        <th>Sale price</th>
        <th>Country of origin</th>
        <th colspan="3">Options</th>
    </tr>
    <?php
    while ($row = $result->fetch_array())
    {
        ?>
        <tr>
            <td><?php echo $row["product_id"]; ?></td>
            <td><?php echo $row["product_name"]; ?></td>
            <td><?php echo $row["product_purchase_price"]; ?></td>
            <td><?php echo $row["product_sale_price"]; ?></td>
            <td><?php echo $row["product_country_of_origin"]; ?></td>
            <td><a href="productModify.php?product_id=<?php echo $row["product_id"]; ?>&Action=View">View</a></td>
            <td><a href="productModify.php?product_id=<?php echo $row["product_id"]; ?>&Action=Update">Update</a></td>
            <td><a href="productModify.php?product_id=<?php echo $row["product_id"]; ?>&Action=Delete">Delete</a></td>

        </tr>
        <?php
    }
    ?>
</table>
<a href="addProduct.php"> Create </a><br>
<form method = "post" action="search.php">
    Search by Category : <input type="text" name="keyword" />
    <input type="submit" value="Search" />
</form>
<a href = "index.php">Back to menu </a><br>
<a  onclick= "myFunction()"><img src=img/products.jpg></a><br>
<?php
$result->free_result();
$conn->close();
?>
</body>
</html>
<script language="JavaScript">
    function myFunction() {
        window.open("viewCode.php?filename=product.php");
    }
</script>