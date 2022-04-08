<?php
include("../../essentials/session.php");
$error = 0;
$cUserId = "";
$cUserName = "";
$cSection = "";

if ( !isset($_REQUEST['cUserId'], $_REQUEST['cSection']) ) {
    $error = 1;
} else {
    $cUserId = $_REQUEST['cUserId'];
    $cUserName = GetUserName( $cUserId, $database );
    $cSection = $_REQUEST['cSection'];
}

if ( $error == 0 ) {
    if ( $cSection == "Timeline" ) {
        $error = FALSE;
        $cStart = 0;
        $cEnd = 1000;
        if ($user_timeline = $database->prepare('SELECT id AS id, user_id AS user_id, NULL AS path, post AS post, NULL AS format, created AS created, \'post\' AS type FROM posts WHERE user_id=? UNION SELECT id AS id, user_id AS user_id, path AS path, NULL AS post, format AS format,created AS created, \'image\' AS type FROM images WHERE user_id=? UNION SELECT id AS id, user_id AS user_id, path AS path, NULL AS post, NULL AS format,created AS created, \'video\' AS type FROM videos WHERE user_id=? ORDER BY created DESC LIMIT ? OFFSET ?')) {
            $user_timeline->bind_param("sssii",$cUserId, $cUserId, $cUserId, $cEnd, $cStart );
            $user_timeline->execute();
            $result = $user_timeline->get_result();
            $Data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            $error = TRUE;
        }

        if ( $error == FALSE ) {
            echo "<div class=\"col-xs-12 col-sm-10 col-md-10 col-lg-10\">";
                DisplayTimeline($Data, $database);
            echo "</div>";
        }

    } elseif ($cSection == "Images") {

        $PROFILE_IMAGES = "P";
        if ($user_images = $database->prepare('SELECT id, user_id, path FROM images WHERE user_id=? AND gallery<>? ORDER BY created DESC')) {
            $user_images->bind_param("ss", $cUserId, $PROFILE_IMAGES);
            $user_images->execute();
            $result = $user_images->get_result();
            $Images = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        echo "<div class=\"col-xs-12 col-sm-10 col-md-8 col-lg-6\">";
        DisplayImages($Images, $database);
        echo "</div><div id=\"action_modal_wrapper\" class=\"modal\"></div>";

    } elseif ($cSection == "Videos") {
        if ($user_videos = $database->prepare('SELECT id, user_id, path FROM videos WHERE user_id=? ORDER BY created DESC')) {
            $user_videos->bind_param("s", $cUserId);
            $user_videos->execute();
            $result = $user_videos->get_result();
            $Videos = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        echo "<div class=\"col-xs-12 col-xs-10 col-xs-10 col-xs-10 center-xs\">";
        DisplayVideos($Videos, $database);
        echo "</div>";

    } elseif ($cSection == "Posts") {
        if ($user_posts = $database->prepare('SELECT id, user_id, post, created FROM posts WHERE user_id=? ORDER BY created DESC')) {
            $user_posts->bind_param("s", $cUserId);
            $user_posts->execute();
            $result = $user_posts->get_result();
            $Posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }


        echo "<div class=\"col-xs-12 col-xs-10 col-xs-10 col-xs-10 center-xs\">";
        DisplayPosts($Posts, $database);
        echo "</div>";

    } elseif ($cSection == "Trips") {
        if ($user_trips = $database->prepare('SELECT id, title, description, time_span, group_type, trip_type, transport_type, country, place, created, user_id, licenses FROM trips WHERE user_id=? ORDER BY created ASC')) {
            $user_trips->bind_param("s", $cUserId);
            $user_trips->execute();
            $result = $user_trips->get_result();
            $Trips = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        echo "<div class=\"col-xs-12 col-xs-10 col-xs-10 col-xs-10 center-xs\">";
        DisplayTrips($Trips, $database);
        echo "</div><div id=\"action_modal_wrapper\" class=\"modal\"></div>";

    } elseif ($cSection == "Infos") {
        echo <<<EOF
            <div class="col-xs-6 center-xs">
                <h1>IM BAU</h1>
                <div class="row">
                    <div class="col-sm-4">
                        <p>Reist häufig mit: </p>
                    </div>
                    <div class="col-sm-8">
                    
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-4">
                        <p>Reist häufig mit: </p>
                    </div>
                    <div class="col-sm-8">
                    
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-4">
                        <p>Reist häufig mit: </p>
                    </div>
                    <div class="col-sm-8">
                    
                    </div>
                </div>
            
            </div>
EOF;
    }
}
?>