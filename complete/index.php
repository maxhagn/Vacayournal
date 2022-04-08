<?php
include("../resources/config/config.php");
include("../essentials/html_header.php");
include("../essentials/essentials.php");

$cUserId = "";
$cStatus = "1";

if(isset($_REQUEST['cUserId'])) {
    $cUserId = $_REQUEST['cUserId'];
}

if(isset($_REQUEST['cStatus'])) {
    $cStatus = $_REQUEST['cStatus'];
}


echo <<<EOF
    <body style="overflow-x: hidden; overflow-y: auto; background-attachment: fixed; background-image: url('../resources/images/bg.jpeg'); background-position: center; background-size: cover; background-repeat: no-repeat;">
            <div class="row h_padding_vertical h_height_100">
                <div style="margin: auto;" class="col-xs-12 col-sm-6 col-md-6 col-lg-6 h_login_get_style h_text_center center-xs h_position_relative">
                    <div class="row">
                        <form class="s_profile_form h_padding_vertical" enctype="multipart/form-data" method="post" id="action_profile_form"></form>
                    </div>
                </div>
            </div>
     
        <script>
            CallProfileForm('${cStatus}', '${cUserId}');
        </script>
        
        
        
        <div class="s_absolute_back">
            <i onclick="if (confirm('Du kommst zurück zur Startseite, die letzte Forumlar-Seite wird nicht gespeichert und der \'Profil-Vervollständigen\'-Vorgang nicht übersprungen, bei der nächsten Anmeldung kommst du wieder hierher.')) {location.href='/website/'}" title="Du kommst zurück zur Startseite, die letzte Forumlar-Seite wird nicht gespeichert und der 'Profil-Vervollständigen'-Vorgang nicht übersprungen, bei der nächsten Anmeldung kommst du wieder hierher." class="far fa-times-circle"></i>
        </div>
    </body>
    
    
    
</html>

EOF;
?>

