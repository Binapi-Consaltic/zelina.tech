<?php 

session_start();
require_once("../../setup/connect.php");

if(isset($_POST["pay"])){
    $username = $_POST["user_name"];
    $expiration = $_POST["expiration"];
    $cardnumber = $_POST["card_number"];
    $cvv = $_POST["cvv"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Platební karta | <?php echo $bussinessName; ?></title>
</head>
<body>
    <header>
        <?php require_once("../../layouts/nav-menu.php"); ?>
    </header>
    <main>
        <section class="h-100 h-custom">
               <form action="" method="post">
               <div class="card shadow-2-strong mb-5 mb-lg-0" style="border-radius: 16px;">
                <div class="card-body p-4">

                    <div class="row">
                    <div class="col-md-6 col-lg-4 col-xl-3 mb-4 mb-md-0">
                        <form>
                        <div class="d-flex flex-row pb-3">
                            <div class="d-flex align-items-center pe-2">
                            <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel1v"
                                value="" aria-label="..." checked />
                            </div>
                            <div class="rounded border w-100 p-3">
                            <p class="d-flex align-items-center mb-0">
                                <i class="fab fa-cc-mastercard fa-2x text-dark pe-2"></i>Kreditní
                                karta
                            </p>
                            </div>
                        </div>
                        <div class="d-flex flex-row pb-3">
                            <div class="d-flex align-items-center pe-2">
                            <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel2v"
                                value="" aria-label="..." />
                            </div>
                            <div class="rounded border w-100 p-3">
                            <p class="d-flex align-items-center mb-0">
                                <i class="fab fa-cc-visa fa-2x fa-lg text-dark pe-2"></i>Debetní karta
                            </p>
                            </div>
                        </div>
                        
                        </form>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-6">
                        <div class="row">
                        <div class="col-12 col-xl-6">
                            <div class="form-outline mb-4 mb-xl-5">
                            <input type="text" id="typeName" name="user_name" class="form-control form-control-lg" siez="17"
                                placeholder="John Smith" />
                            <label class="form-label" for="typeName">Jméno na kartě</label>
                            </div>

                            <div class="form-outline mb-4 mb-xl-5">
                            <input type="text" name="expiration" id="typeExp" class="form-control form-control-lg" placeholder="MM/YY"
                                size="7" id="exp" minlength="7" maxlength="7" />
                            <label class="form-label" for="typeExp">Datum expirace</label>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="form-outline mb-4 mb-xl-5">
                            <input type="text" name="card_number" id="typeText" class="form-control form-control-lg" siez="17"
                                placeholder="1111 2222 3333 4444" minlength="19" maxlength="19" />
                            <label class="form-label" for="typeText">Číslo karty</label>
                            </div>

                            <div class="form-outline mb-4 mb-xl-5">
                            <input type="password" id="typeText" name="cvv" class="form-control form-control-lg"
                                placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                            <label class="form-label" for="typeText">Cvv</label>
                            </div>
                        </div>
                        </div>
                    </div>
                    <?php 
                    if(!empty($_SESSION["shopping_cart"])){
                        $sumPrice = null;
                        foreach($_SESSION["shopping_cart"] as $key => $item){
                            $sumPrice += $item["totalPrice"] + 199;
                    ?>
                    <div class="col-lg-4 col-xl-3">
                        <div class="d-flex justify-content-between" style="font-weight: 500;">
                        <p class="mb-2">Celkem</p>
                        <p class="mb-2"><?php echo number_format($sumPrice); ?> Kč</p>
                        </div>

                        <div class="d-flex justify-content-between" style="font-weight: 500;">
                        <p class="mb-0">Poštovné</p>
                        <p class="mb-0">199 Kč</p>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                        <p class="mb-2">Celkem (včetně DPH))</p>
                        <p class="mb-2"><?php echo number_format($sumPrice); ?> Kč</p>
                        </div>

                        <button style="width: 100%;" type="submit" class="btn btn-primary btn-block btn-lg" name="pay">
                        <div class="d-flex justify-content-between">
                            <span>Zaplatit</span>
                            <span><?php echo number_format($sumPrice); ?> Kč</span>
                        </div>
                        </button>

                    </div>
                    <?php
                        }
                    }else{
                       echo "Nákupní košík je prázdný";
                    }
                    ?>
                    </div>

                </div>
                </div>

            </div>
            </div>
            </div>
               </form>
        </section>
    </main>
</body>
</html>