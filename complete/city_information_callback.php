<?php
include("../resources/config/config.php");

$cCity= "";

if(isset($_REQUEST['cCity'])) {
    $cCity = $_REQUEST['cCity'];
}

if ($select_city = $database->prepare('SELECT latitude,longitude,name FROM cities WHERE id=?')) {
    $select_city->bind_param('i', $cCity);
    $select_city->execute();
    $select_city->bind_result($cLatitude, $cLongitude, $cName);
    $select_city->fetch();
    $select_city->close();
}

echo <<<EOF


    <link rel='stylesheet' type='text/css' href='../resources/scripts/tomtom/sdk/maps.css'/>
    <link rel='stylesheet' type='text/css' href='../resources/scripts/tomtom/pages/examples/styles/main.css'/>

    <div class="row center-xs">
        <div class="col-xs-12 h_position_relative">

            <div id='map' class='map' style="margin-top: 20px; width: 100%; height: 400px;"></div>
            
            <script src='../resources/scripts/tomtom/sdk/maps-web.min.js'></script>
            <script type='text/javascript' src='../resources/scripts/tomtom/pages/examples/assets/js/mobile-or-tablet.js'></script>
            
        </div>
    </div>




EOF;


?>