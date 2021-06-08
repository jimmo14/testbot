<?php



require "vendor/autoload.php";


if (php_sapi_name() != 'cli') {
    throw new Exception('This application must be run on the command line.');
}

$excel_val = "test test test ";

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Sheets API PHP Quickstart');
    $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = 'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}


// Get the API client and construct the service object.
/*$client = getClient();
$service = new Google_Service_Sheets($client);

// Prints the names and majors of students in a sample spreadsheet:
// https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit
$spreadsheetId = '1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms';
$range = 'Class Data!A2:E';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();



if (empty($values)) {
    $excel_val .= "No data found.\n";
} else {
    $excel_val .= "Name, Major:\n";
    foreach ($values as $row) {
        $excel_val .= $row[0];
        // Print columns A and E, which correspond to indices 0 and 4.
        //printf("%s, %s\n", $row[0], $row[4]);
    }
}*/


/****************************
connect to line bot
*****************************/
$access_token = 'RF0Iz2xcl+yLlGh76tQRCzFEstrAEye0PdExGR5qcf1QY2P8xP743U45QWWKAfRfyC42Np/CYYknEHKT73u97/W1Hb8XwaX3uhfpZQWiTTTX0cxSnKXygjcWD0QYylE0WU7RplCn+nEYtRo9y893XAdB04t89/1O/w1cDnyilFU=';

$channelSecret = '31d037ba1d9d1829c72f810240fc1f75';

$pushID = 'Uaf78a3809be375039177b2dcdbeb0fee';

$pushID =  array(
  //"Uaf78a3809be375039177b2dcdbeb0fee", 
  //"U974d484b14ae66b54afcb686160a86df", 
  "Uaf78a3809be375039177b2dcdbeb0fee"
); 

$worldBot = "bot say hallo !!";
//$worldBot = $excel_val;

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($worldBot);

for($i=0;$i<count($pushID);$i++){
  $response = $bot->pushMessage($pushID[$i], $textMessageBuilder);
  echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
}









