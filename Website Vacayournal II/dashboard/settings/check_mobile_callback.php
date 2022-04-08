<?php
include('../../essentials/session.php');

$cUrlName = "";
if ( isset($_REQUEST['cMobile']) ) {
    $cMobile = $_REQUEST['cMobile'];
}

if ($stmt = $database->prepare('SELECT * FROM users WHERE mobile=?')) {
    $stmt->bind_param('s', $cMobile);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        echo "0";

    } else {

        echo "1";

    }
}
