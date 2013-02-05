<?
/* This program converts other formats to flv to use with osDate - Vijay Nair */

// Set ffmpeg command format, first %s will be replaced with source file
// and second with destination
// LD_LIBRARY_PATH=. is necessary when ffmpeg with its libraries is located
// in the same directory as script
// if ffmpeg is installed by system admin, following format can be used:
// $ffmpeg_format = "ffmpeg -y -i %s %s > /dev/null 2>&1";
// standard and error outputs are redirected to /dev/null since we don't need them
// we will use ffmpeg's return value

// Detect running OS
function convert2flv($fromfile, $tofile) {

	$this_dir = dirname(__FILE__) . '/';

	$ffmpeg_format="";

	if(strstr($_SERVER['SERVER_SOFTWARE'],"Win32") or strstr($_SERVER['OS'],'Window')) {
		$ffmpeg_format = $this_dir."ffmpeg.exe -y -i %s %s";
	} else {
		$ffmpeg_format = "LD_LIBRARY_PATH=. ./ffmpeg -y -i %s %s > /dev/null 2>&1";
	}


	$ffmpeg_command = sprintf($ffmpeg_format, $fromfile, $tofile);


	if (system($ffmpeg_command, $ret_value) === FALSE || $ret_value != 0) {
			// ffmpeg was failed
		return FALSE;
	} elseif (!is_file($tofile)) { return FALSE; }

	return TRUE;
}
