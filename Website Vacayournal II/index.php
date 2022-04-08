<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("essentials/essentials.php");
include('essentials/html_header.php');




$special_page = "";

if ( isset( $_REQUEST["sSpecial"] ) ) {
    $special_page = $_REQUEST["sSpecial"];
}

if ( $special_page == "" ) {
    if (session_status() == PHP_SESSION_ACTIVE) {
        session_destroy();
    }
}

echo <<<EOF
        <body onload="LoadIndex( '${special_page}' );" onresize="LoadIndex( '${special_page}' );" id="action_index_wrapper"></body>
        
        
    </html>
EOF;

?>
