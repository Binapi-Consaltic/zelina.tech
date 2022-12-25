<?php

function app_shopping_cart_add($id){
    global $title, $priceDPH;
    $quantity = 1;

    if(isset($_POST["add_cart"])){
        $input_data = array(
            "id" => $id,
            "title" => $title,
            "quantity" => $_POST["quantity"],
            "price" => $priceDPH,
            "totalPrice" => $priceDPH * $_POST["quantity"],
        );

        $_SESSION["shopping_cart"][$input_data["id"]]["id"] = $input_data["id"];
        $_SESSION["shopping_cart"][$input_data["id"]]["title"] = $input_data["title"];
        $_SESSION["shopping_cart"][$input_data["id"]]["quantity"] = $input_data["quantity"];
        $_SESSION["shopping_cart"][$input_data["id"]]["price"] = $input_data["price"];
        $_SESSION["shopping_cart"][$input_data["id"]]["totalPrice"] = $input_data["totalPrice"];
    }
}

function app_shopping_cart_delete(){
    if(isset($_POST["app_item_delete"])){
        unset($_SESSION["shopping_cart"][$_POST["app_item_delete"]]);
    }
}