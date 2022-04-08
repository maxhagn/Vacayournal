<?php
include("session.php");


if ($user_posts = $database->prepare('SELECT username, message, link, seen, created FROM notifications WHERE username=? ORDER BY created DESC')) {
    $user_posts->bind_param('s', $_SESSION['name']);
    $user_posts->execute();
    $result = $user_posts->get_result();
    $Notifications = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $user_posts->close();
}

foreach ( $Notifications as $Notification ):

    echo <<<EOF
    
            <div class="s_notification_box">
                ${Notification['message']}
            </div>

EOF;

endforeach;

?>