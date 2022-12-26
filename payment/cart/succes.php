<?php

session_start();
require_once("../../setup/connect.php");



?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="" >
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <title>Potvrzení platby | <?php echo $bussinessName; ?></title>
</head>
<body>
    <header>
    <?php 

// echo "<pre>";
// print_r($_SESSION["shopping_cart"]);
// echo "</pre>";

if(!empty($_SESSION["shopping_cart"])){
    global $item_cart;
    $item_cart = count($_SESSION["shopping_cart"]);
}else{
    $item_cart = 0;
}

if(isset($_POST["view_cart"])){
    header('Location: shopping-cart.php');
}

?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <!-- <a class="navbar-brand" href="#!">Start Bootstrap</a> -->
                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button> -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">PC a Notebooky</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $result = mysqli_query($connection, "SELECT * FROM categorylist WHERE SuperCategoryCode = 11");
                                if(!$result){
                                    die("Print data from database error");
                                }
                            while($row = mysqli_fetch_array($result)){
                            ?>
                            <li><a class="dropdown-item" href="view_category.php?action=<?php echo $row["CategoryCode"]; ?>"><?php echo $row["CategoryName"]; ?></a></li>
                            <?php
                            }
                            ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Multifunkce a tiskárny</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $result = mysqli_query($connection, "SELECT * FROM categorylist WHERE SuperCategoryCode = 121");
                                if(!$result){
                                    die("Print data from database error");
                                }
                            while($row = mysqli_fetch_array($result)){
                            ?>
                            <li><a class="dropdown-item" href="view_category.php?action=<?php echo $row["CategoryCode"]; ?>"><?php echo $row["CategoryName"]; ?></a></li>
                            <?php
                            }
                            ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Periferie</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $result = mysqli_query($connection, "SELECT * FROM categorylist WHERE SuperCategoryCode = 6");
                                if(!$result){
                                    die("Print data from database error");
                                }
                            while($row = mysqli_fetch_array($result)){
                            ?>
                            <li><a class="dropdown-item" href="view_category.php?action=<?php echo $row["CategoryCode"]; ?>"><?php echo $row["CategoryName"]; ?></a></li>
                            <?php
                            }
                            ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Komponenty</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $result = mysqli_query($connection, "SELECT * FROM categorylist WHERE SuperCategoryCode = 3");
                                if(!$result){
                                    die("Print data from database error");
                                }
                            while($row = mysqli_fetch_array($result)){
                            ?>
                            <li><a class="dropdown-item" href="view_category.php?action=<?php echo $row["CategoryCode"]; ?>"><?php echo $row["CategoryName"]; ?></a></li>
                            <?php
                            }
                            ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Servery a zálohování</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $result = mysqli_query($connection, "SELECT * FROM categorylist WHERE SuperCategoryCode = 7");
                                if(!$result){
                                    die("Print data from database error");
                                }
                            while($row = mysqli_fetch_array($result)){
                            ?>
                            <li><a class="dropdown-item" href="view_category.php?action=<?php echo $row["CategoryCode"]; ?>"><?php echo $row["CategoryName"]; ?></a></li>
                            <?php
                            }
                            ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Síťové prvky</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $result = mysqli_query($connection, "SELECT * FROM categorylist WHERE SuperCategoryCode = 8");
                                if(!$result){
                                    die("Print data from database error");
                                }
                            while($row = mysqli_fetch_array($result)){
                            ?>
                            <li><a class="dropdown-item" href="view_category.php?action=<?php echo $row["CategoryCode"]; ?>"><?php echo $row["CategoryName"]; ?></a></li>
                            <?php
                            }
                            ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Software</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $result = mysqli_query($connection, "SELECT * FROM categorylist WHERE SuperCategoryCode = 9");
                                if(!$result){
                                    die("Print data from database error");
                                }
                            while($row = mysqli_fetch_array($result)){
                            ?>
                            <li><a class="dropdown-item" href="view_category.php?action=<?php echo $row["CategoryCode"]; ?>"><?php echo $row["CategoryName"]; ?></a></li>
                            <?php
                            }
                            ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Telefony a tablety</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $result = mysqli_query($connection, "SELECT * FROM categorylist WHERE SuperCategoryCode = 18");
                                if(!$result){
                                    die("Print data from database error");
                                }
                            while($row = mysqli_fetch_array($result)){
                            ?>
                            <li><a class="dropdown-item" href="view_category.php?action=<?php echo $row["CategoryCode"]; ?>"><?php echo $row["CategoryName"]; ?></a></li>
                            <?php
                            }
                            ?>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex" method="post">
                        <button class="btn btn-outline-dark" type="submit" name="view_cart">
                            <i class="bi-cart-fill me-1"></i>
                            Košík
                            <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo $item_cart; ?></span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../../js/scripts.js"></script>
    </header>
    <main>
        <div class="app_succes_error">
            <p>ERROR: Omlováme se, ale platba selhala. Skuste to prosím později nebo vyberte jinou <a href="../../default.php"> platební metodu</a>.</p>
        </div>
    </main>
</body>
</html>