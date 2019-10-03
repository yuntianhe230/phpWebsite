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
        window.location='productModify.php?product_id=<?php echo $_GET["product_id"]; ?>&Action=ConfirmDelete';
    }
</script>
<h3 align="center">product Modification</h3>
<?php
include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB)
or die("Couldn't log on to database");
$query="SELECT * FROM product WHERE product_id =".$_GET["product_id"];
$result = $conn->query($query);
$row = $result->fetch_assoc();
$query="SELECT * FROM product_image WHERE product_id=".$_GET["product_id"];
$result = $conn->query($query);
$strAction = $_GET["Action"];

switch($strAction)
{
case "View":
    ?>
    <center>View Product<br/></center>
<table border="1"  align ="center" cellpadding="3">
    <tr>
        <th>Id</th>
        <td><?php echo $row["product_id"]; ?></td>
    </tr>
    <tr>
        <th>Name</th>
        <td><?php echo $row["product_name"]; ?></td>
    </tr>
    <tr>
        <th>Purchase price</th>
        <td><?php echo $row["product_purchase_price"]; ?></td>
    </tr>
    <tr>
        <th>Sale price</th>
        <td><?php echo $row["product_sale_price"]; ?></td>
    </tr>
    <tr>
        <th>Country of origin</th>
        <td><?php echo $row["product_country_of_origin"]; ?></td>
    </tr>
    <?php
    while ($row2 = $result->fetch_array())
    {
    ?>
    <tr>
        <th>image</th>
        <td><img src="product_images/<?php echo $row2['image_name']?>" height="100" width="100"></td>
    </tr>
        <?php
    }
    ?>
</table> <br/>

    <table align="center">
        <tr>
            <td><input type = "button" value = "Return to List" onclick="window.location.href='product.php';"/></td>
        </tr>
    </table>

<?php
break;
case "Update":
    ?>
    <form method="post" enctype="multipart/form-data" action="productModify.php?product_id=<?php echo $_GET["product_id"]; ?>&Action=ConfirmUpdate">
        <h3 align="center">Product details<br /></h3><p />
        <table border="1"  align="center" cellpadding="3">
            <tr />
            <td><b>Id</b></td>
            <td><?php echo $row["product_id"]; ?></td>
            </tr>
            <tr>
                <td><b>Name</b></td>
                <td>
                    <input type="text" name="name" size="30" maxlength="30" value="<?php echo $row["product_name"]; ?>">
                </td>
            </tr>
            <tr>
                <td><b>Purchase price</b></td>
                <td>
                    <input type="number" name="purchase_price" size="10" maxlength="10" value="<?php echo $row["product_purchase_price"]; ?>">
                </td>
            </tr>
            <tr>
                <td><b>Sale price</b></td>
                <td>
                    <input type="number" name="sale_price" size="10" maxlength="10"  value="<?php echo $row["product_sale_price"]; ?>">
                </td>
            </tr>
            <tr>
                <td><b>Country of origin</b></td>
                <td>
                    <input type="text" name="country" size="40" maxlength="40" value="<?php echo $row["product_country_of_origin"]; ?>">
                </td>
            </tr>

            <?php
            while ($row2 = $result->fetch_array())
            {
                ?>
                <tr>
                    <th>image</th>
                    <td><img src="product_images/<?php echo $row2['image_name']?>" height="100" width="100">delete:<input type="checkbox" name="deleteCheck[]" value="<?php echo $row2["image_name"]; ?>"></td>

                </tr>
                <?php
            }
            ?>
            <tr>
                <th>image</th>
                <td><b>Select a image to upload:</b><br><input type="file" size="50" name="upload_image"></td>
            </tr>
        </table>
        <br/>
        <table align="center">
            <tr>
                <td><input type="submit" value="Update product"></td>
                <td><input type="button" value="Return to List" OnClick="window.location='product.php'"></td>
            </tr>
        </table>
    </form>
    <?php
    break;

case "ConfirmUpdate":
    {
        $query="UPDATE product set product_name='$_POST[name]', 
product_purchase_price='$_POST[purchase_price]', product_sale_price='$_POST[sale_price]', product_country_of_origin='$_POST[country]' WHERE product_id =".$_GET["product_id"];
        $result= $conn->query($query);
        if($_FILES['upload_image']['size'] == 0) {}else{
            $temp = explode(".", $_FILES["upload_image"]["name"]);
            $id=$_GET['product_id'] ;
            $name=$_POST['name'];
            $newfilename = $id . '_' . $name .'_'.date('dmYHis'). '.' . end($temp);
            $upfile = "product_images/" . $newfilename;
            if ($_FILES["upload_image"]["type"] != "image/gif" && $_FILES["upload_image"]["type"] != "image/pjpeg" && $_FILES["upload_image"]["type"] != "image/jpeg" && $_FILES["upload_image"]["type"] != "image/png") {
                echo "ERROR: You may only upload .jpg or .gif or.png files";
            } else {
                move_uploaded_file($_FILES["upload_image"]["tmp_name"], $upfile);
                $query = "INSERT into product_image(product_id, image_name) VALUES ('$id','$newfilename') ";
                $conn->query($query);
            }
        }
        if(!isset($_POST["deleteCheck"])){}else{
              foreach ($_POST["deleteCheck"] as $deleteName) {
                  $query = "DELETE FROM product_image WHERE image_name= '$deleteName'";
                  $conn->query($query);
                  unlink("product_images/".$deleteName);
              }
        }
        header("Location: product.php");
    }
    break;

case "Delete":
    ?>
    <h3 align="center">Confirm deletion of the following product record<br /></h3><p />
    <table border="1"  align="center">
        <tr>
            <td><b>product_id.</b></td>
            <td><?php echo $row["product_id"]; ?></td>
        </tr>
        <tr>
            <td><b>product_name</b></td>
            <td><?php echo $row["product_name"]; ?></td> </tr>
    </table>
    <br/>
    <table align="center">
        <tr>
            <td>
                <input type="button" value="Confirm" OnClick="confirm_delete();"></td>
            <td>
                <input type="button" value="Cancel" OnClick="window.location='product.php'">
            </td>
        </tr>
    </table>
    <?php
    break;

case "ConfirmDelete":
$query="DELETE FROM product  WHERE product_id =".$_GET["product_id"];
if($conn->query($query))
{
?>
<center>
    The following product record has been successfully deleted<br />
    <?php
    echo"ID: ". $row["product_id"]." name: ".$row["product_name"];
    echo "</center><p />";
    }
    else
    {
        echo "<h3 align='center'>Error deleting product record<p /></h3>";
    }
    echo "<center><input type='button' value='Return to List' OnClick='window.location=\"product.php\"'></center>";

    break;



    }


    $result->free_result();
    $conn->close();
    ?>
</body>
</html>