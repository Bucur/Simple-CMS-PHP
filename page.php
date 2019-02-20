<?php

include_once 'database.php';
$conn = new MySQLi(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    render('db-error') and exit();
}

$conn->set_charset('utf8');

include_once 'functions.php';


if(isset($_GET['page']) && $_GET['page'] != '') {

    $page = mysqli_query($conn, "SELECT * FROM pages WHERE slug = '{$_GET['page']}'") or showErrorPage();

    if(mysqli_num_rows($page) > 0) {
        $page = mysqli_fetch_assoc($page);

        include_once('views/view.php');

    }

function showErrorPage() {
    include_once('views/error.php');
    die();
   }

}

function showErrorPage() {
    include_once('views/error.php');
    die();
    }

//else die('Page doesn\'t exists!');
