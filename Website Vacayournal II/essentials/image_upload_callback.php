<?php
include("../essentials/session.php");
include("../classes/resize-class.php");

$newHeight = "";
$newWidth = "";
$cropStartX = "";
$cropStartY = "";
$cache_image = "";
$cUserId = $_SESSION['id'];

if ( isset($_REQUEST['newwidth'], $_REQUEST['newheight'], $_REQUEST['newx'], $_REQUEST['newy'], $_REQUEST['cache_image']) ) {

    $newWidth = $_REQUEST['newwidth'];
    $newHeight = $_REQUEST['newheight'];
    $cropStartX = $_REQUEST['newx'];
    $cropStartY = $_REQUEST['newy'];
    $cache_image =  $_REQUEST['cache_image'];

}


$resizeObj = new resize($cache_image);
$resizeObj -> selectImageArea( $newWidth, $newHeight, $cropStartX, $cropStartY );

$insert_gallery= "P";
$insert_file = $database->prepare('INSERT INTO images (user_id, path, gallery, created) VALUES (?, ?, ?, NOW())');
$insert_file->bind_param('sss', $cUserId, $insert_gallery, $insert_gallery);
$insert_file->execute();
$insert_file->close();
$inserted_image_id = mysqli_insert_id( $database );

$targetDir = "../resources/images/profile/";
$fileType = pathinfo($cache_image,PATHINFO_EXTENSION);
$targetDir = $targetDir . $inserted_image_id . "." . $fileType;

$resizeObj -> saveImage($targetDir, 1000);

$format = "square";
$database_path = "/resources/images/profile/" . $inserted_image_id . "." . $fileType;
$update_file = $database->prepare('UPDATE images SET path=?, format=? WHERE id=?');
$update_file->bind_param('ssi', $database_path, $format, $inserted_image_id);
$update_file->execute();
$update_file->close();

$delete_cache = $database->prepare('DELETE FROM images_cache WHERE user_id=?');
$delete_cache->bind_param('s', $cUserId);
$delete_cache->execute();
$delete_cache->close();