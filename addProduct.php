<html>
<head><title></title></head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>

<?php
if (empty($_POST["name"]))
{
    ?>
    <center><h3>product Details</h3></center>
    <form method="post" enctype="multipart/form-data" action="addProduct.php">
        <center>Welcome to our Web Site<p />
            Please enter your product details for our database</center>
        <table border = "1" align="center">
            <tr>
                <th>Name</th>
                <td><input type="text" size="30" maxlength="30" name="name"></td>
            </tr>
            <tr>
                <th>Purchase price</th>
                <td><input type="number" size="10" maxlength="10" name="purchase_price"></td>
            </tr>
            <tr>
                <th>Sale price</th>
                <td><input type="number" size="10" maxlength="10" name="sale_price"></td>
            </tr>
            <tr>
                <th>Country of origin</th>
                <td><input type="text" size="40" maxlength="40" name="country"></td>
            </tr
            <tr>
                <th> image</th>
                <td><b>Select a image to upload:</b><br><input type="file" size="50" name="upload_image"></td>
            </tr>
        </table>
        <p />
        <center>
            <input type="submit" value="Add Details">
            <input type="reset" value="Clear Details">
            <a href="product.php">Back</a>
        </center>
    </form>
<?php
}
else
{
    include("connection.php");
    $conn = new mysqli($Host, $UName, $PWord, $DB)
    or die("Couldn't log on to database");
    $query = "INSERT INTO product (product_name,product_purchase_price,product_sale_price,product_country_of_origin) VALUES
                ( '$_POST[name]','$_POST[purchase_price]','$_POST[sale_price]','$_POST[country]') ";
    if (!$conn->query($query))
    {
        //echo mysqli_error($conn);
        ?>
            <script language="JavaScript">
                alert("Error adding record. Contact System Administrator");
                window.location.href = "addProduct.php";
            </script>
        <?php
    }
    else
    { if($_FILES['upload_image']['size'] == 0) {
        ?>
        <script language="JavaScript">
            alert("Product record successfully added to database");
            window.location.href = "product.php";
        </script>

    <?php
    }else{
            $temp = explode(".", $_FILES["upload_image"]["name"]);
        $id = $conn->insert_id;
        $name = $_POST['name'];
        $newfilename = $id . '_' . $name .'_'.date('dmYHis'). '.' . end($temp);
        $upfile = "product_images/" . $newfilename;
        if ($_FILES["upload_image"]["type"] != "image/gif" && $_FILES["upload_image"]["type"] != "image/pjpeg" && $_FILES["upload_image"]["type"] != "image/jpeg" && $_FILES["upload_image"]["type"] != "image/png") {
            echo "ERROR: You may only upload .jpg or .gif or.png files";
        } else {
            move_uploaded_file($_FILES["upload_image"]["tmp_name"], $upfile);
            $query = "INSERT into product_image(product_id, image_name) VALUES ('$id','$newfilename') ";
            if(!$conn->query($query))
            {

            ?>
            <script language="JavaScript">
                alert("Error storing image. Contact System Administrator");
                window.location.href = "addProduct.php";
            </script>
            <?php
            }else{
            ?>
                <script language="JavaScript">
                    alert("Product record successfully added to database");
                    window.location.href = "product.php";
                </script>
                <?php
                $conn->close();
            }
        }

    }
}
}
?>
</body>
</html>