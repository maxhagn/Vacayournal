<?php
include("../essentials/session.php");


if ($user_posts = $database->prepare('SELECT user_id, message, link, seen, created FROM notifications WHERE user_id=? ORDER BY created DESC')) {
    $user_posts->bind_param('s', $_SESSION['id']);
    $user_posts->execute();
    $result = $user_posts->get_result();
    $Notifications = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $user_posts->close();
}

    echo "solle was sein";

    foreach ( $Notifications as $Notification ):

        echo <<<EOF
        
                <div class="s_notification_box">
                    ${Notification['message']}
                </div>

EOF;

    endforeach;

?>