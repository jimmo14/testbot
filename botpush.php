<?php



require "vendor/autoload.php";

$access_token = 'RF0Iz2xcl+yLlGh76tQRCzFEstrAEye0PdExGR5qcf1QY2P8xP743U45QWWKAfRfyC42Np/CYYknEHKT73u97/W1Hb8XwaX3uhfpZQWiTTTX0cxSnKXygjcWD0QYylE0WU7RplCn+nEYtRo9y893XAdB04t89/1O/w1cDnyilFU=';

$channelSecret = '31d037ba1d9d1829c72f810240fc1f75';

$pushID = 'Uaf78a3809be375039177b2dcdbeb0fee';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







