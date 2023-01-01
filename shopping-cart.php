<?php 

require_once("setup/connect.php");
session_start();

require_once("setup/shopping-cart-function.php");

$id = null;

app_shopping_cart_add($id); 
app_shopping_cart_delete();



if(isset($_POST["send_order"])){

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }

    $bussinesName = $_POST['bussinesName'];
    $ic = $_POST['bussinesICO'];
    $userOrder = $_POST['user_order_number'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $street = $_POST['street'];
    $psc = $_POST['psc'];
    $town = $_POST["town"];
    $state = $_POST["state"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $date = date("d/m/y");
    $time = date("h : i a");
    $user_id = $_SESSION["id"];

    if(isset($_POST["select_transport"])){
        $transportCode = $_POST["select_transport"];
        $query_transport = mysqli_query($connection, "SELECT * FROM transport WHERE id = $transportCode");
            if(!$query_transport){
                die("ERROR: Query transport");
            }
        foreach($query_transport as $item){
            $transport_price = $item["price"];
        }
    }

    if(isset($_POST["test"]) == true){
        $bussinesPay = "ano";
    }else{
        $bussinesPay = "ne";
    }

    if(isset($_POST["user_note"])){
        $user_note = $_POST["user_note"];
    }

    if(isset($_POST["select_payment"])){
        $payment = $_POST["select_payment"];
    }

    // select count(1) from user_order;
    $res_a = mysqli_query($connection, "select count(1) as test from user_order");
    $row_a = mysqli_fetch_row($res_a);

    //echo $row_a[0];
    global $orderr;
    $orderr = date("y")."0000" . $row_a[0];

    if($row_a[0] < 10) {
        $orderr = date("y")."000" . $row_a[0];
    } 

    if($row_a < 100){
        $orderr = date("y")."00" . $row_a[0];
    }

    $query = "INSERT INTO user_order(user_id,bussine_name, ICO, user_order_number, name, surname, addres, PSC, town, state, phone, email, message, number_order, transport, transport_price, payment_bussines, payment_method, date, time)VALUES('$user_id','$bussinesName','$ic','$orderr','$name','$surname','$street','$psc','$town','$state','$phone','$email','$user_note','$orderr','$transportCode','199','$bussinesPay','','$date','$time')";

    $res = mysqli_query($connection, $query);
    
    if ($res) {
        echo "";
    } else {
        echo "error";
    }

    $proid = $_POST["id"];
    $title = $_POST["title"];
    $quantity = $_POST["quantity"];
    $totalPrice = $_POST["totalPrice"];

    $res_item = mysqli_query($connection, "INSERT INTO item_order(user_id,number_order, proid, nazev_produktu, počet_ks, celkova_cena)VALUES('$user_id','$orderr','$proid','$title','$quantity','$totalPrice')");

    if ($res_item) {
        echo "";
    } else {
        echo "error";
    }

    header("Location: shrnuti.php?number_order=".$orderr);
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
    <title>Nakupní košík | <?php echo $bussinessName; ?></title>
</head>
<body>
    <header><?php require_once("layouts/nav-menu.php"); ?></header>
    <main>
        <section class="app_item_cart_header">
            <container>
                <div class="app_item_cart_title">
                    <h3>Nákupní košík</h3>
                </div>
                <div class="app_item_cart_table_head table-responsive">
                    <form action="" method="post">
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
                    </form>
                </div>
            </container>
        </section>
        <section class="app_cart_oreder_header layout">
            <div class="app__cart_order_title">
                <h3>Objednávka</h3>
            </div>
            <container class="app_cart_order_form">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="app_order_transportation">
                                <h5>Způsob dopravy:</h5>
                            </div>
                            <label for="select_transport">Vyberte dopravu:</label>
                            <select class="form-control" name="select_transport" id="">
                                <!-- <option value="">Vyberte dobravu</option> -->
                            <?php
                                $result = mysqli_query($connection, "SELECT * FROM transport");
                                while($row = mysqli_fetch_array($result)){
                            ?>
                                <option value="<?php echo $row["Code"]; ?>">
                                    <span><?php echo $row["Name"]; ?></span>
                                    <span><?php echo $row["Price"]; ?></span>
                                </option>
                            <?php
                                }
                            ?>
                            </select><br>
                            <input class="form-check-input" type="checkbox" name="test" require="" checked id="bussinessCheck" onclick="showBussiness()">
                            <label for="bussinessCheck">Nakupuji na firmu</label><br>
                            <span style="" id="text">
                                <div class="row">
                                    <?php
                                    if(isset($_POST["test"]) == true){
                                    ?>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="bussinesName" id="" placeholder="Název firmy">
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="bussinesICO" id="" placeholder="IČ firmy">
                                    </div>
                                    <?php
                                    }else{
                                    ?>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="bussinesName" id="" placeholder="Název firmy">
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="bussinesICO" id="" placeholder="IČ firmy">
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </span>
                            <label for="user_order_number">Vaše označení objednávky:</label><br>
                            <input class="form-control" type="text" name="user_order_number" id="user_order_number"><br>
                            <label for="user_note">Poznámka:</label><br>
                            <textarea class="form-control" name="user_note" id="user_note" cols="30" rows="5"></textarea><br>
                            <input type="checkbox" name="full_order_transport" id="full_order_transport">
                            <label for="full_order_transport">Expedovat pouze celou objednávku</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="app_cart_order_addres_title">
                                <h5>Fakturačí adresa</h5>
                            </div>
                            <div class="app_cart_order_adrres_value">
                                <label for="name">Jméno:</label><br>
                                <input class="form-control" type="text" name="name" id="name" require=""><br>
                                <label for="surname">Příjmení:</label>
                                <input type="text" name="surname" id="surname" require="" class="form-control"><br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="street">Ulice:</label><br>
                                        <input type="text" name="street" id="street" require="" class="data_order_form form-control">
                                        <label for="PSC">PSČ:</label><br>
                                        <input type="text" name="psc" id="PSC" require="number" class="form-control"><br>
                                        <label for="phone">Telefon:</label><br>
                                        <input type="tel" name="phone" id="phone" require="" class="form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="town">Město:</label><br>
                                        <input type="text" name="town" id="town" require="" class="data_order_form form-control"><br>
                                        <label for="state">Stát</label><br>
                                        <select name="state" id="state" require="" class="form-control">
                                            <?php 
                                            $result = mysqli_query($connection, "SELECT * FROM country");
                                            while($row = mysqli_fetch_array($result)){
                                            ?>
                                            <option value="<?php echo $row["Stát / Oblast"]; ?>"><?php echo $row["Stát / Oblast"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="email">E-mail:</label><br>
                                        <input type="email" name="email" id="email" require="" class="form-control">
                                    </div>
                                </div>
                                <div class="app_cart_send_order">
                                    
                                    <input type="submit" value="Odeslat objednávku" name="send_order" class="send_order">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                     if(isset($_SESSION["shopping_cart"])){
                        foreach($_SESSION["shopping_cart"] as $key => $item){
                    ?>
                    <input type="hidden" name="id" value='<?php echo $item["id"]; ?>'>
                    <input type="hidden" name="title" value='<?php echo $item["title"]; ?>'>
                    <input type="hidden" name="quantity" value='<?php echo $item["quantity"]; ?>'>
                    <input type="hidden" name="totalPrice" value='<?php echo $item["totalPrice"]; ?>'>
                    <?php
                        }
                     }
                     ?>
                </form>
            </container>
        </section>
    </main>
    <footer>
        <?php require_once("layouts/footer.php"); ?>
    </footer>
    <script src="js/user-script.js"></script>
</body>
</html>
<!-- <form action="" method="post">
    <input type="submit" value="Odstranit" name="remove">
</form>-->






