<?php
include("../essentials/session.php");
include("../essentials/essentials.php");
include("../classes/resize-class.php");

$time_span = "";
$place = "";
if ( isset( $_REQUEST['new_title'], $_REQUEST['new_description'], $_REQUEST['new_precision'], $_REQUEST['new_title'], $_REQUEST['new_country'], $_REQUEST['new_group_type'], $_REQUEST['new_trip_type'], $_REQUEST['new_transport_type'] ) ) {
    $precision = $_REQUEST['new_precision'];
    if ( $precision == 1 ) {
        if ( isset( $_REQUEST['new_from_day'], $_REQUEST['new_from_month'], $_REQUEST['new_from_year'], $_REQUEST['new_to_day'], $_REQUEST['new_to_month'], $_REQUEST['new_to_year'] ) ) {
            $time_span = $_REQUEST['new_from_day'] . "." . $_REQUEST['new_from_month'] . "." . $_REQUEST['new_from_year'] . "-" . $_REQUEST['new_to_day'] . "." . $_REQUEST['new_to_month'] . "." . $_REQUEST['new_to_year'];
        }
    } elseif ( $precision == 2 ) {
        if ( isset( $_REQUEST['new_from_month'], $_REQUEST['new_from_year'], $_REQUEST['new_to_month'], $_REQUEST['new_to_year'] ) ) {
            $time_span = $_REQUEST['new_from_month'] . "." . $_REQUEST['new_from_year'] . "-" . $_REQUEST['new_to_month'] . "." . $_REQUEST['new_to_year'];
        }
    } elseif ( $precision == 3 ) {
        if ( isset( $_REQUEST['new_season'] ) ) {
            $time_span = $_REQUEST['new_season'];
        }
    } elseif ( $precision == 4 ) {
        if ( isset( $_REQUEST['new_from_year'], $_REQUEST['new_to_year'] ) ) {
            $time_span = $_REQUEST['new_from_year'] . "-" . $_REQUEST['new_to_year'];
        }
    }
} else {
    echo "Complete the form";
}


if ( isset( $_REQUEST['new_place'] ) ) {
    $place = $_REQUEST['new_place'];
}


if ($insert_trip = $database->prepare('INSERT INTO trips (title, description, time_span, group_type, trip_type, transport_type, country, place, created, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)')) {
    $insert_trip->bind_param('ssssssss', $_REQUEST['new_title'], $_REQUEST['new_description'], $time_span, $_REQUEST['new_group_type'], $_REQUEST['new_trip_type'], $_REQUEST['new_transport_type'], $_REQUEST['new_country'], $place, $_SESSION['name'] );
    $insert_trip->execute();
    $insert_trip->close();
}

$inserted_trip_id = mysqli_insert_id( $database );

$targetDir = "resources/images/trips/";
$allowTypes = array('jpg','png','jpeg','gif');

if(!empty(array_filter($_FILES['files']['name']))){
    foreach($_FILES['files']['name'] as $key=>$val){
        $fileName = basename($_FILES['files']['name'][$key]);
        $targetFilePath = $targetDir . $fileName;



        $insert_gallery= "T" . $inserted_trip_id;
        $insert_file = $database->prepare('INSERT INTO images (user_id, path, gallery, created) VALUES (?, ?, ?, NOW())');
        $insert_file->bind_param('sss', $_SESSION['id'], $targetDir, $insert_gallery);
        $insert_file->execute();
        $insert_file->close();
        $inserted_image_id = mysqli_insert_id( $database );

        // Check whether file type is valid
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        if(in_array($fileType, $allowTypes)){
            $new_targetFilePath = $targetDir . $inserted_image_id . "." . $fileType;

            if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $new_targetFilePath)) {
                correctImageOrientation($new_targetFilePath);

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
}


header('Location: index.php');