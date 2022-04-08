<?php
include("../resources/config/config.php");
include("../essentials/essentials.php");
$cPage= "";

if(isset($_REQUEST['cPage'])) {
    $cPage = $_REQUEST['cPage'];
}

$saved_profile_description = "";
$saved_profile_nickname = "";
$saved_profile_slogan = "";
$saved_profile_email= "";
$saved_profile_phone= "";

if(isset($_SESSION['saved_profile_description'])) {
    $saved_profile_description = $_SESSION['saved_profile_description'];
}

if(isset($_SESSION['saved_profile_nickname'])) {
    $saved_profile_nickname = $_SESSION['saved_profile_nickname'];
}

if(isset($_SESSION['saved_profile_slogan'])) {
    $saved_profile_slogan = $_SESSION['saved_profile_slogan'];
}

if(isset($_SESSION['saved_profile_email'])) {
    $saved_profile_email = $_SESSION['saved_profile_email'];
}

if(isset($_SESSION['saved_profile_phone'])) {
    $saved_profile_number = $_SESSION['saved_profile_phone'];
}

$cUserId = "";
$cVerified = "";
$cVerifyMessage  = "";
$cVerifyKeyword = "";
if(isset($_REQUEST['cUserId'])) {
    $cUserId = $_REQUEST['cUserId'];

    if ( $check_verified = $database->prepare( 'SELECT verified FROM users WHERE id=?' ) ) {
        $check_verified->bind_param('s', $cUserId);
        $check_verified->execute();
        $check_verified->bind_result($cVerified);
        $check_verified->fetch();
        $check_verified->close();
    }

    if ( $cVerified == 1 ) {
        $cVerifyMessage = "Du hast dein Konto mit deiner E-Mail-Adresse bestätigt, wir empfehlen jedoch ebenfalls die Handynummer zu bestätigen.";
        $cVerifyKeyword = "Handynummer";
    } else if ( $cVerified == 2 ) {
        $cVerifyMessage = "Du hast dein Konto mit deiner Handynummer bestätigt, wir empfehlen jedoch ebenfalls die E-Mail-Adresse zu bestätigen.";
        $cVerifyKeyword = "E-Mail-Adresse";
    }
}

