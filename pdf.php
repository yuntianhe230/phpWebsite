<?php ob_start();
require "vendor/autoload.php";
include("connection.php");
include("createPDF.php");
?>

<html>
<head>
    <title>PHP PDF Creation</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<h1>Create PDF</h1>
<?php
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh = new PDO($dsn,$UName,$PWord);

$stmt = $dbh->prepare("SELECT * FROM client ORDER BY client_id");
$stmt->execute();
$allRows=$stmt->fetchAll(PDO::FETCH_ASSOC);

//Column titles
$header = array('Client_Id', 'Name', 'Address', 'Contact');
//Column Widths
$headerWidth=array(150,250,300,200);

//create new instance of my CreatePDF class
$PDF = new createPDF();

//pass it headers, headerWidth and data
$table = $PDF->clientPDF($header, $headerWidth, $allRows);

echo $table;
echo "<br />";
echo "<a href='PDFS/clients.pdf'>Click here to see PDF</a>";
echo "<br />";
//echo dirname($_SERVER["SCRIPT_FILENAME"]);
?>

</body>
</html>