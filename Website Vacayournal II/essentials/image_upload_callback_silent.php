<?php
include("session.php");
include("../classes/resize-class.php");


$cUserId = $_SESSION['id'];

if ( isset($_FILES['new_profile_image']) ) {

    $targetDir = "../resources/images/cache/";
    $allowTypes = array('jpg','png','jpeg','gif');
    $fileName = basename($_FILES["new_profile_image"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    $insert_file = $database->prepare('INSERT INTO images_cache (user_id, path, created) VALUES (?, ?, NOW())');
    $insert_file->bind_param('ss', $cUserId, $targetDir);
    $insert_file->execute();
    $insert_file->close();
    $inserted_image_id = mysqli_insert_id( $database );

    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    if(in_array($fileType, $allowTypes)){
        $new_targetFilePath = $targetDir . $inserted_image_id . "." . $fileType;

        if(move_uploaded_file($_FILES["new_profile_image"]["tmp_name"], $new_targetFilePath)) {
            $cleanPath = "/resources/images/cache/" . $inserted_image_id . "." . $fileType;
            correctImageOrientation(".." . $cleanPath);
            $cleanPath = "/website" . $cleanPath;


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








            $update_file = $database->prepare('UPDATE images_cache SET path=?, format=? WHERE id=?');
            $update_file->bind_param('ssi', $cleanPath, $format, $inserted_image_id);
            $update_file->execute();
            $update_file->close();

            echo $new_targetFilePath;


        } else {
            echo "Could'n move File";
        }
    } else {
        echo "wrong file extension";
    }
}