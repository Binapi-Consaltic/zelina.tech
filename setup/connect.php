<?php

$bussinessName = "MILLENIUM INTERNATIONAL s.r.o.";
global
$connection;

$localhost_list = array(
    "127.0.0.1",
    "::1"
);

if(!in_array($_SERVER["REMOTE_ADDR"], $localhost_list)){
    define("db_server", "localhost");
    define("db_user_name", "u203272543_u203272543");
    define("db_password", "fotoatalierzelinaZelio_6236");
    define("db_name", "u203272543_eshop");
}else{
    define("db_server", "localhost");
    define("db_user_name", "root");
    define("db_password", "");
    define("db_name", "cc-eshop");
}

$GLOBALS["connection"] = mysqli_connect(db_server,db_user_name,db_password,db_name);
    if(!$GLOBALS["connection"]){
        die("Connection in to database error");
    }

?>
