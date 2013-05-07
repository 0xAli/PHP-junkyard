<?
// Unrestricted file upload
// Use it at least with password protection like hardcoded.php
// https://github.com/0xAli/PHP-junkyard/blob/master/auth/hardcoded.php
if(!$_FILES['file']['tmp_name']){
		print '<form action="" method="post" enctype="multipart/form-data">
		File:
		<input type="file" name="file" />
		<input type="submit" name="submit" value="Upload!" />
		</form>';
	}else{
		$folder = 'uploads/'; // Upload folder name, leave empty for current directory.
		// And please make sure the directory name ends with a slash 
		if(file_exists($folder.$_FILES['file']['name'])){
			$rand = rand(1111,9999);
			$fileFinalPath = $folder.$rand.'-'.$_FILES['file']['name'];
		}else{
			$fileFinalPath = $folder.$_FILES['file']['name'];
		}
		
		if(move_uploaded_file($_FILES['file']['tmp_name'],$fileFinalPath)){
			print 'Image URL<br/><input type="text" style="width:550px;" value="'.dirname($_SERVER['HTTP_REFERER']).'/'.$fileFinalPath.'" />';
		}else{
			print 'Couldn\'t upload the file!';
		}
	}
?>