<?php

if(!isset($_POST["knownImgHash"])){
    echo "{\"error\":\"Checking if a new image exists requires the previous image's hash\"}";
    exit(0);
}

$knownHash = $_POST["knownImgHash"];
$currentImgHash = hash_file(
    "sha256",
    "../assets/img/display-image.png"
);

// echo "{$knownHash}\t{$currentImgHash}\n";

if(strcmp($knownHash, $currentImgHash) != 0) {
    echo "{\"do_refresh\": true, \"new_hash\": \"{$currentImgHash}\"}";
}
else {
    echo "{\"do_refresh\": false}";
}