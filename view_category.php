<?php

session_start();
require_once("setup/connect.php");

if(isset($_GET["action"])){
    global $id;

    $id = $_GET["action"];
}

function ____app_sql_query($data) {
    return $data;
    }
    
$REMOTE_HOSTNAME = "";
$LOCAL_HOSTNAME = "http://localhost/bootstrap-sablona/";

$REMOTE_STORAGE_SERVER = "";
// $LOCAL_STORAGE_SERVER = "http://localhost/app-data-management/";
$LOCAL_STORAGE_SERVER = "../";


$localhost_list = array(
    "127.0.0.1",
    "::1"
);

if(!in_array($_SERVER["REMOTE_ADDR"], $localhost_list))
{

    define("APP_PATH", "../bootstrap-sablona/");
    define("APP_RES_PATH", "{$REMOTE_HOSTNAME}");
    define("APP_INCLUDE_PATH", "");
    define("APP_STORAGE_PATH", "{$REMOTE_STORAGE_SERVER}");

}

else {

    define("APP_PATH", "../bootstrap-sablona/");
    define("APP_RES_PATH", "{$LOCAL_HOSTNAME}");
    define("APP_INCLUDE_PATH", "");
    define("APP_STORAGE_PATH", "{$LOCAL_STORAGE_SERVER}");

}
    
    
    
// ____app_form_data_user____pagination
function ____app_form_data_user____pagination() {
    
    global
    $connection,
    $app_pagination,
    $sql_search_query;
    
    $app_pagination = array(
    "total_rows" => null,
    "total_rows_per_page" => null,
    "offset" => null,
    "page_number" => null,
    "total_number_of_pages" => null,
    "previous_page" => null,
    "next_page" => null
    );
    
    
    define("APP_PAGINATION_URL", "view_category/page/");	
    
    // set
    $app_pagination["page_number"] = 1;
    // end set
    
    // set rows
    if(isset($_SESSION["total_rows_per_page"])) {
    $app_pagination["total_rows_per_page"] = $_SESSION["total_rows_per_page"];	
    }
    
    else {
    $app_pagination["total_rows_per_page"] = 2000;
    }
    // end rows
    
    
$sql_query = ____app_sql_query("
    SELECT COUNT(*) AS total_rows FROM 
    product_item
    $sql_search_query
    ");
    // end sql_query
    
    // prepare
    $stmt = $connection->prepare($sql_query);
    $stmt->execute();
    $response = $stmt->get_result();
    $row = $response->fetch_array();
    $app_pagination["total_rows"] = $row["total_rows"];
    
    //echo ceil($app_pagination["total_rows"] / $app_pagination["total_rows_per_page"]);
    //echo "<br>";
    
    //echo $app_pagination["total_rows"];
    
    if(ceil($app_pagination["total_rows"] / $app_pagination["total_rows_per_page"]) == 0) {
    $app_pagination["total_number_of_pages"] = 1;	
    }
    
    else {
    $app_pagination["total_number_of_pages"] = ceil($app_pagination["total_rows"] / $app_pagination["total_rows_per_page"]);
    }
    
    // end prepare
    
    
    // get condition
    if(isset($_GET["page_number"])) {
    
    if(is_numeric($_GET["page_number"]) && !($_GET["page_number"] > $app_pagination["total_number_of_pages"]) && !($_GET["page_number"] < 0) && !($_GET["page_number"] == 0) ) {
    $app_pagination["page_number"] = $_GET["page_number"];
    }
    
    else {
    header("Location: " . APP_RES_PATH . "index");
    }
    
    }	
    // end get condition
    
    
    // set
    $app_pagination["offset"] = ($app_pagination["page_number"]-1) * $app_pagination["total_rows_per_page"];
    
    
    if( ($app_pagination["page_number"] - 1) == 0) {
    $app_pagination["previous_page"] = 1; 
    }
    
    else {
    $app_pagination["previous_page"] = $app_pagination["page_number"] - 1;
    }
    
    
    if( ($app_pagination["page_number"] + 1) >= $app_pagination["total_number_of_pages"]) {
    $app_pagination["next_page"] = $app_pagination["total_number_of_pages"]; 
    }
    
    else {
    $app_pagination["next_page"] = $app_pagination["page_number"] + 1;	
    }
    
    // end set
    
    }
    // end ____app_form_data_user____pagination
    
    
    ____app_form_data_user____pagination();



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
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <!-- Navigation-->
        <?php require_once("layouts/nav-menu.php"); ?>
        <!-- Header-->
        <!-- Carousel -->
           <?php require_once("layouts/slider.php"); ?>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php
                    $sql_search_query = "WHERE categorycode = ".$id; 
                    $sql_query = ____app_sql_query("
                    SELECT * FROM  
                    product_item
                    $sql_search_query
                    ORDER BY 
                    id
                    ASC
                    LIMIT
        
                    $app_pagination[offset], $app_pagination[total_rows_per_page]
        
                    ");
                        
                        if($stmt = $connection->prepare($sql_query)) {
                        $stmt->execute();
                        $response = $stmt->get_result();
                        
                        $index_id = 1;
                        
                        if($response->num_rows > 0) {
                        while($row = $response->fetch_array()) {
                        
                        $response_data = array(
                        "index_id" => $index_id++,
                        "id" => $row["proid"],	
                        "title" => substr($row["name"],0,50)."...",
                        "quantity" => $row["onstocktext"]." Ks",
                        "price" => number_format($row["enduserprice"],2,".",",")." Kč",
                        );
        
                        $data = $row["imagelist"];
                        $image_replace = str_replace("'",'"', $data);
                        $image = json_decode($image_replace, true);
                    ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <a href="view_item.php?id=<?php echo $response_data["id"]; ?>"><img class="card-img-top user-image" src="<?php echo $image[0]; ?>" alt="<?php echo $response_data["title"]; ?>" /></a>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder title-name"><?php echo $response_data["title"]; ?></h5>
                                    <!-- Product price-->
                                    <?php echo $response_data["price"]; ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="view_item.php?id=<?php echo $response_data["id"]; ?>">View options</a></div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }}}
                    ?>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer>
            <?php require_once("layouts/footer.php"); ?>
        </footer>
    </body>
</html>
