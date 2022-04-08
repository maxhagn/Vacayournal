<?php
include("resources/config/config.php");
include("mail.php");
include("mail_templates.php");
include("sms.php");
session_start();

$can_save = TRUE;
$cBirthDate = "";
$cUsername = "";

$cVerifyBy      = $_SESSION['saved_register_verify_by']   = $_REQUEST['new_verify_by'];

if ( $cVerifyBy != "" ) {

    if ( $cVerifyBy == "verify_by_email" ) {

        $cVerifyBy = 1;

    } else if ( $cVerifyBy == "verify_by_phone" ) {

        $cVerifyBy = 2;

    } else {

        $can_save = FALSE;
        $cVerifyBy = 0;

    }

} else {

    $can_save = FALSE;

}

$cPhone = "";
$cEmail = "";
if ( $cVerifyBy == 1 ) { $cEmail = $_SESSION['saved_register_email'] = $_REQUEST['new_email']; }
if ( $cVerifyBy == 2 ) { $cPhone = $_SESSION['saved_register_number'] = $_REQUEST['new_full_data']; }
$cFirstName     = $_SESSION['saved_register_username']    = $_REQUEST['new_username'];
$cLastName      = $_SESSION['saved_register_surname']     = $_REQUEST['new_surname'];
$cNumber        = $_SESSION['saved_register_phone']       = $_REQUEST['new_phone'];
$cDay           = $_SESSION['saved_register_day']         = $_REQUEST['new_day'];
$cMonth         = $_SESSION['saved_register_month']       = $_REQUEST['new_month'];
$cYear          = $_SESSION['saved_register_year']        = $_REQUEST['new_year'];
$cGender        = $_SESSION['saved_register_gender']      = $_REQUEST['new_gender'];
$cPassword      = $_REQUEST['new_password'];


// Check if all Data exists
if ( $cFirstName == "" ) { $_SESSION['register_error'][1] = "Bitte gib deinen Vornamen an!"; $can_save = FALSE; }
if ( $cLastName == "" ) { $_SESSION['register_error'][2] = "Bitte gib deinen Nachnamen an!"; $can_save = FALSE; }
if ( $cEmail == "" && $cVerifyBy == 1 ) { $_SESSION['register_error'][3] = "Bitte gib deine E-Mail-Adresse an!"; $can_save = FALSE; }
if ( $cNumber == "" && $cVerifyBy == 2 ) { $_SESSION['register_error'][4] = "Bitte gib deine Telefonnummer an!"; $can_save = FALSE; }
if ( $cDay == "" ) { $_SESSION['register_error'][5] = "Bitte gib den Tag deiner Geburt an!"; $can_save = FALSE; }
if ( $cMonth == "" ) { $_SESSION['register_error'][6] = "Bitte gib den Monat deiner Geburt an!"; $can_save = FALSE; }
if ( $cYear == "" ) { $_SESSION['register_error'][7] = "Bitte gib dein Geburtsjahr an!"; $can_save = FALSE; }
if ( $cGender == "" ) { $_SESSION['register_error'][8] = "Bitte gib dein Geschlecht an!"; $can_save = FALSE; }
if ( $cPhone == "" && $cVerifyBy == 2 ) { $_SESSION['register_error'][9] = "Bitte gib sowohl die Vorwahl als auch die Nummer an!"; $can_save = FALSE; }
if ( $cVerifyBy == "" ) { $_SESSION['register_error'][10] = "Bitte gib die Art der Veridierung an!"; $can_save = FALSE; }
if ( $cPassword == "" ) { $_SESSION['register_error'][11] = "Bitte gib ein Passwort an!"; $can_save = FALSE; }

// Merge Birth Date
if ( $cDay != "" && $cMonth != "" && $cYear ) {
    if ( $cDay < 10 ) { $cDay = "0" . $cDay; }
    if ( $cMonth < 10 ) { $cMonth = "0" . $cMonth; }
    $cBirthDate = $cYear . "-" . $cMonth . "-" . $cDay;

} else { $can_save = FALSE; }

