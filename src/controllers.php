<?php
require_once 'business.php';
require_once 'controller_utils.php';
const IMG_PATH = 'images/';

const AMOUNT_OF_IMG_ON_PAGE = 9;

function home(&$model)
{
    return 'home_view';
}

function contact(&$model)
{
	clear_db();
    return 'contact_view';
}

function gallery(&$model)
{
	$model['images'] = get_images();
	$model['amount_of_pages'] = ceil(count($model['images']) / AMOUNT_OF_IMG_ON_PAGE);
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
	if($model['last'] > count($model['images']))
		$model['last'] = count($model['images']);
	
    return 'gallery_view';
}

function add_image(&$model)
{
    return 'upload_view';
}

function upload_image(&$model)
{
	$model['statement'] = '';


	if($_FILES["image"]["error"] > 0) {
		if($_FILES["image"]["error"] == 1)
			$model['statement'] .= "File is too big to upload. ";
		else
			$model['statement'] .= "Error occured. ";

		return 'upload_view';
	}

	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo(IMG_PATH . basename($_FILES["image"]["name"]),PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) 
	{
		$check = getimagesize($_FILES["image"]["tmp_name"]);
		if($check !== false) 
		{
			$model['statement'] .= "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} 
		else 
		{
			$model['statement'] .= "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check file size
	if ($_FILES["image"]["size"] > 1000000) 
	{
		$model['statement'] .= "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png") 
	{
		$model['statement'] .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) 
	{
		$model['statement'] .= "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} 
	else 
	{
		$new_image = 
		[
			'title' => $_POST["title"],
			'author' => $_POST["author"],
			'name' => $imageFileType
		];
		$name = push_image($new_image);
		$target_file = IMG_PATH . $name;
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) 
		{
			create_thumbnail($name);
			$model['statement'] .= "The file ". $_POST["title"] . " has been uploaded.";
		} 
		else 
		{
			$model['statement'] .= "Sorry, there was an error uploading your file.";
		}
	}
    return 'upload_view';
}

