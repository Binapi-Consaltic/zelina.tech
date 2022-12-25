<?php

session_start();
require_once("../setup/connect.php");
require_once("../setup/shopping-cart-function.php");

if(isset($_GET["id"])){
    $id = $_GET["id"];
}

if(isset($_SESSION["shopping_cart"])){
    $price = null;
    foreach($_SESSION["shopping_cart"] as $key => $item){

        $price += $item["totalPrice"];
    }
}

if(isset($_POST["app_item_delete"])){
    session_destroy();
    header("Location: ../default.php");
}




?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" type="text/css" />
    <title>Bankovní převod | <?php echo $bussinessName; ?></title>
</head>
<body>
    <header>
        <?php require_once("../layouts/nav-menu.php"); ?>
    </header>
    <main class="layout">
        <div class="app_thanks">
            <h1>Děkujeme</h1>
        </div>
        <div class="app_info_order_send">
            <h3>Vaše objednávka byla uspěšne odeslána</h3>
            <p>Kopie objednávky Vám zašleme na e-mail</p>
        </div>
        <div class="app_payment_info">
            <h3>Platba převodem na účet</h3>
            <p>Čekáme na úhradu částky:</p>
            <p class="value"><?php echo number_format($price,2); ?> Kč</p>
            <span>
                <p>Ondřej Zelina</p>
                <p>Košická 63/30 Praha 101 00</p>
                <p>Variabilní symbol:</p>
                <p class="value"><?php echo $_SESSION["order"]; ?></p>
                <p>IBAN:</p>
                <p class="value">LT743250086579500488</p>
                <p>SWIFT/BIC:</p>
                <p class="value">REVOLT21</p>
            </span>
        </div>
        <form action="" method="post">
            <button type="submit" name="app_item_delete">Zpět na titulní stranu</button>
        </form>
    </main>
</body>
</html>