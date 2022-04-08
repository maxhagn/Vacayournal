<?php
include("../resources/config/config.php");

$cSearch= "";
$cCountry= "";

if(isset($_REQUEST['cSearch'],$_REQUEST['cCountry'])) {
    $cSearch = $_REQUEST['cSearch'];
    $cCountry = $_REQUEST['cCountry'];
}

$cSearch = $cSearch . "%";

if ( $cCountry == "0") {
    $all_countries = $database->prepare('SELECT name, id, latitude, longitude FROM geo_zips WHERE name LIKE ? ORDER BY name LIMIT 5');
    $all_countries->bind_param("s", $cSearch );
    $all_countries->execute();
    $result = $all_countries->get_result();
    $num = $result->num_rows;
    $Cities = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else if ( $cSearch == "" ) {
    $all_countries = $database->prepare('SELECT name, id, latitude, longitude FROM geo_zips WHERE country_code=? ORDER BY name LIMIT 5');
    $all_countries->bind_param("i", $cCountry);
    $all_countries->execute();
    $result = $all_countries->get_result();
    $num = $result->num_rows;
    $Cities = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $all_countries = $database->prepare('SELECT name, id, latitude, longitude FROM geo_zips WHERE country_code=? AND name LIKE ? ORDER BY name LIMIT 5');
    $all_countries->bind_param("is", $cCountry, $cSearch );
    $all_countries->execute();
    $result = $all_countries->get_result();
    $num = $result->num_rows;
    $Cities = mysqli_fetch_all($result, MYSQLI_ASSOC);
}


if ( $num > 0 ) {
    foreach ( $Cities as $City ):

        echo <<<EOF
        <div class="row center-xs s_search_result_box" onclick="SaveCity(${City['id']}, ${City['latitude']}, ${City['longitude']})">
            <div class="col-xs-12" id="action_location_preview">
                ${City['name']}
            </div>
        </div>
EOF;

    endforeach;
} else {
    echo <<<EOF
    <div class="row center-xs s_search_result_box">
        <div class="col-xs-12" id="action_location_preview">
            Keine Ergebnisse zu deiner Suche
        </div>
    </div>
EOF;
}

