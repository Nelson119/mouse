<?php

$loader = require __DIR__.'/vendor/autoload.php';

	print_r($_FILES);
  if(isset($_FILES['video'])){
  	$info = pathinfo($_FILES['video']['name']);
	$ext = $info['extension']; // get the extension of the file
	$newname =  'file_'.
		hash ('md5', time()).
		time().'.'.$ext; 

	$target = __DIR__.'/upload/'.$newname;
	$r = move_uploaded_file( $_FILES['video']['tmp_name'], $target);
	print_r($target);
  	$ffmpeg = FFMpeg\FFMpeg::create();
	// $video = $ffmpeg->open('video.mpg');
	// $video
	//     ->filters()
	//     ->resize(new FFMpeg\Coordinate\Dimension(320, 240))
	//     ->synchronize();
	// $video
	//     ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(10))
	//     ->save('frame.jpg');
	// $video
	//     ->save(new FFMpeg\Format\Video\X264(), 'export-x264.mp4')
	//     ->save(new FFMpeg\Format\Video\WMV(), 'export-wmv.wmv')
	//     ->save(new FFMpeg\Format\Video\WebM(), 'export-webm.webm');
  } 
?>