<?php
include('session.php');
include('html_header.php');
include('dashboard_header.php');

$current_user = "";
$following = "";
if (isset($_REQUEST['tUsername'])) {
    $current_user = $_REQUEST['tUsername'] ;
    $current_user = urldecode( $current_user );

    if ($select_followed = $database->prepare('SELECT follower FROM follower WHERE follower=? AND followed=?')) {
        $select_followed->bind_param('ss', $_SESSION['name'], $current_user);
        $select_followed->execute();
        $select_followed->store_result();
        $following = $select_followed->num_rows;
        $select_followed->close();

        if ( $following > 0 ) {
            $following = TRUE;
        } else {
            $following = FALSE;
        }
    }

} else {
    $current_user = $_SESSION['name'];
}

if ($user_posts = $database->prepare('SELECT username, post, created FROM posts WHERE username=? ORDER BY created DESC')) {
    $user_posts->bind_param('s', $current_user);
    $user_posts->execute();
    $result = $user_posts->get_result();
    $Posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $user_posts->close();
}

if ($select_user_data = $database->prepare('SELECT name, email, slogan, nickname, home_country FROM users WHERE name=?')) {
    $select_user_data->bind_param('s', $current_user);
    $select_user_data->execute();
    $select_user_data->bind_result($tName, $tEmail, $tSlogan, $tNickname, $tHomeCountry);
    $select_user_data->fetch();
    $select_user_data->close();
}

if ($count_trips = $database->prepare('SELECT COUNT(*) FROM trips WHERE username=?')) {
    $count_trips->bind_param('s', $current_user);
    $count_trips->execute();
    $count_trips->bind_result($cTrips);
    $count_trips->fetch();
    $count_trips->close();
}

if ($count_posts = $database->prepare('SELECT COUNT(*) FROM posts WHERE username=?')) {
    $count_posts->bind_param('s', $current_user);
    $count_posts->execute();
    $count_posts->bind_result($cPosts);
    $count_posts->fetch();
    $count_posts->close();
}

if ($count_images = $database->prepare('SELECT COUNT(*) FROM images WHERE username=?')) {
    $count_images->bind_param('s', $current_user);
    $count_images->execute();
    $count_images->bind_result($cImages);
    $count_images->fetch();
    $count_images->close();
}

if ($count_videos = $database->prepare('SELECT COUNT(*) FROM videos WHERE username=?')) {
    $count_videos->bind_param('s', $current_user);
    $count_videos->execute();
    $count_videos->bind_result($cVideos);
    $count_videos->fetch();
    $count_videos->close();
}

if ($count_follower = $database->prepare('SELECT COUNT(*) FROM follower WHERE followed=?')) {
    $count_follower->bind_param('s', $current_user);
    $count_follower->execute();
    $count_follower->bind_result($cFollower);
    $count_follower->fetch();
    $count_follower->close();
}

if ($count_followed = $database->prepare('SELECT COUNT(*) FROM follower WHERE follower=?')) {
    $count_followed->bind_param('s', $current_user);
    $count_followed->execute();
    $count_followed->bind_result($cFollowed);
    $count_followed->fetch();
    $count_followed->close();
}

$tCountryCode = "";
$tCountryName = "";
if ($select_country_info = $database->prepare('SELECT country_code, country_name FROM countries WHERE id=?')) {
    $select_country_info->bind_param('i', $tHomeCountry);
    $select_country_info->execute();
    $select_country_info->bind_result($tCountryCode, $tCountryName);
    $select_country_info->fetch();
    $select_country_info->close();
}
$tCountryCode = strtolower($tCountryCode);


$iPath = GetProfilePicture( $current_user, $database );

ShowHeader("user", $database);

echo <<<EOF
    <script>
        window.onload = function(){CallUserSection('$current_user', 'Timeline');};
    </script>
    <main class="s_dashboard">
        <div class="container">
            <div class="row center-xs">
                <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6" style="text-align: left">
                    <section class="s_user_preview h_margin_top_large">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="h_round_image" style="background-image: url($iPath);">
                    
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                <div class="row h_margin_bottom">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                       <span class="f_user_title">${tName}
EOF;

                    if ( $tCountryCode != "" ) {
                        echo "&nbsp;(&nbsp;&nbsp;<span class=\"flag-icon flag-icon-${tCountryCode}\"></span>&nbsp;&nbsp;)";
                    }

                    echo <<<EOF
                                       </span>
                                    </div>
