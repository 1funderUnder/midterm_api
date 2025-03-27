<?php
// Headers
/*header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Connect to Database
$database = new Database();
$db = $database->connect();*/

// Instantiate Author Object
$author = new Author($db);

// Author Read Query
$result = $author->read();

// Get Row Count
$num = $result->rowCount();

// See if any Authors Exist
if($num > 0) {
    // Category array
    $auth_arr = array();
    //$auth_arr['data'] = array();

   while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $auth_item = array(
        'id' => $id,
        'author' => $row['author']
    );

    // Push to array
    array_push($auth_arr, $auth_item);
   } 

   // Turn to JSON and output
   echo json_encode($auth_arr);
} else {
    echo json_encode(
        array('message' => 'No Authors Found.')
    );
}