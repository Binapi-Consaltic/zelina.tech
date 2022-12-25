<?php 

require_once("setup/connect.php");

$query = mysqli_query($connection, "SELECT * FROM product_item WHERE categorycode = 115");



?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testovní dokument | <?php echo $bussinessName; ?></title>
</head>
<body>
    <form action="" method="post">
        <select name="" id="">
            <?php 
            foreach($query as $item){
                $data = $item["imagelist"];
                $image_replace = str_replace("'",'"', $data);
                $image = json_decode($image_replace, true);
                $atrribute = $item["productnavigatordatalist"];
                $attribute_replace = str_replace("'",'"', $atrribute);
                $attribute_code = json_decode($attribute_replace, true);
                echo "<pre>";
                
                echo "</pre>";
            ?>
            <option value="<?php echo $attribute_code[0]["AttributeCode"]; ?>"><?php echo $attribute_code[0]["ValueCode"]; ?></option>
            <?php
            }
            ?>
        </select>
    </form>
</body>
</html>

<!-- select join -->

<?php

$query = "SELECT column_name(s) FROM table1 INNER JOIN table2 ON table1.column_name = table2.column_name";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <select name="" id="">
            <option value=""></option>
        </select>
    </form>
</body>
</html>