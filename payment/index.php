<?php

session_start();
require_once("paypal-api-environment.php");


//$_SESSION["txn_id"] = "xxx";

?>

<!DOCTYPE html>
<html lang="cs">

<head>

<meta charset="utf-8" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" /> 

<style>

html, body {
position: relative;
margin: 0vw;
padding: 0vw;
width: 100%;
height: 100%;
background-color: none;
font-family: "Montserrat",sans-serif;
background-attachment: fixed;
overflow-y: var(--app-overflow);
}


.app_form_subset_item_paypal {
display: flex;
justify-content: center;
align-items: center;
position: relative;	
width: 100%;
min-height: 100%;
height: 100%;
background-color: none;
}

.app_form_subset_item_button_paypal {
position: relative;
display: flex;
justify-content: center;
align-items: center;
margin: 0vw;
padding: 0vw;
width: 12vw; 
height: 2.5vw;
padding: 0vw;
border: 0.2vw solid white;
overflow: hidden;
border-radius: 25vw;
background-color: #0070ba;
cursor: pointer;
transition: 0.3s ease-in-out;
}

.app_form_subset_item_button_paypal:hover .app_form_subset_item_button_paypal_overlay {
background-color: #005c99; 
}

.app_form_subset_item_button_paypal:hover {
 background-color: #005c99; 
}

.app_form_subset_item_button_paypal_overlay {
display: block;
position: absolute;  
z-index: 1000;
left: 0vw;
top: 0vw;
width: 100%;
height: 2.5vw;
background-color: #0070ba;
background-image: url("paypal-logo.svg");
background-size: 4vw;
background-repeat: no-repeat;
background-position: 50% 40%;
pointer-events: none;
transition: 0.3s ease-in-out;
}

.app_form_subset_item_button_paypal_iframe {
display: flex;
justify-content: center;
align-items: center;
width: 12vw;
height: 2vw;
background-color: silver;
overflow: hidden;
border-radius: 0vw;
margin: 0vw;
padding: 0vw;
}

.app_form_subset_item_button_paypal_iframe iframe {
transform: scale(5);
width: 100%;
margin: 0vw;
padding: 0vw;
}

</style>

</head>

<body>


<form>

<label>
<input type="hidden" class="app_form_subset_item_input_checkbox" name="coins" value="60" />
</label>
<br>

<!--
<input type="hidden" name="app_form_submit" value="true">
-->

<button type="button" class="app_form_subset_item_button_paypal">
<span class="app_form_subset_item_button_paypal_overlay"></span>
<span class="app_form_subset_item_button_paypal_iframe"></span>
</button>

</form>





<script src="https://www.paypal.com/sdk/js?client-id=ATeuEfsxpbXpe2sNi-x3lfUkw4dHJbdEWANUSBgiBFCsN5Oasw6M4j2d8clFBlP9aSxGrEzXDgHFDUOt&commit=true&vault=true&intent=capture&disable-funding=card,credit"></script>

<script>

var d = document;
var app_form_data = new FormData();

var app_form_subset_item_input_checkbox = d.querySelectorAll(".app_form_subset_item_input_checkbox");

var app_form_subset_item_input_checkbox_value;

function ____app_form_subset_item_input_checkbox____click() {
app_form_subset_item_input_checkbox_value = this.value;

app_form_data.append("coins", this.value);

alert(app_form_subset_item_input_checkbox_value);

}

for(i = 0; i < app_form_subset_item_input_checkbox.length; i++) {
app_form_subset_item_input_checkbox[i].addEventListener("click", ____app_form_subset_item_input_checkbox____click);
}

app_form_data.append("app_form_submit", "true");



paypal.Buttons({

env: "sandbox",

style: {
layout: 'horizontal',
color: 'blue',
shape: 'pill',
size: 'responsive'
},

createOrder: function() {

return fetch('paypal-api-txn-create.php', {
method: "POST",
body: app_form_data
})
.then(function(res) {

return res.json();

}).then(function(data) {

if(data.id) {
return data.id;	
}

else {
return document.write(data.message);
}

//return data.orderID;
//alert(data["id"]);

});


},

onApprove: function(data, actions) {

document.write("loading...");
document.write("<br><br>");

return fetch('paypal-api-txn-capture.php')
.then(function(res) {
return res.json();
}).then(function(details) {

//document.write(JSON.stringify(details));
document.write("processing...");
document.write("<br><br>");

fetch('paypal_api_txn_data_insert-into_database.php')
.then(function(res) {

return res.json();

}).then(function(data) {

//document.write("grant access...");

document.write(JSON.stringify(data));

});

//document.write(JSON.stringify(details));
//window.location.href = "success.php";
//alert('Transaction funds captured from ' + details.payer_given_name);

});

}

/*
onCancel: function(data) {

alert("cancel...");

},

onError: function(error) {

alert("error...");

},

onClick: function() {
alert("triggered...");	
}
*/

}).render('.app_form_subset_item_button_paypal_iframe');


</script>

</body>

</html>