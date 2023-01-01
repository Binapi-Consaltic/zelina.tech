<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
global $link;

$localhost_list = array(
    "127.0.0.1",
    "::1"
);

if(!in_array($_SERVER["REMOTE_ADDR"], $localhost_list)){
    define("db_server", "localhost");
    define("db_user_name", "u203272543_u203272543");
    define("db_password", "Zelio_6236");
    define("db_name", "u203272543_eshop");
}else{
    define("db_server", "localhost");
    define("db_user_name", "root");
    define("db_password", "");
    define("db_name", "cc-eshop");
}

/* Attempt to connect to MySQL database */
$link = mysqli_connect(db_server, db_user_name, db_password, db_name);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>