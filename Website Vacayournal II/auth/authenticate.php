<?php
include("../resources/config/config.php");
session_start();
$can_login = TRUE;

if ( !isset($_POST['username'], $_POST['password']) ) {
    $can_login = FALSE;
    $_SESSION['login_error'][1] = "Benutzername oder Password wurde falsch eingegeben";
} else {
    $_SESSION['saved_login_username']= $_POST['username'];
}

if (empty($_POST['username']) || empty($_POST['password'])) {
    $can_login = FALSE;
    $_SESSION['login_error'][0] = "Bitte gib alle Daten an!";
}

if ( $can_login ) {
    if ($stmt = $database->prepare('SELECT first_name, last_name, id, password, verified FROM users WHERE email=? OR mobile=?')) {
            $stmt->bind_param('ss', $_POST['username'], $_POST['username']);
            $stmt->execute();
            $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($sFirstName,$sLastName, $id, $password, $verified);
            $stmt->fetch();


            if (password_verify($_POST['password'], $password)) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $sFirstName . " " . $sLastName;
                $_SESSION['id'] = $id;

                if ( isset($_COOKIE['session']) ) {
                    $cLoggedInUsers = $_COOKIE['session'];
                    $cLoggedInUsersArray = explode(",", $cLoggedInUsers);
                    $cAlreadySaved = FALSE;

                    foreach ($cLoggedInUsersArray as $cLoggedInUser) {
                        if ( $cLoggedInUser == $id ){
                            $cAlreadySaved = TRUE;
                        }
                    }

                    if ( $cAlreadySaved == FALSE ) {

                        $cLoggedInUsers= $cLoggedInUsers . "," . $id;
                        setcookie('session', $cLoggedInUsers);

                    }


                } else {

                    setcookie('session', $id);

                }



                if ( $verified == 0 ) {
                    $cLocation = "Location: /website/verify/mail_verify_information.php?cUserId=${id}";
                    header($cLocation);
                } elseif ( $verified == 1 || $verified == 2 ) {
                    $url = "Location: /website/complete/?cUserId=" . $id;
                    header( $url );
                } elseif ( $verified == 4 || $verified == 5 || $verified == 6  ) {
                    header('Location: /website/dashboard/');
                }
            } else {
                $_SESSION['login_error'][1] = "Benutzername oder Password wurde falsch eingegeben";
                header('Location: /website/index.php?sSpecial=l');
            }
        } else {
            $_SESSION['login_error'][1] = "Benutzername oder Password wurde falsch eingegeben";
            header('Location: /website/index.php?sSpecial=l');
        }
        $stmt->close();

    }
} else {
    header('Location: index.php?sSpecial=l');
}

?>

