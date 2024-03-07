<?php

$config = require basePath('config/db.php');

// instantiate Database class
$db = new Database($config);

// query to fetch listings data
$listings = $db->query("SELECT * FROM listings")->fetchAll();

loadView('listings/index', [
    'listings' => $listings
]);