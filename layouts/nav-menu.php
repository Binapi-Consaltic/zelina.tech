<?php 



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
<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');


.app_nav_bar_set {
		position: fixed;
		display: none;
		justify-content: center;
		width: 100%;
		height: 60px;
		background-color: rgba(49,49,50,1);
        z-index: 1000;
	}

	.app_nav_bar_subset {
		position: relative;
		display: flex;
		box-sizing: border-box;
		padding: 15px;
		justify-content: flex-end;
		align-items: center;
		width: 100%;
		min-height: 100%;
		height: 100%;
		background-color: none;
	}

	.app_nav_bar_subset ul {
		list-style-type:  none;
		margin: 0px;
		padding: 0px;
	}

	.app_nav_bar_subset li {
		display: flex;
		justify-content: center;
		align-items: center;
		margin: 0px;
		padding: 0px;
		color: rgba(214,214,214,1);
		background-color: none;
	}

	.app_nav_bar_subset li img {
		display: block;
		margin: 0px;
		padding: 0px;
		width: 10%;
	}

	.app_nav_bar_button {
		display: flex;
		justify-content: center;
		align-items: center;
		cursor:  pointer;
		background: none;
		border: none;
		margin: 0px;
		padding: 0px;
		outline: none;
	}

	.app_nav_bar_button span {
		color: rgba(214,214,214,1);
		font-size: 30px;
	}

	.app_nav_bar_logo {
		display: flex;
		justify-content: center;
		align-items: center;
		margin: 0px;
		padding: 0px;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		background-color: none;
		width: 35px;
	}

	.app_nav_bar_logo img {
		display: block;
		margin: 0px;
		padding: 0px;
		width: 100%;
	}

	.app_nav_menu_set {
		display: flex;
		justify-content: center;
		align-items: center;
		box-sizing: border-box;
		padding: 15px;
		position: fixed;
		margin: 60px 0px 0px 0px;
		width: 100%;
		background-color: rgba(29,29,31,1);
        z-index: 500;
	}

	.app_nav_menu_subset {
		width: 90%;
		min-height: 100%;
		height: 100%;
		background-color: none;

	}

	.app_nav_menu_set ul {
		background-color: none;
		list-style-type:  none;
		margin: 0px;
		padding: 0px;
	}

	.app_nav_menu_set li {
		padding: 8px 0px 8px 0px;
		margin: 0px 0px 20px 0px;
		background-color: none;
		border-bottom: 1px solid rgba(214,214,214,1);
	}

	.app_nav_menu_set li a {
		color: rgba(214,214,214,1);
		text-decoration: none;
		font-size: 18px;
	}

	.app_hidden {
		display: none;
	}

	.app_visible {
		display: flex;
	}

	@media only screen and (min-width: 0px) and (max-width: 1400px) {

		header {
			display: block;
		}

        .app_nav_bar_set{
            display: flex;
        }

        .swiper-wrapper{
            margin-top: 4%;
        }

	}

</style>
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
        <script src="js/scripts.js"></script>


<!-- mobile-menu -->
<nav class="app_nav_bar_set">
    <div class="app_nav_bar_subset">

        <ul>
            <li>
                <button class="app_nav_bar_button">
                    <span class="material-icons">menu</span>
                </button>
            </li>
        </ul>

        <!-- <figure class="app_nav_bar_logo">
            <img src="apple-logo.svg" alt="apple logo" />
        </figure> -->
        
    </div>
</nav>

<nav class="app_nav_menu_set app_hidden">
    <div class="app_nav_menu_subset">
        <ul>
            <li><a href="#">PC a Notebooky</a></li>
            <li><a href="#">Multifunkce a tiskárny</a></li>
            <li><a href="#">Periferie</a></li>
            <li><a href="#">Komponenty</a></li>
            <li><a href="#">Servery a zálohování</a></li>
            <li><a href="">Software</a></li>
            <li><a href="">Mobily a telefony</a></li>
        </ul>
    </div>
</nav>

<script>

    var d = document;
    var dom = [];

    dom['app_nav_bar_button'] = d.querySelector(".app_nav_bar_button");
    dom['app_nav_menu_set'] = d.querySelector(".app_nav_menu_set");

    function __app_nav_menu__switch() {

        if(dom['app_nav_menu_set'].classList.contains("app_hidden")) {

            dom['app_nav_bar_button'].children[0].innerText = "close";

            dom['app_nav_menu_set'].classList.remove("app_hidden");
            dom['app_nav_menu_set'].classList.add("app_visible");
        } else {

            dom['app_nav_bar_button'].children[0].innerText = "menu";

            dom['app_nav_menu_set'].classList.remove("app_visible");
            dom['app_nav_menu_set'].classList.add("app_hidden");
        }

    }

    dom['app_nav_bar_button'].addEventListener('click', __app_nav_menu__switch);

</script>