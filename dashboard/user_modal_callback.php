<?php
include('../essentials/session.php');


    echo <<<EOF
        <div class="s_user_modal_content">
            <span class="close_user_modal"><i class="far fa-times"></i></span>
            
            
            
            
            
EOF;

if ( isset($_REQUEST['cUser'], $_REQUEST['cType']) ) {
    $cUser = $_REQUEST['cUser'];
    $cType = $_REQUEST['cType'];
    if ( $cType == "followed" ) {
        if ($select_follower = $database->prepare('SELECT follower AS name, created FROM follower WHERE followed=? ORDER BY created DESC')) {
            $select_follower->bind_param("s", $cUser);
            $select_follower->execute();
            $result = $select_follower->get_result();
            $Follower= mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        echo "<div class=\"s_user_modal_header\">Abonnenten</div><div class=\"s_user_modal_user_container\">";

        DisplayUsers( $Follower, $database );
    } elseif ( $cType == "following" ) {
        if ($select_following = $database->prepare('SELECT followed AS name, created FROM follower WHERE follower=? ORDER BY created DESC')) {
            $select_following->bind_param("s", $cUser);
            $select_following->execute();
            $result = $select_following->get_result();
            $Following= mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        echo "<div class=\"s_user_modal_header\">Abonniert</div><div class=\"s_user_modal_user_container\">";

        DisplayUsers( $Following, $database );
    } elseif ( $cType == "v" || $cType == "i" || $cType == "t" || $cType == "p" ) {
        $cId = $_REQUEST['cId'];
        if ($select_following = $database->prepare('SELECT username AS name, created FROM likes WHERE element_id=? AND type=? ORDER BY created DESC')) {
            $select_following->bind_param("ss", $cId, $cType);
            $select_following->execute();
            $result = $select_following->get_result();
            $Following= mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        echo "<div class=\"s_user_modal_header\">Gefällt</div><div class=\"s_user_modal_user_container\">";

        DisplayUsers( $Following, $database );
    }
}

            echo <<<EOF
        </div></div>
EOF;


?>