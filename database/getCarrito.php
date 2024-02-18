<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, GET");
header("Access-Control-Allow-Headers: Content-Type");

function getCarrito() {
    // Path to the SQLite database file
    $db_path = 'db.sqlite';

    // Attempt to connect to the SQLite database
    $db = new SQLite3($db_path);

    // Check if the connection was successful
    if (!$db) {
        die("Error connecting to the database.");
    }

    // Execute a SELECT query
    $query = "SELECT * FROM carrito WHERE id_usuario = '$_GET[id_usuario]'";
    $result = $db->query($query);

    // Check if the query was successful
    if (!$result) {
        die("Error executing the query: " . $db->lastErrorMsg());
    }

    // Fetch the results and store them in an array
    $data = array();
    while ($row = $result->fetchArray()) {
        $data[$row['id_producto']] = $row['cantidad'];
    }

    echo json_encode($data);
    // Close the result set
    $result->finalize();

    // Close the database connection
    $db->close();

}

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Execute the function for GET request
    getCarrito();
}

