<?php
include('session.php');
include('html_header.php');
include('dashboard_header.php');

ShowHeader( "dash", $database );


echo <<<EOF
<main class="s_dashboard">
    <div class="container">
        <div class="row">
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
        <div class="row s_action_add_section h_margin_vertical" id="action_add_section"></div>
        <div class="row center-xs">
            
EOF;

                $error = FALSE;
                $cStart = 0;
                $cEnd = 1000;
                if ($user_timeline = $database->prepare('SELECT id AS id, username  AS username, NULL AS path, post AS post, NULL AS format, created AS created, \'post\' AS type FROM posts UNION SELECT id AS id, username AS username, path AS path, NULL AS post, format AS format,created AS created, \'image\' AS type FROM images UNION SELECT id AS id, username AS username, path AS path, NULL AS post, NULL AS format,created AS created, \'video\' AS type FROM videos ORDER BY created DESC LIMIT ? OFFSET ?')) {
                    $user_timeline->bind_param("ii", $cEnd, $cStart );
                    $user_timeline->execute();
                    $result = $user_timeline->get_result();
                    $Data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                } else {
                    $error = TRUE;
                }

                if ( $error == FALSE ) {
                echo "<div class=\"col-xs-12 col-xs-10 col-xs-10 col-xs-10 center-xs\">";
                    DisplayTimeline( $Data, $database );
                echo "</div>";
            }

echo <<<EOF
            
        </div>
    </div>
    
    <div id="action_user_modal_wrapper" class="s_user_modal"></div>
</main>
</body>
</html>
EOF;


?>


