<?php
include('../../essentials/session.php');

$cEmail = "";
if ( isset($_REQUEST['cEmail']) ) {
    $cEmail = $_REQUEST['cEmail'];
}

if ($stmt = $database->prepare('SELECT * FROM users WHERE email=?')) {
    $stmt->bind_param('s', $cEmail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        echo "0";

    } else {

        echo "1";

    }
}
