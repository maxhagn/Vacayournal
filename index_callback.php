<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


include("resources/config/config.php");
include("essentials/essentials.php");
include("essentials/dashboard_header.php");

$saved_login_username= "";
$login_error= "";
$saved_register_username= "";
$saved_register_surname= "";
$saved_register_email= "";
$saved_register_phone= "";
$saved_register_verify_by= "";
$saved_register_day= date('d');
$saved_register_month= date('m');
$saved_register_year= date('Y') - 25;
$register_error= "";

if(isset($_SESSION['saved_login_username'])) {
    $saved_login_username = $_SESSION['saved_login_username'];
}

if(isset($_SESSION['saved_register_username'])) {
    $saved_register_username = $_SESSION['saved_register_username'];
}

if(isset($_SESSION['saved_register_surname'])) {
    $saved_register_surname = $_SESSION['saved_register_surname'];
}

if(isset($_SESSION['saved_register_email'])) {
    $saved_register_email = $_SESSION['saved_register_email'];
}

if(isset($_SESSION['saved_register_phone'])) {
    $saved_register_number = $_SESSION['saved_register_phone'];
}

if(isset($_SESSION['saved_register_day'])) {
    $saved_register_day = $_SESSION['saved_register_day'];
}

if(isset($_SESSION['saved_register_month'])) {
    $saved_register_month = $_SESSION['saved_register_month'];
}

if(isset($_SESSION['saved_register_year'])) {
    $saved_register_year = $_SESSION['saved_register_year'];
}

if(isset($_SESSION['login_error'])) {
    $login_error = $_SESSION['login_error'];
}

if(isset($_SESSION['register_error'])) {
    $register_error = $_SESSION['register_error'];
}

$show_login = "FALSE";
$show_information = "TRUE";
$show_register = "TRUE";
$size_header = "index_large";

if ( isset( $_REQUEST["sLogin"], $_REQUEST["sRegister"], $_REQUEST["sInformation"], $_REQUEST["sHeader"] ) ) {
    $show_login = $_REQUEST["sLogin"];
    $show_register = $_REQUEST["sRegister"];
    $show_information = $_REQUEST["sInformation"];
    $size_header = $_REQUEST["sHeader"];
} else {
    $show_login = "FALSE";
    $show_information = "TRUE";
    $show_register = "TRUE";
    $size_header = "index_large";
}

$session = "session";
ShowHeader( $size_header, $database );

echo <<<EOF
    <main id="action_index_container" class="s_index_container">
        <div class="row center-xs h_margin_vertical">
EOF;

