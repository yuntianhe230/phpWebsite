<html>
<head><title></title></head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>

<?php
if (empty($_POST["gname"])AND empty($_POST["fname"]))
{
    ?>
    <center><h3>Client Details</h3></center>
    <form method="post" action="addClient.php">
        <center>Welcome to our Web Site<p />
            Please enter your details for our database</center>
        <table border = "1" align="center">
            <tr>
                <th>GivenName</th>
                <td><input type="text" size="50" name="gname"></td>
            </tr>
            <tr>
                <th>FamilyName</th>
                <td><input type="text" size="50" name="fname"></td>
            </tr>
            <tr>
                <th>Street</th>
                <td><input type="text" size="100" name="street"></td>
            </tr>
            <tr>
                <th>Suburb</th>
                <td><input type="text" size="50" name="suburb"></td>
            </tr>
            <tr>
                <th>state</th>
                <td><input type="text" size="6" name="state"></td>
            </tr>
            <tr>
                <th>Postcode</th>
                <td><input type="text" size="4" name="postcode"></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input type="email" size="50" name="email"></td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td><input type="text" size="12" name="mobile"></td>
            </tr>
            <tr>
                <th>MailingListing</th>
                <td><select type="text" size="1" name="mailingList">
                        <option value="Y">Yes</option>
                        <option value="N">No</option>
                    </select>

                </td>
            </tr>
        </table>
        <p />
        <center>
            <input type="submit" value="Add Details">
            <input type="reset" value="Clear Details">
            <a href="client.php">Back</a>
        </center>
    </form>
<?php
}
else
{
include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$query="INSERT INTO client (client_gname,client_fname,client_street,client_suburb,client_state,client_pc,client_email,client_mobile,client_mailinglist) VALUES
			('$_POST[gname]','$_POST[fname]','$_POST[street]','$_POST[suburb]','$_POST[state]','$_POST[postcode]','$_POST[email]','$_POST[mobile]','$_POST[mailingList]')";

if(!$conn->query($query))
{
//echo mysqli_error($conn);
?>
    <script language="JavaScript">
        alert("Error adding record. Contact System Administrator");
        window.location.href="AddClient.php";
    </script>
<?php
}
else
{
?>
    <script language="JavaScript">
        alert("Client record successfully added to database");
        window.location.href="client.php";
    </script>


    <?php

    $conn->close();
}
}
?>
</body>
</html>