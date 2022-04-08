<?php
include("../../essentials/session.php");

$iImageId = "";
$iUserId = "";
if ( isset($_REQUEST['cImage']) ) {
    $iImageId = $_REQUEST['cImage'];
}

if ($select_image_data = $database->prepare('SELECT path,user_id,created,format FROM images WHERE id=?')) {
    $select_image_data->bind_param('i', $iImageId);
    $select_image_data->execute();
    $select_image_data->bind_result($iPath, $iUserId, $iCreated, $iFormat);
    $select_image_data->fetch();
    $select_image_data->close();
}

$iPath = "/website/" . $iPath;

$cType = "i";
if ($image_comment = $database->prepare('SELECT user_id,comment,created FROM comments WHERE element_id=? AND type=? ORDER BY created DESC')) {
    $image_comment->bind_param("is", $iImageId, $cType);
    $image_comment->execute();
    $result = $image_comment->get_result();
    $Comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

$cLiked = "";
if ($count_likes = $database->prepare('SELECT COUNT(*) FROM likes WHERE element_id=? AND type=?')) {
    $count_likes->bind_param('ss', $iImageId, $cType);
    $count_likes->execute();
    $count_likes->bind_result($cLiked);
    $count_likes->fetch();
    $count_likes->close();
}

$cCreatorImage = GetProfilePicture( $iUserId, $database );

$iUsername = GetUserName( $iUserId, $database );

if ( $cLiked == 0 ) {
    $cLiked = "Sei der/die Erste, dem <b style='cursor: pointer;' onclick=\"Like('${iImageId}', 'i', '0', '1');\">das gefällt</b>";
} else {
    $cLiked = "<b style='cursor: pointer;' onclick=\"ToggleUserModal('${cUserId}', '${iImageId}', 'i', '1');\">Gefällt " . $cLiked . " Mal</b>";
}

$iSize = "s_modal_image_" . $iFormat;
$iCreated = FormatJustDate($iCreated);


echo <<<EOF
        <div class="modal-content">
            <span class="close"><i class="far fa-times-circle"></i></span>
            
            <div class="row">
            
                    <div class="${iSize}" style="background-image: url(${iPath})"></div>
                    
                    
                    <div class="s_modal_text_container" id="action_element_information_${cType}_${iImageId}">
                        <div class="s_modal_creator"> 
                            <div class="row">
                                <div class="row col-sm-2 center-sm middle-sm">
                                
                                    <div class="h_round_image" style="background-image: url(${cCreatorImage});"></div>
                                
                                </div>
                                <div class="col-sm-10">
                                
                                    ${iUsername}
                                
                                </div>
                            </div>
                         </div>
                        
                             
                        <div class="s_modal_comments">
EOF;

                        foreach ($Comments as $Comment):

                            $uPath = GetProfilePicture( $Comment["user_id"], $database );
                            $uCreated = FormatJustTime( $Comment["created"] );

                            echo <<<EOF
                            <div class="row s_show_comment">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="h_round_image" style="margin-top: 5px; background-image: url(${uPath});"></div>
                                        </div>
                                        <div class="col-sm-10 h_padding_vertical">${Comment["comment"]}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-offset-10 col-sm-2 h_padding_vertical">
                                            ${uCreated}
                                        </div>
                                    </div>
                                </div>
                            </div>
EOF;

                        endforeach;

echo <<<EOF
                    </div>

                    <div class="s_modal_action_buttons">
                        <div class="row">
                            <div class="col-sm-12 h_margin_top_small">
                                <div class="row">
EOF;


                                $currentLike = "";
                                if ($current_user_like = $database->prepare('SELECT COUNT(*) FROM likes WHERE element_id=? AND type=? AND username=?')) {
                                    $current_user_like->bind_param('sss', $iImageId, $cType, $_SESSION['name']);
                                    $current_user_like->execute();
                                    $current_user_like->bind_result($currentLike);
                                    $current_user_like->fetch();
                                    $current_user_like->close();
                                }

                                if ( $currentLike == 0 ) {
                                    echo "<div class=\"col-sm-2\"><button onclick=\"Like('${iImageId}', 'i', '0');\"><i class=\"far fa-heart\"></i></i></button></div>";
                                } else {
                                    echo "<div class=\"col-sm-2\"><button onclick=\"Like('${iImageId}', 'i', '1');\"><i class=\"far fa-heart-broken\"></i></i></button></div>";
                                }

                                echo <<<EOF
                                
                                    
                                    <div class="col-sm-2"><button><i class="far fa-caret-square-right"></i></button></div>
                                    <div class="col-sm-offset-6 col-sm-1"><button><i class="far fa-bookmark"></i></button></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 h_margin_top_small h_margin_left_small">${cLiked}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 h_margin_top_small h_margin_left_small"><small>Erstellt am ${iCreated}</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="s_modal_input">
                        <textarea id="action_comment_textarea_i_${iImageId}" placeholder="Kommentar hinzufügen"></textarea>
                        <button onclick="WriteComment( '${iImageId}', 'i', '1' );">Posten</button>
                    </div>
                </div>
            </div>
          </div>



EOF;


