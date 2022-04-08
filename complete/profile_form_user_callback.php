<?php
include("../resources/config/config.php");
include("../essentials/essentials.php");
session_start();


if ($present_users = $database->prepare('SELECT id FROM users WHERE id!=? ORDER BY first_name LIMIT 10')) {
    $present_users->bind_param("s", $_SESSION["id"]);
    $present_users->execute();
    $result = $present_users->get_result();
    $Users = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

DisplayUsersNoLink( $Users, $database );


?>