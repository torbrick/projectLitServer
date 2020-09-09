<?php
	if (isset ( $_GET["msg"] )) {
		$msg = strip_tags ($_GET["msg"]);
		//test if value is a number
		if ( is_string($msg) ) {
			$dir = "onOffDir";
			if(!file_exists($dir)){
				mkdir($dir,0744);
			}
			//append file or create file if doesn't exist
			$filename = "$dir/onOff.txt";
			
			$date = date("D M d, Y G:i:s");
			$data = $date.'--- '.$msg;
			$byteswritten = file_put_contents($filename, $data.PHP_EOL , FILE_APPEND | LOCK_EX);
			$filesize = filesize($filename);
			$filetext = file_get_contents($filename,);
			
			echo("File name: $filename");
			echo("Bytes Written: $byteswritten bytes");
			echo("File size: $filesize bytes");
			echo("File text: $filetext");
		}
		else{
			echo("Could not process note!");
		}
	}
?>
