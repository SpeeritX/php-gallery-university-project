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

function save_image($src, $name)
{

}