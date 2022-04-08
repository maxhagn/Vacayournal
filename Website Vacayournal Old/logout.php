<?php
include("resources/config/config.php");
session_start();
$NULL= "NULL";
$session = $database->prepare('UPDATE users SET session=? AND changed=NOW() WHERE name=?');
$session->bind_param('ss', $NULL, $_SESSION['name']);
$session->execute();
session_destroy();
header('Location: index.php');
?>