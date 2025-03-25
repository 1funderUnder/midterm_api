<?php
declare(strict_types = 1);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();

    

    echo '<pre>';
    print_r(getenv('SITE_URL'));
    echo '<br>';
    print_r($_SERVER);
    echo '</pre>';
    
    phpinfo();   
} 

    echo '<h1>Welcome to My Midterm Page for INF653</h1>';
    echo '<h2>By Laura Funderburk</h2>';
    echo '<p>This is the main page. Here, you can access various APIs for quotes, categories, and authors.</p>';
    echo '<p>You can interact with the API using the following endpoints:</p>';
    
    echo '<ul>
            <li> /api/quotes</li>
            <li> /api/categories</li>
            <li> /api/authors</li>
          </ul>';
    
    echo '<p> Thanks for visiting!';
    ?>  

