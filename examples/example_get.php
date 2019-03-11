<?php
require '../Meli/meli.php';
require '../configApp.php';

$meli = new Meli($appId, $secretKey);

$params = array();

$url = '/sites/' . $token;

$result = $meli->get($url, access_token='.$token, $params);

echo '<pre>';
print_r($result);
echo '</pre>';
