<?php 
session_start();
$_SESSION["ID"] = null;
header("Location: ../../ModuleA/index.php");
?>