// Merge User Name
if ( $cFirstName != "" && $cLastName != "" ) {
    if (preg_match('/[A-Za-z0-9]+/', $cFirstName) == 0) {
        $can_save = FALSE;
        $_SESSION['register_error'][12] = "Der Vorname ist nicht gültig!";
    }

    if (preg_match('/[A-Za-z0-9]+/', $cLastName) == 0) {
        $can_save = FALSE;
        $_SESSION['register_error'][13] = "Der Nachname ist nicht gültig!";
    }

    $cUsername = $cFirstName . " " . $cLastName;
} else { $can_save = FALSE; }


// Validate E-Mail
if ( $cVerifyBy == 1 ) {
    if (!filter_var($cEmail, FILTER_VALIDATE_EMAIL)) {
        $can_save = FALSE;
        $_SESSION['register_error'][14] = "Die E-Mail ist nicht gültig!";
    }
}


// Validate Password Length
if (strlen($cPassword) > 20 || strlen($cPassword) < 5) {
    $can_save = FALSE;
    $_SESSION['register_error'][15] = "Das Passwort muss zwischen 5 und 20 Zeichen lang sein!";
}

// Try Save
if ($can_save == TRUE) {
    if ($check_user = $database->prepare('SELECT id, password FROM users WHERE name=?')) {
        $check_user->bind_param('s', $cUsername);
        $check_user->execute();
        $check_user->store_result();
        $user_exist = $check_user->num_rows;
        $check_user->close();

        if ($user_exist > 0) {
            $_SESSION['register_error'][16] = "Der Benutzername existiert bereits, bitte wähle einen anderen!";
        } else {

            $cQuery = "";
            $cInsertValidation = "";
            if ( $cVerifyBy == 1 ) { $cQuery = "INSERT INTO users (name, password, email, created, changed, verified, birth_date, gender) VALUES (?, ?, ?, NOW(), NOW(), ?, ?, ?)"; $cInsertValidation = $cEmail; }
            elseif ( $cVerifyBy == 2 ) { $cQuery = "INSERT INTO users (name, password, mobile, created, changed, verified, birth_date, gender) VALUES (?, ?, ?, NOW(), NOW(), ?, ?, ?)"; $cInsertValidation = $cPhone; }

            if ($insert_user = $database->prepare( $cQuery )) {
                $cVerified = 0;
                $cPassword = password_hash($cPassword,PASSWORD_DEFAULT);
                $insert_user->bind_param('sssiss', $cUsername, $cPassword, $cInsertValidation, $cVerified, $cBirthDate, $cGender );
                $insert_user->execute();
                $insert_user->close();

                $cCode = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 20);
                if ($store_safety_code = $database->prepare('INSERT INTO safety_codes (username, code, requested, type) VALUES (?, ?, NOW(), ?)')) {
                    $store_safety_code->bind_param('ssi', $cUsername, $cCode, $cVerifyBy);
                    $store_safety_code->execute();
                    $store_safety_code->close();


                    if ( $cVerifyBy == 1 ) {

                        $cSubject = "Bestätigungsmail | Vacayournal";
                        $cMessage = DisplayRegisterMail( $cUsername, $cEmail, $cCode );
                        sendMail( $cSubject, $cMessage, $cEmail );

                    } else if ( $cVerifyBy == 2 ) {

                        $cNumber = trim( $cPhone );
                        $cNumber = str_replace("+", "", $cNumber);
                        $cMessage = "Du hast dich vor Kurzem für Vacaytional registriert. Bestätige bitte dein Konto, um deine Registrierung abzuschließen. Dein Sicherheitscode ist: ${cCode}";

                        sendSms($cPhone, $cMessage);

                    }


                    $cLocation = "Location: mail_verify_information.php?=cUsername=${cUsername}";
                    header($cLocation);

                } else {
                    $_SESSION['register_error'][17] = "Der E-Mail-Code konnte nicht erzeugt werden!";
                    header('Location: index.php?sSpecial=r');
                }
            } else {
                $_SESSION['register_error'][18] = "Es ist ein undefinierter Fehler beim Hochladen aufgetreten!";
                header('Location: index.php?sSpecial=r');
            }
        }
    } else {
        $_SESSION['register_error'][19] = "Es ist ein undefinierter Fehler beim Hochladen aufgetreten!";
        header('Location: index.php?sSpecial=r');
    }
} else {
    $_SESSION['register_error'][20] = "Anfrage konnte nicht bearbeitet werden!";
    header('Location: index.php?sSpecial=r');
}

$database->close();
?>

