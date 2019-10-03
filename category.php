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
<body>
<h3 align="center" >category Details</h3>
<?php
include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$query = "SELECT * FROM category";
$result = $conn->query($query);
?>
<table border="1" align="center">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th colspan="3">Options</th>
    </tr>
    <?php
    while ($row = $result->fetch_array())
    {
    ?>
    <tr>
        <td><?php echo $row["category_id"]; ?></td>
        <td><?php echo $row["category_name"]; ?></td>
        <td><a href="categoryModify.php?category_id=<?php echo $row["category_id"]; ?>&Action=View">View</a></td>
        <td><a href="categoryModify.php?category_id=<?php echo $row["category_id"]; ?>&Action=Update">Update</a></td>
        <td><a href="categoryModify.php?category_id=<?php echo $row["category_id"]; ?>&Action=Delete">Delete</a></td>
    </tr>
        <?php
    }
    ?>
</table>
<a href="addCategory.php"> Create </a><br>

<a href = "index.php">Back to menu </a><br>
<a  onclick= "myFunction()"><img src=img/category.jpg></a><br>
<?php
$result->free_result();
$conn->close();
?>
</body>
</html>
<script language="JavaScript">
    function myFunction() {
        window.open("viewCode.php?filename=category.php");
    }
</script>