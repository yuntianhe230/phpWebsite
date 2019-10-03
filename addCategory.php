<html>
<head><title></title></head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>

<?php
if (empty($_POST["name"]))
{
    ?>
    <center><h3>category Details</h3></center>
    <form method="post" action="addCategory.php">
        <center>Welcome to our Web Site<p />
            Please enter your category details for our database</center>
        <table border = "1" align="center">
            <tr>
                <th>Name</th>
                <td><input type="text" size="50" name="name"></td>
            </tr>

        </table>
        <p />
        <center>
            <input type="submit" value="Add Details">
            <input type="reset" value="Clear Details">
            <a href="category.php">Back</a>
        </center>
    </form>
<?php
}
else
{
include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$query="INSERT INTO category (category_name) VALUES
			('$_POST[name]')";

if(!$conn->query($query))
{
//echo mysqli_error($conn);
?>
    <script language="JavaScript">
        alert("Error adding record. Contact System Administrator");
        window.location.href="addCategory.php";
    </script>
<?php
}
else
{
?>
    <script language="JavaScript">
        alert("Category record successfully added to database");
        window.location.href="category.php";
    </script>
    <?php

    $conn->close();
}
}
?>
</body>
</html>