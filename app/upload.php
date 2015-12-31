<?php

// namespace FFMpeg\Tests;
error_reporting(E_ALL); // or E_STRICT
ini_set("display_errors",1);
ini_set("memory_limit","1024M");

$loader = require __DIR__.'/vendor/autoload.php';
use Vimeo\Vimeo;
use Vimeo\Exceptions\VimeoUploadException;

$client_id = '69931139216d9de3df12bf6d6a208722a3714b15';
$client_secret = '/8KCJrp5p4fFbnTplvEqZPGVWvskO0/bDoXeO5cbGKzNc9x0C9yTdWtnqNwGenQH1BJgnMZ5eA80NWApM/WcsP9p9o+iGkugD4e6YmuB+3cCNe7Zi7MjXzwsNX3iDLHm';
$lib = new \Vimeo\Vimeo($client_id, $client_secret);
// $token = $lib->clientCredentials('upload');
// var_dump($token['body']['access_token']);
$lib->setToken('3bccb2d4bf5c557b019b82da2f6d045b');



//  Get the args from the command line to see what files to upload.
$target_path = "uploads/";
print_r( $_FILES['video']['error']);
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

//   Keep track of what we have uploaded.
$uploaded = array();

//  Send the files to the upload script.
foreach ($files as $file_name) {
    //  Update progress.
    print 'Uploading ' . $file_name . "\n";
    try {
        //  Send this to the API library.
        $uri = $lib->upload($file_name);
        //  Now that we know where it is in the API, let's get the info about it so we can find the link.
        $video_data = $lib->request($uri);
        //  Pull the link out of successful data responses.
        $link = '';
        if($video_data['status'] == 200) {
            $link = $video_data['body']['link'];
        }
        //  Store this in our array of complete videos.
        $uploaded[] = array('file' => $file_name, 'api_video_uri' => $uri, 'link' => $link);
    }
    catch (VimeoUploadException $e) {
        //  We may have had an error.  We can't resolve it here necessarily, so report it to the user.
        print 'Error uploading ' . $file_name . "\n";
        print 'Server reported: ' . $e->getMessage() . "\n";
    }
}


//  Provide a summary on completion with links to the videos on the site.
print 'Uploaded ' . count($uploaded) . " files.\n\n";
foreach ($uploaded as $site_video) {
    extract($site_video);
    print "$file is at $link.\n";
}

?>

