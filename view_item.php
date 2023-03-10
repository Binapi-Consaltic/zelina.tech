<?php 

session_start();
require_once("setup/connect.php");
require_once("setup/shopping-cart-function.php");

if(isset($_GET["id"])){
    $id = $_GET["id"];
}else{
    echo "Produk není zařezen to eshopu";
}

$imageData = mysqli_query($connection, "SELECT * FROM product_item WHERE proid = $id");
    if(!$imageData){
        die("ERROR: data was not written from the database");
    }

while($row = mysqli_fetch_array($imageData)){
    $image = json_decode(str_replace("'",'"', $row["imagelist"]),true);
    $title = $row["name"];
    $descriptionShort = $row["descriptionshort"];
    $description = $row["description"];
    $price = $row["enduserprice"] * 1.21;
    $fess = $row["yourpricewithfees"] - $row["yourprice"];
    $priceDPH = $row["yourprice"];
    $partNumber = $row["partnumber"];
    $code = $row["code"];
    $guarantee = $row["warranty"];
    $onStock = $row["onstockcount"]." ".$row["unit"];
    $producerName = $row["producername"];
    $EAN = $row["eancode"];
    $onstock = $row["onstock"];
    $ChristasPrice = $row["yourprice"];
}

function app_viewImage($image){
    global $values;
    global $count;
    if(!is_array($image)){
        die("ERROR: Input is not an array");
    }

    foreach($image as $key => $value){
        if(is_array($value)){
            print_r($value);
        }else{
            $values[] = $value;
            $count++; 
        }
    }

    return array("total" => $count, "values" => $values);
}

$resultImage = app_viewImage($image);


if(isset($_POST["add_cart"])){
    header("Location: shopping-cart.php");
}

app_shopping_cart_add($id);

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
    <link rel="stylesheet" href="css/lightbox.min.css">
    <script src="js/lightbox-plus-jquery.min.js"></script>
    <title><?php echo "Detail produktu"; ?> | <?php echo $bussinessName; ?></title>
</head>
<style>
    @media only screen and (min-width: 0px) and (max-width: 730px){
        main{
            width: 98%;
            margin: 0 auto;
        }
        .app_item_image img{
            width: 98%;
            margin-top: 3%;
        }

        .app_item_price_header,
        .item_value{
            text-align: center;
        }

        .app_item_stock{
            display: flex;
            justify-content: center;
        }
    }
</style>
<body>
    <header>
        <?php require_once("layouts/nav-menu.php");?>
    </header>
    <main class="layout">
        <section class="app_view_item_header">
            <container class="row app_item_header">
                <div class="col-sm-6">
                    <div class="app_item_image">
                        <img src="<?php echo $resultImage["values"][0]; ?>" alt="<?php echo $title; ?>">
                    </div>
                </div>
                <div class="col-sm-6" id="app_item_header">
                    <div class="app_item_title">
                        <h3><?php echo $title; ?></h3>
                    </div>
                    <div class="app_item_description_short">
                        <p><?php echo $descriptionShort; ?></p>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 app_item_price_header">
                            <span class="app_item_price">
                                <h5>Vaše cena s DPH:</h5>
                                <p><?php echo number_format($price,0,",","."); ?> Kč</p>
                            </span>
                            <div class="app_item_fees">
                                <div class="row">
                                    <span class="col-sm-6">
                                        <p>Cena s DPH:</p>
                                    </span>
                                    <span class="col-sm-6">
                                        <p class="item_value"><?php echo number_format($price,2,",","."); ?> Kč</p>
                                    </span>
                                    <span class="col-sm-6">
                                        <p>Recyklační poplatky:</p>
                                    </span>
                                    <span class="col-sm-6">
                                        <!-- <p class="item_value"><?php echo number_format($fess,0,",","."); ?> Kč</p> -->
                                    </span>
                                    </span>
                                    <span class="col-sm-6">
                                        <p>Vaše cena s DPH:</p>
                                    </span>
                                    <span class="col-sm-6">
                                        <p class="item_value"><?php echo number_format($price,0,",","."); ?> Kč</p>
                                    </span>
                                </div>
                                
                                
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="app_item_stock">
                                <div class="row">
                                    <span class="col-sm-6">
                                        Skladem:
                                    </span>
                                    <span class="col-sm-6 ">
                                        <?php 
                                            if($onstock == "false"){
                                                echo "Skladem";
                                            }else{
                                                echo "Skladem";
                                            }
                                            ?>
                                    </span>
                                </div>
                            </div>
                            <div class="app_item_basket">
                                <h4>Vložit do košíku:</h4>
                                <form action="" method="post">
                                    <input type="number" name="quantity" id="" value="1" min="1"> Ks
                                    <button class="payment_online" type=" submit" name="add_cart">Koupit</button>
                                    <p class="item_basket_value">Tisk produktové nabídky</p>
                                    <p>Porovnat produkt</p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </container>
            <container class="row app_item_detail_header">
                    <div class=" col-sm-6 app_item_photogalery">
                    <?php 
                    for($i = 0; $i < $resultImage["total"]; $i++){
                    ?>
                        <a href="<?php echo $resultImage["values"][$i]; ?>" data-lightbox="mygallery"><img src="<?php echo $resultImage["values"][$i]; ?>" alt="<?php $title." ".$i; ?>" data-id="<?php echo $i; ?>"></a>
                    <?php
                    }
                    ?>
                    </div>
                    <div class="col-sm-6 app_item_detail"></div>
            </container>
            <container class="app_wiew_item_description layouts">
                <h2>Popis produktu</h2>
                <?php 
                    echo htmlspecialchars_decode($description);
                ?>
            </container>
        </section>
    </main>
    <footer>
        <?php require_once("layouts/footer.php"); ?>
    </footer>
</body>
</html>