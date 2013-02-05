<?
// Set ffmpeg command format, first %s will be replaced with source file
// and second with destination
// LD_LIBRARY_PATH=. is necessary when ffmpeg with its libraries is located
// in the same directory as script
// if ffmpeg is installed by system admin, following format can be used:
// $ffmpeg_format = "ffmpeg -y -i %s %s > /dev/null 2>&1";
// standard and error outputs are redirected to /dev/null since we don't need them
// we will use ffmpeg's return value

// Detect running OS
$ffmpeg_format="";

if(strstr($_SERVER['SERVER_SOFTWARE'],"Win32"))
	$ffmpeg_format = "ffmpeg.exe -y -i %s %s";
else
	$ffmpeg_format = "LD_LIBRARY_PATH=. ./ffmpeg -y -i %s %s > /dev/null 2>&1";

$download_file = '';
$error = "";
if (isset($_POST['mpeg_submit'])) {

	// form was submited, check if file was uploaded without errors

	if ($_FILES['mpeg_file']['error'] == UPLOAD_ERR_OK) {
		$ret_value = 0;
		// prepare ffmpeg command

		$ffmpeg_command = sprintf($ffmpeg_format, $_FILES['mpeg_file']['tmp_name'], "flvs/test.flv");

		//echo $ffmpeg_command;

		if (system($ffmpeg_command, $ret_value) === FALSE || $ret_value != 0) {
			// ffmpeg was failed
			$error = "ffmpeg failure";
		} else {
			// ffmpeg successfully generated output
			$download_file = "flvs/test.flv";
		}
	} else {
		$error = 'File upload error';
	}
}
?><html>
<head><TITLE>mpeg2flv</TITLE></head>
<body><?=$error?><br>
<FORM method="POST" enctype="multipart/form-data">
MPEG file: <INPUT type="file" name="mpeg_file"><INPUT type="submit" name="mpeg_submit">
<? if ($download_file != '') { ?><br>You can download your file <a href="<?=$download_file?>">here</a>


<?php
//Fill the path to your file (can be any video extension)
$file=$download_file;

//Turn on output buffering
ob_start();

//Pass the command through passthru:
$sh=passthru("ffmpeg.exe  -i $download_file 2>&1");
//get the result
//$duration = ob_get_contents();
$duration = ob_get_contents();

//get the size in Mo
//$filezize=filesize($download_file)/(1024*1024);

ob_end_clean();

//Extract the duration
//echo "<pre>";
//print_r($duration);
//echo "</pre>";

echo $duration;

//$pos = strpos($duration, 'Duration', 1);
//$rest = substr($duration, $pos, -1);
$wordChunks = explode("Duration", $duration);
$wordChunk1=substr($wordChunks[1],0,12);
$last= explode(":", $wordChunk1);
//$last=split(':', $wordChunk1);
$fin=array_shift($last);
list($hours, $mins, $secs) = $last;

//echo "karthick".$wordChunk1;


echo "Video length: Hours: ".$hours." Minutes: ".$mins." Seconds: ".round($secs);
//print_r($last);
//list($hours, $mins, $secs) = split('[:]', $duration);

//Here you are:
//echo "Video length: Hours: ".$hours." Minutes: ".$mins." Seconds: ".round($secs);
//echo "Video size in Mo: ".$filesize;


/*ob_start();
passthru("ffmpeg-9260.exe -i \"". $videofile . "\" 2>&1");
$duration = ob_get_contents();
ob_end_clean();


preg_match('/Duration: (.*?),/', $duration, $matches);
$duration = $matches[1];
$duration_array = split(':', $duration);
$duration = $duration_array[0] * 3600 + $duration_array[1] * 60 + $duration_array[2];
$time = $duration * $percent / 100;
$time = intval($time/3600) . ":" . intval(($time-(intval($time/3600)*3600))/60) . ":" . sprintf("%01.3f", ($time-(intval($time/60)*60)));
*/
}?>

</FORM>
</body>
</html>