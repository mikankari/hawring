<?php

$file = $_FILES["file"];
$file_pathinfo = pathinfo($file["name"]);
$filename = md5_file($file["tmp_name"]) . "." . $file_pathinfo["extension"];

if($file["size"] > 20000000){
	exit("too large file");
}
if(!in_array($file_pathinfo["extension"], array("mp3","aac", "wav", "ogg", "m4a"))){
	exit("not allowed extension");
}
if(!is_uploaded_file($file["tmp_name"]) || $file["error"] > 0){
	exit("uploading error " . $file["error"]);
}

move_uploaded_file($file["tmp_name"], __DIR__ . "/music/" . $filename);
file_put_contents(__DIR__ . "/current.json", "{\"filename\":\"" . $filename . "\"}\n");

print "ok";

?>