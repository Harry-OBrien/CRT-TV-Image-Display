<?php
$target_file = "../assets/img/display-image.png";
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check == false) {
    echo "{\"success\": false, \"reason\":\"File is not an image.\"}";
    exit(0);
  }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 16000000) {
  echo "{\"success\": false, \"reason\":\"Sorry, your file is too large (Max 16MB).\"}";
  exit(0);
}

// Allow certain file formats
if($imageFileType != "png") {
  echo "{\"success\": false, \"reason\":\"Sorry, only PNG files are allowed.\"}";
  exit(0);
}

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  echo "{\"success\": true}";
} else {
  echo "{\"success\": false, \"reason\":\"Moving file to web directory failed. Likely incorrect format (only PNG allowed).\"}";
}

?>
