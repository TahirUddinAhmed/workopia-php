<?php

$config = require basePath('config/db.php');
// Instiating Database class
$db = new Database($config);

$listings = $db->query("SELECT * FROM listings LIMIT 6")->fetchAll();

// inspact($listings);

loadView('home', [
    'listings' => $listings,
]);