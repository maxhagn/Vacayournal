<?php
include("session.php");

$cElementId = "";
$cElementType = "";
$cReloadType = "";

if (isset($_REQUEST['cElem'], $_REQUEST['cType'], $_REQUEST['cReload'])) {
    $cElementId = $_REQUEST['cElem'];
    $cElementType = $_REQUEST['cType'];
    $cReloadType = $_REQUEST['cReload'];
} else {
    echo "ERROR";
}


if ( $cReloadType == '0' ) {
    DisplayElementInformationVertical( $cElementId, $cElementType, $database );
} else if ( $cReloadType == '1' ) {
    DisplayElementInformation( $cElementId, $cElementType, $database );
}



?>