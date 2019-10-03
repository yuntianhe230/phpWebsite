<?php
ob_start();
?>
<html>
<head><title></title></head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
<script language="javascript">
    function confirm_delete()
    {
        window.location='projectModify.php?project_id=<?php echo $_GET["project_id"]; ?>&Action=ConfirmDelete';
    }
</script>
<h3 align="center">project Modification</h3>
<?php
include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB)
or die("Couldn't log on to database");
$query=" SELECT * FROM project WHERE project_id =".$_GET["project_id"];
$result = $conn->query($query);
$row = $result->fetch_assoc();

$strAction = $_GET["Action"];

switch($strAction)
{
case "View":
    ?>

    <center>View project<br/></center>
    <table border="1"  align ="center" cellpadding="3">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Country</th>
            <th>City</th>
        </tr>
        <tr>
            <td><?php echo $row["project_id"]; ?></td>
            <td><?php echo $row["project_desc"]; ?></td>
            <td><?php echo $row["project_country"]; ?></td>
            <td><?php echo $row["project_city"]; ?></td>
        </tr>
    </table> <br/>

    <table align="center">
        <tr>
            <td><input type = "button" value = "Return to List" onclick="window.location.href='project.php';"/></td>
        </tr>
    </table>
<?php
break;
case "Update":
    ?>
    <form method="post" action="projectModify.php?project_id=<?php echo $_GET["project_id"]; ?>&Action=ConfirmUpdate">
        <h3 align="center">project details amendment<br /></h3><p />
        <table border="1" align="center" cellpadding="3">
            <tr />
            <td><b>project_id.</b></td>
            <td><?php echo $row["project_id"]; ?></td>
            </tr>
            <tr>
                <td><b>project_description</b></td>
                <td>
                    <input type="text" name="desc" size="30" value="<?php echo $row["project_desc"]; ?>">
                </td>
            </tr>
            <tr>
                <td><b>project_country</b></td>
                <td>
                    <input type="text" name="country" size="30" value="<?php echo $row["project_country"]; ?>">
                </td>
            </tr>
            <tr>
                <td><b>project_city</b></td>
                <td>
                    <input type="text" name="city" size="30" value="<?php echo $row["project_city"]; ?>">
                </td>
            </tr>
        </table>
        <br/>
        <table align="center">
            <tr>
                <td><input type="submit" value="Update project"></td>
                <td><input type="button" value="Return to List" OnClick="window.location='project.php'"></td>
            </tr>
        </table>
    </form>
    <?php
    break;

case "ConfirmUpdate":
    {
        $query="UPDATE project set project_desc='$_POST[desc]',project_country='$_POST[country]',project_city='$_POST[city]' WHERE project_id =".$_GET["project_id"];
        $result= $conn->query($query);
        header("Location: project.php");
    }
    break;

case "Delete":
    ?>
    <h3 align="center">Confirm deletion of the following project record<br /></h3><p />
    <table border="1" align="center">
        <tr>
            <td><b>project_id.</b></td>
            <td><?php echo $row["project_id"]; ?></td>
        </tr>
        <tr>
            <td><b>project_desc</b></td>
            <td><?php echo $row["project_desc"]?></td> </tr>
    </table>
    <br/>
    <table align="center">
        <tr>
            <td>
                <input type="button" value="Confirm" OnClick="confirm_delete();"></td>
            <td>
                <input type="button" value="Cancel" OnClick="window.location='project.php'">
            </td>
        </tr>
    </table>
    <?php
    break;

case "ConfirmDelete":
$query="DELETE FROM project  WHERE project_id =".$_GET["project_id"];
if($conn->query($query))
{
?>
<center>
    The following project record has been successfully deleted<br />
    <?php
    echo"ID: ". $row["project_id"]." Name: ".$row["project_desc"];
    echo "</center><p />";
    }
    else
    {
        echo "<h3 align='center'>Error deleting project record<p /></h3>";
    }
    echo "<center><input type='button' value='Return to List' OnClick='window.location=\"project.php\"'></center>";

    break;

    }
    $result->free_result();
    $conn->close();
    ?>
</body>
</html>