<?php
include("session.php");
include("html_header.php");
include('dashboard_header.php');



$cElementId = "";
$cElementType = "";

if ( isset($_REQUEST['cId'], $_REQUEST['cType']) ) {
    $cElementId   = $_REQUEST['cId'];
    $cElementType = $_REQUEST['cType'];
}

$cQuery = "";
if       ( $cElementType == "t" ) {
    $cQuery = "SELECT * FROM trips WHERE id=? LIMIT 1";
} elseif ( $cElementType == "i" ) {
    $cQuery = "SELECT * FROM images WHERE id=? LIMIT 1";
} elseif ( $cElementType == "v" ) {
    $cQuery = "SELECT * FROM videos WHERE id=? LIMIT 1";
} elseif ( $cElementType == "p" ) {
    $cQuery = "SELECT * FROM posts WHERE id=? LIMIT 1";
}

if ($select_element = $database->prepare( $cQuery )) {
    $select_element->bind_param("i", $cElementId );
    $select_element->execute();
    $result = $select_element->get_result();
    $Data = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

echo "<body>";
ShowHeader("element", $database);

echo <<<EOF
    <main class="s_dashboard">
        <div class="container">

EOF;

if ( $cElementType == "t" ) {
    DisplayTrips( $Data, $database );
} elseif ( $cElementType == "i" ) {
    DisplayImageVertical( $Data, $database );
} elseif ( $cElementType == "v" ) {
    DisplayVideoVertical( $Data, $database );
} elseif ( $cElementType == "p" ) {
    DisplayPosts( $Data, $database );
}

echo "</div></main></body></html>";



?>