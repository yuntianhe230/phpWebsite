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
<h3 align="center" >Project Details</h3>
<?php
include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$query = "SELECT * FROM project";
$result = $conn->query($query);
?>
<table border="1" align="center">
    <tr>
        <th>ID</th>
        <th>Description</th>
        <th>Country</th>
        <th>City</th>
        <th colspan="3">Options</th>
    </tr>
    <?php
    while ($row = $result->fetch_array())
    {
        ?>
        <tr>
            <td><?php echo $row["project_id"]; ?></td>
            <td><?php echo $row["project_desc"]; ?></td>
            <td><?php echo $row["project_country"]; ?></td>
            <td><?php echo $row["project_city"]; ?></td>

            <td><a href="projectModify.php?project_id=<?php echo $row["project_id"]; ?>&Action=View">View</a></td>
            <td><a href="projectModify.php?project_id=<?php echo $row["project_id"]; ?>&Action=Update">Update</a></td>
            <td><a href="projectModify.php?project_id=<?php echo $row["project_id"]; ?>&Action=Delete">Delete</a></td>
        </tr>
        <?php
    }
    ?>
</table>
<a href="addProject.php"> Create </a><br>

<a href = "index.php">Back to menu </a><br>
<a  onclick= "myFunction()"><img src=img/project.jpg></a><br>
<?php
$result->free_result();
$conn->close();
?>
</body>
</html>
<script language="JavaScript">
    function myFunction() {
        window.open("viewCode.php?filename=project.php");
    }
</script>