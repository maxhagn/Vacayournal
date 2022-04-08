<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../../resources/config/config.php");
include("../../essentials.php");
include("../../dashboard_header.php");
include('../../html_header.php');

echo "<body style='overflow: hidden'>";

$size_header = "cookies_header";
ShowHeader( $size_header, $database );




echo <<<EOF


<script>

    if ( document.getElementById('help_start') ) {
        document.getElementById('help_start').classList.add('help_nav_active');   
    }


</script>



EOF;


?>