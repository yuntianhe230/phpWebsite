<html>
<head><title></title></head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>

<?php
if (empty($_POST["desc"]))
{
    ?>
    <center><h3>Project Details</h3></center>
    <form method="post" action="addProject.php">
        <center>Welcome to our Web Site<p />
            Please enter your project details for our database</center>
        <table border = "1" align="center">
            <tr>
                <td><b>project_description</b></td>
                <td>
                    <input type="text" name="desc" size="30" >
                </td>
            </tr>
            <tr>
                <td><b>project_country</b></td>
                <td>
                    <input type="text" name="country" size="30" >
                </td>
            </tr>
            <tr>
                <td><b>project_city</b></td>
                <td>
                    <input type="text" name="city" size="30" >
                </td>
            </tr>

        </table>
        <p />
        <center>
            <input type="submit" value="Add Details">
            <input type="reset" value="Clear Details">
            <a href="project.php">Back</a>
        </center>
    </form>
<?php
}
else
{
include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$query="INSERT INTO project (project_desc, project_country, project_city) VALUES
			('$_POST[desc]','$_POST[country]','$_POST[city]')";

if(!$conn->query($query))
{
//echo mysqli_error($conn);
?>
    <script language="JavaScript">
        alert("Error adding record. Contact System Administrator");
        window.location.href="addProject.php";
    </script>
<?php
}
else
{
?>
    <script language="JavaScript">
        alert("Project record successfully added to database");
        window.location.href="project.php";
    </script>
    <?php

    $conn->close();
}
}
?>
</body>
</html>