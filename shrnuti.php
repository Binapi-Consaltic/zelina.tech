<?php

session_start();
require_once("setup/connect.php");
$payment = null;
$a = null;


if(isset($_GET["number_order"])){
    global $number_order;
    $number_order = $_GET["number_order"];
    $_SESSION["order"] = $number_order;
}




if(isset($_POST["select_payment"])){
    $payment = $_POST["select_payment"];

    // $result = mysqli_query($connection, "UPDATE `number_order` SET `id`= $result_order WHERE 1");

    // echo $payPal;
}

if($payment === "Bankovní převod"){
    header("Location: payment/bank-transfer/transfer.php");
}elseif($payment === "PayPal"){
    header("Location: payment/paypal/index.php");
}elseif($payment === "Kreditní karta"){
    header('Location: payment/cart/cart.php');
}

?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-252695724-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-252695724-1');
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <title>Shrnutí objednavky | <?php echo $bussinessName; ?></title>
</head>
<body>
    <header>
        <?php require_once("layouts/nav-menu.php");?>
    </header>
    <main>
        <section class="app_summary_order_header layout" style="margin-top: 1%">
            <div class="app_sumary_order_title">
                <h3>Objednávka:</h3>
            </div>
            <div style="display: flex" class="app_sumarry_order_number">
                <h5>Číslo objednávky:</h5>
                <h5 style="margin-left: 2%"><span><?php echo ""; ?></span></h5>
            </div>
            <form action="" method="post">
            <div class="app_summary_order_item">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-3">
                                <span>Vaše číslo:</span><br>
                                <span>Datum vytvoření:</span><br>
                                <span>Doprava:</span><br>
                                <span>Adresa dodání:</span><br>
                                <span>Telefon:</span><br>
                                <span>E-mail:</span><br>
                            </div>
                            <div class="col-sm-9">
                            <?php
                                $number_order = $_GET["number_order"];
                                $query = mysqli_query($connection, "SELECT * FROM user_order WHERE number_order = $number_order");
                                if(!$query){
                                    die("ERROR:");
                                }

                                foreach($query as $row){
                                ?>
                                
                                <span><?php echo $number_order; ?></span><br>
                                <span><?php echo $row["date"]; ?></span><br>
                                <span><?php echo $row["transport"]; ?></span><br>
                                <span><?php echo $row["bussine_name"]." ".$row["addres"]; ?></span><br>
                                <span><?php echo $row["phone"]; ?></span><br>
                                <span><?php echo $row["email"]; ?></span>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-3">
                                <span>Celková cena s DPH:</span>
                                <span>Kompletní dodávka:</span>
                            </div>
                            <div class="col-sm-9">
                                <span></span><br>
                                <span><input type="checkbox" name="complet_transport" id="complet_transport"></span>
                                <label for="complet_transport">Expedovat kompletni objednávku</label>
                            </div>
                            <div class="app_summary_order_select_payment">
                                <h6>Prosím veberte platbu:</h6>
                                <select name="select_payment" id="select_payment" class="form-control">
                                    <?php
                                    $result = mysqli_query($connection, "SELECT * FROM payment_method");
                                    while($row = mysqli_fetch_array($result)){
                                    ?>
                                        <!-- <option value="Bankovní převod">Bankovní převod</option> -->
                                        <option value="<?php echo $row["title_payment"]; ?>"><?php echo $row["title_payment"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="app_payment_online">
                <button type="submit" class="payment_online">Zaplatit online</button>
            </div>
            <form>
        </section>
        <section class="app_summarty_order_values_header layout">
            <div class="app_summarty_order_values_title">
                <h6>Shrnutí objednávky:</h6>
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th style="width: 60%">Název produktu</th>
                            <th>Množství</th>
                            <th style="width: 10%">Celková cena</th>
                            <th style="width: 3%;">
                                <span class="glyphicon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                </svg>
                                <!-- OB -->
                                </span>
                            </th>
                            <th style="width: 3%;">
                                <span class="glyphicon">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                </svg> -->
                                R
                                </span>
                            </th>
                            <th style="width: 3%;">
                                <span class="glyphicon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-check-fill" viewBox="0 0 16 16">
                                    <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47L15.964.686Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                                    <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z"/>
                                    </svg>
                                </span>
                            </th>
                            <th style="width: 3%;">
                                <span class="glyphicon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-x" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6.146 5.146a.5.5 0 0 1 .708 0L8 6.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 7l1.147 1.146a.5.5 0 0 1-.708.708L8 7.707 6.854 8.854a.5.5 0 1 1-.708-.708L7.293 7 6.146 5.854a.5.5 0 0 1 0-.708z"/>
                                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                                </svg>
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($_SESSION["shopping_cart"])){
                            foreach($_SESSION["shopping_cart"] as $key => $item){
                                $sumPrice = null;
                                $sumPrice += $item["totalPrice"];
                        ?>
                            <tr>
                                <td class="id"><?php echo $item["id"]; ?></td>
                                <td class="title"><?php echo $item["title"]; ?></td>
                                <td style="text-align: center" class="quantity"><?php echo $item["quantity"]; ?> Ks</td>
                                <td class="total_price"><?php echo number_format($item["totalPrice"],0,",","."); ?> Kč</td>
                                <td>
                                    <span class="glyphicon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-check-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zm8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                    </svg>
                                    </span>
                                </td>
                                <td style="text-align: center">1</td>
                                <td style="text-align: center">1</td>
                                <td style="text-align: center">0</td>
                            </tr>
                            <!-- <div class="app_item_cart_update">
                                
                            </div> -->
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="app_summary_order_explanations_header layout">
             <div class="app_summary_order_explanations">
                <p>Vysvětlivky:</p>
                <span class="glyphicon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16"><path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                    </svg>
            </span>
            <span>Objednáno</span>
            <span class="glyphicon_explanations">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                </svg>
            </span>
            <span>Blokováno</span>
            <span class="glyphicon_explanations">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-check-fill" viewBox="0 0 16 16">
                <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47L15.964.686Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z"/>
                </svg>           
            </span>
            <span>Expedováno</span>
            <span class="glyphicon_explanations">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-x" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6.146 5.146a.5.5 0 0 1 .708 0L8 6.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 7l1.147 1.146a.5.5 0 0 1-.708.708L8 7.707 6.854 8.854a.5.5 0 1 1-.708-.708L7.293 7 6.146 5.854a.5.5 0 0 1 0-.708z"/>
                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                </svg>
            </span>
            <span>Storno</span>
             </div> 
             <p class="danger"> Smluvní navýšení ceny o náklady vyplývající ze zák č. 185/2001 Sb. v platném znění na likvidaci elektroodpadu bude prodávajícím stanoveno v té výši, v jaké jej prodávající stanoví ve svém ceníku v den fakturace za toto objednané zboží a náklady na autorské odměny dle zák. č. 121/2000 Sb. v platném znění bude prodávajícím stanoveno v té výši, v jaké jej prodávající stanoví ve svém ceníku v den fakturace za toto objednané zboží.</p>          
        </section>
    </main>
    <footer>
        <?php require_once("layouts/footer.php"); ?>
    </footer>
</body>
</html>