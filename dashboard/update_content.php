<?php
session_start();
require "../config.php";

require "./php_scripts/head_scripts.php";

if (!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true) {
    header("location: index.php");
    exit;
}
