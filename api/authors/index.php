<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Connect to the database
$database = new Database();
$db = $database->connect();

// Instantiate the Author Object
$author = new Author($db);

// Get data
$data = json_decode(file_get_contents("php://input"));

// Check for missing data
if(empty($data->author)) {
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit();
}


// Handle files based on the request method
switch ($method) {
    case 'GET':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            // Include the file to get a single author
            include_once 'read_single.php';
        } else {
            // Include the file to get all authors
            include_once 'read.php';
        }
        break;

    case 'POST':
               
        // Include the file to create a new author
        include_once 'create.php';
        break;

    case 'PUT':
        // Include the file to update an existing author
        include_once 'update.php';
        break;

    case 'DELETE':
        // Include the file to delete an author
        include_once 'delete.php';
        break;

        // Default message / invalid request
    default:
        echo json_encode(array('message' => 'Invalid Request Method'));
        break;
}
?>
