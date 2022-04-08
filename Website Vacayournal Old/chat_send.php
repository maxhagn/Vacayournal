<?php
include("session.php");


$message = urldecode( $_GET['message'] );
$user = $_GET['user'];
$FALSE = 0;
$error = "";

// check and create sender chat
if ($check_chats = $database->prepare('SELECT id FROM chats WHERE sender=? AND receiver=?')) {
    $check_chats->bind_param('ss', $_SESSION['name'], $user);
    $check_chats->execute();
    $check_chats->store_result();
    $sender_available = $check_chats->num_rows;
    $check_chats->close();

    if ($sender_available > 0) {
        if ($update_chat = $database->prepare("UPDATE chats SET last_action=NOW(),archived=? WHERE sender=? AND receiver=?")) {
            $update_chat->bind_param('ssi', $FALSE, $_SESSION['name'], $user);
            $update_chat->execute();
            $update_chat->close();
        } else {
            $error = "Couldn't update sender chat";
        }
    } else {
        if ($insert_chat = $database->prepare("INSERT INTO chats (sender,receiver,archived,created) VALUES (?,?,?,NOW())")) {
            $insert_chat->bind_param('ssi', $_SESSION['name'], $user, $FALSE);
            $insert_chat->execute();
            $insert_chat->close();
        } else {
            $error = "Couldn't insert sender chat";
        }
    }
} else {
    $error = "Couldn't select sender chat";
}

// check and create receiver chat
if ($check_chats = $database->prepare('SELECT id FROM chats WHERE sender=? AND receiver=?')) {
    $check_chats->bind_param('ss', $user,$_SESSION['name']);
    $check_chats->execute();
    $check_chats->store_result();
    $receiver_available = $check_chats->num_rows;
    $check_chats->close();

    if ($receiver_available > 0) {
        if ($update_chat = $database->prepare("UPDATE chats SET last_action=NOW(),archived=? WHERE sender=? AND receiver=?")) {
            $update_chat->bind_param('ssi', $FALSE, $user, $_SESSION['name']);
            $update_chat->execute();
            $update_chat->close();
        } else {
            $error = "Couldn't update receiver chat";
        }
    } else {
        if ($insert_chat = $database->prepare("INSERT INTO chats (sender,receiver,archived,created) VALUES (?,?,?,NOW())")) {
            $insert_chat->bind_param('ssi', $user, $_SESSION['name'], $FALSE);
            $insert_chat->execute();
            $insert_chat->close();
        } else {
            $error = "Couldn't insert receiver chat";
        }
    }
} else {
    $error = "Couldn't select receiver chat";
}

if ( $error == 0 ) {
    if ($insert_message = $database->prepare("INSERT INTO messages (message,created,sender,receiver,seen) VALUES (?,NOW(),?,?,?)")) {
        $insert_message->bind_param('sssi', $message, $_SESSION['name'], $user, $FALSE);
        $insert_message->execute();
        $insert_message->close();
    } else {
        $error = "Couldn't insert message";
    }
}



echo $error;
?>