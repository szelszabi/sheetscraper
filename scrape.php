<?php
require __DIR__ . '/vendor/autoload.php';
$client = new \Google_Client();
$client->setApplicationName('Google Sheets Scraping');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__.'/creds.json');
$service = new Google_Service_Sheets($client);
$sheetID = '1cJ8VirupqOmEYi-Q6-oNB9wGFWsx8pgn5fY35-LcBCs';
$range = 'games';
$response = $service->spreadsheets_values->get($sheetID, $range);
$values = $response->getValues();
if(empty($values))
{
    header("Location: index.php?response=1");
} 
else
{
    $result = '<table>';
    foreach($values as $row)
    {
        $result .= "<tr>";
        foreach($row as $item)
        {
            $result .= '<td>'.$item.'</td>';
        }
        $result.='</tr>';
    }
    $result.='</table>';
}
?>