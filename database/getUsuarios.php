<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");

function handleGetRequest() {
    // Path to the SQLite database file
    $db_path = 'db.sqlite';

    // Attempt to connect to the SQLite database
    $db = new SQLite3($db_path);

    // Check if the connection was successful
    if (!$db) {
        die("Error connecting to the database.");
    }

    // Execute a SELECT query
    $query = "SELECT * FROM productos";
    $result = $db->query($query);

    // Check if the query was successful
    if (!$result) {
        die("Error executing the query: " . $db->lastErrorMsg());
    }

    // Fetch the results and store them in an array
    $products = array();
    while ($row = $result->fetchArray()) {
        $product = array();
        $product['id'] = $row['id'];
        $product['nombre'] = $row['nombre'];
        $product['descripcion'] = $row['descripcion'];
        $product['precio'] = $row['precio'];
        if (!empty($row['imagen'])) {
            $product['imagen'] = 'data:image/png;base64,' . base64_encode($row['imagen']);
        } else {
            $product['imagen'] = null;
        }
        $products[] = $product;
}

    echo json_encode($products);

    // Close the result set
    $result->finalize();

    // Close the database connection
    $db->close();

}

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Execute the function for GET request
    handleGetRequest();
}

