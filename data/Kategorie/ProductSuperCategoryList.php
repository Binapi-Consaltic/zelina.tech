<?php

require_once("simple-html-dom.php");

$input_data = array(
    "input" => "xml\ProductCategoryList.xml",
    "output" => "csv\ProductSuperCategoryList.csv"
);

$app_xml_parser = file_get_html($input_data["input"]);
$app_data_header = array();
$app_data_buffer = array();
$app_data_buffer = array();

$app_data_header_inc = -1;
$app_data_children_inc = 0;

while(1){
    $app_data_header_inc++;

    if(!isset($app_xml_parser->find("ProductSuperCategory",0)->children($app_data_header_inc)->tag)){
        break;
    }else{
        array_push($app_data_header, $app_xml_parser->find("ProductSuperCategory",0)->children($app_data_header_inc)->tag);
    }
}

foreach($app_xml_parser->find("ProductSuperCategory") as $item){
    $app_data_children_inc++;
    for($i = 0; $i<= $app_data_children_inc; $i++){
        if(isset($item->children($i)->innertext)){
            $app_data_buffer[$app_data_children_inc][$i] = $item->children($i)->innertext;
        }
    }
}


$file = fopen($input_data["output"], "w+");
fputcsv($file, $app_data_header);

foreach($app_data_buffer as $item){
    fputcsv($file, $item);
}

fclose($file);

echo ">>> Data written to the file successfully";

?>