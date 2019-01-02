<?php
require_once 'business.php';
require_once 'controller_utils.php';

const AMOUNT_OF_IMG_ON_PAGE = 9;

function home(&$model)
{
    return 'home_view';
}

function contact(&$model)
{
    return 'contact_view';
}

function gallery(&$model)
{
	$images = glob('images/*.{jpg,png,gif}', GLOB_BRACE);
	$model['amount_of_pages'] = ceil(count($images) / AMOUNT_OF_IMG_ON_PAGE);
	if($model['amount_of_pages'] == 0)
		$model['amount_of_pages'] = 1;
		
	if(empty($_GET['page']))
		$model['page'] = 1;
	else
		$model['page'] = $_GET['page'];
	
	$model['next'] = get_next_page($model);
	$model['prev'] = get_prev_page($model);
	$model['first'] = ($model['page'] - 1) * AMOUNT_OF_IMG_ON_PAGE;
	$model['last'] = $model['page'] * (AMOUNT_OF_IMG_ON_PAGE);
	if($model['last'] > count($images))
		$model['last'] = count($images);
	
    return 'gallery_view';
}

function add_image(&$model)
{
    return 'upload_view';
}

function upload_image(&$model)
{
	$target_dir = "images/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["image"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}

	// Check if file already exists
	if (file_exists($target_file)) {
		//echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["image"]["size"] > 1000000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		//echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
    return 'home_view';
}

