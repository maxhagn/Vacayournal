<?php

$path = $_SERVER['DOCUMENT_ROOT'] . "/website/resources/config/config.php";

include($path);
include('essentials.php');
session_start();

if (!isset($_SESSION['loggedin'])) {
    $NULL= "";
    $session = $database->prepare('UPDATE users SET session=?, changed=NOW() WHERE id=?');
    $session->bind_param('ss', $NULL, $_SESSION['id']);
    $session->execute();
    session_destroy();
    header('Location: /website/index.php');
    exit();
} else {
    $session_id= session_id( );
    $session = $database->prepare('UPDATE users SET session=?, changed=NOW() WHERE id=?');
    $session->bind_param('ss', $session_id, $_SESSION['id']);
    $session->execute();
}

$inactive = 60000;
if( !isset($_SESSION['timeout']) ) {
    $_SESSION['timeout'] = time() + $inactive;
}

$session_life = time() - $_SESSION['timeout'];

if( $session_life > $inactive ) {
    $NULL= "";
    $session = $database->prepare('UPDATE users SET session=?, changed=NOW() WHERE id=?');
    $session->bind_param('ss', $NULL, $_SESSION['id']);
    $session->execute();
    session_destroy();
    header("Location: /website/index.php");
    exit();
}
?>