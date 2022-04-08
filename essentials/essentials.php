<?php


// ---------- Essential Make, Get and Format Functions ---------- //
// ---------- Make Functions ---------- //
function MakeDayOption ( $preset ) {
    echo "<option value='Tag'>Tag</option>";
    for ($i = 1; $i <= 31; $i++) {
        if ( $i == $preset ) {
            echo "<option title='${i}. Tag des Monats' selected='selected' value='${i}'>" . ${i} . "</option>";
        } else {
            echo "<option title='${i}. Tag des Monats' value='${i}'>" . ${i} . "</option>";
        }
    }
}

function MakeMonthOption ( $preset ) {
    $months = array("Monat", "Jänner", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");

    for ($i = 0; $i <= 12; $i++) {
        if ( $i == $preset ) {
            echo "<option title='Monat ${months[$i]}' selected='selected' value='$i'>" . $months[$i] . "</option>";
        } else {
            echo "<option title='Monat ${months[$i]}' value='$i'>" . $months[$i] . "</option>";
        }
    }
}

function MakeYearOption ( $preset ) {
    echo "<option value='0'>Jahr</option>";

    for ($i = 1905; $i <= 2019; $i++) {
        if ( $i == $preset ) {
            echo "<option title='Jahr ${i}' selected='selected' value='${i}'>" . ${i} . "</option>";
        } else {
            echo "<option title='Jahr ${i}' value='${i}'>" . ${i} . "</option>";
        }
    }
}

function MakeTimePrecisionOption ( $preset ) {
    $precision = array( "", "Exakt", "Genau", "Ungefähr", "Geschätzt" );

    for ($i = 1; $i <= 4; $i++) {
        if ( $i == $preset ) {
            echo "<option selected='selected' value='$i'>" . $precision[$i] . "</option>";
        } else {
            echo "<option value='$i'>" . $precision[$i] . "</option>";
        }
    }
}

function MakeSeasonOption ( $preset ) {
    $season = array("Jahreszeit", "Winter", "Frühling", "Sommer", "Herbst");

    for ($i = 0; $i <= 4; $i++) {
        if ( $i == $preset ) {
            echo "<option selected='selected' value='$i'>" . $season[$i] . "</option>";
        } else {
            echo "<option value='$i'>" . $season[$i] . "</option>";
        }
    }
}

function MakeCountryOption ( $preset, $database ) {
    if ($all_countries = $database->prepare('SELECT country_name, country_code FROM geo_countries ORDER BY country_name')) {
        $all_countries->execute();
        $result = $all_countries->get_result();
        $Countries = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    if ( $preset == "" ) {
        echo "<option selected='selected' value='0'>Land</option>";
    } else {
        echo "<option value='0'>Land</option>";
    }

    foreach ($Countries as $Country):
        if ( $Country["country_code"] == $preset ) {
            echo <<<EOF
            
            <option selected='selected' value='${Country['country_code']}'>
                ${Country['country_name']}
            </option>

EOF;
        } else {
            echo <<<EOF
            <option value='${Country['country_code']}'> 
                ${Country['country_name']}
            </option>
            
EOF;
        }

    endforeach;
}

function MakeGroupTypeOption ( $preset ) {
    $season = array("Begleitung", "Alleinreiser", "Arbeitskollegen", "Familie", "Freunde", "Paar");



    for ($i = 0; $i <= 4; $i++) {
        if ( $i == $preset ) {
            echo "<option selected='selected' value='$i'>" . $season[$i] . "</option>";
        } else {
            echo "<option value='$i'>" . $season[$i] . "</option>";
        }
    }
}

function MakeTripTypeOption ( $preset ) {
    $season = array("Reiseart", "Geschäftsreise", "Partyurlaub", "Romantikurlaub", "Erholungsurlaub", "Backpacking", "Exchange", "Auslandsjahr", "Work and Travel", "Strandurlaub", "Kulturreise", "Rundreise", "Luxusurlaub", "Kreuzfahrt", "Sporturlaub", "Roadtrip", "Extremurlaube", "Städteurlaub", "Skiurlaub", "Wanderurlaub");

    for ($i = 0; $i <= 19; $i++) {
        if ( $i == $preset ) {
            echo "<option selected='selected' value='$i'>" . $season[$i] . "</option>";
        } else {
            echo "<option value='$i'>" . $season[$i] . "</option>";
        }
    }
}

function MakeTripTypeString ( $num ) {
    $season = array("Reiseart", "Geschäftsreise", "Partyurlaub", "Romantikurlaub", "Erholungsurlaub", "Backpacking", "Exchange", "Auslandsjahr", "Work and Travel", "Strandurlaub", "Kulturreise", "Rundreise", "Luxusurlaub", "Kreuzfahrt", "Sporturlaub", "Roadtrip", "Extremurlaube", "Städteurlaub", "Skiurlaub", "Wanderurlaub");
    $result = $season[$num];
    return $result;
}

function MakeTransportOption ( $preset ) {
    $season = array("Transport", "Flugzeug", "Auto", "Fahrrad", "zu Fuß", "Zug", "Bus", "Schiff");

    for ($i = 0; $i <= 7; $i++) {
        if ( $i == $preset ) {
            echo "<option selected='selected' value='$i'>" . $season[$i] . "</option>";
        } else {
            echo "<option value='$i'>" . $season[$i] . "</option>";
        }
    }
}

function MakeTypeString ( $string ) {
    $result = "";
    $array = explode (",", $string);

    foreach ($array as $element):
        $result.= $element . ", ";
    endforeach;

    $result = substr( $result, 0, strlen($result) - 2);

    return $result;
}

function FormatJustDate ( $timestamp ) {
    $date = new DateTime($timestamp);
    return $date->format('d.m.Y');
}

function FormatJustTime ( $timestamp ) {
    $date = new DateTime($timestamp);
    return $date->format('H:i');
}

function DateToTimePassed($timestamp)
{
    $time = strtotime($timestamp);
    $time = time() - $time;
    $time = ($time < 1) ? 1 : $time;
    $tokens = array(
        31536000 => 'Jahr',
        2592000 => 'Monat',
        604800 => 'Woche',
        86400 => 'Tag',
        3600 => 'Stunde',
        60 => 'Minute',
        1 => 'Sekunde'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 'en' : '');
    }

}

function IsFollowing ( $cUserId, $database ) {
    $cFollowing = "";

    if ($select_followed = $database->prepare('SELECT follower_id FROM follower WHERE follower_id=? AND followed_id=?')) {
        $select_followed->bind_param('ss', $_SESSION['id'], $cUserId);
        $select_followed->execute();
        $select_followed->store_result();
        $following = $select_followed->num_rows;
        $select_followed->close();

        if ( $following > 0 ) {
            $cFollowing = TRUE;
        } else {
            $cFollowing = FALSE;
        }
    }

    return $cFollowing;
}

function MakeFollowingButton ( $cUserId, $database ) {
    $cFollowing = IsFollowing( $cUserId, $database);
    $cUserName = GetUserName( $cUserId, $database );

    if ( $_SESSION['id'] != $cUserId && $cFollowing == FALSE) {


        echo <<<EOF
                                    
                                        <button class="s_user_modal_buttons" onclick="CallFollow( '${cUserId}', '0' );">
                                            Auch folgen
                                        </button>
                                    
EOF;
    } elseif ( $_SESSION['id'] != $cUserId && $cFollowing == TRUE) {
        echo <<<EOF

                                        <button class="s_user_modal_buttons" onclick="if(confirm('Möchtest du ${cUserName} wirklich nicht mehr Folgen?')) { CallFollow( '${cUserId}', '1'); }">
                                            Abonniert
                                        </button>
                                   
EOF;
    }
}

function GetProfilePicture ( $cUserId, $database ) {
    $PROFILE_PICTURES= "P";
    $ProfilePicturePath = "";
    if ($profile_image = $database->prepare('SELECT path FROM images WHERE user_id=? AND gallery=? ORDER BY id DESC LIMIT 1')) {
        $profile_image->bind_param('is', $cUserId, $PROFILE_PICTURES );
        $profile_image->execute();
        $profile_image->bind_result($ProfilePicturePath);
        $profile_image->fetch();
        $profile_image->close();



        if ( $ProfilePicturePath == "" ) {
            $ProfilePicturePath = "/resources/images/nouser.svg";
        } else {
            $ProfilePicturePath = "/" . $ProfilePicturePath;
        }
    }

    return $ProfilePicturePath;
}

function GetUserName ( $sUserId, $database ) {
    $sFirstName = "";
    $sLastName = "";
    $sUsername = "";

    if ($profile_image = $database->prepare('SELECT first_name, last_name FROM users WHERE id=?')) {
        $profile_image->bind_param( 's', $sUserId );
        $profile_image->execute();
        $profile_image->bind_result( $sFirstName, $sLastName );
        $profile_image->fetch();
        $profile_image->close();
    }

    $sUsername = $sFirstName . " " . $sLastName;
    return $sUsername;
}

function GetUserFirstName ( $sUserId, $database ) {
    $sFirstName = "";

    if ($profile_image = $database->prepare('SELECT first_name FROM users WHERE id=?')) {
        $profile_image->bind_param( 's', $sUserId );
        $profile_image->execute();
        $profile_image->bind_result( $sFirstName );
        $profile_image->fetch();
        $profile_image->close();
    }

    return $sFirstName;
}

function correctImageOrientation($filename) {
    if (function_exists('exif_read_data')) {
        $exif = exif_read_data($filename);
        if($exif && isset($exif['Orientation'])) {
            $orientation = $exif['Orientation'];
            if($orientation != 1){
                $img = imagecreatefromjpeg($filename);
                $deg = 0;
                switch ($orientation) {
                    case 3:
                        $deg = 180;
                        break;
                    case 6:
                        $deg = 270;
                        break;
                    case 8:
                        $deg = 90;
                        break;
                }
                if ($deg) {
                    $img = imagerotate($img, $deg, 0);
                }
                // then rewrite the rotated image back to the disk as $filename
                imagejpeg($img, $filename, 100);
            } // if there is some rotation necessary
        } // if have the exif orientation info
    } // if function exists
}


// ---------- Chat Messages and User Display ---------- //
function ShowUserChat($Users, $active_user, $database)
{
    $mMessage = "";
    foreach ($Users as $User):
        $iPath = GetProfilePicture( $User['sender_id'], $database );
        $cUserName = GetUserName( $User['sender_id'], $database );

        if ($profile_image = $database->prepare('SELECT message FROM messages WHERE (sender_id=? AND receiver_id=?) OR (sender_id=? AND receiver_id=?) ORDER BY created DESC LIMIT 1')) {
            $profile_image->bind_param('ssss', $_SESSION['id'], $User['sender_id'], $User['sender_id'], $_SESSION['id']);
            $profile_image->execute();
            $profile_image->bind_result($mMessage);
            $profile_image->fetch();
            $profile_image->close();
        }

        $SEEN = 0;
        $count_unread_messages = "";
        if ($count_unread = $database->prepare('SELECT COUNT(*) FROM messages WHERE sender_id=? AND receiver_id=? AND seen=?')) {
            $count_unread->bind_param('ssi', $User['sender_id'], $_SESSION['id'], $SEEN);
            $count_unread->execute();
            $count_unread->bind_result($count_unread_messages);
            $count_unread->fetch();
            $count_unread->close();
        }

        $mMessage = substr( $mMessage, 0, 50 ) . "...";
        $time_passed = FormatJustDate($User['last_action']);

        $background_color = "white";
        if ( $User['sender_id'] == $active_user['sender_id'] ) {
            $background_color = "#e9ebeb";
        }

        echo <<<EOF
            <div class="row s_show_user_chat" style="background-color: ${background_color}" onclick="call('${User['sender_id']}');">
                <div class="col-sm-2">
                    <div class="h_round_image" style="background-image: url($iPath); background-size: cover; background-color: gray;"></div>
                </div>
                <div class="col-sm-10">
                    <div class="row h_margin_bottom">
                        <div class="col-sm-8">
                            ${cUserName}
                        </div>
                        <div class="col-sm-4">
                            <div class="row h_no_margin end-sm">
                                ${time_passed}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            ${mMessage}
                        </div>
                        <div class="col-sm-4">
                            <div class="row h_no_margin end-sm">
                            
EOF;
        if ( $count_unread_messages > 0 ) {
            echo <<<EOF
                                <div class="s_user_unread">
                                    ${count_unread_messages}                        
                                </div> 
EOF;

        }

        echo <<<EOF
                            </div>
                        </div>
                    </div>
                </div>
            </div>
EOF;
    endforeach;
}

function ShowMessages( $user, $database )
{
    $SEEN = 1;
    $NOT_SEEN = 0;
    if ($update_seen = $database->prepare('UPDATE messages SET seen=? WHERE sender_id=? AND receiver_id=? AND seen=?' )) {
        $update_seen->bind_param('issi', $SEEN, $user['sender_id'], $_SESSION["id"], $NOT_SEEN);
        $update_seen->execute();
        $update_seen->close();
    }

    if ($chat_message = $database->prepare('SELECT sender_id, message, created FROM messages WHERE (sender_id=? AND receiver_id=?) OR (sender_id=? AND receiver_id=?) ORDER BY created ASC' )) {
        $chat_message->bind_param('ssss', $_SESSION["id"], $user['sender_id'], $user['sender_id'], $_SESSION["id"]);
        $chat_message->execute();
        $result = $chat_message->get_result();
        $Messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $chat_message->close();
    }

    foreach ( $Messages as $Message ):

        $justify = "flex-start";
        $background_color = "#FFFFFF";
        if ( $Message['sender_id'] == $_SESSION["id"] ) {
            $justify = "flex-end";
            $background_color = "#DCF8C6";
        }

        $time_passed = FormatJustTime($Message['created']);

        echo <<<EOF

        <div class="row" style="justify-content: ${justify};">
            <div class="col-sm-8 s_chat_message" style="background-color: ${background_color};">
                <div class="row h_no_padding">
                    <p class="h_no_margin_top_bottom">${Message['message']}</p>
                </div>
                <div class="row h_no_padding end-sm">
                    ${time_passed}
                </div>
            </div>
        </div>

EOF;

    endforeach;

}


// ---------- Display Functions ---------- //
// ---------- Timeline Display ---------- //
function DisplayTimeline ( $Data, $database ) {
    foreach ( $Data as $Row ):
        if ( $Row["type"] == "post" ) {
            DisplayPost( $Row, $database );
        } elseif ( $Row["type"] == "image" ) {
            DisplayImage( $Row, $database );
        } elseif ( $Row["type"] == "video" ) {
            DisplayVideo( $Row, $database );
        }
    endforeach;
}


// ---------- Posts Write and Display ---------- //
function DisplayWritePost (  ) {
    echo <<<EOF
        <section class="s_write_post">
            <div class="row">
                <div class="col-sm-12 s_write_post_heading">
                    <h3>Beitrag erstellen</h3>
                </div>
            </div>
    
            <form action="post.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12">
                <textarea class="h_underline" name="new_post" rows="5"
                          placeholder="Was machst du gerade, ${_SESSION['name']} ?"></textarea>
                    </div>
                </div>
    
                <div class="row h_padding_vertical">
                    <div class="col-sm-12">
                        <button>
                            <i class="fas fa-user-friends"></i>
                            Freunde markieren
                        </button>
                        <button>
                            <i class="far fa-image"></i>
                            Fotos hinzufügen
                        </button>
    
                        <button id="button_emotions" type="button" title="Emotionen" onclick="openEmotions();">
                            <i class="far fa-smile-wink"></i>
                            Emotionen
                        </button>
    
                        <button type="submit">
                            <i class="far fa-share-square"></i>
                            Teilen
                        </button>
                    </div>
                </div>
            </form>
        </section>
EOF;

}

function DisplayPosts($Posts, $database)
{
    foreach ($Posts as $Post):
        DisplayPost($Post, $database);
    endforeach;
}

function DisplayPost($Post, $database)
{
    $cPostType = "p";
    $cPostId = $Post['id'];
    $cPostUserId = $Post['user_id'];
    $cPostUser = GetUserName( $cPostUserId, $database );
    $cPostCreated = $Post['created'];
    $cPostText = $Post['post'];


    echo <<<EOF
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">  
            <div class="s_element_container">
                <div class="row middle-xs start-xs s_element_creator" id="action_element_header_${cPostType}_${cPostId}">
EOF;

    DisplayElementHeader( $cPostUserId, $database );

    echo <<<EOF
                </div>
                <div class="row middle-xs middle-sm middle-md middle-lg center-xs center-sm center-md center-lg">
                    <div class="col-sm-12 s_show_post_content">
                        <p>${cPostText}</p>
                    </div>
                </div>
                <div class="s_element_information" id="action_element_information_${cPostType}_${cPostId}">
EOF;

    DisplayElementInformationVertical( $cPostId, $cPostType, $database );

    echo <<<EOF
            
                </div>
            </div>
         </div>
     </div>

EOF;
}


// ---------- Display User for Likes, Follower, Followed and Online ---------- //
function DisplayUsers ( $Users, $database ) {

    foreach ( $Users as $User ):
        $cUserId = $User["id"];
        $cUserName = GetUserName( $cUserId, $database );
        $cProfileImage = GetProfilePicture( $cUserId, $database );

        echo <<<EOF
        <div class="row">
        <div class="col-xs-12">
            <div class="s_show_user_container">
                <div class="row">
                    <div class="col-sm-2 row middle-sm">
                        <div class="h_round_image" style="background-image: url(${cProfileImage})"></div>
                    </div>
                    <div class="col-sm-5">
                        <a href="index.php?tUsername=${cUserId}">${cUserName}</a>
                    </div>
                    <div class="col-sm-5 row end-sm middle-sm">
EOF;

                    MakeFollowingButton( $cUserId, $database );

        echo <<<EOF
                    </div>
                </div>
            </div>
            </div>
        </div>

EOF;
    endforeach;
}

function DisplayUserPredictions ( $Users, $database ) {

    foreach ( $Users as $User ):
        $cUserId = $User["id"];
        $cUserName = GetUserName( $cUserId, $database );
        $cProfileImage = GetProfilePicture( $cUserId, $database );

        echo <<<EOF
            <div class="s_show_user_container_flexible center-xs">
                    <div class="col-xs-2 row middle-sm">
                        <div class="h_round_image" style="border-radius:360%;background-image: url(${cProfileImage})"></div>
                    </div>
                    <div class="col-xs-6">
                        <a href="/dashboard/user/?tUsername=${cUserId}">${cUserName}</a>
                    </div>
                    <div class="col-xs-4 row end-sm middle-sm">
EOF;

        MakeFollowingButton( $cUserId, $database );

        echo <<<EOF
                    </div>
                </div>
EOF;
    endforeach;
}

function DisplayUsersNoLink ( $Users, $database ) {

    foreach ( $Users as $User ):
        $cUserId = $User["id"];
        $cUsername = GetUserName( $cUserId, $database );
        $cProfileImage = GetProfilePicture( $cUsername, $database );

        if ($select_followed = $database->prepare('SELECT follower_id FROM follower WHERE follower_id=? AND followed_id=?')) {
            $select_followed->bind_param('ss', $_SESSION['id'], $cUserId);
            $select_followed->execute();
            $select_followed->store_result();
            $following = $select_followed->num_rows;
            $select_followed->close();

            if ( $following > 0 ) {
                $following = TRUE;
            } else {
                $following = FALSE;
            }
        }


        echo <<<EOF
        <div class="row">
        <div class="col-sm-12">
            <div class="s_show_user_container">
                <div class="row">
                    <div class="col-sm-2 row middle-sm">
                        <div class="h_round_image" style="background-image: url(${cProfileImage})"></div>
                    </div>
                    <div class="col-sm-5">
                        <span>${cUsername}</span>
                    </div>
                    <div class="col-sm-5 row end-sm middle-sm">
EOF;
        if ( $_SESSION['id'] != $cUserId && $following == FALSE) {


            echo <<<EOF
                                    
                        <button type="button" class="s_user_modal_buttons" onclick="CallFollowAndReload( '${cUserId}', '0' );">
                            Auch folgen
                        </button>
                                    
EOF;
        } elseif ( $_SESSION['id'] != $cUserId && $following == TRUE) {
            echo <<<EOF

                        <button type="button" class="s_user_modal_buttons" onclick="if(confirm('Möchtest du ${cUserId} wirklich nicht mehr Folgen?')) { CallFollowAndReload( '${cUserId}', '1'); }">
                            Abonniert
                        </button>
                                   
EOF;
        }

        echo <<<EOF
                    </div>
                </div>
            </div>
            </div>
        </div>

EOF;
    endforeach;
}



// ---------- Images Display ---------- //
// ---------- Square Image Preview with Modal ---------- //
function DisplayImages ( $Images, $database ) {
    echo "<div class=\"row start-xs\">";
    foreach ( $Images as $Image ):

        $cImageId = $Image['id'];
        $cImagePath = "/" . $Image['path'];
        $cImageCommented = "";
        $cImageLiked = "";
        $cImageType = "i";

        if ($count_comments = $database->prepare('SELECT COUNT(*) FROM comments WHERE element_id=? AND type=?')) {
            $count_comments->bind_param('ss', $cImageId , $cImageType);
            $count_comments->execute();
            $count_comments->bind_result($cImageCommented);
            $count_comments->fetch();
            $count_comments->close();
        }

        if ($count_likes = $database->prepare('SELECT COUNT(*) FROM likes WHERE element_id=? AND type=?')) {
            $count_likes->bind_param('ss', $cImageId, $cImageType);
            $count_likes->execute();
            $count_likes->bind_result($cImageLiked);
            $count_likes->fetch();
            $count_likes->close();
        }

        echo <<<EOF

        <div class="col-xs-4 h_smaller_margin_on_mobile">
            <div class="i_show_image" onclick="ToggleModal( '${cImageId}' );" style="background-image: url('${cImagePath}')">
                <div class="i_hover_image">
                    <div class="row middle-xs center-xs">
                        <div class="col-xs-12">
                            <span><i class="fas fa-heart"></i>&nbsp;&nbsp;${cImageLiked}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <span><i class="fas fa-comment"></i>&nbsp;&nbsp;${cImageCommented}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

EOF;
    endforeach;

    echo "</div>";

}

// ---------- Full Image with Information Section ---------- //
function DisplayImage ( $Image, $database ) {
    $cImageType = "i";
    $cImageId = $Image['id'];
    $cImageUserId = $Image['user_id'];
    $cImagePath = "/" . $Image['path'];
    $cImageSize = "s_element_" . $Image["format"];

    echo <<<EOF
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">  
            <div class="s_element_container">
                <div class="row middle-xs start-xs s_element_creator" id="action_element_header_${cImageType}_${cImageId}">
EOF;

    DisplayElementHeader( $cImageUserId, $database );

    echo <<<EOF
                </div>
                <div class="row middle-xs middle-sm middle-md middle-lg center-xs center-sm center-md center-lg">
                    <div class="${cImageSize}" style="background-image: url(${cImagePath})"></div>
                </div>
                <div class="s_element_information" id="action_element_information_${cImageType}_${cImageId}">
EOF;

    DisplayElementInformationVertical( $cImageId, $cImageType, $database );

    echo <<<EOF
            
                </div>
            </div>
         </div>
     </div>

EOF;
}

function DisplayImageVertical ( $Images, $database ) {
    foreach ( $Images as $Image ):

        $cImageType = "i";
        $cImageId   = $Image["id"];
        $cImagePath = "/" . $Image["path"];
        $cImageUserId = $Image["user_id"];
        $cImageSize = $Image["format"];
        $cImageSize = "s_modal_image_" . $cImageSize;

        echo <<<EOF
<div class="row center-sm">
    <div class="s_full_image_container">
        <div class="row middle-sm">
            <div class="s_modal_image_container">
                <div class="${cImageSize}" style="background-image: url(${cImagePath})"></div>
            </div>
            <div class="s_modal_text_container" id="action_element_information_${cImageType}_${cImageId}">
EOF;

        DisplayElementInformation( $cImageId, $cImageType, $database );


        echo <<<EOF
            </div>
        </div>
     </div>
 </div>

EOF;
    endforeach;
}

// ---------- Video Display ---------- //
function DisplayVideos ( $Videos, $database ) {
    foreach ( $Videos as $Video ):
        DisplayVideo ( $Video, $database );
    endforeach;
}

function DisplayVideo ( $Video, $database ) {
    $cVideoType = "v";
    $cVideoId   = $Video["id"];
    $cVideoPath = "/" . $Video["path"];
    $cVideoUserId = $Video["user_id"];
    $cVideoUser = GetUserName( $cVideoUserId, $database );


    echo <<<EOF
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="s_element_container">
                <div class="row middle-xs start-xs s_element_creator" id="action_element_header_${cVideoType}_${cVideoId}">
EOF;
                DisplayElementHeader( $cVideoUserId, $database );

    echo <<<EOF
                </div>
                <div class="row middle-xs middle-sm middle-md middle-lg center-xs center-sm center-md center-lg">
                    <video class="s_element_landscape" controls>
                        <source src="${cVideoPath}">
                        Your browser does not support HTML5 video.
                    </video>
                 </div>
                 <div class="s_element_information" id="action_element_information_${cVideoType}_${cVideoId}">
EOF;

               DisplayElementInformationVertical( $cVideoId, $cVideoType, $database );

           echo <<<EOF
            
                </div>
             </div>
         </div>
     </div>

EOF;
}

function DisplayVideoVertical ( $Videos, $database ) {
    foreach ( $Videos as $Video ):

    $cVideoType = "v";
    $cVideoId   = $Video["id"];
    $cVideoPath = "/" . $Video["path"];
    $cVideoUserId = $Video["user_id"];
    $cVideoUser = GetUserName( $cVideoUserId, $database );


    echo <<<EOF
    <div class="row center-sm">
        <div class="s_full_image_container">
            <div class="row middle-sm">
                <div class="s_modal_image_container">
                    <div class="s_modal_image_landscape">
                        <video class="s_modal_image_landscape" controls>
                            <source src="${cVideoPath}">
                            Your browser does not support HTML5 video.
                        </video>
                    </div>
                </div>
                <div class="s_modal_text_container" id="action_element_information_${cVideoType}_${cVideoId}">
EOF;

    DisplayElementInformation( $cVideoId, $cVideoType, $database );

    echo <<<EOF
                </div>
            </div> 
        </div>
     </div>

EOF;
    endforeach;
}

// ---------- Trip Display ---------- //
function DisplayTrips( $Trips, $database ) {
    foreach ( $Trips as $Trip ):
        DisplayTrip ( $Trip, $database );
    endforeach;
}

function DisplayTrip( $Trip, $database ) {
    $cTripType = "t";
    $cTripTitle = $Trip["title"];
    $cTripUser = $Trip["username"];
    $cTripCountry = $Trip["country"];
    $cTripPlace = $Trip["place"];
    $cTripGroup = $Trip["group_type"];
    $cTripCategory = $Trip["trip_type"];
    $cTripTransport = $Trip["transport_type"];
    $cTripDescription = $Trip["description"];
    $cTripId = $Trip["id"];
    $cTripLicenses = $Trip["licenses"];
    $cTripLicenses = MakeTypeString( $cTripLicenses );
    $cTripGroup = MakeTypeString( $cTripGroup );
    $cTripTransport = MakeTypeString( $cTripTransport );
    $cTripCategory = MakeTripTypeString( $cTripCategory );



    $cTripTitlePicturePath = "";
    $cTripTitlePictureFormat = "landscape";
    $cTripTitlePictureGallery = "T" . $cTripId;
    if ($select_title_picture = $database->prepare('SELECT path FROM images WHERE gallery=? AND format=? ORDER BY created DESC LIMIT 1')) {
        $select_title_picture->bind_param('ss', $cTripTitlePictureGallery, $cTripTitlePictureFormat);
        $select_title_picture->execute();
        $select_title_picture->bind_result($cTripTitlePicturePath);
        $select_title_picture->fetch();
        $select_title_picture->close();
    }

    $cTripCountryCode = "";
    $cTripCountryName = "";
    if ($select_country_info = $database->prepare('SELECT country_code, country_name FROM countries WHERE id=?')) {
        $select_country_info->bind_param('i', $cTripCountry);
        $select_country_info->execute();
        $select_country_info->bind_result($cTripCountryCode, $cTripCountryName);
        $select_country_info->fetch();
        $select_country_info->close();
    }

    $cTripCountryCode = strtolower($cTripCountryCode);

    $Images = "";
    if ($image_previews = $database->prepare('SELECT path FROM comments WHERE element_id=? AND type=? ORDER BY created DESC')) {
        $image_previews->bind_param("is", $cTripId, $cTripType);
        $image_previews->execute();
        $result = $image_previews->get_result();
        $Images = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

echo <<<EOF
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="s_element_container">
                <div class="row middle-xs start-xs s_element_creator" id="action_element_header_${cTripType}_${cTripId}">
EOF;

                DisplayElementHeader( $cTripUser, $database );
                echo "</div>";

            if ( $cTripTitlePicturePath != "" ) {
                echo "<div class=\"s_trip_title_vertical\" style=\"background-image: url(${cTripTitlePicturePath})\"></div>";
            }

            echo <<<EOF
                    <div class="row middle-xs middle-sm middle-md middle-lg center-xs center-sm center-md center-lg">
                        <div class="col-sm-6">
                            <h3>${cTripTitle}</h3>
                            <p>${cTripDescription}</p>
                        </div>
                        <div class="col-sm-6" style="padding: 10px 20px;">
                            <div class="row middle-sm">
                                <div class="col-sm-4">
                                    <p class="h_padding_vertical_small">Reiseziel: </p>
                                </div>
                                <div class="col-sm-8">
                                    <span class="flag-icon flag-icon-${cTripCountryCode}"></span> ${cTripCountryName},  ${cTripPlace}
                                </div>
                            </div>
                            <div class="row middle-sm">
                                <div class="col-sm-4">
                                    <p class="h_padding_vertical_small">Begleitung: </p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="h_padding_vertical_small">${cTripGroup}</p>
                                </div>
                            </div>
                            <div class="row middle-sm">
                                <div class="col-sm-4">
                                    <p class="h_padding_vertical_small">Reiseart: </p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="h_padding_vertical_small">${cTripCategory}</p>
                                </div>
                            </div>
                            <div class="row middle-sm">
                                <div class="col-sm-4">
                                    <p class="h_padding_vertical_small">Transport: </p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="h_padding_vertical_small">${cTripTransport}</p>
                                </div>
                            </div>
                            <div class="row middle-sm">
                                <div class="col-sm-4">
                                    <p class="h_padding_vertical_small">Lizenzen: </p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="h_padding_vertical_small">${cTripLicenses}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row"></div>
                    </div>
                    <div class="s_element_information" id="action_element_information_${cTripType}_${cTripId}">
EOF;

    DisplayElementInformationVertical( $cTripId, $cTripType, $database );

    echo <<<EOF
            
            </div>
        </div>
    </div>
</div>
EOF;
}


// ---------- Comment and Like Section Display ---------- //
function DisplayElementInformation ( $cElementId, $cElementType, $database ) {
    $cElementUserId = "";
    $cElementUserName = "";
    $cElementCreated = "";
    $cElementLikes = "";
    $cQuery = "";

    if ( $cElementType == "t" ) {
        $cQuery = "SELECT user_id, created FROM trips WHERE id=?";
    } elseif ( $cElementType == "i" ) {
        $cQuery = "SELECT user_id, created FROM images WHERE id=?";
    } elseif ( $cElementType == "v" ) {
        $cQuery = "SELECT user_id, created FROM videos WHERE id=?";
    } elseif ( $cElementType == "p" ) {
        $cQuery = "SELECT user_id, created FROM posts WHERE id=?";
    }


    if ($select_element_information = $database->prepare($cQuery)) {
        $select_element_information->bind_param('s', $cElementId);
        $select_element_information->execute();
        $select_element_information->bind_result($cElementUserId, $cElementCreated);
        $select_element_information->fetch();
        $select_element_information->close();
    }

    $cElementUserName = GetUserName( $cElementUserId, $database );
    $cElementUserImage = GetProfilePicture( $cElementUserId, $database );
    $cElementCreated = DateToTimePassed($cElementCreated);


    if ($count_likes = $database->prepare('SELECT COUNT(*) FROM likes WHERE element_id=? AND type=?')) {
        $count_likes->bind_param('ss', $cElementId, $cElementType);
        $count_likes->execute();
        $count_likes->bind_result($cElementLikes);
        $count_likes->fetch();
        $count_likes->close();
    }

    $Comments = "";
    if ($image_comment = $database->prepare('SELECT user_id,comment,created FROM comments WHERE element_id=? AND type=? ORDER BY created ASC')) {
        $image_comment->bind_param("is", $cElementId, $cElementType);
        $image_comment->execute();
        $result = $image_comment->get_result();
        $Comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    if ( $cElementLikes == 0 ) {
        $cElementLikes = "Sei der/die Erste, dem <b style='cursor: pointer;' onclick=\"Like('${cElementId}','${cElementType}','0', '1');\">das gefällt</b>";
    } else {
        $cElementLikes = "<b style='cursor: pointer;' onclick=\"ToggleUserModal('${cElementUserId}', '${cElementId}', '${cElementType}');\">Gefällt " . $cElementLikes . " Mal</b>";
    }


    echo <<<EOF
    <div class="s_modal_creator"> 
                    <div class="row">
                        <div class="row col-sm-2 center-sm middle-sm">
                            <div class="h_round_image" style="background-image: url(${cElementUserImage});"></div>
                        </div>
                        <div class="col-sm-5 f_font_size_middle"><a href="index.php?cUserId=${cElementUserId}">${cElementUserName}</a></div>
                        <div class="col-sm-5">
EOF;

        MakeFollowingButton( $cElementUserId, $database );

        echo <<<EOF
                        
                        </div>
                    </div>
                 </div>
                 <div class="s_modal_comments" id="action_comment_horizontal">
EOF;

    foreach ($Comments as $Comment):

        $cCommentUserId = $Comment["user_id"];
        $cCommentUser = GetUserName( $cCommentUserId, $database );
        $cCommentCreated = $Comment["created"];
        $cCommentText = $Comment["comment"];
        $cCommentUserPath =  GetProfilePicture( $cCommentUserId, $database );
        $cCommentCreated = DateToTimePassed( $cCommentCreated );

        echo <<<EOF
                    <div class="row s_show_comment">
                        <div class="col-sm-12">
                            <div class="row start-sm">
                                <div class="col-sm-2">
                                    <div class="h_round_image h_margin_top_small" style="background-image: url(${cCommentUserPath})"></div>
                                </div>
                                <div class="col-sm-10 h_padding_vertical"><b><a href="/dashboard/index.php?cUserId=${cCommentUserId}">${cCommentUser}</a></b>&nbsp;${cCommentText}</div>
                            </div>
                            <div class="row start-sm f_light_gray">
                                <div class="col-sm-offset-2 col-sm-10 h_padding_vertical">
                                    ${cCommentCreated}
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
                            if ($current_user_like = $database->prepare('SELECT COUNT(*) FROM likes WHERE element_id=? AND type=? AND user_id=?')) {
                                $current_user_like->bind_param('sss', $cElementId, $cElementType, $_SESSION['id']);
                                $current_user_like->execute();
                                $current_user_like->bind_result($currentLike);
                                $current_user_like->fetch();
                                $current_user_like->close();
                            }

                            if ( $currentLike == 0 ) {
                                echo "<div class=\"col-sm-2\"><button title=\"Gefällt mir\" onclick=\"Like('${cElementId}','${cElementType}','0', '1');\"><i class=\"far fa-heart\"></i></i></button></div>";
                            } else {
                                echo "<div class=\"col-sm-2\"><button title=\"Gefällt mir nicht mehr\"  onclick=\"Like('${cElementId}','${cElementType}','1', '1');\"><i class=\"far fa-heart-broken\"></i></i></button></div>";
                            }

                                echo <<<EOF
                                <div class="col-sm-2"><button onclick="location.href='index.php?cUserId=${cElementUserId}'" title="Nachricht an ${cElementUserName} senden"><i class="far fa-comments"></i></button></div>
                                <div class="col-sm-2"><button title="Beitrag teilen"><i class="far fa-caret-square-right"></i></button></div>
                                <div class="col-sm-offset-4 col-sm-1"><button title="Beitrag privat speichern"><i class="far fa-bookmark"></i></button></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 h_margin_top_small h_margin_left_small">${cElementLikes}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 h_margin_top_small h_margin_left_small"><small>${cElementCreated}</small></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="s_modal_input">
                    <textarea id="action_comment_textarea_${cElementType}_${cElementId}" placeholder="Kommentar hinzufügen"></textarea>
                    <button onclick="WriteComment( '${cElementId}', '${cElementType}', '1' );">Posten</button>
                </div>

                <script>
                    var commentSection = document.getElementById("action_comment_horizontal");
                    commentSection.scrollTop = commentSection.scrollHeight;
                </script>
EOF;
}

function DisplayElementInformationVertical ( $cElementId, $cElementType, $database ) {
    $cElementUser = "";
    $cElementUserId = "";
    $cElementCreated = "";
    $cElementLikes = "";
    $cElementComments = "";
    $cQuery = "";

    if ( $cElementType == "t" ) {
        $cQuery = "SELECT user_id, created FROM trips WHERE id=?";
    } elseif ( $cElementType == "i" ) {
        $cQuery = "SELECT user_id, created FROM images WHERE id=?";
    } elseif ( $cElementType == "v" ) {
        $cQuery = "SELECT user_id, created FROM videos WHERE id=?";
    } elseif ( $cElementType == "p" ) {
        $cQuery = "SELECT user_id, created FROM posts WHERE id=?";
    }


    if ($select_element_information = $database->prepare($cQuery)) {
        $select_element_information->bind_param('s', $cElementId);
        $select_element_information->execute();
        $select_element_information->bind_result($cElementUserId, $cElementCreated);
        $select_element_information->fetch();
        $select_element_information->close();
    }

    $iCreated = FormatJustDate($cElementCreated);

    if ($count_likes = $database->prepare('SELECT COUNT(*) FROM likes WHERE element_id=? AND type=?')) {
        $count_likes->bind_param('ss', $cElementId, $cElementType);
        $count_likes->execute();
        $count_likes->bind_result($cElementLikes);
        $count_likes->fetch();
        $count_likes->close();
    }

    if ($count_comments = $database->prepare('SELECT COUNT(*) FROM comments WHERE element_id=? AND type=?')) {
        $count_comments->bind_param('ss', $cElementId, $cElementType);
        $count_comments->execute();
        $count_comments->bind_result($cElementComments);
        $count_comments->fetch();
        $count_comments->close();
    }

    $Comments = "";
    if ($image_comment = $database->prepare('SELECT user_id,comment,created FROM comments WHERE element_id=? AND type=? ORDER BY created ASC LIMIT 3')) {
        $image_comment->bind_param("is", $cElementId, $cElementType);
        $image_comment->execute();
        $result = $image_comment->get_result();
        $Comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }


    if ( $cElementLikes == 0 ) {
        $cElementLikes = "Sei der/die Erste, dem <b style='cursor: pointer;' onclick=\"Like('${cElementId}','${cElementType}','0','0');\">das gefällt</b>";
    } else {
        $cElementLikes = "<b style='cursor: pointer;' onclick=\"ToggleUserModal('${cElementUserId}', '${cElementId}', '${cElementType}');\">Gefällt " . $cElementLikes . " Mal</b>";
    }


    echo <<<EOF
                    
                    <div class="row s_element_action_buttons">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
EOF;
    $currentLike = "";
    if ($current_user_like = $database->prepare('SELECT COUNT(*) FROM likes WHERE element_id=? AND type=? AND user_id=?')) {
        $current_user_like->bind_param('sss', $cElementId, $cElementType, $_SESSION['id']);
        $current_user_like->execute();
        $current_user_like->bind_result($currentLike);
        $current_user_like->fetch();
        $current_user_like->close();
    }

    if ( $currentLike == 0 ) {
        echo "<div class=\"col-xs-1\"><button title=\"Gefällt mir\" onclick=\"Like('${cElementId}','${cElementType}','0', '0');\"><i class=\"far fa-heart\"></i></i></button></div>";
    } else {
        echo "<div class=\"col-xs-1\"><button title=\"Gefällt mir nicht mehr\"  onclick=\"Like('${cElementId}','${cElementType}','1', '0');\"><i class=\"far fa-heart-broken\"></i></i></button></div>";
    }

    echo <<<EOF
                                <div class="col-xs-1"><button onclick="location.href='index.php?cUserId=${cElementUserId}'" title="Nachricht an ${cElementUser} senden"><i class="far fa-comments"></i></button></div>
                                <div class="col-xs-1"><button title="Beitrag teilen"><i class="far fa-caret-square-right"></i></button></div>
                                <div class="col-xs-offset-8 col-xs-1"><button title="Beitrag privat speichern"><i class="far fa-bookmark"></i></button></div>
                            </div>
                        </div>
                    </div>
                    <div class="row s_element_likes">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-12">
                                    ${cElementLikes}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row s_element_comments_container">
                        <div class="col-xs-12">
EOF;

    if ( $cElementComments > 3 ) {
        echo <<<EOF
        <div class="row start-xs s_element_comments">
            <div class="col-xs-10"><b><a href="/dashboard/element.php?cId=${cElementId}&cType=${cElementType}">Alle ${cElementComments} Kommentare ansehen</a></b></div>
        </div>
EOF;
    }

    foreach ($Comments as $Comment):

        $cCommentUserId = $Comment["user_id"];
        $cCommentUser = GetUserName( $cCommentUserId, $database );
        $cCommentCreated = $Comment["created"];
        $cCommentText = $Comment["comment"];
        $cCommentCreated = DateToTimePassed( $cCommentCreated );

        echo <<<EOF
                    <div class="row start-xs s_element_comments">
                        <div class="col-xs-10"><b><a href="index.php?cUserId=${cCommentUserId}">${cCommentUser}</a></b>&nbsp;${cCommentText}</div>
                        <div class="col-xs-2 f_light_gray end-xs">
                            ${cCommentCreated}
                        </div>
                    </div>
EOF;
    endforeach;

    echo <<<EOF
    </div>
                </div>
                <div class="row s_element_input">
                    <textarea id="action_comment_textarea_${cElementType}_${cElementId}" placeholder="Kommentar hinzufügen"></textarea>
                    <button onclick="WriteComment( '${cElementId}', '${cElementType}', '0' );">Posten</button>
                </div>
EOF;
}

function DisplayElementHeader ( $cElementUserId, $database ) {
    $cElementUser = GetUserName( $cElementUserId, $database );
    $cElementUserImage = GetProfilePicture( $cElementUserId, $database );

    if ($select_followed = $database->prepare('SELECT follower_id FROM follower WHERE follower_id=? AND followed_id=?')) {
        $select_followed->bind_param('ss', $_SESSION['id'], $cElementUserId);
        $select_followed->execute();
        $select_followed->store_result();
        $following = $select_followed->num_rows;
        $select_followed->close();

        if ( $following > 0 ) {
            $following = TRUE;
        } else {
            $following = FALSE;
        }
    }

    print <<<EOF
        <div class="row col-xs-1 end-sm">
            <div class="h_round_image" style="background-image: url(${cElementUserImage});"></div>
        </div>
        <div class="col-xs-6 f_font_size_middle"><a href="index.php?cUserId=${cElementUserId}">${cElementUser}</a></div>
        <div class="col-xs-5 end-xs">
EOF;
        MakeFollowingButton( $cElementUserId, $database );

    echo "</div>";
}

function PrintUserQuestions ( $status ) {

    if ( $status == 1 ) {
        $trip_times = array("Keine Angabe", "weniger als 10 Tage", "weniger als 30 Tage", "bis zu 2 Monate", "bis zu 6 Monaten", "über 6 Monate");
        $how = array("Keine Angabe", "Fotos", "Videos", "Beiträge im Netz", "Reise-Tagebuch", "Gar nicht");
        $who = array("Keine Angabe", "Familie", "Freunden", "Partner", "Alleine", "Reise-Gruppen");

        echo <<<EOF
    
                <hr>
                
                <div class="row center-xs">
                    <div class="col-xs-12 h_margin_bottom">
                        <p><strong>Wie lange verreist du insgesamt pro Jahr?</strong></p>
                    </div>
                </div>
                
                <div class="row start-xs middle-xs">
                
EOF;

        for ($i = 0; $i <= 5; $i++) {
            if ( $i == 0 ) {

                echo <<<EOF
        
                    <div class="col-xs-2 h_position_relative">
                        <div style="min-height: 50px;" class="row center-xs middle-xs">
                            <div class="col-xs-12 center-xs middle-xs">
                                <p class="f_font_size_12">${trip_times[$i]}</p>
                            </div>
                        </div>
                        <div class="row center-xs middle-xs h_position_relative">
                            <div class="col-xs-12 center-xs bottom-xs">
                                <label style="box-shadow: none; border: none" title="${trip_times[$i]}" for="trip_time_na">
                                    <input checked="checked" type="radio" name="new_trip_times" id="trip_time_na" value="trip_time_na">
                                    <span style="margin-left: -55px" title="${trip_times[$i]}"  class="i_check_mark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
        
EOF;

            } else {

                echo <<<EOF
        
                    <div class="col-xs-2 h_position_relative">
                        <div style="min-height: 50px;" class="row center-xs middle-xs">
                            <div class="col-xs-12 center-xs middle-xs">
                                <p class="f_font_size_12">${trip_times[$i]}</p>
                            </div>
                        </div>
                        <div class="row center-xs middle-xs h_position_relative">
                            <div class="col-xs-12 center-xs middle-xs">
                                <label style="box-shadow: none; border: none" title="${trip_times[$i]}" for="${trip_times[$i]}">
                                    <input type="radio" name="new_trip_times" id="${trip_times[$i]}" value="${trip_times[$i]}">
                                    <span style="margin-left: -55px" title="${trip_times[$i]}"  class="i_check_mark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
        
EOF;

            }
        }

        echo <<<EOF
                </div>
                
                <hr>
                
                <div class="row center-xs">
                    <div class="col-xs-12 h_margin_bottom">
                        <p><strong>Wie hälst du deine Erinnerungen am Liebsten fest?</strong></p>
                    </div>
                </div>
                
                                <div class="row start-xs middle-xs">
                
EOF;

        for ($i = 0; $i <= 5; $i++) {
            if ( $i == 0 ) {

                echo <<<EOF
        
                    <div class="col-xs-2 h_position_relative">
                        <div style="min-height: 60px;" class="row center-xs middle-xs">
                            <div class="col-xs-12 center-xs middle-xs">
                                <p class="f_font_size_12">${how[$i]}</p>
                            </div>
                        </div>
                        <div class="row center-xs middle-xs h_position_relative">
                            <div class="col-xs-12 center-xs bottom-xs">
                                <label style="box-shadow: none; border: none" title="${how[$i]}" for="how_na">
                                    <input checked="checked" type="radio" name="new_how" id="how_na" value="how_na">
                                    <span style="margin-left: -55px" title="${how[$i]}"  class="i_check_mark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
        
EOF;

            } else {

                echo <<<EOF
        
                    <div class="col-xs-2 h_position_relative">
                        <div style="min-height: 60px;" class="row center-xs middle-xs">
                            <div class="col-xs-12 center-xs middle-xs">
                                <p class="f_font_size_12">${how[$i]}</p>
                            </div>
                        </div>
                        <div class="row center-xs middle-xs h_position_relative">
                            <div class="col-xs-12 center-xs middle-xs">
                                <label style="box-shadow: none; border: none" title="${how[$i]}" for="${how[$i]}">
                                    <input type="radio" name="new_how" id="${how[$i]}" value="${how[$i]}">
                                    <span style="margin-left: -55px" title="${how[$i]}"  class="i_check_mark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
        
EOF;

            }
        }

        echo <<<EOF
                </div>
                
                <hr>
                
                <div class="row center-xs">
                    <div class="col-xs-12 h_margin_bottom">
                        <p><strong>Mit wem verreist du am Liebsten?</strong></p>
                    </div>
                </div>
                
                                <div class="row start-xs middle-xs">
                
EOF;

        for ($i = 0; $i <= 5; $i++) {
            if ( $i == 0 ) {

                echo <<<EOF
        
                    <div class="col-xs-2 h_position_relative">
                        <div style="min-height: 60px;" class="row center-xs middle-xs">
                            <div class="col-xs-12 center-xs middle-xs">
                                <p class="f_font_size_12">${who[$i]}</p>
                            </div>
                        </div>
                        <div class="row center-xs middle-xs h_position_relative">
                            <div class="col-xs-12 center-xs bottom-xs">
                                <label style="box-shadow: none; border: none" title="${who[$i]}" for="who_na">
                                    <input checked="checked" type="radio" name="new_who" id="who_na" value="who_na">
                                    <span style="margin-left: -55px" title="${who[$i]}"  class="i_check_mark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
        
EOF;

            } else {

                echo <<<EOF
        
                    <div class="col-xs-2 h_position_relative">
                        <div  style="min-height: 60px;" class="row center-xs middle-xs">
                            <div class="col-xs-12 center-xs middle-xs">
                                <p class="f_font_size_12">${who[$i]}</p>
                            </div>
                        </div>
                        <div class="row center-xs middle-xs h_position_relative">
                            <div class="col-xs-12 center-xs middle-xs">
                                <label style="box-shadow: none; border: none" title="${who[$i]}" for="${who[$i]}">
                                    <input type="radio" name="new_who" id="${who[$i]}" value="${who[$i]}">
                                    <span style="margin-left: -55px" title="${who[$i]}"  class="i_check_mark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
        
EOF;

            }
        }

        echo <<<EOF
        
                </div>
                
              
                
EOF;
    } elseif ( $status == 2 ) {

        echo <<<EOF
    
                <hr>
                
                <div class="row center-xs">
                    <div class="col-xs-12 h_margin_bottom">
                        <p><strong>Wähle Reisearten aus, an denen du interessiert bist.</strong></p>
                    </div>
                </div>
                
                <div class="row start-xs middle-xs">
                
EOF;

        $season = array("Keine Angabe", "Geschäfts-Reise", "Party-Urlaub", "Romantik-Urlaub", "Erholungs-Urlaub", "Back-Packing", "Exchange", "Auslands-Jahr", "Work & Travel", "Strand-Urlaub", "Kultur-Reise", "Rund-Reise", "Luxus-Urlaub", "Kreuzfahrt", "Sport-Urlaub", "Roadtrip", "Extrem-Urlaub", "Städte-Urlaub", "Ski-Urlaub", "Wander-Urlaub");
        $cTripTypes = array("typesnoanswer", "businesstrip", "partyholiday", "romanceholiday", "relaxionholiday", "backpacking", "exchange", "yearabroad", "workandtravel", "beachholiday", "culturetrip", "roundtrip", "luxuryholiday", "cruisetrip", "sportholiday", "roadtrip", "extremeholiday", "cityholiday", "skiholiday", "hikingholiday");

        for ($i = 0; $i <= 19; $i++) {
            if ( $i == 0 ) {

                echo <<<EOF
        
                    <div class="col-xs-2 h_position_relative">
                        <div class="row center-xs middle-xs">
                            <div class="col-xs-12 center-xs middle-xs">
                                <p class="f_font_size_12">${season[$i]}</p>
                            </div>
                        </div>
                        <div class="row center-xs middle-xs h_position_relative">
                            <div class="col-xs-12 center-xs bottom-xs">
                                <label style="box-shadow: none; border: none" title="${season[$i]}" for="${cTripTypes[$i]}">
                                    <input onchange="TickTypesOff();" checked="checked" type="checkbox" name="${cTripTypes[$i]}" id="${cTripTypes[$i]}" value="1">
                                    <span style="margin-left: -55px" title="${season[$i]}"  class="i_check_mark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
        
EOF;

            } else {

                echo <<<EOF
        
                    <div class="col-xs-2 h_position_relative">
                        <div  style="min-height: 60px;" class="row center-xs middle-xs">
                            <div class="col-xs-12 center-xs middle-xs">
                                <p class="f_font_size_12">${season[$i]}</p>
                            </div>
                        </div>
                        <div class="row center-xs middle-xs h_position_relative">
                            <div class="col-xs-12 center-xs middle-xs">
                                <label style="box-shadow: none; border: none" title="${season[$i]}" for="${cTripTypes[$i]}">
                                    <input onchange="TickTypesOn();" class="action_types_toggle" type="checkbox" name="${cTripTypes[$i]}" id="${cTripTypes[$i]}" value="1">
                                    <span style="margin-left: -55px" title="${season[$i]}"  class="i_check_mark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
        
EOF;

            }
        }

        echo <<<EOF
    
                </div>
                
EOF;
    }
}

function PrintFooter () {

    print <<<EOF
    
    
        <footer>
        <div class="row center-xs middle-xs">
            <div class="col-xs-12">
                <div class="row center-xs s_footer_language">
                    <div class="col-xs-6 center-xs">
                        <p><small><b style="color: #414141">Deutsch</b> &nbsp;&nbsp;&nbsp;&nbsp;Derzeit gibt es Uns nur in Deutsch, aber keine Sorge, damit haben wir bereits eine potentielle Reichweite von 130 - 419 Millionen Menschen - in über 40 Ländern.</small></p>
                    </div>
                </div>
                <div class="row s_footer_buttons center-xs">
                    <div class="col-xs-6">
                        <a href='/index.php?sSpecial=r'">Registrieren</a>
                        <a href='/index.php?sSpecial=l'">Anmelden</a>
                        <a href='/help/information'">Informationen</a>
                        <a href='/converter'">Währungsrechner</a>
                        <a href='/map'">TomTom Karte</a>
                        <a href='/policies/#imprint'">Impressum</a>
                        <a href='/help/about'">Über Uns</a>
                        <a href='/developer/api'">Entwickler</a>
                        <a href='/developer/career'">Karriere</a>
                        <a href='/policies/'">Datenschutz</a>
                        <a href='/policies/#cookies_heading'">Cookies</a>
                        <a href='/help'">Hilfe</a>
                        <a href='/help/questions/#questions_mail'">Kontaktiere Uns</a>
                        <a href='/help/questions/#questions_report'">Rechtwidriges Verhalten</a>
                        <a href='/help/questions/#questions_error'">Fehlermeldungen</a>
                        <a target="_blank" href='https://www.facebook.com'">Facebook-Seite</a>
                        <a target="_blank" href='https://www.twitter.com'">Twitter-Seite</a>
                        <a target="_blank" href='https://www.expedia.com'">Expedia</a>
                        <a target="_blank" href='https://www.checkfelix.com'">Checkfelix</a>
                        <a target="_blank" href='https://www.airbnb.com'">AirBnb</a>
                        <a target="_blank" href='https://www.easyjet.com'">EasyJet</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

EOF;

}

function PrintDashboardFooter () {

    print <<<EOF
    
    
    <footer style="position: sticky;background: none; box-shadow: none; top: 0;">
        <div class="row s_footer_buttons center-xs">
            <div class="col-xs-12">
                <a href='/help/information'>Informationen</a>
                <a href='/converter'>Währungsrechner</a>
                <a href='/map'>TomTom Karte</a>
                <a href='/policies/#imprint'>Impressum</a>
                <a href='/help/about'>Über Uns</a>
                <a href='/developer/api'>Entwickler</a>
                <a href='/developer/career'>Karriere</a>
                <a href='/policies/'>Datenschutz</a>
                <a href='/policies/#cookies_heading'>Cookies</a>
                <a href='/help'>Hilfe</a>
                <a href='/help/questions/#questions_mail'>Kontaktiere Uns</a>
                <a href='/help/questions/#questions_report'>Rechtwidriges Verhalten</a>
                <a href='/help/questions/#questions_error'>Fehlermeldungen</a>
                <a target="_blank" href='https://www.facebook.com'>Facebook-Seite</a>
                <a target="_blank" href='https://www.twitter.com'>Twitter-Seite</a>
                <a target="_blank" href='https://www.expedia.com'>Expedia</a>
                <a target="_blank" href='https://www.checkfelix.com'>Checkfelix</a>
                <a target="_blank" href='https://www.airbnb.com'>AirBnb</a>
                <a target="_blank" href='https://www.easyjet.com'>EasyJet</a>
            </div>
        </div>
    </footer>

EOF;

}

?>