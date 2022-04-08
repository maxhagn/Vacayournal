<?php
include("../resources/config/config.php");
include('../essentials/html_header.php');
include("../essentials/essentials.php");
include("../essentials/dashboard_header.php");
echo "<body>";

ShowHeader( "index_small", $database );


$cUserId = "";
if ( isset( $_REQUEST['cUserId']) ) {
    $cUserId = $_REQUEST['cUserId'];
}

echo <<<EOF

<main class="s_index_container m_container_to_page_bottom">
    <div class="container">
        <div class="row center-xs">
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 start-xs">
    
                <h1 class="h_no_margin">Registration erfolgreich</h1>
                <p>Die Registration wurde erfolgreich abgeschlossen. Bestätige nun deine E-Mail-Adresse, um dein Konto zu aktivieren.</p>
                
                <p><small>Bitte beachte, dass dein Profil zu deiner eigenen Sicherheit erst freigeschalten wird wenn du deine E-Mail-Adresse bestätigst.</small></p>
            
            
            </div>
        </div>
        
        <div class="row center-xs">
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 start-xs">
                <p>Du kannst deine E-Mail-Adresse auch bestätigen, indem du unten den zugesendeten Code eingibst. Oder du klickst einfach auf der Link in der E-Mail.</p>
            </div>
        </div>
        
        <div class="row center-xs">
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 h_login_get_style">
                <form action="mail_verify.php" method="post">
                    <input type="hidden" name="user_id" value="${cUserId}">
                    <div class="row h_no_margin">
                        <label for="password">
                            <i class="fas fa-terminal"></i>
                        </label>
                        <input type="text" name="code" placeholder="Sicherheitscode">
                    </div>
                    <div class="row h_margin_vertical">
                        <div class="col-sm-12">
                            <button class="b_large_action_button" type="submit"><i class="fas fa-paper-plane"></i>  Bestätigen</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<div style="margin-bottom: 400px;"></div>
EOF;

    PrintFooter();

echo <<<EOF
    
</main>

EOF;


?>
