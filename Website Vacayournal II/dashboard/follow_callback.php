<?php
include("../essentials/session.php");


if ( isset($_REQUEST['cFollow']) ) {
    if ( isset($_REQUEST['cAction']) && $_REQUEST['cAction'] == 0 ) {
        if ($insert_follow = $database->prepare('INSERT INTO follower (follower_id, followed_id, created) VALUES (?, ?, NOW())')) {
            $insert_follow->bind_param('ss', $_SESSION['id'], $_REQUEST['cFollow']);
            $insert_follow->execute();
            $insert_follow->close();
        } else {
            echo "ERROR";
        }
    } elseif ( isset($_REQUEST['cAction']) && $_REQUEST['cAction'] == 1 ) {
        if ($delete_follow = $database->prepare('DELETE FROM follower WHERE follower_id=? AND followed_id=?')) {
            $delete_follow->bind_param('ss', $_SESSION['id'], $_REQUEST['cFollow']);
            $delete_follow->execute();
            $delete_follow->close();
        } else {
            echo "ERROR";
        }
    }

} else {
    echo "ERROR";
}


