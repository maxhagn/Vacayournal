<?php
include("resources/config/config.php");
include('essentials.php');
include('html_header.php');
include('dashboard_header.php');

echo "<body>";

ShowHeader( "index_small", $database );


echo "<main class=\"s_index_container m_container_to_page_bottom h_container_large_top\"><div class=\"container center-xs\">";

$code = $_REQUEST['code'];
$user_id = $_REQUEST['user_id'];

$cEmail = "";
$cMobile = "";
$cVerified = "";
$iVerified = "";
$cVerifiedAddress = "";

if ($check_verified = $database->prepare('SELECT first_name, email, mobile, verified FROM users WHERE id=?')) {
    $check_verified->bind_param('s', $user_id);
    $check_verified->execute();
    $check_verified->bind_result($cFirstName, $cEmail, $cMobile, $cVerified);
    $check_verified->fetch();
    $check_verified->close();
}

if ( $cVerified == 0 ) {
    if ($check_mail_code = $database->prepare('SELECT user_id, type  FROM safety_codes WHERE code=?')) {
        $check_mail_code->bind_param('s', $code);
        $check_mail_code->execute();
        $check_mail_code->bind_result($cUserId, $vType);
        $check_mail_code->fetch();
        $check_mail_code->close();

        if ( $cEmail != "" && $vType == 1 ) { $cVerifiedAddress = $cEmail;  }
        if ( $cMobile != "" && $vType == 2 ) { $cVerifiedAddress = $cMobile;  }

        if ($delete_mail_code = $database->prepare('DELETE FROM safety_codes WHERE code=?')) {
            $delete_mail_code->bind_param('s', $code);
            $delete_mail_code->execute();
            $delete_mail_code->close();
        }

        $iVerified = $vType;
        if ($set_verified = $database->prepare('UPDATE users SET verified=?, changed=NOW() WHERE id=?')) {
            $set_verified->bind_param('is', $iVerified, $cUserId);
            $set_verified->execute();
            $set_verified->close();
        }

    } else {
        echo "Statement fehlerhaft";
    }

    if ( $cUserId != 0) {
        echo <<<EOF
   
        <h1>Bestätigung Erfolgreich</h1>
        
        <p class="f_font_size_12">${cFirstName}, deine E-Mail-Adresse ( ${cVerifiedAddress} ) wurde erfolgreich bestätigt. </p>
        
        <p class="f_font_size_12">Du kannst dich sofort von hier aus anmelden </p>
        
        <div class="row center-xs">
            <div class="col-xs-10 col-sm-10 col-md-8 col-lg-4 center-xs h_login_get_style">
                <form action="../auth/authenticate.php" method="post">
                    <input type="hidden" name="username" value="${cVerifiedAddress}">
                    <div class="row center-xs h_no_margin">
                        <label for="password">
                            <i class="fas fa-signature"></i>
                        </label>
                        <input type="password" name="password" placeholder="Passwort">
                    </div>
                    <div class="row h_margin_vertical">
                        <div class="col-sm-12 center-xs">
                            <button type="submit" class="b_large_action_button"><i class="fas fa-paper-plane"></i>  Anmelden</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <form action="../index.php">
            <button type="submit" class="b_large_action_button">Zurück zur Startseite</button>
        </form>
        

EOF;
    } else {
        echo <<<EOF
        <h1>Bestätigung Fehlgeschlagen</h1>
        
        <p class="f_font_size_12">Bei der Bestätigung deiner E-Mail-Adresse ist uns leider ein Fehler unterlaufen. </p>
        
        <p class="f_font_size_12">Deine Email wurde nicht von uns bestätigt! </p>
        
        <form action="mail_verify_information.php">
            <input type="hidden" name="cProblem" value="0">
            <button type="submit" class="b_large_action_button">Code neu anfordern</button>
        </form>
        
        <form action="../index.php">
            <button type="submit" class="b_large_action_button">Zurück zur Startseite</button>
        </form>

EOF;
    }

} else {

    echo <<<EOF
        <h1>Bestätigung bereits durchgeführt</h1>
        
        <p class="f_font_size_12">Deine Email wurde anscheinend bereits bestätigt! </p>
        
        <p class="f_font_size_12">Teile uns bitte mit, falls du deine Email nicht selbst bestätigt hast ( <a href="mail_verify_information.php?cStatus=0">Code neu anfordern</a>, <a href="../abuse/report_abuse.php?cStatus=0">Missbrauch melden</a> ) </p>
        
        <form action="../index.php">
            <input type="hidden" name="sSpecial" value="l">
            <button type="submit" class="b_large_action_button">Zurück zur Anmeldung</button>
        </form>
        
        <form action="../index.php">
            <button type="submit" class="b_large_action_button">Zurück zur Startseite</button>
        </form>

EOF;

}

echo "</div></main></body>";






?>

</body>
</html>
