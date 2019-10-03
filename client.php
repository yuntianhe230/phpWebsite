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
<center><h3>Client Details</h3></center>
<?php
include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$query = "SELECT * FROM client";
$result = $conn->query($query);
?>
<table border="1" align="center">
    <tr>
        <th>client_id</th>
        <th>GivenName</th>
        <th>FirstName</th>
        <th>Street</th>
        <th>Suburb</th>
        <th>State</th>
        <th>Postcode</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>MailingList</th>
        <th colspan="3">Options</th>
    </tr>
    <?php
    while ($row = $result->fetch_array())
    {
        ?>
        <tr>
            <td><?php echo $row["client_id"]; ?></td>
            <td><?php echo $row["client_gname"]; ?></td>
            <td><?php echo $row["client_fname"]; ?></td>
            <td><?php echo $row["client_street"]; ?></td>
            <td><?php echo $row["client_suburb"]; ?></td>
            <td><?php echo $row["client_state"]; ?></td>
            <td><?php echo $row["client_pc"]; ?></td>
            <td><?php echo $row["client_email"]; ?></td>
            <td><?php echo $row["client_mobile"]; ?></td>
            <td><?php echo $row["client_mailinglist"]; ?></td>



            <td><a href="clientModify.php?client_id=<?php echo $row["client_id"]; ?>&Action=View">View</a></td>
            <td><a href="clientModify.php?client_id=<?php echo $row["client_id"]; ?>&Action=Update">Update</a></td>
            <td><a href="clientModify.php?client_id=<?php echo $row["client_id"]; ?>&Action=Delete">Delete</a></td>
        </tr>



        <?php
    }
    ?>

</table>
<a href = "addClient.php">Add </a><br>
<a href = "email.php">Email </a><br>
<a href = "pdf.php">PDF </a><br>
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