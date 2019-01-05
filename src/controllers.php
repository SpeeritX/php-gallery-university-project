<?php
require_once 'business.php';
require_once 'controller_utils.php';
const IMG_PATH = 'images/';

const AMOUNT_OF_IMG_ON_PAGE = 6;

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
		$model['page'] = secure_input($_GET['page']);
	
	$model['next'] = get_next_page($model);
	$model['prev'] = get_prev_page($model);
	$model['first'] = ($model['page'] - 1) * AMOUNT_OF_IMG_ON_PAGE;
	$model['last'] = $model['page'] * (AMOUNT_OF_IMG_ON_PAGE) + 1;
	if($model['last'] > count($model['images']))
		$model['last'] = count($model['images']);
	
    return 'gallery_view';
}

function add_image(&$model)
{
    return 'upload_view';
}

function login(&$model)
{
	if ($_SERVER["REQUEST_METHOD"] === 'POST') 
	{
		$login = secure_input($_POST["login"]);
		$password = secure_input($_POST["password"]);

		if(log_in($login, $password))
		{
			$model['statement'] = 'Pomyślnie zalogowano.';
			$_SESSION['user'] = $login;
			$_SESSION['logged_in'] = true;
		}
		else 
		{
			$model['statement'] = 'Nieprawidłowy login lub hasło.';
		}
	}
    return 'login_view';
}

function log_out(&$model)
{
	$_SESSION['user'] = 'Niezalogowany';
	$_SESSION['logged_in'] = false;
	return gallery($model);
}

function register(&$model)
{
	if ($_SERVER["REQUEST_METHOD"] === 'POST') 
	{
		$email = secure_input($_POST["email"]);
		$login = secure_input($_POST["login"]);
		$password = secure_input($_POST["password"]);
		$password_again = secure_input($_POST["password_again"]);

		if($password != $password_again)
		{
			$model['statement'] = 'Podane hasła nie są takie same.';
		}
		else if(add_user($email, $login, $password))
		{
			$model['statement'] = 'Pomyślnie zarejestrowano.';
			$_SESSION['user'] = $login;
			$_SESSION['logged_in'] = true;
		}
		else 
		{
			$model['statement'] = 'Podany login jest zajęty.';
		}
	}
    return 'register_view';
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

	$title = secure_input($_POST["title"]);
	$author = secure_input($_POST["author"]);
	$watermark = secure_input($_POST["watermark"]);
	$added_by = secure_input($_POST["added_by"]);	
	$user = 'default';
	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'])
		$user = $_SESSION['user'];
	if(secure_input($_POST["privacy"]) == 'private')
		$private = true;

	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo(IMG_PATH . basename($_FILES["image"]["name"]),PATHINFO_EXTENSION));

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
			'name' => $imageFileType,
			'title' => $title,
			'author' => $author,
			'added_by' => $added_by,
			'private' => $private,
			'user' => $user
		];
		$name = push_image($new_image);
		$target_file = IMG_PATH . $name;
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) 
		{
			create_thumbnail($name);
			add_watermark($name, $watermark);
			$model['statement'] .= "The file ". $title . " has been uploaded.";
		} 
		else 
		{
			$model['statement'] .= "Sorry, there was an error uploading your file.";
		}
	}
    return 'upload_view';
}

