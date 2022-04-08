<?php
include("resources/config/config.php");
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
    $verified = 1;
    if ($stmt = $database->prepare('SELECT name, id, password FROM users WHERE ( email=? OR mobile=? ) AND verified=?')) {
            $stmt->bind_param('ssi', $_POST['username'], $_POST['username'], $verified);
            $stmt->execute();
            $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($sUsername, $id, $password);
            $stmt->fetch();

            if (password_verify($_POST['password'], $password)) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $sUsername;
                $_SESSION['id'] = $id;

                header('Location: dashboard.php');
            } else {
                $_SESSION['login_error'][1] = "Benutzername oder Password wurde falsch eingegeben";
                header('Location: index.php?sSpecial=l');
            }
        } else {
            $_SESSION['login_error'][1] = "Benutzername oder Password wurde falsch eingegeben";
            header('Location: index.php?sSpecial=l');
        }
        $stmt->close();

    }
} else {
    header('Location: index.php?sSpecial=l');
}

?>

