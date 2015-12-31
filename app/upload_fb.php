<?php

// namespace FFMpeg\Tests;
error_reporting(E_ALL); // or E_STRICT
ini_set("display_errors",1);
ini_set("memory_limit","1024M");

$loader = require __DIR__.'/vendor/autoload.php';



// If you already have a valid access token:
$session = new Facebook\FacebookSession('CAAIK2IJWaKQBAP1wYUMV7MZCknrmjQ98y3dNZA2L10v9wOUU2lE2wG4HAF7Xcqtq5QBa1ZARzjPDVwZARqCV2rsop0CGhFRNzQZAraZAPs0w41NGEm1iTD38DvX1mkZBVRe9vzAHoIVzA3f9fHGVF81aFuhJqcvWenGB2aaPRgTTrhv6AarYk68TnQEHopMlLvsRVpbvN3xNVtIZAoyrix4b3XAmJloq4u4ZD');


$fb = new Facebook\Facebook([
  'app_id' => '574874969335972',
  'app_secret' => '54ca7b3e1b7c1bd171fb1c9988c1b4fe',
  'default_graph_version' => 'v2.2',
  ]);

// To validate the session:
try {
  $session->validate();
  echo 'session validate';
} catch (FacebookRequestException $ex) {
  // Session not valid, Graph API returned an exception with the reason.
  echo $ex->getMessage();
} catch (\Exception $ex) {
  // Graph API returned info, but it may mismatch the current app or have expired.
  echo $ex->getMessage();
}

//  Get the args from the command line to see what files to upload.
$target_path = "uploads/";
if(isset($_FILES['video'])){
	$target_path = $target_path . basename( $_FILES['video']['name']); 

	if(move_uploaded_file($_FILES['video']['tmp_name'], $target_path)) {
	    echo "The file ".  basename( $_FILES['video']['name']). 
	    " has been uploaded";
	} else{
	    echo "There was an error uploading the file, please try again!";
	}
}
$files = Array();
array_push($files, $target_path);

?>

