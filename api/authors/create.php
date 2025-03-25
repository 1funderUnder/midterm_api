<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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

if (empty($data->author)) {
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit();
}
    // Set author
    $author->author = $data->author;

    // Create author
    if ($author->create()) {

        $new_author_id = $author->id;

        echo json_encode(array('id' => $new_author_id, 'author' => $author->author));
    } else {
        echo json_encode(array('message' => 'Author Not Created'));
    }