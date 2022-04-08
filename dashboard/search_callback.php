<?php
include("../essentials/session.php");

$cSearchText = "";
$cStyle = 0;
$cLimit = 8;

if ( isset($_REQUEST['cSearchText']) ) {
    $cSearchText = $_REQUEST['cSearchText'];
    $_SESSION['search_text'] = $cSearchText;
}

if ( isset($_REQUEST['cStyle']) ) {
    $cStyle = $_REQUEST['cStyle'];
    $cLimit = 3000;
}

$cSearchTextClean = $cSearchText;
$cSearchText = "%" . $cSearchText . "%";

if ($user_posts = $database->prepare('SELECT id AS id, NULL AS country_name, NULL AS country_code FROM users WHERE first_name LIKE ? OR last_name LIKE ? UNION SELECT NULL AS id, country_name AS country_name, country_code AS country_code FROM geo_countries WHERE country_name LIKE ? ORDER BY id DESC LIMIT ?') ) {
    $user_posts->bind_param('ssss', $cSearchText, $cSearchText, $cSearchText, $cLimit);
    $user_posts->execute();
    $result = $user_posts->get_result();
    $Predictions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $user_posts->close();
}

if ( $cStyle == 0 ) {

    foreach ( $Predictions as $Prediction ):

        $cUserId = $Prediction['id'];

        if ( $Prediction['country_name'] != "" ) {
            $cUserName = $Prediction['country_name'];
        } else {
            $cUserName = GetUserName( $cUserId, $database );
        }

        if ( $Prediction['country_code'] != "" ) {

        }


        echo <<<EOF
        
                <div class="s_search_box">
                    ${cUserName}
                </div>

EOF;

    endforeach;

    echo <<<EOF
        
                <div class="s_search_box h_search_box_more" onclick="location.href='/website/dashboard/search/?cSearchText=${cSearchTextClean}'">
                    Alle Ergebnisse zu "${cSearchTextClean}" anzeigen
                </div>

EOF;


} else if ( $cStyle == 1 ) {

    echo $cSearchText;

    foreach ( $Predictions as $Prediction ):

        $cUserId = $Prediction['id'];

        if ( $Prediction['country_name'] != "" ) {
            $cUserName = $Prediction['country_name'];
        } else {
            $cUserName = GetUserName( $cUserId, $database );
        }

        $cPreviewString = "";

        if ( $Prediction['country_code'] != "" ) {
            $cCountryCode = strtolower( $Prediction['country_code'] );
            $cPreviewString = "<span class=\"flag-icon flag-icon-${cCountryCode}\"></span>";
        } else if ( $Prediction['id'] != ""  ) {
            $cUserImagePath = GetProfilePicture( $cUserId, $database );
            $cPreviewString = "<div class=\"h_round_image\" style=\"background-image: url(${cUserImagePath})\"></div>";
        }


        echo <<<EOF
        
                <div class="s_search_box_large">
                    <div class="row">
                        <div class="col-xs-3">
                            ${cPreviewString}
                        </div>
                        <div class="col-xs-9">
                            ${cUserName}
                        </div>
                    </div>
                </div>

EOF;

    endforeach;
}



?>