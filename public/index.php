<?php
require '../helpers.php';

// require basePath('views/home.view.php');
// loadView('home');

// Router logic
$uri = $_SERVER['REQUEST_URI'];

require basePath('router.php');