EOF;

                    if ( $_SESSION['name'] != $current_user && $following == FALSE) {


                                    echo <<<EOF
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <button onclick="CallFollow( '${current_user}', '0' );">
                                            Auch folgen
                                        </button>
                                        <button onclick="location.href='#'">
                                            <i class="fas fa-angle-double-right"></i>
                                        </button>
                                    </div>
EOF;
                    } elseif ( $_SESSION['name'] != $current_user && $following == TRUE) {
                        echo <<<EOF
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <button onclick="if(confirm('Möchtest du ${current_user} wirklich nicht mehr Folgen?')) { CallFollow( '${current_user}', '1'); }">
                                            Abonniert
                                        </button>
                                        <button onclick="location.href='#'">
                                            <i class="fas fa-angle-double-right"></i>
                                        </button>
                                    </div>
EOF;
                    }
                                echo <<<EOF
                                </div>
                                <div class="row f_user_stats">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <b>${cTrips}</b> Reisen
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <b>${cPosts}</b> Posts
                                    </div>
                                </div>
                                <div class="row f_user_stats">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <b>${cImages}</b> Bilder
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <b>${cVideos}</b> Videos
                                    </div>
                                </div>
                                <div class="row f_user_stats h_margin_bottom">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
EOF;
                    if ( $cFollower > 0 ) {
                        echo "<a onclick=\"ToggleUserModal('${current_user}', '', 'followed');\"><b>${cFollower}</b> Abonenten</a>";
                    } else {
                        echo "<b>${cFollower}</b> Abonenten";
                    }
                                echo <<<EOF
                                    </div>                                   
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
EOF;
                    if ( $cFollowed > 0 ) {
                        echo "<a onclick=\"ToggleUserModal('${current_user}', '', 'following');\"><b>${cFollowed}</b> Abonniert</a>";
                    } else {
                        echo "<b>${cFollowed}</b> Abonniert";
                    }


                                echo <<<EOF
                                        
                                    </div>
                                </div>
                                <div class="row f_user_info">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <b>${tNickname}</b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                ${tSlogan}
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            
EOF;
            if ( $_SESSION["name"] == $current_user ) {
            echo <<<EOF
            <div class="row s_upload h_margin_vertical">
                <div class="col-xs-12 center-xs">
                    <div class="b_button_container">
                        <button title="Hochladen" class="b_hoverable_action" id="select_button"><i class="fas fa-plus"></i></button>
                        <button title="Fotos hochladen" class="b_add_action" id="button_image" onclick="CallAdd( 'Images' );"><i class="far fa-images"></i></button>
                        <button title="Videos hochladen" class="b_add_action" id="button_video" onclick="CallAdd( 'Videos' );"><i class="fas fa-video"></i></button>
                        <button title="Beiträge schreiben" class="b_add_action" id="button_post" onclick="CallAdd( 'Posts' );"><i class="fas fa-pen"></i></button>
                        <button title="Reise hinzufügen" class="b_add_action" id="button_trip" onclick="CallAdd( 'Trips' );"><i class="fas fa-suitcase"></i></button>
                    </div>
                </div>
            </div>
            <div class="row s_action_add_section" id="action_add_section">
EOF;
            }
            echo <<<EOF
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <nav class="s_user_navigation">
EOF;
                    if ( ($cTrips + $cPosts + $cImages + $cVideos) > 0 ) {
                        echo "<a class=\"h_reset_active\" id=\"action_section_Timeline\" onclick=\"CallUserSection( '$current_user', 'Timeline');\">Timeline</a>";
                    }
                    if ( $cImages > 0 ) {
                        echo "<a class=\"h_reset_active\" id=\"action_section_Images\" onclick=\"CallUserSection('$current_user', 'Images');\">Fotografien</a>";
                    }
                    if ( $cVideos > 0 ) {
                        echo "<a class=\"h_reset_active\" id=\"action_section_Videos\" onclick=\"CallUserSection('$current_user', 'Videos');\">Videografien</a>";
                    }
                    if ( $cPosts > 0 ) {
                        echo "<a class=\"h_reset_active\" id=\"action_section_Posts\" onclick=\"CallUserSection( '$current_user', 'Posts');\">Beiträge</a>";
                    }
                    if ( $cTrips > 0 ) {
                        echo "<a class=\"h_reset_active\" id=\"action_section_Trips\" onclick=\"CallUserSection( '$current_user', 'Trips');\">Reisen</a>";
                    }

echo <<<EOF
                        <a class="h_reset_active" id="action_section_Infos" onclick="CallUserSection( '$current_user', 'Infos');">Informationen</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row center-xs" id="profile_sections_action_wrapper">
        
        </div>
    </main>
EOF;

echo "<div id=\"action_user_modal_wrapper\" class=\"s_user_modal\"></div>";

?>


</body>
</html>