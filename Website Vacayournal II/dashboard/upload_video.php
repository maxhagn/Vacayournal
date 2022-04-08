<?php
include("../essentials/session.php");
include("../essentials/essentials.php");


$targetDir = "resources/videos/";
$fileType = $_FILES["videoToUpload"]["type"];

$allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
$extension = pathinfo($_FILES['videoToUpload']['name'], PATHINFO_EXTENSION);

if ((($_FILES["videoToUpload"]["type"] == "video/mp4")
        || ($_FILES["videoToUpload"]["type"] == "audio/mp3")
        || ($_FILES["videoToUpload"]["type"] == "audio/wma")
        || ($_FILES["videoToUpload"]["type"] == "image/pjpeg")
        || ($_FILES["videoToUpload"]["type"] == "image/gif")
        || ($_FILES["videoToUpload"]["type"] == "image/jpeg"))

    && ($_FILES["videoToUpload"]["size"] < 20000000)
    && in_array($extension, $allowedExts))

{
    if ($_FILES["videoToUpload"]["error"] > 0)
    {
        echo "Return Code: " . $_FILES["videoToUpload"]["error"] . "<br />";
    }
    else
    {
        $insert_gallery= "S";
        $insert_file = $database->prepare('INSERT INTO videos (username, path, gallery, created) VALUES (?, ?, ?, NOW())');
        $insert_file->bind_param('sss', $_SESSION['name'], $targetDir, $insert_gallery);
        $insert_file->execute();
        $insert_file->close();
        $inserted_video_id = mysqli_insert_id( $database );

        $new_targetFilePath = $targetDir . $inserted_video_id . "." . $extension;

        if (move_uploaded_file($_FILES["videoToUpload"]["tmp_name"], $new_targetFilePath)) {
            $update_file = $database->prepare('UPDATE videos SET path=? WHERE id=?');
            $update_file->bind_param('si', $new_targetFilePath, $inserted_video_id);
            $update_file->execute();
            $update_file->close();

            header('Location: index.php');
        }
    }
}
else
{
    echo "Invalid file";
}
?>