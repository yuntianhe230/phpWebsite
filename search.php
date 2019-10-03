<html>
<head><title></title></head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>

<?php
    include("connection.php");
    $conn = new mysqli($Host, $UName, $PWord, $DB)
    or die("Couldn't log on to database");
    $keyword = $_POST["keyword"];
$query=" SELECT * FROM product as prod INNER JOIN  product_category   prod_cate on prod.product_id = prod_cate.product_id
 INNER JOIN  category c on prod_cate.category_id = c.category_id WHERE C.category_name LIKE '%{$keyword}%'";
    $pquery = mysqli_prepare($conn, $query);
    $pquery->execute();
    $result = $pquery->get_result();
    $product_list=array();
    if (mysqli_num_rows($result)==0) {
        ?>
    <script language="JavaScript">
        alert("No result found");
        window.location.href="product.php";
    </script>
        <?php
    }else{
        ?>
        <center><h3>Product Details</h3></center>
        <p/>
        <table border="1" align="center">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Purchase price</th>
                <th>Sale price</th>
                <th>Country of origin</th>
                <th colspan="3">Options</th>
            </tr>
            <?php
            while ($row = $result->fetch_array()) {
                $id=$row["product_id"];
                if(in_array($id,$product_list)){
                }else{
               array_push($product_list,$id);
                ?>
                <tr>
                    <td><?php echo $row["product_id"]; ?></td>
                    <td><?php echo $row["product_name"]; ?></td>
                    <td><?php echo $row["product_purchase_price"]; ?></td>
                    <td><?php echo $row["product_sale_price"]; ?></td>
                    <td><?php echo $row["product_country_of_origin"]; ?></td>
                    <td><a href="productModify.php?product_id=<?php echo $row["product_id"]; ?>&Action=View">View</a></td>
                    <td><a href="productModify.php?product_id=<?php echo $row["product_id"]; ?>&Action=Update">Update</a></td>
                    <td><a href="productModify.php?product_id=<?php echo $row["product_id"]; ?>&Action=Delete">Delete</a></td>
                </tr>
                <?php
            }
                }

            ?>
        </table>
        <?php
        $result->free_result();
        $conn->close();
    }

?>
</body>
</html>