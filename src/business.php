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
	$_SESSION['chosen_images'] = [];
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
    $db = get_db();
	$image['_id'] = new ObjectID();
	$image['name'] = $image['_id'] . '.' . $image['name'];
	$db->images->insertOne($image);

    return $image['name'];
}

function get_images()
{
    $db = get_db();
    return $db->images->find()->toArray();
}

function get_image_by_id($id)
{
	$db = get_db();	
	return $db->images->findOne(['_id' => new ObjectID($id)]);
}