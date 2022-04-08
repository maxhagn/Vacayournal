<?php
include("../essentials/session.php");


$target_dir = "resources/images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}


if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}



if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    $insert_gallery= "P";
    $insert_file = $database->prepare('INSERT INTO images (username, path, gallery, created) VALUES (?, ?, ?, NOW())');
    $insert_file->bind_param('sss', $_SESSION['name'], $target_dir, $insert_gallery);
    $insert_file->execute();

    $file_id = mysqli_insert_id( $database );
    $file_name= $target_dir . $file_id . "." . $imageFileType;

    $insert_file = $database->prepare('UPDATE images SET path=? WHERE id=?');
    $insert_file->bind_param('si', $file_name, $file_id);
    $insert_file->execute();

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file_name)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        header('Location: index.php');
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>