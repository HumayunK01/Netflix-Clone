<?php
session_start();

require_once "../config.php";

if (!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true) {
    header("location: index.php");
    exit;
}

?>

<?php include "./layout/header.php";?>

<iframe src="content.php" frameborder="0" id="dynamic_iframe" style="height:100vh; width:100%;"></iframe>


<?php include "./layout/footer.php";?>