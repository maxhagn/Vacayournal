<?php
include('../../essentials/session.php');

$cIndex = 1;
if ( isset($_REQUEST['cIndex']) ) {
    $cIndex = $_REQUEST['cIndex'];
}

$cUserId = $_SESSION['id'];
$cUserName = GetUserName( $cUserId, $database );

if ( $cIndex == 1 ) {

    if ($select_overview = $database->prepare('SELECT first_name, last_name, middle_name FROM users WHERE id=?')) {
        $select_overview->bind_param('s', $cUserId);
        $select_overview->execute();
        $select_overview->bind_result($cFirstName, $cLastName, $cMiddleName);
        $select_overview->fetch();
        $select_overview->close();
    }


    print <<<EOF
    <form method="POST" enctype="multipart/form-data" onsubmit="SaveSettings( this, event, '1' );">
        <div class="row middle-xs center-xs">
            <div class="col-xs-12">
                <div class="row middle-xs h_margin_bottom">
                    <div class="col-xs-4 end-xs middle-xs">
                        Vorname
                    </div>
                    <div class="col-xs-8 start-xs middle-xs">
                        <input name="cFirstName" type="text" value="${cFirstName}" required>
                    </div>
                </div>
                <div class="row middle-xs h_margin_bottom">
                    <div class="col-xs-4 end-xs middle-xs">
                        Zweiter Vorname
                    </div>
                    <div class="col-xs-8 start-xs middle-xs">
                        <input name="cMiddleName" type="text" placeholder="Optional" value="${cMiddleName}">
                    </div>
                </div>
                <div class="row middle-xs h_margin_bottom">
                    <div class="col-xs-4 end-xs middle-xs">
                        Nachname
                    </div>
                    <div class="col-xs-8 start-xs middle-xs">
                        <input name="cLastName" type="text" value="${cLastName}" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row middle-xs center-xs h_margin_top_middle">
            <div class="col-xs-8 start-xs middle-xs">
                <p><b>Informationen:</b> Bitte verwende die übliche Groß-Kleinschreibung und füge keine Sonderzeichen hinzu. Dein Name kann nur alle 2 Monate geändert werden und beeinflusst indirekt deinen Benutzernamen.</p>
            </div>
        </div>
        <div class="row middle-xs center-xs h_margin_top_middle">
            <div class="col-xs-12">
                <button type="button" onclick="CancelEdit();" class="b_settings_edit">Abbrechen</button>
                <button type="submit" class="b_settings_edit">Speichern</button>
            </div>
        </div>
    </form>
EOF;

} else if ( $cIndex == 2 ) {

    if ($select_overview = $database->prepare('SELECT url_name FROM users WHERE id=?')) {
        $select_overview->bind_param('s', $cUserId);
        $select_overview->execute();
        $select_overview->bind_result($cUrlName);
        $select_overview->fetch();
        $select_overview->close();
    }

    print <<<EOF
    <form method="POST" enctype="multipart/form-data" onsubmit="SaveSettings( this, event, '2' );">
        <div class="row middle-xs center-xs">
            <div class="col-xs-12">
                <div class="row middle-xs h_margin_bottom">
                    <div class="col-xs-4 end-xs bottom-xs">
                        Benutzername
                    </div>
                    <div class="col-xs-8 start-xs middle-xs" >
                        <p style="font-size: 9px">https://www.vacayournal.com/dashboard/user/<br>?cUser=</p>
                        <input name="cUrlName" onkeyup="CheckUrlName();" type="text" id="action_url_name" value="${cUrlName}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row middle-xs center-xs h_margin_top_middle">
            <div class="col-xs-8 start-xs middle-xs">
                <p><b>Informationen:</b> Über deinen Benutzernamen kannst du dein Profil auf anderen Kanälen teilen, um deine Reichweite zu erhöhen. Verwende bitte nur Buchstaben, Zahlen und Punkte. Dein Benutzername sollte deinen echten Namen beinhalten.
                <p>Status: <span style="font-size: 12px;color: green;" id="action_answer_wrapper">Verfügbar</span></p>
                </p>
            </div>
        </div>
        <div class="row middle-xs center-xs h_margin_top_middle">
            <div class="col-xs-12">
                <button type="button" onclick="CancelEdit();" class="b_settings_edit">Abbrechen</button>
                <button type="submit" id="action_url_name_submit" class="b_settings_edit">Speichern</button>
            </div>
        </div>
    </form>
EOF;

} else if ( $cIndex == 3 ) {

    if ($select_overview = $database->prepare('SELECT email FROM users WHERE id=?')) {
        $select_overview->bind_param('s', $cUserId);
        $select_overview->execute();
        $select_overview->bind_result($cEmail);
        $select_overview->fetch();
        $select_overview->close();
    }

    print <<<EOF
    <form method="POST" enctype="multipart/form-data" onsubmit="SaveSettings( this, event, '3' );">
        <div class="row middle-xs center-xs">
            <div class="col-xs-12">
                <div class="row middle-xs h_margin_bottom">
                    <div class="col-xs-4 end-xs bottom-xs">
                        E-Mail-Adresse
                    </div>
                    <div class="col-xs-8 start-xs middle-xs">
                        <input name="cEmail" onkeyup="CheckEmail();" type="text" id="action_email" value="${cEmail}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row middle-xs center-xs h_margin_top_middle">
            <div class="col-xs-8 start-xs middle-xs">
                <p><b>Informationen:</b> Wenn du deine E-Mail-Adresse änderst, musst du diese erneut bestätigen. Löscht du deine einzige Konto-Bestätigung wirst du abgemeldet und musst zuerst deine E-Mail-Adresse bestätigen.
                <p>Status: <span style="font-size: 12px;color: green;" id="action_answer_wrapper">Verfügbar</span></p>
                </p>
            </div>
        </div>
        <div class="row middle-xs center-xs h_margin_top_middle">
            <div class="col-xs-12">
                <button type="button" onclick="CancelEdit();" class="b_settings_edit">Abbrechen</button>
                <button type="submit" id="action_url_name_submit" class="b_settings_edit">Speichern</button>
            </div>
        </div>
    </form>
EOF;

} else if ( $cIndex == 4 ) {

    if ($select_overview = $database->prepare('SELECT mobile FROM users WHERE id=?')) {
        $select_overview->bind_param('s', $cUserId);
        $select_overview->execute();
        $select_overview->bind_result($cMobile);
        $select_overview->fetch();
        $select_overview->close();
    }

    print <<<EOF
    <form method="POST" enctype="multipart/form-data" onsubmit="SaveSettings( this, event, '4' );">
        <div class="row middle-xs center-xs">
            <div class="col-xs-12">
                <div class="row middle-xs h_margin_bottom">
                    <div class="col-xs-4 end-xs bottom-xs">
                        Handynummer
                    </div>
                    <div class="col-xs-8 start-xs middle-xs">
                        <input name="cMobile" onkeyup="CheckMobile();" type="text" id="action_mobile" value="${cMobile}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row middle-xs center-xs h_margin_top_middle">
            <div class="col-xs-8 start-xs middle-xs">
                <p><b>Informationen:</b> Wenn du deine Handynummer änderst, musst du diese erneut bestätigen. Löscht du deine einzige Konto-Bestätigung wirst du abgemeldet und musst zuerst deine Handynummer bestätigen.
                <p>Status: <span style="font-size: 12px;color: green;" id="action_answer_wrapper">Verfügbar</span></p>
                </p>
            </div>
        </div>
        <div class="row middle-xs center-xs h_margin_top_middle">
            <div class="col-xs-12">
                <button type="button" onclick="CancelEdit();" class="b_settings_edit">Abbrechen</button>
                <button type="submit" id="action_url_name_submit" class="b_settings_edit">Speichern</button>
            </div>
        </div>
    </form>
EOF;

} else if ( $cIndex == 5 ) {

    if ($select_overview = $database->prepare('SELECT email FROM users WHERE id=?')) {
        $select_overview->bind_param('s', $cUserId);
        $select_overview->execute();
        $select_overview->bind_result($cEmail);
        $select_overview->fetch();
        $select_overview->close();
    }

    print <<<EOF
    <div class="row middle-xs center-xs">
        <div class="col-xs-12">
            <div class="row middle-xs h_margin_bottom">
                <div class="col-xs-4 end-xs bottom-xs">
                    Dokument
                </div>
                <div class="col-xs-8 start-xs middle-xs">
                    <input type="text" value="${cEmail}">
                </div>
            </div>
        </div>
    </div>
    <div class="row middle-xs center-xs h_margin_top_middle">
        <div class="col-xs-8 start-xs middle-xs">
            <p><b>Informationen:</b> Wenn dDOKSgen. Löscht du deine einzige Konto-Bestätigung wirst du abgemeldet und musst zuerst deine Handynummer bestätigen.
            <p>Status: <span style="font-size: 12px;color: green;" id="action_answer_wrapper">Verfügbar</span></p>
            </p>
        </div>
    </div>
    <div class="row middle-xs center-xs h_margin_top_middle">
        <div class="col-xs-12">
            <button type="button" onclick="CancelEdit();" class="b_settings_edit">Abbrechen</button>
            <button type="button" onclick="SaveEdit();" class="b_settings_edit">Speichern</button>
        </div>
    </div>
EOF;

} else if ( $cIndex == 20 ) {

    if ($select_overview = $database->prepare('SELECT nickname FROM users WHERE id=?')) {
        $select_overview->bind_param('s', $cUserId);
        $select_overview->execute();
        $select_overview->bind_result($cNickname);
        $select_overview->fetch();
        $select_overview->close();
    }


    print <<<EOF
    <form method="POST" enctype="multipart/form-data" onsubmit="SaveSettings( this, event, '20' );">
        <div class="row middle-xs center-xs">
            <div class="col-xs-12">
                <div class="row middle-xs h_margin_bottom">
                    <div class="col-xs-4 end-xs bottom-xs">
                        Spitzname
                    </div>
                    <div class="col-xs-8 start-xs middle-xs">
                        <input name="cNickname" type="text" placeholder="Optional" value="${cNickname}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row middle-xs center-xs h_margin_top_middle">
            <div class="col-xs-12">
                <button type="button" onclick="CancelEdit();" class="b_settings_edit">Abbrechen</button>
                <button type="submit" onclick="SaveEdit();" class="b_settings_edit">Speichern</button>
            </div>
        </div>
    </form>
EOF;

} else if ( $cIndex == 21 ) {

    if ($select_overview = $database->prepare('SELECT slogan FROM users WHERE id=?')) {
        $select_overview->bind_param('s', $cUserId);
        $select_overview->execute();
        $select_overview->bind_result($cSlogan);
        $select_overview->fetch();
        $select_overview->close();
    }


    print <<<EOF
    <form method="POST" enctype="multipart/form-data" onsubmit="SaveSettings( this, event, '21' );">
        <div class="row middle-xs center-xs">
            <div class="col-xs-12">
                <div class="row middle-xs h_margin_bottom">
                    <div class="col-xs-4 end-xs bottom-xs">
                        Slogan
                    </div>
                    <div class="col-xs-8 start-xs middle-xs">
                        <input name="cSlogan" type="text" placeholder="Optional" value="${cSlogan}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row middle-xs center-xs h_margin_top_middle">
            <div class="col-xs-12">
                <button type="button" onclick="CancelEdit();" class="b_settings_edit">Abbrechen</button>
                <button type="submit" onclick="SaveEdit();" class="b_settings_edit">Speichern</button>
            </div>
        </div>
    </form>
EOF;

}


?>