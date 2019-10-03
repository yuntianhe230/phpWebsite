<html>
<head></head>
<body>
<center><H3>PHP Email</H3></center>
<?php
include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$query = "SELECT * FROM client WHERE client_mailinglist='Y'";
$result = $conn->query($query);
if (!isset($_POST["check"]))
{
    ?>

    <form method="post" action="email.php" style="text-align: center">
        <center><H3>To</H3></center>
        <table border="1" align="center">
            <tr>
                <th>client_id</th>
                <th>GivenName</th>
                <th>FirstName</th>
                <th>sent</th>
            </tr>
            <?php
            while ($row = $result->fetch_array()) {
                ?>
                <tr>
                    <td><?php echo $row["client_id"]; ?></td>
                    <td><?php echo $row["client_gname"]; ?></td>
                    <td><?php echo $row["client_fname"]; ?></td>
                    <td align="center"><input type="checkbox" name="check[]" value="<?php echo $row["client_email"]; ?>"></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <br>
        <table border="0" align="center">
            <tr>
                <td>Subject</td>
                <td><input type="text" name="subject" size="45"></td>
            </tr>
            <tr>
                <td>Message</td>
                <td valign="top" align="left">
                    <textarea cols="68" name="message" rows="9"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2"><br /><br /><input type="submit" value="Send Email">
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
    <?php
}
else
{
    $from = "From: Lei Xiang <lxia0004@student.monash.edu>";
    $msg =  $_POST["message"];
    $subject = $_POST["subject"];
    foreach ($_POST["check"] as $to){
        if(mail($to, $subject, $msg, $from))
        {
            echo "$to.Mail Sent " ;
            ?>
            <br>
            <?php

        }
        else
        {
            echo "$to.Error Sending Mail ";
            ?>
            <br>
            <?php
        }
    }
    ?>

    <a href = "client.php">back</a>
    <?php
}
?>
</body>
</html>
