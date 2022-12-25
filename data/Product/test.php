<?php

$string = "

<ProductNavigatorDataList>
<ProductNavigatorData>
  <AttributeCode>823</AttributeCode>
  <ValueCode>10575</ValueCode>
</ProductNavigatorData>
<ProductNavigatorData>
  <AttributeCode>1015</AttributeCode>
  <ValueCode>13916</ValueCode>
</ProductNavigatorData>
<ProductNavigatorData>
  <AttributeCode>184</AttributeCode>
  <ValueCode>8711</ValueCode>
</ProductNavigatorData>
<ProductNavigatorData>
  <AttributeCode>1331</AttributeCode>
  <ValueCode>19598</ValueCode>
</ProductNavigatorData>
<ProductNavigatorData>
  <AttributeCode>1331</AttributeCode>
  <ValueCode>19597</ValueCode>
</ProductNavigatorData>

";

$app_token_pattern = '/(<AttributeCode[^>]*>(.*?)<\/AttributeCode>)|(<ValueCode[^>]*>(.*?)<\/ValueCode>)/';
$app_token_match_inc = preg_match_all($app_token_pattern, $string, $app_token_match);

$output = array();

for($i = 0; $i < $app_token_match_inc; $i++) {
	array_push($output, trim(strip_tags($app_token_match[0][$i])));
}

echo "<pre>";
print_r($output);
echo "</pre>";

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

// echo "<pre>";
// print_r($output2);
// echo "</pre>";

echo json_encode($output2, JSON_FORCE_OBJECT);
echo "<br>";
foreach($output2 as $item){
?>
<select name="" id="">
    <option value="<?php echo $item["AttributeCode"];?>"></option>
</select>
<?php
}

?>