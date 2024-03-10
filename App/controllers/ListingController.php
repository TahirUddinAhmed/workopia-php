<?php

namespace App\Controllers;

use Framework\Database;

class ListingController {
    protected $db;

    public function __construct() {
        $config = require BasePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show All Listings
     *
     * @return void
     */
    public function index() {
        // query to fetch listings data
        $listings = $this->db->query("SELECT * FROM listings")->fetchAll();

        loadView('listings/index', [
            'listings' => $listings
        ]);
    }

    /**
     * Show the create listing form
     *
     * @return void
     */
    public function create() {
        loadView('/listings/create');
    }

    /**
     * Show signle listing
     *
     * @return void
     */
    public function show() {
        // Get the listing ID
        $id = $_GET['id'] ?? '';

        $params = [
            'id' => $id
        ];

        $listing = $this->db->query("SELECT * FROM listings WHERE id = :id", $params)->fetch();


        loadView('listings/show', [
            'listing' => $listing
        ]);
    }
}