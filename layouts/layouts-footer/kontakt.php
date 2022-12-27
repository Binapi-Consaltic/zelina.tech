<?php

require_once("../../setup/connect.php");

if(isset($_POST["send_message"])){
    echo $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    echo $date = date("d m y h:i:s");

    $query = mysqli_query($connection, "INSERT INTO kontakt(name,phone,email,message,date)VALUES('$name','$phone','$email','$message','$date')");
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
    <link href="../../css/styles.css" rel="stylesheet" type="text/css" />
    <title>Kontakt | <?php echo $bussinessName; ?></title>
</head>
<style>
    h1{
        margin-top: 1%;
    }

    .row{
        margin-top: 2%;
    }

    .iframe{
        width: 100%
    }

</style>
<body>
    <header><?php require_once("../../layouts/nav-menu.php"); ?></header>
    <main class="layout">
        <h1>Kontakt</h1>
        <div class="row">
            <div class="col">
                <h5><?php echo $bussinessName; ?></h5>
                <p>Ondřej Zelina</p>
                <p>Košická 63/30</p>
                <p>101 00 Praha 10 Vršovice</p>
                <p>Česká republika</p>
                <p>E-mail: info@zelina.tech</p>
            </div>
            <div class="col">
                <h5>Reklamace</h5>
                <p>Ondřej Zelina</p>
                <p>Tel: 799562478 </p>
                <p>E-mail: info@zelina.tech</p>   
            </div>
            <div class="col">
                <h5>Kontak pro media</h5>
                <p>Ondřej Zelina</p>
                <p>tel: 799562478</p>
                <p>E-mail: media@zelina.tech</p>
            </div>
        </div>
        <div class="app_kontakt_map">
        <iframe style="border:none" src="https://frame.mapy.cz/s/jepabevuro" width="100%" height="560" frameborder="0"></iframe>
        </div>
        <div class="app_kontakt_form">
        
        <!-- Wrapper container -->
        <div class="container py-4">

        <!-- Bootstrap 5 starter form -->
        <form id="contactForm" data-sb-form-api-token="API_TOKEN">

            <!-- Name input -->
            <div class="mb-3">
            <label class="form-label" for="name">Name</label>
            <input name="name" class="form-control" id="name" type="text" placeholder="Name" data-sb-validations="required" />
            <div class="invalid-feedback" data-sb-feedback="name:required">Name is required.</div>
            </div>
            
            <div class="mb-3">
            <label class="form-label" for="name">Telefon</label>
            <input name="phone" class="form-control" id="name" type="text" placeholder="Phone" data-sb-validations="required" />
            <div class="invalid-feedback" data-sb-feedback="name:required">Telefon je vyžadovaný.</div>
            </div>

            <!-- Email address input -->
            <div class="mb-3">
            <label class="form-label" for="emailAddress">Email Address</label>
            <input name="email" class="form-control" id="emailAddress" type="email" placeholder="Email Address" data-sb-validations="required, email" />
            <div class="invalid-feedback" data-sb-feedback="emailAddress:required">Email Address is required.</div>
            <div class="invalid-feedback" data-sb-feedback="emailAddress:email">Email Address Email is not valid.</div>
            </div>

            <!-- Message input -->
            <div class="mb-3">
            <label class="form-label" for="message">Message</label>
            <textarea name="message" class="form-control" id="message" type="text" placeholder="Message" style="height: 10rem;" data-sb-validations="required"></textarea>
            <div class="invalid-feedback" data-sb-feedback="message:required">Message is required.</div>
            </div>

            <!-- Form submissions success message -->
            <div class="d-none" id="submitSuccessMessage">
            <div class="text-center mb-3">Form submission successful!</div>
            </div>

            <!-- Form submissions error message -->
            <div class="d-none" id="submitErrorMessage">
            <div class="text-center text-danger mb-3">Error sending message!</div>
            </div>

            <!-- Form submit button -->
            <div class="d-grid">
            <button name="send_meassage" class="btn btn-primary btn-lg disabled" id="submitButton" type="submit">Odeslat</button>
            </div>

        </form>

        </div>

        <!-- SB Forms JS -->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

        </div>
    </main>
</body>
</html>