<?php

// Get the requested route from the URL
$route = isset($_GET['route']) && !str_ends_with($_GET['route'], '.php') ? $_GET['route'] : 'index';
$routeParts = explode('/', $route);

// Check whether it is try to access assets folder or not
if (strpos($routeParts[0], 'asset') === 0) {
    $file_path = __DIR__ . '/' . $route;

    if (file_exists($file_path) && is_file($file_path)) {
        // Set appropriate headers for the file type
        $mime_type = mime_content_type($file_path);
        header('Content-Type: ' . $mime_type);

        // Read and output the file
        readfile($file_path);
        exit();
    } else {
        http_response_code(404);
        exit('File not found');
    }
} else {
    // Define the path to the controllers folder
    $controllerPath = 'controllers/';
    
    // Construct the file path for the requested route
    $filePath = $controllerPath . $routeParts[0] . '.php';
    
    // Check if the file exists
    if (file_exists($filePath)) {
        // Include the controller file
        include_once($filePath);
        // Include the config and db access file
        include_once('config/config.php');
        include_once('db/access.php');
        $db = new DB\ConnectionDB($servername, $username, $password, $dbname);
        $controllerClass = 'Controllers\\'. ucfirst($routeParts[0]);
        $controller = new $controllerClass($db->getConnection());
        if(isset($routeParts[1]) && !empty($routeParts[1])) {
            $controller->{$routeParts[1]}();
        }
        else {
            $controller->index();
        }
    } else {
        // Handle 404 error (file not found)
        echo "404 - Page Not Found";
    }
}
