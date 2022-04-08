<?php
include('../../essentials/session.php');
include('../../essentials/mail.php');
include('../../essentials/mail_templates.php');
include('../../essentials/sms.php');

$cIndex = 1;
if (isset($_REQUEST['cIndex'])) {
    $cIndex = $_REQUEST['cIndex'];
}

$cUserId = $_SESSION['id'];
$cUserName = GetUserName($cUserId, $database);

if ($cIndex == 1) {
    if (isset($_REQUEST["cFirstName"])) {

        $cFirstName = $_REQUEST["cFirstName"];

        if ($set_slogan = $database->prepare('UPDATE users SET first_name=?, changed=NOW() WHERE id=?')) {
            $set_slogan->bind_param('ss', $cFirstName, $cUserId);
            $set_slogan->execute();
            $set_slogan->close();
        }
    }

    if (isset($_REQUEST["cLastName"])) {

        $cLastName = $_REQUEST["cLastName"];

        if ($set_nickname = $database->prepare('UPDATE users SET last_name=?, changed=NOW() WHERE id=?')) {
            $set_nickname->bind_param('ss', $cLastName, $cUserId);
            $set_nickname->execute();
            $set_nickname->close();
        }
    }

    if (isset($_REQUEST["cMiddleName"])) {

        $cMiddleName = $_REQUEST["cMiddleName"];

        if ($set_nickname = $database->prepare('UPDATE users SET middle_name=?, changed=NOW() WHERE id=?')) {
            $set_nickname->bind_param('ss', $cMiddleName, $cUserId);
            $set_nickname->execute();
            $set_nickname->close();
        }
    }
} else if ($cIndex == 2) {
    if (isset($_REQUEST["cUrlName"])) {

        $cUrlName = $_REQUEST["cUrlName"];

        if ($set_slogan = $database->prepare('UPDATE users SET url_name=?, changed=NOW() WHERE id=?')) {
            $set_slogan->bind_param('ss', $cUrlName, $cUserId);
            $set_slogan->execute();
            $set_slogan->close();
        }
    }
} else if ($cIndex == 3) {
    if (isset($_REQUEST["cEmail"])) {

        $cEmail = $_REQUEST["cEmail"];

        if ($set_slogan = $database->prepare('UPDATE users SET email=?, changed=NOW() WHERE id=?')) {
            $set_slogan->bind_param('ss', $cEmail, $cUserId);
            $set_slogan->execute();
            $set_slogan->close();
        }

        $ONE = 1;
        $cCode = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
        if ($store_safety_code = $database->prepare('INSERT INTO safety_codes (user_id, code, requested, type) VALUES (?, ?, NOW(), ?)')) {
            $store_safety_code->bind_param('ssi', $cUserId, $cCode, $ONE);
            $store_safety_code->execute();
            $store_safety_code->close();

            $cSubject = "Bestätigungsmail | Vacayournal";
            $cMessage = DisplayRegisterMail($cUserName, $cEmail, $cCode, $cUserId);
            sendMail($cSubject, $cMessage, $cEmail);

        }
    }
} else if ($cIndex == 4) {
    if (isset($_REQUEST["cMobile"])) {

        $cMobile = $_REQUEST["cMobile"];

        if ($set_slogan = $database->prepare('UPDATE users SET mobile=?, changed=NOW() WHERE id=?')) {
            $set_slogan->bind_param('ss', $cMobile, $cUserId);
            $set_slogan->execute();
            $set_slogan->close();
        }

        $TWO = 2;
        $cCode = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
        if ($store_safety_code = $database->prepare('INSERT INTO safety_codes (user_id, code, requested, type) VALUES (?, ?, NOW(), ?)')) {
            $store_safety_code->bind_param('ssi', $cUserId, $cCode, $TWO);
            $store_safety_code->execute();
            $store_safety_code->close();

            $cNumber = trim( $cMobile );
            $cNumber = str_replace("+", "", $cMobile);
            $cMessage = "Du hast dich vor Kurzem für Vacaytional registriert. Bestätige bitte dein Konto, um deine Registrierung abzuschließen. Dein Sicherheitscode ist: ${cCode}";

            sendSms($cMobile, $cMessage);

        }
    }
} else if ($cIndex == 20) {
    if (isset($_REQUEST["cNickname"])) {

        $cNickname = $_REQUEST["cNickname"];

        if ($set_slogan = $database->prepare('UPDATE users SET nickname=?, changed=NOW() WHERE id=?')) {
            $set_slogan->bind_param('ss', $cNickname, $cUserId);
            $set_slogan->execute();
            $set_slogan->close();
        }
    }
} else if ($cIndex == 21) {
    if (isset($_REQUEST["cSlogan"])) {

        $cSlogan = $_REQUEST["cSlogan"];

        if ($set_slogan = $database->prepare('UPDATE users SET slogan=?, changed=NOW() WHERE id=?')) {
            $set_slogan->bind_param('ss', $cSlogan, $cUserId);
            $set_slogan->execute();
            $set_slogan->close();
        }
    }
}

