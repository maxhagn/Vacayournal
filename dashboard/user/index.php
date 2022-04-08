<?php
include('../../essentials/session.php');
include('../../essentials/html_header.php');
include('../../essentials/dashboard_header.php');

$PROFILE_IMAGES = "P";
$cFollower = "";
$cFollowed = "";
$following = "";
$cUserId = "";

if (isset($_REQUEST['cUserId'])) {
    $cUserId = $_REQUEST['cUserId'];
} else {
    $cUserId = $_SESSION['id'];
}

$cUserName = GetUserName( $cUserId, $database );
$following = IsFollowing( $cUserId, $database );
$iPath = GetProfilePicture( $cUserId, $database );

// Get Data
if ($user_posts = $database->prepare('SELECT user_id, post, created FROM posts WHERE user_id=? ORDER BY created DESC')) {
    $user_posts->bind_param('s', $cUserId);
    $user_posts->execute();
    $result = $user_posts->get_result();
    $Posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $user_posts->close();
}
if ($select_user_data = $database->prepare('SELECT first_name, last_name, email, slogan, nickname FROM users WHERE id=?')) {
    $select_user_data->bind_param('s', $cUserId);
    $select_user_data->execute();
    $select_user_data->bind_result($tFirstName, $tLastname, $tEmail, $tSlogan, $tNickname );
    $select_user_data->fetch();
    $select_user_data->close();
}
if ($count_trips = $database->prepare('SELECT COUNT(*) FROM trips WHERE user_id=?')) {
    $count_trips->bind_param('s', $cUserId);
    $count_trips->execute();
    $count_trips->bind_result($cTrips);
    $count_trips->fetch();
    $count_trips->close();
}
if ($count_posts = $database->prepare('SELECT COUNT(*) FROM posts WHERE user_id=?')) {
    $count_posts->bind_param('s', $cUserId);
    $count_posts->execute();
    $count_posts->bind_result($cPosts);
    $count_posts->fetch();
    $count_posts->close();
}
if ($count_images = $database->prepare('SELECT COUNT(*) FROM images WHERE user_id=? AND gallery<>?')) {
    $count_images->bind_param('ss', $cUserId, $PROFILE_IMAGES);
    $count_images->execute();
    $count_images->bind_result($cImages);
    $count_images->fetch();
    $count_images->close();
}
if ($count_videos = $database->prepare('SELECT COUNT(*) FROM videos WHERE user_id=?')) {
    $count_videos->bind_param('s', $cUserId);
    $count_videos->execute();
    $count_videos->bind_result($cVideos);
    $count_videos->fetch();
    $count_videos->close();
}
if ($count_follower = $database->prepare('SELECT COUNT(*) FROM follower WHERE followed_id=?')) {
    $count_follower->bind_param('s', $cUserId);
    $count_follower->execute();
    $count_follower->bind_result($cFollower);
    $count_follower->fetch();
    $count_follower->close();
}
if ($count_followed = $database->prepare('SELECT COUNT(*) FROM follower WHERE follower_id=?')) {
    $count_followed->bind_param('s', $cUserId);
    $count_followed->execute();
    $count_followed->bind_result($cFollowed);
    $count_followed->fetch();
    $count_followed->close();
}
if ($select_geo = $database->prepare('SELECT country FROM geo_user WHERE user_id=?')) {
    $select_geo->bind_param('s', $cUserId);
    $select_geo->execute();
    $select_geo->bind_result($cCountry);
    $select_geo->fetch();
    $select_geo->close();
}
$cCountry = strtolower($cCountry);




ShowHeader("user", $database);



echo <<<EOF
    <script>
        window.onload = function(){CallUserSection('${cUserId}', 'Timeline');};
    </script>
    
    <link  href="../../resources/scripts/cropperjs-master/dist/cropper.css" rel="stylesheet">
    <script src="../../resources/scripts/cropperjs-master/dist/cropper.js"></script>
    
    <main style="padding-top: 0;" class="s_dashboard">
    <div class="s_title_image" style="background-image: url('/resources/images/bg.jpg');"></div>
        <div class="container">
            <div class="row center-xs">
                <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6" style="text-align: left">
                    <section class="s_user_preview h_margin_top_large">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="h_round_image h_edit_profile i_profile_image_edit" style="background-image: url(${iPath});">
                                    <div class="i_hover_profile_image_edit">
                                        <div class="row middle-xs center-xs">
                                            <div class="col-xs-12">
                                                <span id="action_file_input_container" onclick="TriggerUploadProfileImage();"><i class="fas fa-upload"></i></span>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <span><i class="fas fa-eye"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                <div class="row h_margin_bottom">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                       <span class="f_user_title">${cUserName}
EOF;

                    if ( $cCountry != "" ) {
                        echo "&nbsp;(&nbsp;&nbsp;<span class=\"flag-icon flag-icon-${cCountry}\"></span>&nbsp;&nbsp;)";
                    }

                    echo <<<EOF
                                       </span>
                                    </div>
EOF;
                                MakeFollowingButton( $cUserId, $database );
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
                        echo "<a onclick=\"ToggleUserModal('${cUserId}', '', 'followed');\"><b>${cFollower}</b> Abonenten</a>";
                    } else {
                        echo "<b>${cFollower}</b> Abonenten";
                    }
                                echo <<<EOF
                                    </div>                                   
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
EOF;
                    if ( $cFollowed > 0 ) {
                        echo "<a onclick=\"ToggleUserModal('${cUserId}', '', 'following');\"><b>${cFollowed}</b> Abonniert</a>";
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
            if ( $_SESSION["id"] == $cUserId ) {
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

                    echo "<a class=\"h_reset_active\" id=\"action_section_Timeline\" onclick=\"CallUserSection( '${cUserId}', 'Timeline');\">Timeline</a>";

                    if ( $cImages > 0 ) {
                        echo "<a class=\"h_reset_active\" id=\"action_section_Images\" onclick=\"CallUserSection('${cUserId}', 'Images');\">Fotografien</a>";
                    }
                    if ( $cVideos > 0 ) {
                        echo "<a class=\"h_reset_active\" id=\"action_section_Videos\" onclick=\"CallUserSection('${cUserId}', 'Videos');\">Videografien</a>";
                    }
                    if ( $cPosts > 0 ) {
                        echo "<a class=\"h_reset_active\" id=\"action_section_Posts\" onclick=\"CallUserSection( '${cUserId}', 'Posts');\">Beiträge</a>";
                    }
                    if ( $cTrips > 0 ) {
                        echo "<a class=\"h_reset_active\" id=\"action_section_Trips\" onclick=\"CallUserSection( '${cUserId}', 'Trips');\">Reisen</a>";
                    }

echo <<<EOF
                        <!--<a class="h_reset_active" id="action_section_Infos" onclick="CallUserSection( '${cUserId}', 'Infos');">Informationen</a>-->
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