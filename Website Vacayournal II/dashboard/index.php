<?php
include('../essentials/session.php');
include('../essentials/html_header.php');
include('../essentials/dashboard_header.php');

ShowHeader( "dash", $database );

$cUserId = $_SESSION['id'];
$cUserName = GetUserName($cUserId, $database);
$cUserPath = GetProfilePicture($cUserId, $database);

if ($user_timeline = $database->prepare('SELECT id FROM users WHERE id<>? LIMIT 3')) {
    $user_timeline->bind_param("i", $cUserId);
    $user_timeline->execute();
    $result = $user_timeline->get_result();
    $User = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

echo <<<EOF
<main class="s_dashboard">
    <div class="container">
        <!--<div class="row">
            <div class="col-sm-12 center-sm">
                    <div class="b_button_container">
                        <button title="Hochladen" class="b_hoverable_action" id="select_button"><i class="fas fa-plus"></i></button>
                        <button title="Fotos hochladen" class="b_add_action" id="button_image" onclick="CallAdd( 'Images' );"><i class="far fa-images"></i></button>
                        <button title="Videos hochladen" class="b_add_action" id="button_video" onclick="CallAdd( 'Videos' );"><i class="fas fa-video"></i></button>
                        <button title="Beiträge schreiben" class="b_add_action" id="button_post" onclick="CallAdd( 'Posts' );"><i class="fas fa-pen"></i></button>
                        <button title="Reise hinzufügen" class="b_add_action" id="button_trip" onclick="CallAdd( 'Trips' );"><i class="fas fa-suitcase"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row s_action_add_section h_margin_vertical" id="action_add_section"></div>-->
        <div class="row center-xs">
            
EOF;

                $error = FALSE;
                $cStart = 0;
                $cEnd = 1000;
                if ($user_timeline = $database->prepare('SELECT id AS id, user_id AS user_id, NULL AS path, post AS post, NULL AS format, created AS created, \'post\' AS type FROM posts UNION SELECT id AS id, user_id AS user_id, path AS path, NULL AS post, format AS format,created AS created, \'image\' AS type FROM images UNION SELECT id AS id, user_id AS user_id, path AS path, NULL AS post, NULL AS format,created AS created, \'video\' AS type FROM videos ORDER BY created DESC LIMIT ? OFFSET ?')) {
                    $user_timeline->bind_param("ii", $cEnd, $cStart );
                    $user_timeline->execute();
                    $result = $user_timeline->get_result();
                    $Data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                } else {
                    $error = TRUE;
                }

                if ( $error == FALSE ) {
                echo "<div class=\"col-xs-5 center-xs h_padding_horizontal\">";
                    DisplayTimeline( $Data, $database );
                echo "</div>";
            }

echo <<<EOF
            
         <div class="col-xs-2 h_padding_horizontal s_dash_sidenav">
            <div class="row middle-xs center-xs s_side_nav_active_user">
                <div class="col-xs-3 center-xs">
                    <div class="h_round_image_large" style="background-image: url(${cUserPath});"></div>
                </div>
                <div class="col-xs-8 center-xs">
                    <a href="/website/dashboard/user/?tUsername=${cUserId}">${cUserName}</a>
                </div>
            </div>
            <div class="row middle-xs">
                <div class="col-xs-4 h_no_padding">
                    <button id="css_action_create_button" type="button" style="border-bottom-left-radius: 4px; border-left: 1px solid #e6e6e6" class="b_side_nav" onclick="location.href='../help/setup'">Erstellen</button>
                </div>
                <div class="col-xs-4 h_no_padding">
                    <button id="css_action_explore_button" type="button" class="b_side_nav" onclick="location.href='../help/setup'">Entdecken</button>
                </div>
                <div class="col-xs-4 h_no_padding">
                    <button id="css_action_settings_button" type="button" style="border-bottom-right-radius: 4px;" class="b_side_nav" onclick="location.href='../help/setup'">Verwalten</button>
                </div>
            </div>
            <div class="row middle-xs">
                <div class="col-xs-12 start-xs s_user_predictions">
                    <h3 class="h_margin_left_medium">Vorschläge für Dich</h3>
                
EOF;
                    DisplayUserPredictions( $User, $database );
echo <<<EOF
                </div>
            </div>
            <div class="row middle-xs">
                <div class="col-xs-12 start-xs s_user_predictions s_predictions">
                    <h3 class="h_padding_horizontal">Hast Du schon versucht ...</h3>
                    <div class="s_show_user_container_flexible middle-xs start-xs">
                        <div class="col-xs-12">
                            <a class="h_padding_horizontal"href="/website/dashboard/user/?tUsername=${cUserId}">ein Foto hochzuladen?</a>
                        </div>
                    </div>
                    <div class="s_show_user_container_flexible middle-xs start-xs">
                        <div class="col-xs-12">
                            <a class="h_padding_horizontal" href="index.php?tUsername=${cUserId}">eine Reise mit Freunden zu teilen?</a>
                        </div>
                    </div>
                    <div class="s_show_user_container_flexible middle-xs start-xs">
                        <div class="col-xs-12">
                            <a class="h_padding_horizontal"href="index.php?tUsername=${cUserId}">einen Beitrag privat zu sichern?</a>
                        </div>
                    </div>
                    <div class="s_show_user_container_flexible middle-xs start-xs">
                        <div class="col-xs-12">
                            <a class="h_padding_horizontal"href="index.php?tUsername=${cUserId}">Deine Profil-Informationen anzupassen?</a>
                        </div>
                    </div>
                    <div class="s_show_user_container_flexible middle-xs start-xs">
                        <div class="col-xs-12">
                            <a class="h_padding_horizontal"href="index.php?tUsername=${cUserId}">Unsere Hilfe-Seite zu verwenden?</a>
                        </div>
                    </div>
                </div>
            </div>
            
         
EOF;
    PrintDashboardFooter();


    echo <<<EOF
         </div>   
         
        </div>
    </div>
    
    <div id="action_user_modal_wrapper" class="s_user_modal"></div>
</main>
</body>
</html>
EOF;


?>


