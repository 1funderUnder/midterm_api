<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Connect to Database
$database = new Database();
$db = $database->connect();

// Instantiate Author Object
$author = new Author($db);

// Get raw data
$data = json_decode(file_get_contents("php://input"));

// Check if data is received
if (!isset($data->id) || empty($data->id)) {
    echo json_encode(array('message' => 'author_id Not Found'));
    exit(); // Exit if the ID is missing
}

// Set property to delete
$author->id = $data->id;

// Delete author
if($author->delete()){
    echo json_encode(
        array('id' => $author->id)
    );   
} else {
    echo json_encode(
        array('message' => 'Author Not Deleted')
    );
}