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
	//clear_db();
    return 'contact_view';
}

function gallery(&$model)
{
	if ($_SERVER["REQUEST_METHOD"] === 'POST'  && !empty($_POST['chosen'])) 
	{
		$chosen_images = &get_chosen_images();
		foreach($_POST['chosen'] as $chosen)
		{
			$image = get_image_by_id($chosen);
			if(!in_array($image, $chosen_images))
				$chosen_images[] = $image;
		}
	}

	calculate_gallery_model($model, get_images());

    return 'gallery_view';
}

function selected(&$model)
{
	if ($_SERVER["REQUEST_METHOD"] === 'POST' && !empty($_POST['chosen'])) 
	{
		$chosen_images = &get_chosen_images();
		foreach($_POST['chosen'] as $chosen)
		{
			$image = get_image_by_id($chosen);
			if (($key = array_search($image, $chosen_images)) !== false) 
				array_splice($chosen_images, $key, 1);
		}
	}

	calculate_gallery_model($model, get_chosen_images());

    return 'gallery_view';
}

function search(&$model)
{
	calculate_gallery_model_all_pages($model, get_images());

	if(isset($_GET["q"]))
	{
		$q = strtolower($_GET["q"]);
		if(true)
		{
			$images = $model["images"];
			$model["images"] = [];

			foreach($images as $img)
			{
				if(strpos(strtolower($img['title']), $q) !== false || 
					strpos(strtolower($img['author']), $q) !== false || 
					strpos(strtolower($img['added_by']), $q) !== false)
				{
					$model["images"][] = $img;
				}
			}
		}
		return 'images_view';
	}
	else 
	{
		return 'search_view';
	}
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

function logout(&$model)
{
	$_SESSION['user'] = NULL;
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
			$model['registered'] = true;
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

	if($_FILES['image']['error'] > 0) 
	{
		if($_FILES['image']['error'] == 1)
			$model['statement'] .= "Plik był zbyt duży do wysłania. ";
		else
			$model['statement'] .= "Wystąpił błąd podczas wysyłania pliku. ";
		return 'upload_view';
	}

	$title = secure_input($_POST['title']);
	$author = secure_input($_POST['author']);
	$watermark = secure_input($_POST['watermark']);
	$added_by = secure_input($_POST['added_by']);	
	$user = 'default';
	$private = false;
	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'])
		$user = $_SESSION['user'];
	if(isset($_POST['privacy']) && secure_input($_POST['privacy']) == 'private')
		$private = true;

	$imageFileType = strtolower(pathinfo(IMG_PATH . basename($_FILES['image']['name']),PATHINFO_EXTENSION));
	$imageFileType = secure_input($imageFileType);
	
	$upload_result = 1;
	if ($_FILES['image']['size'] > 1000000) 
	{
		$model['statement'] .= "Plik jest zbyt duży. ";
		$upload_result = 0;
	}

	if($imageFileType != "jpg" && $imageFileType != "png") 
	{
		$model['statement'] .= "Dozwolone są tylko pliki: jpg, png. ";
		$upload_result = 0;
	}

	if ($upload_result == 0) 
	{
		$model['statement'] = "Wystąpił Błąd. " . $model['statement'];
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
			'user' => $user,
			'_id' => null
		];
		$name = push_image($new_image);
		$target_file = IMG_PATH . $name;
		if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) 
		{
			create_thumbnail($name, $imageFileType);
			add_watermark($name, $watermark, $imageFileType);
			$model['statement'] .= "Książka $title została dodana.";
		} 
		else 
		{
			$model['statement'] .= "Wystąpił nieznany błąd.";
		}
	}
    return 'upload_view';
}

