<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, POST");
header("Access-Control-Allow-Headers: Content-Type");

function handlePOSTRequest() {
    // Path to the SQLite database file
    $db_path = 'db.sqlite';

    // Attempt to connect to the SQLite database
    $db = new SQLite3($db_path);

    // Check if the connection was successful
    if (!$db) {
        die("Error connecting to the database.");
    }

    // Execute a SELECT query
    $query = "SELECT * FROM usuarios WHERE nombre = '$_POST[usuario]'";
    $result = $db->query($query);

    // Check if the query was successful
    if (!$result) {
        die("Error executing the query: " . $db->lastErrorMsg());
    } else {
        $row = $result->fetchArray();
        if ($row) {
            if ($row['contrasena'] == $_POST['contraseña']) {
                $respuesta = array();
                $respuesta["resultado"] = "true";
                $respuesta["mensaje"] = "Inicio de sesión exitoso";
            } else {
                $respuesta = array();
                $respuesta["resultado"] = "false";
                $respuesta["mensaje"] = "La contraseña es incorrecta";
            }
        } else {
            $respuesta = array();
            $respuesta["resultado"] = "false";
            $respuesta["mensaje"] = "El usuario no existe";
        }
    }

    echo json_encode($respuesta);

    // Close the result set
    $result->finalize();

    // Close the database connection
    $db->close();

}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Execute the function for POST request
    handlePOSTRequest();
}