if ( $show_information == "TRUE" ) {
    echo <<<EOF
            <section class="col-xs-10 col-sm-10 col-md-8 col-lg-4 start-xs start-sm start-md start-lg s_register">
EOF;
        if ( isset( $_COOKIE[$session] ) ) {

            $cStoredUsers = "";
            $cStoredUsers = $_COOKIE[$session];
            $cStoredUserIdArray = explode(",", $cStoredUsers);



            echo <<<EOF
            <div class="row">
                <div class="col-xs-12">
                <h2>Letzte Anmeldungen</h2>
                
                
                <h3 class="h_margin_bottom"><small>Klicke auf dein Bild oder füge ein Konto hinzu.</small></h3>
                
                
                <div class="row start-xs">
                
EOF;
                foreach ($cStoredUserIdArray as $char) {
                    $cStoredImage = GetProfilePicture( $char, $database );
                    $cStoredUserName = GetUserName( $char, $database );

                    echo <<<EOF
                    <div class="col-xs-4">
                        <div class="s_cookie__preview_container">
                            <div class="s_cookie_user_preview" style="background-image: url(${cStoredImage})"></div>
                            <p class="h_text_center">${cStoredUserName}</p>
                            <button type="button" class="tooltip b_cookies_delete"><i class="fas fa-times-circle"></i>
                            
                                <span class="tooltiptext">Konto von der Startseite entfernen.</span>
                            </button>
                        </div>
                    </div>
EOF;
                }

                echo <<<EOF
                </div>
            </div> 
            
            
</div>
EOF;
        }
             echo <<<EOF
            <div class="row">
                <h2>Informationen</h2>
                <h3><small>Vacation, You, Journal, Vacayournal</small></h3>
                <div class="row h_no_margin">
                    <p>Mit Vacayournal kannst du unkompliziert Bilder, Videos und Beiträge von deinen schönsten Reisen mit anderen Teilen. Inspiriere Familie und Freunde in dem du deine besten Urlaube dokumentierst. Du kannst andere Urlauber abonieren, ihre Beiträge kommentieren und bewerten. Brauchst du genauere Informationen zu einer Reise, kannst du über unsere Plattform Kontakte aufbauen und dir Tipps geben lassen. Suchst du nach einem besonderen Ereignis oder möchtest deine perfekten Momente mit anderen teilen bist du bei uns genau richtig. <br> 
                    <strong> Mache deine nächste Reise zu deiner Schönsten. </strong>  
                    <br><br> Wir sind ein junges Entwicklerteam aus Österreich, Wien und haben die Vision eine Facebook-Unabhängige Social-Media Plattform zu kreiren. Wir möchten Benutzerinnen und Benutzern die Möglichkeit geben sicher und schnell Beiträge miteinander auszutauschen und dabei besonderen Wert auf die Privatsphäre und Datensicherheit unserer Kundinnen und Kunden legen. Wir verschlüsseln alle personenbezogenen Daten und geben unseren Anwenderinnen und Anwendern die Möglichkeit selbst zu entscheiden, welche Informationen auf Ihren Profilen erscheinen soll. Ein Weiteres Anliegen von uns ist, dass wir Werbefrei bleiben, wir werden keinerlei Werbung einblenden. Weitere Informationen dazu findest du in unserer <a href='policies/index.php'>Datenrichtlinie</a>.
                    <br><br> Bald gibt es uns auch als Applikation für Android und iOS, kannst du es jetzt schon nicht mehr erwarten erstelle einfach ein Lesezeichen zu unserer Webapp und füge es zu deiner Startseite hinzu.
                    <br><br> 
                    </p>
                </div>   
            </div>
        </section>
EOF;
}

if ( $show_login == "TRUE" ) {
    echo <<<EOF
            <section class="col-xs-10 col-sm-10 col-md-8 col-lg-4 start-xs start-sm start-md start-lg col-lg-offset-1 s_register" style="min-height: 700px;">
EOF;

    if ( $login_error != "" ) {
        foreach ( $_SESSION['login_error'] as $error ):

            echo <<<EOF
            <div class="row left-xs h_margin_vertical">
                <section class="col-xs-12 s_error_box">
                    <i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;${error}
                </section>
            </div>
EOF;

        endforeach;
    }
                echo <<<EOF
                <h2>Melde dich an</h2>
                <h3><small>Sicher, Verschlüsselt und einfach</small></h3>
                <form action="/auth/authenticate.php" method="post">
                    <div class="row h_no_margin">
                        <label for="username">
                            <i class="fas fa-user"></i>
                        </label>
                        <input type="text" id="username" name="username" value="${saved_login_username}" placeholder="E-Mail-Adresse oder Telefonnummer">
                    </div>
                    <div class="row h_no_margin">
                        <label for="password">
                            <i class="fas fa-signature"></i>
                        </label>
                        <input type="password" id="password" name="password" placeholder="Passwort">
                    </div>
                    <div class="row h_margin_vertical">
                        <div class="col-sm-12">
                            <button class="b_large_action_button" type="submit"><i class="fas fa-paper-plane"></i>  Anmelden</button>
                        </div>
                    </div>
                </form>
            </section>

EOF;
}

