<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

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
     * @param array $params
     * @return void
     */
    public function show($params) {
        // Get the listing ID
        $id = $params['id'] ?? '';

        $params = [
            'id' => $id
        ];

        $listing = $this->db->query("SELECT * FROM listings WHERE id = :id", $params)->fetch();

        // Check if listing exists
        if(!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        loadView('listings/show', [
            'listing' => $listing
        ]);
    }


    /**
     * Store data in database
     * 
     * @return void
     */
    public function store() {
        $allowedFields = ['title', 'description', 'salary', 'requirements', 'benefits', 'tags' , 'company', 'address', 'city', 'state', 'phone', 'email'];
        
        $newListingData = array_intersect_key($_POST, array_flip($allowedFields));

        $newListingData['user_id'] = 1;

        $newListingData = array_map('sanitize', $newListingData);
        
        $requiredFields = ['title', 'description', 'email', 'city', 'state', 'salary'];
        $errors = [];

        foreach($requiredFields as $fields) {
            if(empty($newListingData[$fields]) || !Validation::string($newListingData[$fields])) {
                $errors[$fields] = ucfirst($fields) . ' is required'; 
            }
            // inspact($newListingData[$fields]);
        }
    

        if(!empty($errors)) {
            // Reload views with errors
            loadView('listings/create', [
                'errors' => $errors,
                'listing' => $newListingData
            ]);
        } else {
            // Submit data
            $fields = [];
            foreach($newListingData as $field => $value) {
                $fields[] = $field;
            }

            // Convert the array intro string 
            $fields = implode(', ', $fields);

            // inspactAndDie($fields);

            $values = [];

            foreach($newListingData as $field => $value) {
                // Convert empty string to null
                if($value === '') {
                    $newListingData[$field] = null;
                }
                $values[] = ':' . $field;
            }

            // convert array into string 
            $values = implode(', ', $values);

            $query = "INSERT INTO listings ({$fields}) VALUES({$values})";
            
            $this->db->query($query, $newListingData);

            redirect('/listings');
            // inspactAndDie($values);
        }
    }

    /**
     * Delete a listing
     * 
     * @param array $params
     * @return void
     */
    public function destroy($params) {
        $id = $params['id'];

        $params = [
            'id' => $id
        ];

        // Check if the data is there in the db
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        if(!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        $this->db->query('DELETE FROM listings WHERE id = :id', $params);
        
        redirect('/listings');
    }
}