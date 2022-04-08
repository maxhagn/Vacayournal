<?php
include('../essentials/session.php');


if ($chat_user = $database->prepare('SELECT sender_id, last_action FROM chats WHERE receiver_id=? ORDER BY last_action DESC')) {
    $chat_user->bind_param('s', $_SESSION["id"]);
    $chat_user->execute();
    $result = $chat_user->get_result();
    $Users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $chat_user->close();
}

$reverse = array_reverse( $Users );
$pop = array_pop($reverse);
if( isset( $_REQUEST['cUserId'] ) ) {
    $last_action_user['sender_id'] = $_REQUEST['cUserId'];
} else {
    $last_action_user = $pop;
}

$iPath = GetProfilePicture( $last_action_user, $database);
$cUserProfileImage = GetProfilePicture( $_SESSION["id"], $database );


echo <<<EOF
    <div class="container">
        <section class="s_chat_container">
        <div class="row middle-sm s_chat_bar">
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="h_round_image" style="background-image: url(${cUserProfileImage});">
            
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <button>
                            <i class="fas fa-comments"></i>
                        </button>
                        <button>
                            <i class="fas fa-angle-double-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="row middle-sm">
                    <div class="col-sm-1">
                        <div class="h_round_image" style="background-image: url(${iPath}); background-size: 60%; background-color: gray; filter: invert(100%);">
            
                        </div>
                    </div>
                    <div class="col-sm-2">
                        ${last_action_user['sender_id']}
                    </div>
                    <div class="col-sm-9 end-sm">
                        <button>
                            <i class="fas fa-search"></i>
                        </button>
                        <button>
                            <i class="fas fa-paperclip"></i>
                        </button>
                        <button>
                            <i class="fas fa-angle-double-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 s_user_container">
EOF;
             ShowUserChat( $Users, $last_action_user, $database );
echo <<<EOF
            </div>
            <div class="col-sm-8">
                <div id="message_container" class="row s_message_container">
EOF;

             ShowMessages( $last_action_user, $database );

echo <<<EOF
                </div>
                
                <div class="row s_input_container">
                    <div class="col-sm-12">
                        <button id="sendMessage" onclick="sendMessage( '${last_action_user['sender_id']}');"><i class="far fa-laugh"></i></button>
                        <textarea  id="message" placeholder="Hier deine Nachricht"></textarea>
                        <button id="sendMessage" onclick="sendMessage( '${last_action_user['sender_id']}' );"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
        
            
        
        </script>
        
        </section>
        
    </div>
EOF;


?>


