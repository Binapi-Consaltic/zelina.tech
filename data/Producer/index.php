<?php

ini_set("memory_limit", "-1");
require_once("simple-html-dom.php");

$http_url = "http://private.ws.cz.elinkx.biz/service.asmx/getProductProducerList?login=ondrej.zelina@proton.me&password=fotoatalierzelinaZelio_6236";

// cilovy nazev souboru
$file_name = "xml/producer.xml";

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

$input_data = [
	"input" => $file_name,
	"output" => "csv/producer.csv"
];

$app_xml_parser = file_get_html($input_data["input"]);
$app_data_children_header_inc = -1;
$app_data_children_inc = -1;
$app_data_list_header = [];
$app_data_list_buffer = [];

while(1){
	$app_data_children_header_inc++;

	if(!isset($app_xml_parser->find("ProductProducer",0)->children($app_data_children_header_inc)->tag)){
		break;
	}else{
		array_push($app_data_list_header, $app_xml_parser->find("ProductProducer",0)->children($app_data_children_header_inc)->tag);
	}
}


while(2){
	$app_data_children_inc++;

	if(!isset($app_xml_parser->find("ProductProducer",0)->children($app_data_children_inc)->innertext)){
		break;
	}else{
		array_push($app_data_list_buffer, $app_xml_parser->find("ProductProducer",0)->children($app_data_children_inc)->innertext);
	}

	echo "<pre>";
	print_r($app_xml_parser->find("ProductProducer"));
	echo "</pre>";
}

$file = fopen($input_data["output"], "w+");
fputcsv($file, $app_data_list_header);

$set = [];
array_push($set, $app_data_list_buffer);

foreach($set as $item){
	// array_push($app_data_list_buffer, $item);
	// print_r($app_data_list_buffer);
	fputcsv($file, $item);
}

// echo "<pre>";
// print_r($set);
// echo "</pre>";

fclose($file);

?>