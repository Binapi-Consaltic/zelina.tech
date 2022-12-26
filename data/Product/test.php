<?php

ini_set("memory_limit", "-1");
require_once("simple-html-dom.php");
require_once("../../setup/connect.php");

if(isset($_POST["download"])){
  $url = $_POST["url"];
  $file = $_POST["file_name"];

  $http_url = $url."?login=info@interierovysortiment.cz&password=Zelio_6236";

  // cilovy nazev souboru
  $file_name = "xml/".$file.".xml";
  
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

  echo ">>> ".$file.".xml was written to the file successfully<br>";

  $app_file = array(
    "input" =>  "xml/".$file.".xml",
    "output" => "sql/".$file.".sql"
    );
    
    $app_file_buffer = array();
    $app_data_list_buffer = array();
    $app_data_list_header = array();
    
    
    $app_xml_parser = file_get_html($app_file["input"]);
    
    $app_data_list__inc = -1;
    $app_data_list__item_children_inc = -1;
    
    $app_data_list__response_inc = -1;
    $app_data_list__image_list_inc = -1;
    $app_data_list__image_list_b_inc = -1;
    
    
    $app_data_list__image_list_pattern = array();
    $app_data_list__image_list_match = array();
    
    $app_data_list__navigator_data_list_pattern = array();
    $app_data_list__image_list_match = array();
    
    
    $app_data_list__logistic_data_list_pattern = array();
    $app_data_list__logistic_data_list_match = array();
    
    
    //echo $app_xml_parser->find('imageList',3)->innertext;
    
    
    // ____app_data_list__children_count
    while(1) {
      $app_data_list__item_children_inc++;
    
      if(!isset($app_xml_parser->find('ProductComplete',0)->children($app_data_list__item_children_inc)->tag)) {
        break;
      }
    
      else {
        array_push($app_data_list_header, $app_xml_parser->find('ProductComplete',0)->children($app_data_list__item_children_inc)->tag);
      }
    
    }
    // end ____app_data_list__children_count
    
    
    // ____app_data_list__item_count
    foreach($app_xml_parser->find('ProductComplete') as $item) {
      $app_data_list__inc++;
    }
    
    for($i = 0; $i <= $app_data_list__inc; $i++) {
      array_push($app_data_list_buffer, array());
    }
    // end ____app_data_list__children_count
    
    
    
    /*
    // ____app_data_list__image_list_children_count
    foreach($app_xml_parser->find('ProductComplete') as $item) {
    $app_data_list__image_list_inc++;
    
    array_push($app_data_list__image_list_pattern, $app_data_list__image_list_inc);
    array_push($app_data_list__image_list_match, $app_data_list__image_list_inc);
    
    $app_data_list__image_list_children = -1;
    
      while(1) {
        $app_data_list__image_list_children++;
        if(!isset($app_xml_parser->find("ImageList", $app_data_list__image_list_inc )->children($app_data_list__image_list_children)->tag)) {
          break;	
        }
    
      }
    
    $app_data_list__image_list_pattern[$app_data_list__image_list_inc] = $app_data_list__image_list_children;
    
    }
    
    
    foreach($app_xml_parser->find('ImageList') as $item) {
    $app_data_list__image_list_b_inc++;
    
    $app_data_list__image_list_children = array();
    
    for($i = 0; $i <= $app_data_list__image_list_pattern[$app_data_list__image_list_b_inc]; $i++) {
      array_push($app_data_list__image_list_children, trim(strip_tags($item->children($i)->innertext)));
    }	
    
    array_pop($app_data_list__image_list_children);
    $app_data_list__image_list_match[$app_data_list__image_list_b_inc] = json_encode($app_data_list__image_list_children, JSON_FORCE_OBJECT);
    $app_data_list__image_list_children = array();
    
    }
    
    
    // end ____app_data_list__image_list_children_count
    
    //print_r($app_data_list__image_list_match);
    */
    
    
    // ____app_data_list__data_push
    foreach($app_xml_parser->find('ProductComplete') as $item) {
    $app_data_list__response_inc++;
    
      for($j = 0; $j <= $app_data_list__item_children_inc; $j++) {
    
        if(isset($item->children($j)->innertext)) {
          $app_data_list_buffer[$app_data_list__response_inc][$j] = $item->children($j)->innertext;
        }
    
        if($j == 49) {
              
          $app_data_output = array();
          $test = $item->children($j)->innertext;
    
          $app_token_pattern = '/(<url[^>]*>(.*?)<\/url>)/';
          $app_token_match_inc = preg_match_all($app_token_pattern, $test, $app_token_match);
    
          for($i = 0; $i < $app_token_match_inc; $i++) {
                  array_push($app_data_output, trim(strip_tags($app_token_match[0][$i])));
          }
                
          $app_data_list_buffer[$app_data_list__response_inc][$j] = json_encode($app_data_output, JSON_FORCE_OBJECT);
        
      
        }
    
        if($j == 50) {
    
          $string = $item->children($j)->innertext;
          
          $app_token_pattern = '/(<attributecode[^>]*>(.*?)<\/attributecode>)|(<valuecode[^>]*>(.*?)<\/valuecode>)/';
          $app_token_match_inc = preg_match_all($app_token_pattern, $string, $app_token_match);
    
          $output = array();
    
          for($i = 0; $i < $app_token_match_inc; $i++) {
            array_push($output, trim(strip_tags($app_token_match[0][$i])));
          }
    
          $output2 = array();
    
          for ($i = 0; $i < count($output); $i++) {
    
            $temp = array(); 
    
            if($i % 2 == 0) {
              $temp["AttributeCode"] = $output[$i];
              $i++;
              $temp["ValueCode"] = $output[$i];
            } 
    
            array_push($output2, $temp);
          }
          
          $app_data_list_buffer[$app_data_list__response_inc][$j] = json_encode($output2, JSON_FORCE_OBJECT);
    
        }
    
        if($j == 51) {
            
          $string = $item->children($j)->innertext;
    
          $app_token_pattern = '/(<typ[^>]*>(.*?)<\/typ>)|(<count[^>]*>(.*?)<\/count>)|(<weight[^>]*>(.*?)<\/weight>)|(<length[^>]*>(.*?)<\/length>)|(<width[^>]*>(.*?)<\/width>)|(<height[^>]*>(.*?)<\/height>)/';
          $app_token_match_inc = preg_match_all($app_token_pattern, $string, $app_token_match);
    
          $output = array();
    
          for($i = 0; $i < $app_token_match_inc; $i++) {
            array_push($output, trim(strip_tags($app_token_match[0][$i])));
          }
    
          $output2 = array();
    
          for ($i = 0; $i < count($output); $i++) {
    
            $temp = array(); 
    
            $temp["typ"] = $output[$i];
            $i++;
            $temp["count"] = $output[$i];
            $i++;
            $temp["weight"] = $output[$i];
            $i++;
            $temp["length"] = $output[$i];
            $i++;
            $temp["width"] = $output[$i];
            $i++;
            $temp["height"] = $output[$i];
    
            array_push($output2, $temp);
          }
    
          $app_data_list_buffer[$app_data_list__response_inc][$j] = json_encode($output2, JSON_FORCE_OBJECT);
      
        }
    
      }
    
    
    }
    // // ____app_data_list__data_push
    
    // $file = fopen($app_file["output"], "w+");
    // $set = array();
    
    // array_push($set, $app_data_list_header);
    
    // $result = array_merge($set, $app_data_list_buffer);
    
    // foreach($result as $item){
    // 	fputcsv($file, $item);
    // }
    
    // fclose($file);
    
    
    ob_start();
    
    $app_sql_column = implode(", ", $app_data_list_header);
    
    echo "INSERT INTO product_item ({$app_sql_column}) VALUES";
    //echo "<br><br>";
    
    for($i = 0; $i <= $app_data_list__inc; $i++) {
    
      $app_sql_row = "(";
      $inc = 0;
      
      foreach($app_data_list_buffer[$i] as $item) {
        $inc++;
    
        if(!($app_data_list__item_children_inc == $inc)) {
          $app_sql_row .= '"' . str_replace('"', "'", $item) . '"' . ",";
        }
    
        else {
            $app_sql_row .= '"' . str_replace('"', "'", $item) . '"' . "";
        }
    
    
      }
    
        
        if( !($i == count($app_data_list_buffer) - 1) ) {
          $app_sql_row .= "),";
        }
    
        else {
          $app_sql_row .= ");";
        }
    
      echo $app_sql_row;
      //echo "<br /><br />";
    
    }
    
    $buffer = ob_get_contents();
    
    ob_end_clean();
    
    // echo $buffer; 
    
    
    $handle = fopen($app_file["output"], "w+");
    fwrite($handle, $buffer);   
    fclose($handle);
    
    echo ">>> ".$file.".sql was written to the file successfully";
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/style.css">
  <title>Download product xml | <?php echo $bussinessName; ?></title>
</head>
<style>
    form{
      width: 25%;
      margin: 0 auto;
    }

    input{
      width: 100%;
      margin-top: 1%;
      height: 30px;
    }
</style>
<body class="layout">
  <h1 style="text-align: center;">Stažení produktového feedu sql</h1>
    <form action="" method="post">
        <input type="text" name="url" id="" placeholder="URL xml feedu"><br>
        <input type="text" name="file_name" id="" placeholder="Název souboru"><br>
        <input type="submit" name="download" value="Stáhnout xml">
    </form>
</body>
</html>