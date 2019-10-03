<?php
ob_start();
session_start();
if((!isset($_SESSION["loggedin"])|| $_SESSION["loggedin"]!=true))
{
    header("location:login.php");
}
?>
<html>
<body>
<?php
$currdir = dirname($_SERVER["SCRIPT_FILENAME"])."/product_images";

$dir = opendir($currdir);

echo "<br /><br />";
echo "<h1>Contents of images</h1>";
while($file = readdir($dir))
{
    if($file == "." || $file =="..")
    {
        continue;
    }
    echo $file."<br />";
}
closedir($dir);

?>
</body>
</html>
