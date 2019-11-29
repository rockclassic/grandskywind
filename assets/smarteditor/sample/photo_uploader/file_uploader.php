<?php
//////////////////////////////////////////////////////////////////////////////////
// default redirection
$url = 'callback.html?callback_func='.$_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

// SUCCESSFUL
if(bSuccessUpload) {
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$name = $_FILES['Filedata']['name'];
	
	
	$filename_ext = strtolower(array_pop(explode('.',$name)));
	$allow_file = array("jpg", "png", "bmp", "gif");
	$name2=date("YmdHis").mt_rand().".".$filename_ext;
	
	if(!in_array($filename_ext, $allow_file)) {
		$url .= '&errstr='.$name;
	} else {
		//$uploadDir = '/upload/';
		$uploadDir = '../../../../upload/';		
		//$uploadDir = '/home/jeromc/upload/';
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}
		
		$newPath = $uploadDir.$name2;//urlencode($_FILES['Filedata']['name']);
		
		@move_uploaded_file($tmp_name, $newPath);
		
		$url .= "&bNewLine=true";
		$url .= "&sFileName=".urlencode(urlencode($name));
		$url .= "&sFileURL=/upload/".urlencode(urlencode($name2));
		//$url .= "&sFileURL=http://".$_SERVER['HTTP_HOST']."/upload/".urlencode(urlencode($name2));
	}
}
// FAILED
else {
	$url .= '&errstr=error';
}
	
header('Location: '. $url);

?>