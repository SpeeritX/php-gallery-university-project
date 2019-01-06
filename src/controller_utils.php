<?php

function &get_cart()
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = []; //pusty koszyk
    }

    return $_SESSION['cart'];
}

function calculate_gallery_model(&$model, $images_set)
{
	//get images -----------------------------------------		
	$images = [];
	foreach($images_set as $img)
	{
		if(!$img['private'] || is_current_user($img['user']))
			$images[] = $img;
	}
	$amount_of_pages =  ceil(count($images) / AMOUNT_OF_IMG_ON_PAGE);
	if($amount_of_pages == 0)
		$amount_of_pages = 1;

	//calculate current page -------------------------------		
	if(empty($_GET['page']))
		$current_page = 1;
	else
	{
		$current_page = secure_input($_GET['page']);
		if($current_page < 1)
			$current_page = 1;
		else if($current_page > $amount_of_pages)
			$current_page = $amount_of_pages;
	}

	//calculate model's variables -------------------------------		
	$model['next'] = get_next_page($current_page, $amount_of_pages);
	$model['prev'] = get_prev_page($current_page);
	$model['images'] = get_images_on_page($images, $current_page);
}

function get_images_on_page($images, $page)
{
	$first_element = ($page - 1) * AMOUNT_OF_IMG_ON_PAGE;
	$amount_of_elements = AMOUNT_OF_IMG_ON_PAGE;
	if($first_element + $amount_of_elements > count($images))
		$amount_of_elements = count($images) - $first_element;

	return array_slice($images, $first_element, $amount_of_elements);
}

function get_next_page($current_page, $amount_of_pages)
{
	$current_page += 1;
	
	if($current_page > $amount_of_pages)
		return NULL;

    return $current_page;
}

function get_prev_page($current_page)
{
	$current_page -= 1;
	
    if($current_page <= 0)
		return NULL;

	return $current_page;
}

function secure_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function create_thumbnail($img_name)
{
	$dest = IMG_PATH . '/thumbnails/' . $img_name;
	$src = IMG_PATH . '/' . $img_name;

	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	$thumb_width = 175;
	$thumb_height = 280;
	
	$virtual_image = imagecreatetruecolor($thumb_width, $thumb_height);
	
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
	
	imagejpeg($virtual_image, $dest);
	imagedestroy($virtual_image);


}

function add_watermark($img_name, $text)
{
	$dest = IMG_PATH . '/mark/' . $img_name;
	$src = IMG_PATH . '/' . $img_name;
	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	$virtual_image = imagecreatetruecolor($width, $height);
	$targetLayer = imagecreatefromjpeg($src);
	imagecopyresampled($virtual_image, $targetLayer, 0, 0, 0, 0, $width, $height, $width, $height);
	$watermarkColor = imagecolorallocate($virtual_image, 171,171,171);
	imagettftext($virtual_image, 20, 0, 25, $height - 25, $watermarkColor, '/var/www/dev/src/web/font.ttf', $text);
	imagejpeg ($virtual_image, $dest);
	imagedestroy($targetLayer);
	imagedestroy($virtual_image);
}

function is_active($currect_page)
{
	$url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
	$url = end($url_array);  
	if(strpos($url, $currect_page) !== false)
		  return true;
	return false;
}

function &get_chosen_images()
{
	if (!isset($_SESSION['chosen_images'])) 
	{
        $_SESSION['chosen_images'] = [];
    }

    return $_SESSION['chosen_images'];
}

function is_chosen($id)
{
	$chosen_images = &get_chosen_images();
	if (array_search(get_image_by_id($id), $chosen_images) !== false) 
		return true;

	return false;
}

function is_current_user($user)
{
	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && $_SESSION['user'] == $user)
		return true;

	return false;
}