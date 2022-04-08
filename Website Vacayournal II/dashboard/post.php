<?php
include("../essentials/session.php");
$can_post = TRUE;

if ( !isset($_POST['new_post']) ) {
    $can_post = FALSE;
    $_SESSION['post_error'] = "Es wurde kein Text eingegeben!";
}

if ( $can_post ) {
    if ($insert_post = $database->prepare('INSERT INTO posts (username, post, created) VALUES (?,?,NOW())')) {
        $insert_post->bind_param('ss', $_SESSION['name'], $_POST['new_post']);
        $insert_post->execute();
        $insert_post->close();

        header('Location: index.php');
    }
} else {
    $_SESSION['post_error'] = "Der Post konnte nicht gespeichert werden!";
    header('Location: index.php');
}