<?php
include('../../essentials/session.php');

$cPage = 1;
if ( isset($_REQUEST['cPage']) ) {
    $cPage = $_REQUEST['cPage'];
}

$cUserId = $_SESSION['id'];
if ( $cPage == 1 ) {

    if ($select_overview = $database->prepare('SELECT first_name, middle_name, last_name, url_name, email, mobile, nickname FROM users WHERE id=?')) {
        $select_overview->bind_param( 's', $cUserId );
        $select_overview->execute();
        $select_overview->bind_result( $cFirstName, $cMiddleName, $cLastName, $cUrlName, $cEmail, $cMobile, $cNickname );
        $select_overview->fetch();
        $select_overview->close();
    }


    print <<<EOF
    <h1>Allgemeine Kontoeinstellungen</h1>
    
    <div id="action_settings_name_wrapper">
        <div id="action_settings_name" onclick="CallbackEdit('action_settings_name', '1');" class="row middle-xs s_change_preview">
            <div class="col-xs-3">
                Name
            </div>
            <div class="col-xs-7">
                ${cFirstName} ${cMiddleName} ${cLastName}
            </div>
            <div class="col-xs-2">
                <button type="button" class="b_settings_edit">Bearbeiten</button>
            </div>
        </div>
    </div>
    <div id="action_settings_username_wrapper">
        <div id="action_settings_username" onclick="CallbackEdit('action_settings_username', '2');" class="row middle-xs s_change_preview">
            <div class="col-xs-3">
                Benutzername
            </div>
            <div class="col-xs-7">
                https://vacayournal.com/dashboard/user/?sUser=${cUrlName}
            </div>
            <div class="col-xs-2">
                <button type="button" class="b_settings_edit">Bearbeiten</button>
            </div>
        </div>
    </div>
    <div id="action_settings_email_wrapper">
        <div id="action_settings_email" onclick="CallbackEdit('action_settings_email', '3');" class="row middle-xs s_change_preview">
            <div class="col-xs-3">
                E-Mail-Adresse
            </div>
            <div class="col-xs-7">
                ${cEmail}
            </div>
            <div class="col-xs-2">
                <button type="button" class="b_settings_edit">Bearbeiten</button>
            </div>
        </div>
    </div>
    <div id="action_settings_mobile_wrapper">
        <div id="action_settings_mobile" onclick="CallbackEdit('action_settings_mobile', '4');" class="row middle-xs s_change_preview">
            <div class="col-xs-3">
                Handynummer
            </div>
            <div class="col-xs-7">
                ${cMobile}
            </div>
            <div class="col-xs-2">
                <button type="button" class="b_settings_edit">Bearbeiten</button>
            </div>
        </div>
    </div>
    <div id="action_settings_identity_wrapper">
        <div id="action_settings_identity" onclick="CallbackEdit('action_settings_identity', '5');" class="row middle-xs s_change_preview">
            <div class="col-xs-3">
                Identität bestätigen
            </div>
            <div class="col-xs-7">
            </div>
            <div class="col-xs-2">
                <button type="button" class="b_settings_edit">Bearbeiten</button>
            </div>
        </div>
    </div>

EOF;

} elseif ( $cPage == 2 ) {

    if ($select_overview = $database->prepare('SELECT slogan, nickname FROM users WHERE id=?')) {
        $select_overview->bind_param( 's', $cUserId );
        $select_overview->execute();
        $select_overview->bind_result( $cSlogan, $cNickname );
        $select_overview->fetch();
        $select_overview->close();
    }

    print <<<EOF
    <h1>Öffentliche Informationen</h1>
    
    <div id="action_settings_nickname_wrapper">
        <div id="action_settings_nickname" onclick="CallbackEdit('action_settings_nickname', '20');" class="row middle-xs s_change_preview">
            <div class="col-xs-3">
                Spitzname
            </div>
            <div class="col-xs-7">
                ${cNickname}
            </div>
            <div class="col-xs-2">
                <button type="button" class="b_settings_edit">Bearbeiten</button>
            </div>
        </div>
    </div>
    
    <div id="action_settings_slogan_wrapper">
        <div id="action_settings_slogan" onclick="CallbackEdit('action_settings_slogan', '21');" class="row middle-xs s_change_preview">
            <div class="col-xs-3">
                Slogan
            </div>
            <div class="col-xs-7">
                ${cSlogan}
            </div>
            <div class="col-xs-2">
                <button type="button" class="b_settings_edit">Bearbeiten</button>
            </div>
        </div>
    </div>

EOF;

} elseif ( $cPage == 3 ) {

    if ($select_overview = $database->prepare('SELECT street, stair, door, city, zip, country, latitude, longitude FROM geo_user WHERE user_id=?')) {
        $select_overview->bind_param( 's', $cUserId );
        $select_overview->execute();
        $select_overview->bind_result( $cStreet, $cStair, $cDoor, $cCity, $cZip, $cCountryCode, $cLatitude, $cLongitude );
        $select_overview->fetch();
        $select_overview->close();
    }

    if ($select_overview = $database->prepare('SELECT country_name FROM geo_countries WHERE country_code=?')) {
        $select_overview->bind_param( 's', $cCountryCode );
        $select_overview->execute();
        $select_overview->bind_result( $cCountryName );
        $select_overview->fetch();
        $select_overview->close();
    }



    print <<<EOF
    <h1>Standort und Geografische Angaben</h1>
    
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-3">
            Land
        </div>
        <div class="col-xs-7">
            ${cCountryName}
        </div>
        <div class="col-xs-2">
            <button type="button" class="b_settings_edit">Bearbeiten</button>
        </div>
    </div>
    
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-3">
            Stadt
        </div>
        <div class="col-xs-7">
            ${cZip}, ${cCity}
        </div>
        <div class="col-xs-2">
            <button type="button" class="b_settings_edit">Bearbeiten</button>
        </div>
    </div>
    
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-3">
            Straße
        </div>
        <div class="col-xs-7">
            ${cStreet}/${cStair}/${cDoor}
        </div>
        <div class="col-xs-2">
            <button type="button" class="b_settings_edit">Bearbeiten</button>
        </div>
    </div>
    
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-3">
            Öffentliche Postition
        </div>
        <div class="col-xs-7">
            ${cCity} | ${cLatitude}/${cLongitude}
        </div>
        <div class="col-xs-2">
            <button type="button" class="b_settings_edit">Bearbeiten</button>
        </div>
    </div>

EOF;

} elseif ( $cPage == 4 ) {
    print <<<EOF
    <h1>Sicherheit und Login</h1>
    
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-3">
            Passwort
        </div>
        <div class="col-xs-7">
            ********
        </div>
        <div class="col-xs-2">
            <button type="button" class="b_settings_edit">Bearbeiten</button>
        </div>
    </div>
    
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-3">
            Benutzer speichern
        </div>
        <div class="col-xs-7">
            Letzte Anmeldungen werden auf der Startseite angezeigt.
        </div>
        <div class="col-xs-2">
            <button type="button" class="b_settings_edit">Bearbeiten</button>
        </div>
    </div>
    
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-3">
            Angemeldet bleiben
        </div>
        <div class="col-xs-7">
            Ein
        </div>
        <div class="col-xs-2">
            <button type="button" class="b_settings_edit">Bearbeiten</button>
        </div>
    </div>

EOF;

} elseif ( $cPage == 5 ) {
    print <<<EOF
    <h1>Privatsphäre</h1>
    
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-3">
            Wer kann deine nächsten Beiträge sehen?
        </div>
        <div class="col-xs-7">
            Öffentlich, Beiträge können gegebenfalls auch im Feed von neuen Benutzern gezeigt werden.
        </div>
        <div class="col-xs-2">
            <button type="button" class="b_settings_edit">Bearbeiten</button>
        </div>
    </div>
    
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-3">
            Wer kann dich abonieren?
        </div>
        <div class="col-xs-7">
            Alle
        </div>
        <div class="col-xs-2">
            <button type="button" class="b_settings_edit">Bearbeiten</button>
        </div>
    </div>
    
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-3">
            Wer kann deine zukünftigen Beiträge sehen?
        </div>
        <div class="col-xs-7">
            Letzte Anmeldungen werden auf der Startseite angezeigt.
        </div>
        <div class="col-xs-2">
            <button type="button" class="b_settings_edit">Bearbeiten</button>
        </div>
    </div>
    
        
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-3">
            Wer kann deine Abonnenten sehen?
        </div>
        <div class="col-xs-7">
            Öffentlich
        </div>
        <div class="col-xs-2">
            <button type="button" class="b_settings_edit">Bearbeiten</button>
        </div>
    </div>
    
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-3">
            Wer kann sehen wem ich folge?
        </div>
        <div class="col-xs-7">
            Öffentlich
        </div>
        <div class="col-xs-2">
            <button type="button" class="b_settings_edit">Bearbeiten</button>
        </div>
    </div>
    
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-3">
            Erscheint mein Name in anderen Abonentenlisten?
        </div>
        <div class="col-xs-7">
            Ja
        </div>
        <div class="col-xs-2">
            <button type="button" class="b_settings_edit">Bearbeiten</button>
        </div>
    </div>
    
        
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-3">
            Wer wird meine genaue Adresse angezeigt?
        </div>
        <div class="col-xs-7">
            Niemandem
        </div>
        <div class="col-xs-2">
            <button type="button" class="b_settings_edit">Bearbeiten</button>
        </div>
    </div>

EOF;

} elseif ( $cPage == 6 ) {
    print <<<EOF
    <h1>Deine Daten</h1>
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-9">
            Welche Daten speichert Vacayournal von mir?    
        </div>
        <div class="col-xs-3">
            <button type="button" class="b_settings_edit">Herunterladen</button>
        </div>
    </div>
        <div class="row middle-xs s_change_preview">
        <div class="col-xs-9">
            Ich möchte mein Konto und alle dazugehörigen Daten löschen!
        </div>
        <div class="col-xs-3">
            <button type="button" class="b_settings_edit">Konto löschen</button>
        </div>
    </div>

EOF;

} elseif ( $cPage == 7 ) {
    print <<<EOF
    <h1>Feed-Einstellungen</h1>
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-7">
            Zeige Beiträge von Personen, die du nicht aboniert hast.
        </div>
        <div class="col-xs-3">
            Nein
        </div>
        <div class="col-xs-2">
            <button type="button" class="b_settings_edit">Bearbeiten</button>
        </div>
    </div>
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-7">
            Zeige Beiträge von bestimmten Benutzern zuerst.
        </div>
        <div class="col-xs-3">
            Nein
        </div>
        <div class="col-xs-2">
            <button type="button" class="b_settings_edit">Bearbeiten</button>
        </div>
    </div>
    <div class="row middle-xs s_change_preview">
        <div class="col-xs-7">
            Ordne Beiträge nach bestimmten Kriterien. 
        </div>
        <div class="col-xs-3">
            Standard
        </div>
        <div class="col-xs-2">
            <button type="button" class="b_settings_edit">Bearbeiten</button>
        </div>
    </div>

EOF;

}