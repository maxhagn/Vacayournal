<?php
include("session.php");
$error = 0;
$user = "";
$section = "";

if ( !isset($_REQUEST['cUser'], $_REQUEST['cSection']) ) {
    $error = 1;
} else {
    $user = $_REQUEST['cUser'];
    $section = $_REQUEST['cSection'];
}

if ( $error == 0 ) {
    if ($section == "Timeline") {
        $error = FALSE;
        $cStart = 0;
        $cEnd = 1000;
        if ($user_timeline = $database->prepare('SELECT id AS id, username  AS username, NULL AS path, post AS post, NULL AS format, created AS created, \'post\' AS type FROM posts WHERE username=? UNION SELECT id AS id, username AS username, path AS path, NULL AS post, format AS format,created AS created, \'image\' AS type FROM images WHERE username=? UNION SELECT id AS id, username AS username, path AS path, NULL AS post, NULL AS format,created AS created, \'video\' AS type FROM videos WHERE username=? ORDER BY created DESC LIMIT ? OFFSET ?')) {
            $user_timeline->bind_param("sssii", $user, $user, $user, $cEnd, $cStart );
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

    } elseif ($section == "Images") {

        if ($user_images = $database->prepare('SELECT id, username, path FROM images WHERE username=? AND gallery<>"P" ORDER BY created DESC')) {
            $user_images->bind_param("s", $user);
            $user_images->execute();
            $result = $user_images->get_result();
            $Images = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        echo "<div class=\"col-xs-12 col-sm-10 col-md-8 col-lg-6\">";
        DisplayImages($Images, $database);
        echo "</div><div id=\"action_modal_wrapper\" class=\"modal\"></div>";

    } elseif ($section == "Videos") {
        if ($user_videos = $database->prepare('SELECT id, username, path FROM videos WHERE username=? ORDER BY created DESC')) {
            $user_videos->bind_param("s", $user);
            $user_videos->execute();
            $result = $user_videos->get_result();
            $Videos = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        echo "<div class=\"col-xs-12 col-xs-10 col-xs-10 col-xs-10 center-xs\">";
        DisplayVideos($Videos, $database);
        echo "</div>";

    } elseif ($section == "Posts") {
        if ($user_posts = $database->prepare('SELECT username, post, created FROM posts WHERE username=? ORDER BY created DESC')) {
            $user_posts->bind_param("s", $user);
            $user_posts->execute();
            $result = $user_posts->get_result();
            $Posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }


        echo "<div class=\"col-xs-12 col-xs-10 col-xs-10 col-xs-10 center-xs\">";
        DisplayPosts($Posts, $database);
        echo "</div>";

    } elseif ($section == "Trips") {
        if ($user_trips = $database->prepare('SELECT id, title, description, time_span, group_type, trip_type, transport_type, country, place, created, username, licenses FROM trips WHERE username=? ORDER BY created ASC')) {
            $user_trips->bind_param("s", $user);
            $user_trips->execute();
            $result = $user_trips->get_result();
            $Trips = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        echo "<div class=\"col-xs-12 col-xs-10 col-xs-10 col-xs-10 center-xs\">";
        DisplayTrips($Trips, $database);
        echo "</div><div id=\"action_modal_wrapper\" class=\"modal\"></div>";

    } elseif ($section == "Infos") {
        echo <<<EOF
            <div class="col-xs-12 col-xs-10 col-xs-10 col-xs-10 center-xs">
            
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