<?php
include("../essentials/session.php");

if ( $_REQUEST['cStatus'] == 0 ) {
    $can_post = TRUE;

    if ( !isset($_REQUEST['cElem'], $_REQUEST['cType']) ) {
        $can_post = FALSE;
    }

    if ( $can_post == TRUE ) {
        if ($insert_like = $database->prepare('INSERT INTO likes (user_id, element_id, type, created) VALUES (?,?,?,NOW())')) {
            $insert_like->bind_param('sss', $_SESSION['id'], $_REQUEST['cElem'], $_REQUEST['cType']);
            $insert_like->execute();
            $insert_like->close();
        }
    }
} elseif ( $_REQUEST['cStatus'] == 1 ) {
    $can_delete = TRUE;

    if ( !isset($_REQUEST['cElem'], $_REQUEST['cType']) ) {
        $can_post = FALSE;
    }

    if ( $can_delete == TRUE ) {
        if ($delete_like = $database->prepare('DELETE FROM likes WHERE user_id=? AND element_id=? AND type=?')) {
            $delete_like->bind_param('sss', $_SESSION['id'], $_REQUEST['cElem'], $_REQUEST['cType']);
            $delete_like->execute();
            $delete_like->close();
        }
    }

}

?>