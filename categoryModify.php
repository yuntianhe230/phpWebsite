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
        window.location='categoryModify.php?category_id=<?php echo $_GET["category_id"]; ?>&Action=ConfirmDelete';
    }
</script>
<h3 align="center">category Modification</h3>
<?php
include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB)
or die("Couldn't log on to database");
$query=" SELECT * FROM category WHERE category_id =".$_GET["category_id"];
$result = $conn->query($query);
$row = $result->fetch_assoc();

$strAction = $_GET["Action"];

switch($strAction)
{
case "View":
    ?>

    <center>View category<br/></center>
    <table border="1"  align ="center" cellpadding="3">
        <tr>
            <th>Id</th>
            <th>Name</th>
        </tr>
        <tr>
            <td><?php echo $row["category_id"]; ?></td>
            <td><?php echo $row["category_name"]; ?></td>
        </tr>
    </table> <br/>

    <table align="center">
        <tr>
            <td><input type = "button" value = "Return to List" onclick="window.location.href='category.php';"/></td>
        </tr>
    </table>
<?php
break;
case "Update":
    ?>
    <form method="post" action="categoryModify.php?category_id=<?php echo $_GET["category_id"]; ?>&Action=ConfirmUpdate">
        <h3 align="center">category details amendment<br /></h3><p />
        <table border="1" align="center" cellpadding="3">
            <tr />
            <td><b>category_id.</b></td>
            <td><?php echo $row["category_id"]; ?></td>
            </tr>
            <tr>
                <td><b>category_street</b></td>
                <td>
                    <input type="text" name="categoryname" size="30" value="<?php echo $row["category_name"]; ?>">
                </td>
            </tr>
        </table>
        <br/>
        <table align="center">
            <tr>
                <td><input type="submit" value="Update category"></td>
                <td><input type="button" value="Return to List" OnClick="window.location='category.php'"></td>
            </tr>
        </table>
    </form>
    <?php
    break;

case "ConfirmUpdate":
    {
        $query="UPDATE category set category_name='$_POST[categoryname]' WHERE category_id =".$_GET["category_id"];
        $result= $conn->query($query);
        header("Location: category.php");
    }
    break;

case "Delete":
    ?>
    <h3 align="center">Confirm deletion of the following category record<br /></h3><p />
    <table border="1" align="center">
        <tr>
            <td><b>category_id.</b></td>
            <td><?php echo $row["category_id"]; ?></td>
        </tr>
        <tr>
            <td><b>category_name</b></td>
            <td><?php echo $row["category_name"]?></td> </tr>
    </table>
    <br/>
    <table align="center">
        <tr>
            <td>
                <input type="button" value="Confirm" OnClick="confirm_delete();"></td>
            <td>
                <input type="button" value="Cancel" OnClick="window.location='category.php'">
            </td>
        </tr>
    </table>
    <?php
    break;

case "ConfirmDelete":
$query="DELETE FROM category  WHERE category_id =".$_GET["category_id"];
if($conn->query($query))
{
?>
<center>
    The following category record has been successfully deleted<br />
    <?php
    echo"ID: ". $row["category_id"]." Name: ".$row["category_name"];
    echo "</center><p />";
    }
    else
    {
        echo "<h3 align='center'>Error deleting category record<p /></h3>";
    }
    echo "<center><input type='button' value='Return to List' OnClick='window.location=\"category.php\"'></center>";

    break;

    }
    $result->free_result();
    $conn->close();
    ?>
</body>
</html>