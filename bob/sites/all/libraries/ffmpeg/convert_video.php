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
function mpeg2flv($video_file_name, $flv_name)
{
	$ffmpeg_format="";

	$curdir = define ('FULL_PATH', dirname(__FILE__).'/');

	if(strstr($_SERVER['SERVER_SOFTWARE'],"Win32"))
		$ffmpeg_format = $curdir."ffmpeg.exe -y -i %s %s";
	else
		$ffmpeg_format = "LD_LIBRARY_PATH=. ".$curdir."ffmpeg -y -i %s %s > /dev/null 2>&1";

	$ret_value = 0;
	// prepare ffmpeg command

	$ffmpeg_command = sprintf($ffmpeg_format, $video_file_name, $flv_name);

	//echo $ffmpeg_command;

	if (system($ffmpeg_command, $ret_value) === FALSE || $ret_value != 0) {
		// ffmpeg was failed
		return false;
	}
	return true;
}