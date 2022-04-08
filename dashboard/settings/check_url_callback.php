<?php
include('../../essentials/session.php');

$cUrlName = "";
if ( isset($_REQUEST['cUrlName']) ) {
    $cUrlName = $_REQUEST['cUrlName'];
}

if ($stmt = $database->prepare('SELECT * FROM users WHERE url_name=?')) {
    $stmt->bind_param('s', $cUrlName);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        echo "0";

    } else {

        echo "1";

    }
}
