<?php
include("../essentials/session.php");

$can_post = TRUE;

if ( !isset($_REQUEST['cComment'], $_REQUEST['cElem'], $_REQUEST['cType']) ) {
    $can_post = FALSE;
}

if ( $can_post ) {
    if ($insert_comment = $database->prepare('INSERT INTO comments (user_id, element_id, type, comment, created) VALUES (?,?,?,?,NOW())')) {
        $insert_comment->bind_param('ssss', $_SESSION['id'], $_REQUEST['cElem'], $_REQUEST['cType'], $_REQUEST['cComment']);
        $insert_comment->execute();
        $insert_comment->close();
    }
}

