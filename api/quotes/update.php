<?php
// Headers
/*header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Connect to Database
$database = new Database();
$db = $database->connect();*/

// Instantiate Quote Object
$quote = new Quote($db);

// Get raw data
$data = json_decode(file_get_contents("php://input"));

// Set properties/ID to update
$quote->id = $data->id;
$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;


// Update quote

if($quote->update()){
    echo json_encode(
        array('id' => $quote->id, 'quote' => $quote->quote, 'author_id' => $quote->author_id, 'category_id' => $quote->category_id)
    );   
} else {
    echo json_encode(
        array('message' => 'Quote Not Updated')
);
}