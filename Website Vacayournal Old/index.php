<?php
include("essentials.php");
include('html_header.php');
session_start();



$special_page = "";

if ( isset( $_REQUEST["sSpecial"] ) ) {
    $special_page = $_REQUEST["sSpecial"];
}

if ( $special_page == "" ) {
    session_destroy();
}

echo <<<EOF
        <body onload="LoadIndex( '${special_page}' );" onresize="LoadIndex( '${special_page}' );" id="action_index_wrapper"></body>
    </html>
EOF;

?>
