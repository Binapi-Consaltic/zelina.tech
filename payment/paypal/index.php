<?php 

session_start();
require_once("../../setup/connect.php");
include_once 'db_connection.php'; 


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PayPal REST API Example</title>
    <link rel="stylesheet" type="text/css" href="../../css/styles.css">
</head>
<body>
  <header><?php require_once("../../layouts/nav-menu.php"); ?></header>
  <main class="App">
    <!-- <h1>How to Integrate PayPal REST API Payment Gateway in PHP</h1> -->
  <div class="wrapper">
  <table class="responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="">Název produktu</th>
                                <th class="">Množství</th>
                                <th class="">Cena</th>
                                <th class="">Cena celkem</th>
                                <th class=""></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(isset($_SESSION["shopping_cart"])){
                            $sumPrice = null;
                            foreach($_SESSION["shopping_cart"] as $key => $item){
                                $sumPrice += $item["totalPrice"];
                                $proid = $item["id"];
                                $title = $item["title"];
                        ?>
                            <tr>
                                <td class="id"><?php echo $item["id"]; ?></td>
                                <td class="title"><?php echo $item["title"]; ?></td>
                                <td class="quantity"><input type="number" name="quantity" value="<?php echo $item["quantity"]; ?>" id="" min="1"> Ks</td>
                                <td class="price"><?php echo number_format($item["price"],0,",","."); ?> Kč</td>
                                <td class="total_price"><?php echo number_format($item["totalPrice"],0,",","."); ?> Kč</td>
                                <td>
                                   <div class="app_item_cart_button">
                                    <button class="product_item" type="submit" name="app_item_delete" value="<?php echo $item["id"]; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                            </svg>
                                        </button>
                                        <button class="product_item" type="submit" name="app_item_update" value="<?php echo $item["id"]; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-repeat" viewBox="0 0 16 16">
                                            <path d="M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192Zm3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z"/>
                                            </svg>
                                        </button>
                                   </div> 
                                </td>
                            </tr>
                            <!-- <div class="app_item_cart_update">
                                
                            </div> -->
                        <?php
                            }
                        }
                        ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="sum_price">Cena celkem s DPH:</td>
                                <td class="sum_price_value"><?php echo number_format($sumPrice,2,",","."); ?> Kč</td>
                            </tr>
                        </tfoot>
                    </table>
        <form class="paypal" action="request.php" method="post" id="paypal_form">
          <input type="hidden" name="item_number" value="<?php echo $proid; ?>" >
          <input type="hidden" name="item_name" value="<?php echo $title; ?>" >
          <input type="hidden" name="amount" value="<?php echo $sumPrice; ?>" >
          <input type="hidden" name="currency_code" value="CZK" >
          <input type="submit" name="submit" value="Buy Now" class="btn__default">
        </form>
	    </div>
    <?php?>
  </div>
  </main>
</body>
</html>