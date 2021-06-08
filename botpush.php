<?php



require "vendor/autoload.php";

$access_token = 'RF0Iz2xcl+yLlGh76tQRCzFEstrAEye0PdExGR5qcf1QY2P8xP743U45QWWKAfRfyC42Np/CYYknEHKT73u97/W1Hb8XwaX3uhfpZQWiTTTX0cxSnKXygjcWD0QYylE0WU7RplCn+nEYtRo9y893XAdB04t89/1O/w1cDnyilFU=';

$channelSecret = '31d037ba1d9d1829c72f810240fc1f75';

$pushID = 'Uaf78a3809be375039177b2dcdbeb0fee';

$pushID =  array(
  //"Uaf78a3809be375039177b2dcdbeb0fee", 
  //"U974d484b14ae66b54afcb686160a86df", 
  "Uaf78a3809be375039177b2dcdbeb0fee"
); 

$worldBot = "bot say hallo !!";

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($worldBot);

for($i=0;$i<count($pushID);$i++){
  $response = $bot->pushMessage($pushID[$i], $textMessageBuilder);
  echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
}









