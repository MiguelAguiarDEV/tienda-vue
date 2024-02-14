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
    $query = "SELECT * FROM usuarios";
    $result = $db->query($query);

    // Check if the query was successful
    if (!$result) {
        die("Error executing the query: " . $db->lastErrorMsg());
    }

    // Fetch the results and store them in an array
    $usuarios = array();
    while ($row = $result->fetchArray()) {
        $usuario = array();
        $usuarios['id'] = $row['id'];
        $usuarios['nombre'] = $row['nombre'];
        $usuarios['descripcion_es'] = $row['descripcion_es'];
        $usuarios['descripcion_en'] = $row['descripcion_en'];
        $usuarios['precio'] = $row['precio'];
        $usuarios['disponibilidad'] = ($row['disponibilidad'] == 1) ? true : false;
        $usuarios[] = $usuario;
}

    echo json_encode($usuarios);

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

