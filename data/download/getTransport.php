<?php


if(isset($_POST["download"])){
    $url = $_POST["url_transport_xml"];
    $xml = $_POST["xml_name"];

    $http_url = $url."?login=ondrej.zelina@proton.me&password=fotoatalierzelinaZelio_6236";

    // cilovy nazev souboru
    $file_name = "xml/".$xml.".xml";

    // fopen automaticky generuje neexistujici soubour v adresari, neni potreba ho vytvaret manualne
    $file_output = fopen($file_name, 'w+');

    // inicializace curl
    $curl = curl_init();

    // incializace url
    curl_setopt($curl, CURLOPT_URL, $http_url);

    // casovy limit stahovani souboru v sekundach
    curl_setopt($curl, CURLOPT_TIMEOUT, 300);

    // prevod dat do ciloveho soubouru + nasledovani presmerovani 
    curl_setopt($curl, CURLOPT_FILE, $file_output); 
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

    // curl odezva a ukonceni
    curl_exec($curl); 
    curl_close($curl);
    fclose($file_output);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Downolad transport method</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="url_transport_xml" id="" placeholder="url xml souboru"><br>
        <input type="text" name="xml_name" id="" placeholder="Název xml souboru"><br>
        <input type="submit" value="Stáhnout xml" name="download">
    </form>
</body>
</html>