<?php
class ImagesModel extends Model{
	public function UploadImages(){
		error_reporting(0);
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$target_dir    = "img/profile-images/";
		$target_file   = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk 	   = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$img 		   = $_FILES["fileToUpload"]["name"];
		$user_id 	   = $_SESSION['user_data']['user_id'];
		
		// Check if image file is a actual image or fake image
		if(isset($_POST["image_submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				Messages::setMsg('File is an image - ' . $check["mime"], 'successMsg');
				$uploadOk = 1;
			} else {
				Messages::setMsg('File is not an image.', 'error');
				$uploadOk = 0;
			}
		
			// Check if file already exists
			if (file_exists($target_file)) {
				Messages::setMsg('Sorry, file already exists.', 'error');
				$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000) {
				Messages::setMsg('Sorry, your file is too large.', 'error');
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				Messages::setMsg('Sorry, only JPG, JPEG, PNG & GIF files are allowed.', 'error');
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				Messages::setMsg('Sorry, your file was not uploaded.', 'error');
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					Messages::setMsg('The file ' . basename( $_FILES["fileToUpload"]["name"]). ' has been uploaded.', 'successMsg');
				} else {
					Messages::setMsg('Sorry, there was an error uploading your file.', 'error');
				}
			}
			
			$user = new UserModel();
			$user->UpdateUserImg($img, $user_id);
		}
		return;
	}
}