if ( $cPage == 1 ) {
echo <<<EOF
    <div class="row">
        <div class="col-xs-12">
            <h1 style="margin-bottom: 10px;">Vervollständige dein Profil</h1>
        </div>
    </div>
    
     <div class="row center-xs">
        <div class="col-xs-6">
            <p class="h_margin_bottom" style="margin-bottom: 20px;">Bitte vervollständige als letzten Schritt noch dein Profil, damit du Interesse bei anderen Benutzern erweckst</p>
        </div>
    </div>
    
    <div class="row center-xs">
        <div class="col-xs-12 col-sm-8 h_login_get_style h_text_center center-xs">
            <div class="row center-xs">
                <label for="new_slogan">
                    <i class="fas fa-quote-right"></i>
                </label>
                <input title="Gib hier ein Motto, einen Slogan oder eine Kurzbeschreibung an. Dieser Text erscheint in deinem Profil." type="text" id="new_slogan" name="new_slogan" value="${saved_profile_slogan}" placeholder="Slogan" required>
            </div>
        

            <div class="row center-xs">
                <label for="new_nickname">
                    <i class="far fa-address-card"></i>
                </label>
                <input title="Gib hier deinen Spitznamen ein. Dieser erscheint in deinem Profil." type="text" id="new_nickname" name="new_nickname" value="${saved_profile_nickname}" placeholder="Spitzname" required>
            </div>

            <div class="row center-xs h_cursor_pointer" id="action_file_input_container" onclick="TriggerUploadModal();">
                <label for="new_username">
                    <i class="far fa-id-badge"></i>
                </label>
                <span class="h_upload_text h_margin_bottom">
                    Wähle ein Profilbild aus!
                </span>
            </div>
             
            <div class="row h_margin_vertical h_padding_horizontal around-sm" id="action_image_preview_wrapper">
                
            </div>

             
            <hr class="h_margin_vertical">
            
            <div class="row h_margin_vertical h_position_relative">
                <div class="col-xs-5 end-xs">
                    <label style="margin-left: 70px; margin-top: 20px;" title="Wähle aus, ob wir dir einen Bestätigungscode an deine ${cVerifyKeyword} senden sollen." for="new_verification">
                        <i class="fas fa-certificate"></i>
                        <input type="checkbox" onchange="SetRequired();" name="new_verification" id="new_verification" value="new_verification">
                        <span style="margin-left: 70px; margin-top: 20px;" title="Wähle aus, ob wir dir einen Bestätigungscode an deine ${cVerifyKeyword} senden sollen."   class="i_check_mark"></span>
                    </label>
                </div>
                <div class="col-sm-5 start-xs">
                    <p style="margin-top: 0;"><small>${cVerifyMessage}</small></p>
                </div>
            </div>
            
EOF;
            if ( $cVerified == 2 ) {
                echo <<<EOF
            <div class="row center-xs">
                <label for="new_email">
                    <i class="fas fa-envelope"></i>
                </label>
                <input title="Um dein Konto zusätzlich zu sichern gib bitte deine E-Mail-Adresse an. Du kannst dich nach der Bestätigung mit Handynummer oder E-Mail-Adresse anmelden." type="email" id="new_email" name="new_email" value="${saved_profile_email}" placeholder="E-Mail-Adresse">
            </div>
            
EOF;
            } else if ( $cVerified == 1 ) {
                echo <<<EOF
            <div class="row h_no_margin center-xs">
                <label for="new_number">
                    <i class="fas fa-phone"></i>
                </label>
                <input style="min-width: 100%; max-width: none;" onchange="getPhoneNumberForm();" title="Gib hier eine Telefonnummer an, mit der du dein Konto bestätigen möchtest." type="tel" id="new_phone" name="new_phone" value="${saved_profile_phone}" placeholder="Handynummer">
            </div>   
EOF;
            }
        echo <<<EOF
            
            <div class="row h_margin_vertical">
                <div class="col-sm-12">
                    <div title="Derzeit: Vervollständige dein Profil." class="s_status_point s_status_point_pending"></div>
                    <div title="Ausstehend: Vervollständige deine Geografischen Daten." class="s_status_point"></div>
                    <div title="Ausstehend: Teile uns deine Interessen mit, damit wir deinen Feed erstellen können." class="s_status_point"></div>
                    <div title="Ausstehend: Folge anderen Profilen" class="s_status_point"></div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <button class="h_margin_vertical b_large_action_button" type="submit" title="Eingaben merken und weiter zu den geografischen Angaben.">Weiter&nbsp;&nbsp;<i class="fas fa-forward"></i></button>
                </div>
            </div>                                
        </div>
    </div>
EOF;
} else if ( $cPage == 2 ) {
    echo <<<EOF
    <div class="row">
        <div class="col-xs-12">
            <h1 style="margin-bottom: 10px;">Dein Standort</h1>
        </div>
    </div>
    
    <div class="row center-xs">
        <div class="col-xs-12 col-sm-8 h_login_get_style h_text_center center-xs">
            <div class="row center-xs">
                <div class="col-xs-12 h_margin_bottom">
                    <p>Deine genaue Position wird verschlüsselt in unserer Datenbank gespeichert und nicht ohne dein Einverständnis an andere Benutzer weitergegeben.</p>
                </div>
            </div>
            
            <div class="row center-xs">
                <div class="row col-xs-12 col-sm-12 h_fit_content center-xs">
                    <label for="new_road">
                        <i class="fas fa-road"></i>
                    </label>
                    <input style="width: 100%;" title="Gib die Straße deiner Wohnadresse an." type="text" id="new_road" name="new_road" value="" placeholder="Straße" required>
                </div>
            </div>
            
            <div class="row center-xs">
                <div class="row col-xs-12 col-sm-6 center-xs">
                    <label for="new_stair">
                        <i class="fas fa-home"></i>
                    </label>
                    <input style="width: 100px;" title="Gib die Stiegennummer deiner Wohnadresse an." type="text" id="new_stair" name="new_stair" value="" placeholder="Stiege">
                </div>
                <div class="row col-xs-12 col-sm-6 center-xs">
                    <label for="new_door">
                       <i class="fas fa-door-open"></i>
                    </label>
                    <input style="width: 100px;" title="Gib die Türnummer deiner Wohnadresse an." type="text" id="new_door" name="new_door" value="" placeholder="Tür">
                </div>
            </div>
            
            <div class="row center-xs">
                <div class="row col-xs-12 col-sm-12 h_fit_content center-xs">
                    <label for="new_search">
                        <i class="fas fa-map-signs"></i>
                    </label>
                    <input style="width: 100%;" title="Gib hier die Stadt in der du wonst an." type="text" id="new_search" name="new_search" value="" placeholder="Stadt" required>
                </div>
            </div>
                        
            <div class="row center-xs">
                <div class="row col-xs-12 col-sm-6 h_fit_content center-xs">
                     <label for="new_zip">
                        <i class="fas fa-mail-bulk"></i>
                    </label>
                    <input title="Gib hier die Postleitzahl deiner Wohnadresse an." type="text" id="new_zip" name="new_zip" value="" style="max-width: 10%;" placeholder="Postleitzahl" required>
                </div>
                <div class="row col-xs-12 col-sm-6 h_fit_content center-xs">
                    <label title="Wähle das Land in dem du wohnst aus." for="new_country">
                        <i class="fas fa-globe-europe"></i>
                    </label>
                    <select class="select-css" title="Wähle das Land in dem du wohnst aus." name="new_country" id="new_country">
EOF;
    MakeCountryOption( "AT", $database );

    echo <<<EOF
                    </select>

                </div>
            </div>
            
            <hr>      
            
            <div class="row h_margin_vertical">
                <div class="col-sm-5 end-xs">
                    <button style="margin-top: 15px; min-width: 200px;" class="b_large_action_button" title="Vorschläge werden auf Grund der Stadt, der Postleitzahl und deines Landes erzeugt. Sollten wir keinen Treffer finden, überprüfe bitte die Rechtschreibung deiner Eingabe." type="button" onclick="PreviewCities();"><i class="fas fa-building"></i> Vorschläge generieren</button>
                </div>
                <div class="col-sm-6 start-xs">
                    <p style="margin-top: 0;"><small>Du kannst eine ungefähre Postition angeben, diese wird anderen Benutzern in deinem Profil angezeigt. Du kannst so Freunde in deiner Nähe finden oder Entfernungen anzeigen. </small></p>
                </div>
            </div>
            
           
            
            <div class="row center-xs h_margin_bottom_large">
                <div class="col-xs-12 s_search_result_container" id="action_location_preview">
                
                </div>
            </div>
            
            <div class="row center-xs h_margin_top">
                <div class="col-xs-12" id="action_city_preview">
                
                </div>
            </div>
            
            <div class="row h_margin_vertical">
                <div class="col-xs-12">
                    <div title="Erledigt: Vervollständige dein Profil." class="s_status_point s_status_point_done"></div>
                    <div title="Derzeit: Vervollständige deine Geografischen Daten." class="s_status_point s_status_point_pending"></div>
                    <div title="Ausstehend: Teile uns deine Interessen mit, damit wir deinen Feed erstellen können." class="s_status_point"></div>
                    <div title="Ausstehend: Folge anderen Profilen" class="s_status_point"></div>
                </div>
            </div>
            
           
            <div class="row h_margin_vertical">
                <div class="col-sm-12">
                    <button class="b_large_action_button h_margin_vertical" onclick="location.href='/website/complete/?cUserId=${cUserId}&cPage=3'" type="button" title="Eingaben verwerfen und zurück zu den geografischen Angaben."><i class="fas fa-backward"></i>&nbsp;&nbsp;Zurück</button>
                    <button class="b_large_action_button h_margin_vertical" type="submit" title="Eingaben merken und weiter zu den geografischen Angaben.">Weiter&nbsp;&nbsp;<i class="fas fa-forward"></i></button>
                </div>
            </div>
        </div>
    </div>

    <script>
     PreviewCities();
    </script>
EOF;
} else if ( $cPage == 3 ) {
    echo <<<EOF
    <div class="row center-xs">
        <div class="col-xs-12 col-sm-8 h_login_get_style h_text_center center-xs">
            <div class="row">
                <div class="col-xs-12">
                    <h1 style="margin-bottom: 10px;">Deine Interessen</h1>
                </div>
            </div>
            
            <div class="row center-xs">
                <div class="col-xs-12 h_margin_bottom">
                    <p>Durch die Angaben deiner Interessen können wir deinen Feed für dich individualisieren und Suchergebnisse dannach ausrichten.</p>
                </div>
            </div>
            
EOF;

            PrintUserQuestions( 1 );

            echo <<<EOF
        
            
            <div class="row h_margin_vertical">
                <div class="col-sm-12">
                    <div title="Erledigt: Vervollständige dein Profil." class="s_status_point s_status_point_done"></div>
                    <div title="Erledigt: Vervollständige deine Geografischen Daten." class="s_status_point s_status_point_done"></div>
                    <div title="Derzeit: Teile uns deine Interessen mit, damit wir deinen Feed erstellen können." style="background: linear-gradient(90deg, #001A33 50%, #C1C1C1 50%);" class="s_status_point"></div>
                    <div title="Ausstehend: Folge anderen Profilen" class="s_status_point"></div>
                </div>
            </div>
            
            <div class="row h_margin_vertical">
                <div class="col-sm-12">
                    <button onclick="location.href='index.php?cStatus=2&cUserId=${cUserId}'" class="b_large_action_button h_margin_vertical" type="button" title="Eingaben verwerfen und zurück zu den geografischen Angaben."><i class="fas fa-backward"></i>&nbsp;&nbsp;Zurück</button>
                    <button class="b_large_action_button" type="submit" title="Eingaben merken und weiter zum zweiten Teil deiner Interessen.">Weiter&nbsp;&nbsp;<i class="fas fa-forward"></i></button>
                </div>
            </div>
        </div>
    </div>
EOF;
} else if ( $cPage == 4 ) {
    echo <<<EOF
    <div class="row center-xs">
        <div class="col-xs-12 col-sm-8 h_login_get_style h_text_center center-xs">
            <div class="row">
                <div class="col-xs-12">
                    <h1 style="margin-bottom: 10px;">Deine Interessen</h1>
                </div>
            </div>
            
            <div class="row center-xs">
                <div class="col-xs-12 h_margin_bottom">
                    <p>Durch die Angaben deiner Interessen können wir deinen Feed für dich individualisieren und Suchergebnisse dannach ausrichten.</p>
                </div>
            </div>
            
EOF;

    PrintUserQuestions( 2 );

    echo <<<EOF
        
            
            <div class="row h_margin_vertical">
                <div class="col-sm-12">
                    <div title="Erledigt: Vervollständige dein Profil." class="s_status_point s_status_point_done"></div>
                    <div title="Erledigt: Vervollständige deine Geografischen Daten." class="s_status_point s_status_point_done"></div>
                    <div title="Derzeit: Teile uns deine Interessen mit, damit wir deinen Feed erstellen können." style="background: linear-gradient(90deg, green 50%, #001A33 50%);" class="s_status_point s_status_point_pending"></div>
                    <div title="Ausstehend: Folge anderen Profilen" class="s_status_point"></div>
                </div>
            </div>
            
            <div class="row h_margin_vertical">
                <div class="col-sm-12">
                    <button onclick="location.href='index.php?cStatus=3&cUserId=${cUserId}'" class="b_large_action_button h_margin_vertical" type="button" title="Eingaben verwerfen und zurück zu den geografischen Angaben."><i class="fas fa-backward"></i>&nbsp;&nbsp;Zurück</button>
                    <button class="b_large_action_button h_margin_vertical" type="submit" title="Eingaben merken und weiter zu den geografischen Angaben.">Weiter&nbsp;&nbsp;<i class="fas fa-forward"></i></button>
                </div>
            </div>
        </div>
    </div>
EOF;
} else if ( $cPage == 5 ) {


    echo <<<EOF
    <div class="row">
        <div class="col-xs-12">
            <h1>Folge anderen Benutzern</h1>
        </div>
    </div>
    
    <div class="row center-xs">
        <div class="col-xs-12 col-sm-8 h_login_get_style h_text_center center-xs">
            <div class="s_user_modal_content" style="margin-top: 0">
                <div class="s_user_modal_header">Vorschläge</div>
                <div class="s_user_modal_user_container" id="action_present_top_user">

                </div>
            </div>
            
            <div class="row h_margin_vertical">
                <div class="col-sm-12">
                    <div title="Erledigt: Vervollständige dein Profil." class="s_status_point s_status_point_done"></div>
                    <div title="Erledigt: Vervollständige deine Geografischen Daten." class="s_status_point s_status_point_done"></div>
                    <div title="Erledigt: Teile uns deine Interessen mit, damit wir deinen Feed erstellen können." class="s_status_point s_status_point_done"></div>
                    <div title="Derzeit: Folge anderen Profilen" class="s_status_point s_status_point_pending"></div>
                </div>
            </div>
            
            <div class="row h_margin_vertical">
                <div class="col-sm-12">
                    <button onclick="location.href='index.php?cStatus=4&cUserId=${cUserId}'" class="b_large_action_button h_margin_vertical" type="button" title="Eingaben verwerfen und zurück zu den geografischen Angaben."><i class="fas fa-backward"></i>&nbsp;&nbsp;Zurück</button>
                    <button class="b_large_action_button h_margin_vertical" type="submit" title="ingaben hochladen und weiter zu deinem neuen Dashboard.">Abschließen und Starten&nbsp;&nbsp;<i class="fas fa-forward"></i></button>
                </div>
            </div>
        </div>
    </div>

    <script>
    
        PreviewTopUser();
    
    </script>
EOF;
}