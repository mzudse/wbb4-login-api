<?php
require_once('global.php');
use wcf\data\user\User;

$email 		= $_POST['email'];
$password 	= $_POST['password'];

$return = [];

if(!isset($email, $password) || empty($email) || empty($password)) {
	echo json_encode(['status' => 'error', 'msg' => 'invalid_params']);
	return;
}

$user = User::getUserByEmail($email);

$userId = $user->userID;

if(!$userId) {
	echo json_encode(['status' => 'error', 'msg' => 'invalid_data_1']);
	return;
}

if(!$user->checkPassword($password)) {
	echo json_encode(['status' => 'error', 'msg' => 'invalid_data_2']);
	return;
}

echo json_encode(['status' => 'success', 'userid' => $userId]);
