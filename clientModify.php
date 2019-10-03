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
        window.location='clientModify.php?client_id=<?php echo $_GET["client_id"]; ?>&Action=ConfirmDelete';
    }
</script>
<center><h3>Client Modification</h3></center>
<?php
include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$query = "SELECT * FROM client WHERE client_id =".$_GET["client_id"];
$result = $conn->query(($query));
$row = $result->fetch_assoc();

$strAction = $_GET["Action"];

switch($strAction)
{
case "Update":
    ?>
    <form method="post" action="clientModify.php?client_id=<?php echo $_GET["client_id"]; ?>&Action=ConfirmUpdate">
        <center>Client details amendment<br /></center><p />
        <table border="1"  align="center" cellpadding="3">
            <tr />
            <td><b>Client. ID.</b></td>
            <td><?php echo $row["client_id"]; ?></td>
            </tr>
            <tr>
                <td><b>Client. GivenName</b></td>
                <td><input type="text" name="gname" size="50" maxlength="50" value="<?php echo $row["client_gname"]; ?>"></td>
            </tr>
            <tr>
                <td><b>Client. FamilyName</b></td>
                <td><input type="text" name="fname" size="50" maxlength="50" value="<?php echo $row["client_fname"]; ?>"></td>
            </tr>
            <tr>
                <td><b>Client. Street</b></td>
                <td><input type="text" name="street" size="100" maxlength="100" value="<?php echo $row["client_street"]; ?>"></td>
            </tr>
            <tr>
                <td><b>Client. Suburb</b></td>
                <td><input type="text" name="suburb" size="50" maxlength="50" value="<?php echo $row["client_suburb"]; ?>"></td>
            </tr>
            <tr>
                <td><b>Client. State</b></td>
                <td><input type="text" name="state" size="6" maxlength="6" value="<?php echo $row["client_state"]; ?>"></td>
            </tr>
            <tr>
                <td><b>Client. Postcode</b></td>
                <td><input type="text" name="postcode" size="4" maxlength="4" value="<?php echo $row["client_pc"]; ?>"></td>
            </tr>
            <tr>
                <td><b>Client. Email</b></td>
                <td><input type="text" name="email" size="50" maxlength="50" value="<?php echo $row["client_email"]; ?>"></td>
            </tr>
            <tr>
                <td><b>Client. Mobile</b></td>
                <td><input type="text" name="mobile" size="12" maxlength="12" value="<?php echo $row["client_mobile"]; ?>"></td>
            </tr>
            <tr>
                <td><b>Client. MailingList</b></td>
                <td><select   name="mailinglist" size="1" >">
                        <option <?php if($row["client_mailinglist"] == "Y") echo "SELECTED";?> value="Y">Yes</option>
                        <option <?php if($row["client_mailinglist"] == "N") echo "SELECTED";?> value="N">No</option>
                    </select>
                </td>
            </tr>
        </table>
        <br/>
        <table align="center">
            <tr>
                <td><input type="submit" value="Update Client"></td>
                <td><input type="button" value="Return to List" OnClick="window.location='client.php'"></td>
            </tr>
        </table>
    </form>
    <?php
    break;

case "ConfirmUpdate":
    {
        $query="UPDATE client set client_gname='$_POST[gname]',
	                    client_fname='$_POST[fname]', client_street='$_POST[street]',
	                    client_suburb='$_POST[suburb]', client_state='$_POST[state]', 
	                    client_pc='$_POST[postcode]', client_email='$_POST[email]',
	                    client_mobile='$_POST[mobile]', client_mailinglist='$_POST[mailinglist]' WHERE client_id =".$_GET["client_id"];
        $result = $conn->query(($query));
        header("Location: client.php");
    }
    break;

case "Delete":
    ?>
    <center>Confirm deletion of the following client record<br /></center><p />
    <table border="1"  align="center" cellpadding="3">
        <tr />
        <td><b>Client. ID.</b></td>
        <td><?php echo $row["client_id"]; ?></td>
        </tr>
        <tr>
            <td><b>Client. Name</b></td>
            <td><?php echo $row["client_gname"]." ".$row["client_fname"]; ?></td>
        </tr>
    </table>
    <br/>
    <table align="center">
        <tr>
            <td><input type="button" value="Confirm" OnClick="confirm_delete();">
            <td><input type="button" value="Cancel" OnClick="window.location='client.php'"></td>
        </tr>
    </table>
    <?php
    break;

case "ConfirmDelete":
$query="DELETE FROM client WHERE client_id =".$_GET["client_id"];
if($conn->query($query))
{
?>
<center>
    The following client record has been successfully deleted<p />
    <?php
    echo "Client. ID. $row[client_id] $row[client_gname] $row[client_fname]";
    echo "</center><p />";
    }
    else
    {
        echo "<center>Error deleting customer record<p /></center>";
    }
    echo "<center><input type='button' value='Return to List' OnClick='window.location=\"client.php\"'></center>";
    break;

    case "View":
        ?>
        <center>View Client<br/></center>

        <table align ="center" cellpadding="3">

            <tr>
                <td><b>ID</b></td>
                <td><?php echo $row["client_id"];?></td>
            </tr>

            <tr>
                <td><b>GivenName</b></td>
                <td><?php echo $row["client_gname"]; ?></td>
            </tr>

            <tr>
                <td><b>FamilyName</b></td>
                <td><?php echo $row["client_fname"]; ?></td>
            </tr>

            <tr>
                <td><b>Street</b></td>
                <td><?php echo $row["client_street"]; ?></td>
            </tr>

            <tr>
                <td><b>Suburb</b></td>
                <td><?php echo $row["client_suburb"]; ?></td>
            </tr>

            <tr>
                <td><b>State</b></td>
                <td><?php echo $row["client_state"]; ?></td>
            </tr>

            <tr>
                <td><b>Postcode</b></td>
                <td><?php echo $row["client_pc"]; ?></td>
            </tr>

            <tr>
                <td><b>Email</b></td>
                <td><?php echo $row["client_email"]; ?></td>
            </tr>

            <tr>
                <td><b>Mobile</b></td>
                <td><?php echo $row["client_mobile"]; ?></td>
            </tr>

            <tr>
                <td><b>MailingList</b></td>
                <td><?php echo $row["client_mailinglist"]; ?></td>
            </tr>

        </table> <br/>

        <table align="center">
            <tr>
                <td><input type = "button" value = "Return to List" onclick="window.location.href='client.php';"/></td>
            </tr>
        </table>

<?php
    }
    $result->free_result();
    $conn->close();
    ?>
</body>
</html>