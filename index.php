<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello</title>
</head>
<body>
    <form method="POST" action="index.php">
        <input type="submit" value="Vakolás" name="scrape">
    </form>
    <?php
    if (isset($_POST['scrape']))
    {
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
            echo "<h1>Nem létező vagy üres tábla!</h1>";
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
        if(isset($result)) echo $result;
        header('Location: index.php');
        exit(); 
    }
?>
    
</body>
</html>