<?php

$cUser = "";
$cStart = "";
$cEnd = "";

if( !isset($_REQUEST['cUser'],$_REQUEST['cStart'],$_REQUEST['cEnd']) ) {

} else {
    include("session.php");
    $cUser = $_REQUEST['cUser'];
    $cStart = $_REQUEST['cStart'];
    $cEnd = $_REQUEST['cEnd'];
    Timeline( $cUser, $cStart, $cEnd, $database );
}

function Timeline( $cUser, $cStart, $cEnd, $database ) {
    $error = FALSE;

    if ($user_timeline = $database->prepare('SELECT id AS id, username  AS username, NULL AS path, post AS post, NULL AS format, created AS created, \'post\' AS type FROM posts WHERE username=? UNION SELECT id AS id, username AS username, path AS path, NULL AS post, format AS format,created AS created, \'image\' AS type FROM images WHERE username=? UNION SELECT id AS id, username AS username, path AS path, NULL AS post, NULL AS format,created AS created, \'video\' AS type FROM videos WHERE username=? ORDER BY created DESC LIMIT ? OFFSET ?')) {
        $user_timeline->bind_param("sssii", $cUser, $cUser, $cUser, $cEnd, $cStart );
        $user_timeline->execute();
        $result = $user_timeline->get_result();
        $Data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = TRUE;
    }

    if ( $error == FALSE ) {
        echo "<div class=\"col-sm-offset-2 col-sm-8 center-sm\">";
            DisplayTimeline( $Data, $database );
        echo "</div>";
    }
}


