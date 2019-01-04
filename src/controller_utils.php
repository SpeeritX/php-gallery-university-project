<?php

function &get_cart()
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = []; //pusty koszyk
    }

    return $_SESSION['cart'];
}

function &get_next_page(&$model)
{
	$amount_of_pages = $model['amount_of_pages'];
	$page = $model['page'] + 1;
	
	if($page > $amount_of_pages)
		$page = $amount_of_pages;

    return $page;
}

function &get_prev_page(&$model)
{
	$amount_of_pages = $model['amount_of_pages'];
	$page = $model['page'] - 1;
	
    if($page <= 0)
		$page = 1;

	return $page;
}

function create_thumbnail($name)
{
	$dest = IMG_PATH . '/thumbnails/' . $name;
	$src = IMG_PATH . '/' . $name;
	/* read the source image */
	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_width = 125;
	$desired_height = 200;
	
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
	/* create the physical thumbnail image to its destination */
	imagejpeg($virtual_image, $dest);

	$imageProperties = imagecreatetruecolor($width, $height);
	$targetLayer = imagecreatefromjpeg($src);
	imagecopyresampled($imageProperties, $targetLayer, 0, 0, 0, 0, $width, $height, $width, $height);
	$WaterMarkText = 'CONFIDENTIAL';
	$watermarkColor = imagecolorallocate($imageProperties, 191,191,191);
	//imagestring($imageProperties, 5, 130, 117, $WaterMarkText, $watermarkColor);
	imagettftext($imageProperties, 50, -60, 100, 100, $watermarkColor, '/var/www/dev/src/web/font.ttf', $WaterMarkText);
	imagejpeg ($imageProperties, IMG_PATH . '/mark/' . $name);
	imagedestroy($targetLayer);
	imagedestroy($imageProperties);

}