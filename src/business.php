<?php


use MongoDB\BSON\ObjectID;


function get_db()
{
    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]);

    $db = $mongo->wai;

    return $db;
}

function clear_db()
{
	$db = get_db();	
	$db->images->deleteMany([]);
	$db->users->deleteMany([]);
}

function log_in($login, $password)
{
	$db = get_db();
	$user = $db->users->findOne(['login' => $login]);
	if($user &&  password_verify($password , $user['password']))
	{
		return true;
	}
	return false;
}

function add_user($email, $login, $password)
{
	$db = get_db();
	$user = $db->users->findOne(['login' => $login]);
	if($user != NULL)
		return false;

	$new_user = [
		'email' => $email,
		'login' => $login,
		'password' => password_hash($password, PASSWORD_DEFAULT)
	];

	$db->users->insertOne($new_user);
	return true;
}

function push_image($image)
{
	$image['name'] = rand(1, 1000) . '.' . $image['name'];

    $db = get_db();

	$db->images->insertOne($image);

    return $image['name'];
}

function get_images()
{
    $db = get_db();
    return $db->images->find()->toArray();
}

function get_products_by_category($cat)
{
    $db = get_db();
    $products = $db->products->find(['cat' => $cat]);
    return $products;
}

function get_product($id)
{
    $db = get_db();
    return $db->products->findOne(['_id' => new ObjectID($id)]);
}

function save_product($id, $product)
{
    $db = get_db();

    if ($id == null) {
        $db->products->insertOne($product);
    } else {
        $db->products->replaceOne(['_id' => new ObjectID($id)], $product);
    }

    return true;
}

function delete_product($id)
{
    $db = get_db();
    $db->products->deleteOne(['_id' => new ObjectID($id)]);
}
