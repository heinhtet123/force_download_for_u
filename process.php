<?php 

$file_name=@$_GET['file'];
$file_path="file/".$file_name;


// // for IE read and write gzip compressed files. Thus it is used for serving faster content to the end users by compressing the data stream.
 if(ini_get('zlib.output_compression'))
 ini_set('zlib.output_compression', 'Off');


$mime="application/octet-stream";

if ($data === NULL && ($fp = @fopen($file_path, 'rb')) === FALSE)
		{
			return;
		}

if (ob_get_level() !== 0 && @ob_end_clean() === FALSE)
{
		@ob_clean();
}


// // application/octet-stream

header('Content-Transfer-Encoding: binary'); 
header('Content-Encoding: none');
header("Content-Length: " . filesize($file_name));
header('Content-Type: '.$mime);
header('Cache-Control: private, no-transform, no-store, must-revalidate');
header("Content-Disposition: attachment; filename=".basename($file_name)."");


// echo file_get_contents($file_path);

while ( ! feof($fp) && ($data = fread($fp)) !== FALSE)
{
	echo $data;
}

fclose($fp);
exit;
