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
    $productos = array();
    $total = floatval(0);
    while ($row = $result->fetchArray()) {
        $fila = [];
        $fila["id_carrito"] = $row["id"];
        $fila["id_usuario"] = $row["id_usuario"];
        $fila["id_producto"] = $row["id_producto"];
        $fila["cantidad"] = $row["cantidad"];
        $productos[] = $fila;
        
        $query2 = "SELECT * FROM productos WHERE id = '$row[id_producto]'";
        $result2 = $db->query($query2);
        $total += $row["cantidad"]*$result2->fetchArray()["precio"];
    }
    $data["total"] = round($total, 2);
    $data["productos"] = $productos;
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

