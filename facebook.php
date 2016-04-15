<?php

$appID = '1708206316123547';
$appSecret = '576263937efdb94b09ceccce7d760447';

$feed = 228735667216; // BBC NEWS
$maximum = 20;
$caching = 60;

$filename = basename(__FILE__, '.php').'.json';
$filetime = file_exists($filename) ? filemtime($filename) : time() - $caching - 1;

if (time() - $caching > $filetime) {
	$authentication = file_get_contents("https://graph.facebook.com/oauth/access_token?grant_type=client_credentials&client_id={$appID}&client_secret={$appSecret}");

	$response = file_get_contents("https://graph.facebook.com/{$feed}/feed?{$authentication}&limit={$maximum}&format=json&fields=id,message,created_time,link,full_picture,shares");

	file_put_contents($filename, $response);
} else {
	$response = file_get_contents($filename);
}

header('Content-Type: application/json');
header('Last-Modified: '.gmdate('D, d M Y H:i:s', $filetime).' GMT');

echo $response;
?>
