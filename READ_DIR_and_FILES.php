<?php

$removed = ['..','.','.DS_Store'];

$dir = array_diff(scandir( DIRECTORY_SEPARATOR . __DIR__),$removed);

foreach($dir as $file) {
	
	if(is_file($file)) 
	{
		echo "$file" . '<strong> - file</strong><br> ';
	} 
	
	elseif(is_dir($file)) {
		echo $file . '<strong> - dir</strong><br>';
	}
}