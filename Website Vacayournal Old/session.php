<?php
include('resources/config/config.php');
include('essentials.php');
session_start();

if (!isset($_SESSION['loggedin'])) {
    $NULL= "";
    $session = $database->prepare('UPDATE users SET session=?, changed=NOW() WHERE name=?');
    $session->bind_param('ss', $NULL, $_SESSION['name']);
    $session->execute();
    session_destroy();
    header('Location: index.php');
    exit();
} else {
    $session_id= session_id( );
    $session = $database->prepare('UPDATE users SET session=?, changed=NOW() WHERE name=?');
    $session->bind_param('ss', $session_id, $_SESSION['name']);
    $session->execute();
}

$inactive = 60000;
if( !isset($_SESSION['timeout']) ) {
    $_SESSION['timeout'] = time() + $inactive;
}

$session_life = time() - $_SESSION['timeout'];

if( $session_life > $inactive ) {
    $NULL= "";
    $session = $database->prepare('UPDATE users SET session=?, changed=NOW() WHERE name=?');
    $session->bind_param('ss', $NULL, $_SESSION['name']);
    $session->execute();
    session_destroy();
    header("Location: index.php");
    exit();
}
?>