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
<h3 align="center" >product Details</h3>
<?php

include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB)
or die("Couldn't log on to database");
if(empty($_POST["check"])){
$query = "SELECT * FROM product";
$result = $conn->query($query);
?>
<form method="post" action="mult_products.php">
    <table border="1" align="center">
        <tr>
            <th>Name</th>
            <th>Sale price</th>
            <th>edit?</th>

        </tr>
        <?php
        while ($row = $result->fetch_array()) {
            ?>
            <tr>
                <td><?php echo $row["product_name"]; ?></td>
                <td><input type="number" name="<?php echo $row['product_id'];?>" size="10" maxlength="10"
                           value="<?php echo $row["product_sale_price"]; ?>"></td>
                <td align="center"><input type="checkbox" name="check[]" value="<?php echo $row["product_id"]; ?>"></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <br>
    <center><input type="submit" value="Update Selected Products"></center>
    <a href="index.php">Back to menu </a><br>
    <a onclick="myFunction()"><img src=img/muti_products.jpg></a><br>
    <?php
    $result->free_result();
    $conn->close();
    }
    else{
        include("connection.php");
        $conn = new mysqli($Host, $UName, $PWord, $DB)
        or die("Couldn't log on to database");

       foreach ($_POST["check"] as $updateId){
           $query="UPDATE product set product_sale_price='$_POST[$updateId]' WHERE product_id='$updateId'";
           $result= $conn->query($query);
       }

        $conn->close();
        header("Location: mult_products.php");
    }
?>
</body>
</html>
<script language="JavaScript">
    function myFunction() {
        window.open("viewCode.php?filename=mult_products.php");
    }
</script>