if ( $show_register == "TRUE" ) {

    echo <<<EOF
            <section class="col-xs-10 col-sm-10 col-md-8 col-lg-4 start-xs start-sm start-md start-lg col-lg-offset-1 s_register">
            
EOF;
    if ( $register_error != "" ) {
        foreach ( $_SESSION['register_error'] as $error ):

            echo <<<EOF
            <div class="row left-xs h_margin_vertical">
                <section class="col-xs-12 s_error_box">
                    <i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;${error}
                </section>
            </div>
EOF;

        endforeach;
    }
                echo <<<EOF
                <h2>Erstelle ein neues Konto</h2>
                <h3><small>Schnell, einfach und sicher</small></h3>
                <form action="/auth/register.php" id="action_registration" method="post">
                    <div class="row h_no_margin">
                        <label for="new_username">
                            <i class="fas fa-user"></i>
                        </label>
                        <input title="Gib hier deinen Vornamen ein. Der Benutzername setzt sich aus Vor- und Nachname zusammen" type="text" id="new_username" name="new_username" value="${saved_register_username}" placeholder="Vorname" required>
                    </div>
                    <div class="row h_no_margin">
                        <label for="new_surname">
                            <i class="fas fa-signature"></i>
                        </label>
                        <input title="Gib hier deinen Nachnamen ein. Der Benutzername setzt sich aus Vor- und Nachname zusammen" type="text" id="new_surname" name="new_surname" value="${saved_register_surname}" placeholder="Nachname" required>
                    </div>
                    
                    <div class="row h_no_margin">
                        <div class="row col-xs-6">
                            <label title="Wähle aus, ob du dein Konto per E-Mail-Adresse oder Handynummer verifizieren möchtest. Wir empfehlen die definitiv kostenlose Bestätigung über deine E-Mail-Adresse." for="new_day">
                                <i class="fas fa-terminal"></i>
                            </label>
                            <select class="select-css" style="min-width: 70%;" onchange="SelectVerifyBy();" title="Wähle aus, ob du dein Konto per E-Mail-Adresse oder Handynummer verifizieren möchtest. Wir empfehlen die definitiv kostenlose Bestätigung über deine E-Mail-Adresse." name="new_verify_by" id="new_verify_by">
                                <option title="Bestätige dein Konto unkompliziert mit deiner E-Mail-Adresse. Deine Handynummer kannst du später angeben, damit du alle Funktionen nutzen kannst." selected='selected' value='verify_by_email'>E-Mail-Adresse</option>
                                <option title="Wir tragen die Kosten der Verifizierung mit deinem Handy, achte jedoch darauf, dass außerhalb Österreichs kosten auf deiner Seite durch den Handyprovider entstehen können." value='verify_by_phone'>Handynummer</option>
                            </select>
                        </div>
                        <div class="col-xs-6" style="margin-bottom: 20px;>
                            <span ">Wähle aus, wie du dein Konto bestätigen möchtest. Du kannst im Verlauf der Anmeldung beides bestätigen lassen, um dein Konto optimal zu schützen.</span>
                        </div>
                    </div>
                    
                    <div class="row h_no_margin" id="verify_by_email">
                        <label for="new_email">
                            <i class="fas fa-envelope"></i>
                        </label>
                        <input title="Gib hier eine E-Mail-Adresse an, mit der du dein Konto bestätigen möchtest." type="email" id="new_email" name="new_email" value="${saved_register_email}" placeholder="E-Mail-Adresse" required>
                    </div>
                    
                    <div class="row h_no_margin" id="verify_by_phone" style="display: none;">
                        <label for="new_number">
                            <i class="fas fa-phone"></i>
                        </label>
                        <input onchange="getPhoneNumber();" title="Gib hier eine Telefonnummer an, mit der du dein Konto bestätigen möchtest." type="tel" id="new_phone" name="new_phone" value="${saved_register_phone}" placeholder="Handynummer">
                    </div>
                    
                    <div class="row h_no_margin">
                        <label for="new_password">
                            <i class="fas fa-key"></i>
                        </label>
                        <input title="Gib eine Passwort zwischen 5 und 20 Zeichen ein. Alle Zeichen sind erlaubt, wir empfehlen jedoch Sonderzeichen, Buchstaben und Ziffern zu verwenden, um Sicherheit zu gewährleisten. Alle Passwörter werden mittels state-of-the-art Verschlüsselungs-Algorithmen gesichert." type="password" id="new_password" name="new_password" placeholder="Passwort"  required>
                    </div>
                    <div class="row h_no_margin">
                        <p style="margin-top: 0">Geburtstag</p>
                    </div>
                    <div class="row h_no_margin">
                        <div class="row col-xs-12 col-sm-4">
                            <label title="Gib hier den Tag deiner Geburt an." for="new_day">
                                <i class="fas fa-calendar-day"></i>
                            </label>
                            <select class="select-css" title="Gib hier den Tag deiner Geburt an." name="new_day" id="new_day"  required>
EOF;
    MakeDayOption( $saved_register_day );

    echo <<<EOF
                            </select>
                        </div>
    
                        <div class="row col-xs-12 col-sm-4">
                            <label title="Gib hier den Monat an in dem du geboren bist." for="new_month">
                                <i class="fas fa-calendar-day"></i>
                            </label>
                            <select class="select-css" title="Gib hier den Monat an in dem du geboren bist." name="new_month" id="new_month" required>
EOF;
    MakeMonthOption( $saved_register_month );

    echo <<<EOF
                            </select>
                        </div>
    
                        <div class="row col-xs-12 col-sm-4">
                            <label title="Gib hier das Jahr an in dem du geboren bist." for="new_year">
                                <i class="fas fa-calendar-day"></i>
                            </label>
                            <select class="select-css" title="Gib hier das Jahr an in dem du geboren bist." name="new_year" id="new_year" required>
EOF;
    MakeYearOption( $saved_register_year );

    echo <<<EOF
                            </select>
                        </div>
                    </div>
                    <div class="row h_no_margin">
                        <p style="margin-top: 0">Geschlecht</p>
                    </div>
                    <div class="row h_no_margin">
                        <div class="row col-xs-12 col-sm-4 h_position_relative">
                            <label title="Wähle diese Möglichkeit, wenn du männlich bist." for="male">
                                <i class="fas fa-mars"></i>
                            </label>
                            <input checked="checked" type="radio" name="new_gender" id="male" value="m">
                            <span title="Wähle diese Möglichkeit, wenn du männlich bist."  class="i_check_mark"></span>
                        </div>
    
                        <div class="row col-xs-12 col-sm-4 h_position_relative">
                            <label title="Wähle diese Möglichkeit, wenn du weiblich bist."  for="female">
                                <i class="fas fa-venus"></i>
                            </label>
                            <input type="radio" name="new_gender" id="female" value="f">
                            <span title="Wähle diese Möglichkeit, wenn du weblich bist."  class="i_check_mark"></span>
                        </div>
    
                        <div class="row col-xs-12 col-sm-4 h_position_relative">
                            <label title="Wähle diese Möglichkeit, wenn du dich nicht mit den anderen Optionen identifizierst." for="divers">
                                <i class="fas fa-transgender"></i>
                            </label>
                            <input type="radio" name="new_gender" id="divers" value="d">
                            <span title="Wähle diese Möglichkeit, wenn du dich nicht mit den anderen Optionen identifizierst." class="i_check_mark"></span>
                        </div>
                    </div>
    
                    <div class="row h_no_margin">
                        <p><small>Indem du auf „Konto erstellen“ klickst, stimmst du unseren Nutzungsbedingungen zu. In unserer <a href="policies/index.php#dataprotection_heading">Datenrichtlinie</a> erfährst du, wie wir deine Daten erfassen, verwenden und teilen. Unsere <a href="policies/index.php#cookies_heading">Cookie-Richtlinie</a> erklärt, wie wir Cookies und ähnliche Technologien verwenden.</small></p>
                    </div>
                    <div class="row h_margin_vertical">
                        <div class="col-sm-12">
                            <button class="b_large_action_button" title="Alle Daten angegeben? Dann eröffne jetzt dein Konto!"  type="submit"><i class="fas fa-paper-plane"></i>  Konto erstellen</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
EOF;
}

    echo "</div><div>";
    PrintFooter();


?>