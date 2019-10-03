<?php
ob_start();
session_start();
if((!isset($_SESSION["loggedin"])|| $_SESSION["loggedin"]!=true))
{}else{
    ?>
    <script language="JavaScript">
        alert("You already logged in");
        window.location.href="index.php";
    </script>
<?php
}
?>
<html>
<head>
    <title>Session Log In </title>
</head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
<?php
if(empty($_POST["uname"]))
{
    ?>
    <form method="post" action="login.php">
        <table border="0" align="center" width="30%" cellpadding="2" cellspacing="5">
            <tr>
                <td class="pref">Username</td>
                <td class="prefdisplaycentre"><input type="text" name="uname" size="12" maxlength="50"></td>
            </tr>
            <tr>
                <td class="pref">Password</td>
                <td class="prefdisplaycentre"><input type="password" name="pword" size="12" maxlength="50"></td>
            </tr>
            <tr>
                <td colspan="3" class="heading2" align="center">
                    <input type="submit" value="Login" name="Action">&nbsp;&nbsp;
                    <input type="reset" value="Reset">
                    <a href = "index.php">Back to menu </a><br>
                </td>
            </tr>
        </table>
    </form>
    <?php
}
else
{
    include("connection.php");
    $conn = new mysqli($Host, $UName, $PWord, $DB)
    or die("Couldn't log on to database");

    $query="SELECT admin_id FROM admin WHERE uname = ? AND pword = ?";

    $stmt = mysqli_prepare($conn, $query);

    $stmt->bind_param('ss', $uname,$pword);
    $uname= $_POST["uname"];
    $pword= $_POST["pword"];
    $stmt->execute();
    $stmt->bind_result($admin_id);

    if(!empty($stmt->fetch()))
    {
        echo "Welcome to our site No.$admin_id";
        $_SESSION["loggedin"] = true;
        header("Location: index.php");
    }
    else
    {
        echo "Sorry, login details incorrect";
    }
}
?>

</body>
</html>