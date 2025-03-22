<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Connect to Database
$database = new Database();
$db = $database->connect();

// Instantiate Author Object
$author = new Author($db);

// Get ID
$author->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get author
$author->read_single();

// check if author exists
if($author->author) {

    // Create array if author exists
$auth_arr = array (
    'id' => $author->id,
    'author' => $author->author
);

 // Convert to JSON
 echo json_encode($auth_arr);
} else {
    // If no author found, print error message
    echo json_encode(array('message' => 'author_id Not Found'));
}
?>