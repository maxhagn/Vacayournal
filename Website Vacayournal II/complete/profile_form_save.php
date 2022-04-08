<?php
include("../resources/config/config.php");
include("../essentials/mail.php");
include("../essentials/essentials.php");
include("../essentials/mail_templates.php");
include("../essentials/sms.php");
include("../classes/resize-class.php");

$cStatus = "";
$cUserId = "";


if ( isset( $_REQUEST["cStatus"], $_REQUEST["cUserId"] ) ) {
    $cStatus = $_REQUEST["cStatus"];
    $cUserId = $_REQUEST["cUserId"];
    $cUsername = GetUserName( $cUserId, $database );
} else {
    header('Location: /website/complete/?cUserId=' . $cUserId . '&cStatus=1');
}

if ( $cStatus == 1 ) {

    if ( isset( $_REQUEST["new_verification"] ) ) {

        $cVerifyBy = "";
        $cCanSend = TRUE;
        $cEmail = "";
        $cPhone = "";

        if ( isset( $_REQUEST["new_email"] ) ) {

            $cEmail = $_REQUEST["new_email"];
            $cVerifyBy = 1;

            if ($set_slogan = $database->prepare('UPDATE users SET email=?, changed=NOW() WHERE id=?')) {
                $set_slogan->bind_param('ss', $cEmail, $cUserId);
                $set_slogan->execute();
                $set_slogan->close();
            }


        } else if ( isset( $_REQUEST["new_full_data"] ) ) {

            $cPhone = $_REQUEST["new_full_data"];
            $cVerifyBy = 2;

            if ($set_slogan = $database->prepare('UPDATE users SET mobile=?, changed=NOW() WHERE id=?')) {
                $set_slogan->bind_param('ss', $cPhone, $cUserId);
                $set_slogan->execute();
                $set_slogan->close();
            }


        } else {

            $cCanSend = FALSE;

        }

        if ( $cCanSend == TRUE ) {
            $cCode = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
            if ($store_safety_code = $database->prepare('INSERT INTO safety_codes (user_id, code, requested, type) VALUES (?, ?, NOW(), ?)')) {

                $store_safety_code->bind_param('ssi', $cUserId, $cCode, $cVerifyBy);
                $store_safety_code->execute();
                $store_safety_code->close();


                if ($cVerifyBy == 1) {

                    $cSubject = "Bestätigungsmail | Vacayournal";
                    $cMessage = DisplayRegisterMail($cUsername, $cEmail, $cCode, $cUserId);
                    sendMail($cSubject, $cMessage, $cEmail);

                } else if ($cVerifyBy == 2) {

                    $cNumber = trim($cPhone);
                    $cNumber = str_replace("+", "", $cNumber);
                    $cMessage = "Du hast dich vor Kurzem für Vacaytional registriert. Bestätige bitte dein Konto, um deine Registrierung abzuschließen. Dein Sicherheitscode ist: ${cCode}";

                    sendSms($cPhone, $cMessage);

                }
            }
        }
    }

    if ( isset( $_REQUEST["new_slogan"] ) ) {

        $cSlogan = $_REQUEST["new_slogan"];

        if ($set_slogan = $database->prepare('UPDATE users SET slogan=?, changed=NOW() WHERE id=?')) {
            $set_slogan->bind_param('ss', $cSlogan, $cUserId);
            $set_slogan->execute();
            $set_slogan->close();
        }
    }

    if ( isset( $_REQUEST["new_nickname"] ) ) {

        $cNickname = $_REQUEST["new_nickname"];

        if ($set_nickname = $database->prepare('UPDATE users SET nickname=?, changed=NOW() WHERE id=?')) {
            $set_nickname->bind_param('ss', $cNickname, $cUserId);
            $set_nickname->execute();
            $set_nickname->close();
        }
    }

    if ( isset($_FILES['new_profile_image']) ) {

        $targetDir = "../resources/images/profile/";
        $allowTypes = array('jpg','png','jpeg','gif');
        $fileName = basename($_FILES["new_profile_image"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        $insert_gallery= "P";
        $insert_file = $database->prepare('INSERT INTO images (user_id, path, gallery, created) VALUES (?, ?, ?, NOW())');
        $insert_file->bind_param('sss', $cUserId, $targetDir, $insert_gallery);
        $insert_file->execute();
        $insert_file->close();
        $inserted_image_id = mysqli_insert_id( $database );

        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        if(in_array($fileType, $allowTypes)){
            $new_targetFilePath = $targetDir . $inserted_image_id . "." . $fileType;

            if(move_uploaded_file($_FILES["new_profile_image"]["tmp_name"], $new_targetFilePath)) {


                $image_info = getimagesize($new_targetFilePath);
                $image_width = $image_info[0];
                $image_height = $image_info[1];
                $format = "";

                $resizeObj = new resize($new_targetFilePath);
                if ( ( $image_height - 200 < $image_width && $image_width < $image_height + 200 ) && ( $image_width - 200 < $image_height && $image_height < $image_width + 200 )  ) {
                    $resizeObj -> resizeImage(1080, 1080, 'crop');
                    $format = "square";
                }
                elseif ( $image_width > $image_height ) {
                    $resizeObj -> resizeImage(1080, 1350, 'landscape');
                    $format = "landscape";
                }
                elseif ( $image_height > $image_width ) {
                    $resizeObj -> resizeImage(1080, 566, 'portrait');
                    $format = "portrait";
                } else {
                    $format = "error";
                }

                // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)

                $resizeObj -> saveImage($new_targetFilePath, 1000);
                unset($resizeObj);

                correctImageOrientation($new_targetFilePath);

                $update_file = $database->prepare('UPDATE images SET path=?, format=? WHERE id=?');
                $update_file->bind_param('ssi', $new_targetFilePath, $format, $inserted_image_id);
                $update_file->execute();
                $update_file->close();


            } else {
                echo "Could'n move File";
            }
        } else {
            echo "wrong file extension";
        }
    }

    header('Location: /website/complete/?cUserId=' . $cUserId . '&cStatus=2');


} else if ( $cStatus == 2 ) {

    if ( isset( $_REQUEST["new_road"],$_REQUEST["new_zip"], $_REQUEST["new_search"], $_REQUEST["new_country"] ) ) {
        $cStreet = $_REQUEST["new_road"];
        $cZip = $_REQUEST["new_zip"];
        $cCity = $_REQUEST["new_search"];
        $cCountry = $_REQUEST["new_country"];

        if ($check_geo = $database->prepare('SELECT * FROM geo_user WHERE user_id=?')) {
            $check_geo->bind_param('s', $cUserId);
            $check_geo->execute();
            $check_geo->store_result();

            if ($check_geo->num_rows > 0) {

                $check_geo->close();

                if (isset($_REQUEST["new_road"])) {

                    if ($set_street = $database->prepare('UPDATE geo_user SET street=? WHERE user_id=?')) {
                        $set_street->bind_param('ss', $cStreet, $cUserId);
                        $set_street->execute();
                        $set_street->close();
                    }
                }

                if (isset($_REQUEST["new_zip"])) {

                    if ($set_zip = $database->prepare('UPDATE geo_user SET zip=? WHERE user_id=?')) {
                        $set_zip->bind_param('ss', $cZip, $cUserId);
                        $set_zip->execute();
                        $set_zip->close();
                    }
                }

                if (isset($_REQUEST["new_search"])) {

                    if ($set_city = $database->prepare('UPDATE geo_user SET city=? WHERE user_id=?')) {
                        $set_city->bind_param('ss', $cCity, $cUserId);
                        $set_city->execute();
                        $set_city->close();
                    }
                }

                if (isset($_REQUEST["new_country"])) {

                    if ($set_country = $database->prepare('UPDATE geo_user SET country=? WHERE user_id=?')) {
                        $set_country->bind_param('ss', $cCountry, $cUserId);
                        $set_country->execute();
                        $set_country->close();
                    }
                }

            } else {

                if ($insert_geo = $database->prepare('INSERT INTO geo_user (street,city,zip,country,user_id,created) VALUES (?,?,?,?,?,NOW())')) {
                    $insert_geo->bind_param('sssss', $cStreet, $cCity, $cZip, $cCountry, $cUserId);
                    $insert_geo->execute();
                    $insert_geo->close();
                }

            }
        }

        if (isset($_REQUEST["new_stair"])) {

            $cStair = $_REQUEST["new_stair"];

            if ($set_stair = $database->prepare('UPDATE geo_user SET stair=? WHERE user_id=?')) {
                $set_stair->bind_param('ss', $cStair, $cUserId);
                $set_stair->execute();
                $set_stair->close();
            }
        }

        if (isset($_REQUEST["new_door"])) {

            $cDoor = $_REQUEST["new_door"];

            if ($set_door = $database->prepare('UPDATE geo_user SET door=? WHERE user_id=?')) {
                $set_door->bind_param('ss', $cDoor, $cUserId);
                $set_door->execute();
                $set_door->close();
            }
        }

        if (isset($_REQUEST["new_latitude"], $_REQUEST["new_longitude"])) {

            $cLatitude = $_REQUEST["new_latitude"];
            $cLongitude = $_REQUEST["new_longitude"];

            if ($set_position = $database->prepare('UPDATE geo_user SET latitude=?, longitude=? WHERE user_id=?')) {
                $set_position->bind_param('sss', $cLatitude, $cLongitude, $cUserId);
                $set_position->execute();
                $set_position->close();
            }
        }

        header('Location: /website/complete/?cUserId=' . $cUserId . '&cStatus=3');

    }
} else if ( $cStatus == 3 ) {

    if ( isset( $_REQUEST["new_trip_times"],$_REQUEST["new_who"], $_REQUEST["new_how"] ) ) {

        $cAttributes = array( "trip_times", "with_who", "memorize_how" );
        $cTripTime =  $_REQUEST["new_trip_times"];
        $cWho = $_REQUEST["new_who"];
        $cHow = $_REQUEST["new_how"];


        if ( $cTripTime != "trip_time_na" ) {
            if ($check_info = $database->prepare('SELECT * FROM users_bias WHERE user_id=? AND attribute=?')) {
                $check_info->bind_param('ss', $cUserId, $cAttributes[0]);
                $check_info->execute();
                $check_info->store_result();

                if ($check_info->num_rows > 0) {
                    if ($update_info = $database->prepare('UPDATE users_bias SET value=? WHERE user_id=? AND attribute=?')) {
                        $update_info->bind_param('sss',$cTripTime, $cUserId, $cAttributes[0] );
                        $update_info->execute();
                        $update_info->close();
                    }
                } else {
                    if ($insert_info = $database->prepare('INSERT INTO users_bias (user_id, attribute, value ) VALUES (?,?,?)')) {
                        $insert_info->bind_param('sss', $cUserId, $cAttributes[0], $cTripTime);
                        $insert_info->execute();
                        $insert_info->close();
                    }
                }

                $check_info->close();
            }
        } else {
            if ($delete_info = $database->prepare('DELETE FROM users_bias WHERE user_id=? AND attribute=?')) {
                $delete_info->bind_param('ss', $cUserId, $cAttributes[0] );
                $delete_info->execute();
                $delete_info->close();
            }
        }

        if ( $cWho != "who_na" ) {
            if ($check_info = $database->prepare('SELECT * FROM users_bias WHERE user_id=? AND attribute=?')) {
                $check_info->bind_param('ss', $cUserId, $cAttributes[1]);
                $check_info->execute();
                $check_info->store_result();

                if ($check_info->num_rows > 0) {
                    if ($update_info = $database->prepare('UPDATE users_bias SET value=? WHERE user_id=? AND attribute=?')) {
                        $update_info->bind_param('sss',$cWho, $cUserId, $cAttributes[1] );
                        $update_info->execute();
                        $update_info->close();
                    }
                } else {
                    if ($insert_info = $database->prepare('INSERT INTO users_bias (user_id, attribute, value ) VALUES (?,?,?)')) {
                        $insert_info->bind_param('sss', $cUserId, $cAttributes[1], $cWho);
                        $insert_info->execute();
                        $insert_info->close();
                    }
                }

                $check_info->close();
            }
        } else {
            if ($delete_info = $database->prepare('DELETE FROM users_bias WHERE user_id=? AND attribute=?')) {
                $delete_info->bind_param('ss', $cUserId, $cAttributes[1] );
                $delete_info->execute();
                $delete_info->close();
            }
        }

        if ( $cHow != "how_na" ) {
            if ($check_info = $database->prepare('SELECT * FROM users_bias WHERE user_id=? AND attribute=?')) {
                $check_info->bind_param('ss', $cUserId, $cAttributes[2]);
                $check_info->execute();
                $check_info->store_result();

                if ($check_info->num_rows > 0) {
                    if ($update_info = $database->prepare('UPDATE users_bias SET value=? WHERE user_id=? AND attribute=?')) {
                        $update_info->bind_param('sss',$cHow, $cUserId, $cAttributes[2] );
                        $update_info->execute();
                        $update_info->close();
                    }
                } else {
                    if ($insert_info = $database->prepare('INSERT INTO users_bias (user_id, attribute, value ) VALUES (?,?,?)')) {
                        $insert_info->bind_param('sss', $cUserId, $cAttributes[2], $cHow);
                        $insert_info->execute();
                        $insert_info->close();
                    }
                }

                $check_info->close();
            }
        } else {
            if ($delete_info = $database->prepare('DELETE FROM users_bias WHERE user_id=? AND attribute=?')) {
                $delete_info->bind_param('ss', $cUserId, $cAttributes[2] );
                $delete_info->execute();
                $delete_info->close();
            }
        }

        header('Location: /website/complete/?cUserId=' . $cUserId . '&cStatus=4');

    } else {

        header('Location: /website/complete/?cUserId=' . $cUserId . '&cStatus=3');

    }
} else if ( $cStatus == 4 ) {

    $cTripTypes = array("typesnoanswer", "businesstrip", "partyholiday", "romanceholiday", "relaxionholiday", "backpacking", "exchange", "yearabroad", "workandtravel", "beachholiday", "culturetrip", "roundtrip", "luxuryholiday", "cruisetrip", "sportholiday", "roadtrip", "extremeholiday", "cityholiday", "skiholiday", "hikingholiday");
    $TRUE = 1;

    for ($i = 0; $i <= 19; $i++) {
        if ($delete_info = $database->prepare('DELETE FROM users_bias WHERE user_id=? AND attribute=?')) {
            $delete_info->bind_param('ss', $cUserId, $cTripTypes[$i] );
            $delete_info->execute();
            $delete_info->close();
        }
    }


    for ($i = 0; $i <= 19; $i++) {
        if ( isset($_REQUEST[$cTripTypes[$i]]) ) {
            if ($insert_info = $database->prepare('INSERT INTO users_bias (user_id, attribute, value ) VALUES (?,?,?)')) {
                $insert_info->bind_param('ssi', $cUserId, $cTripTypes[$i], $TRUE );
                $insert_info->execute();
                $insert_info->close();
            }
        }
    }

    header('Location: /website/complete/?cUserId=' . $cUserId . '&cStatus=5');

} else if ( $cStatus == 5 ) {

    $cSetValue = "";

    if ($check_verified = $database->prepare('SELECT verified FROM users WHERE id=?')) {
        $check_verified->bind_param('s', $cUserId);
        $check_verified->execute();
        $check_verified->bind_result($cVerified);
        $check_verified->fetch();
        $check_verified->close();

        if ( $cVerified == 0 ) {

            echo "ERROR";

        } else if ( $cVerified == 1 ) {

            $cSetValue = 4;

            if ($update_verified = $database->prepare('UPDATE users SET verified=? WHERE id=?')) {
                $update_verified->bind_param('is',$cSetValue, $cUserId );
                $update_verified->execute();
                $update_verified->close();
            }


        } else if ( $cVerified == 2 ) {

            $cSetValue = 5;

            if ($update_verified = $database->prepare('UPDATE users SET verified=? WHERE id=?')) {
                $update_verified->bind_param('is',$cSetValue, $cUserId );
                $update_verified->execute();
                $update_verified->close();
            }

        } else if ( $cVerified == 3 ) {

            $cSetValue = 6;

            if ($update_verified = $database->prepare('UPDATE users SET verified=? WHERE id=?')) {
                $update_verified->bind_param('is',$cSetValue, $cUserId );
                $update_verified->execute();
                $update_verified->close();
            }

        }



    }

    header('Location: /website/dashboard');

}