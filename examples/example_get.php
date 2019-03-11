<?php
require '../Meli/meli.php';
require '../configApp.php';

$meli = new Meli($appId, $secretKey);

$params = array('access_token' => $access_token);

$result = $meli->get('/users/me', $params, true); 
echo '<pre>';
print_r($result);
echo '</pre>';

