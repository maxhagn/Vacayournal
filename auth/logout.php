<?php
include("../resources/config/config.php");
session_start();
$NULL= "NULL";
$session = $database->prepare('UPDATE users SET session=? AND changed=NOW() WHERE id=?');
$session->bind_param('ss', $NULL, $_SESSION['id']);
$session->execute();
session_destroy();
header('Location: /');
?>