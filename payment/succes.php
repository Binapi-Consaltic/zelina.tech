<?php

session_start();
require_once("../setup/connect.php");

if(isset($_SESSION["shopping_cart"])){
    unset( $_SESSION["shopping_cart"]);
}

?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potvrzení platby | <?php echo $bussinesName; ?></title>
</head>
<body>
    <a href="../index.php">Zde</a>
</body>
</html>