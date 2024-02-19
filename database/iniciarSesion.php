<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, GET");
header("Access-Control-Allow-Headers: Content-Type");

function handleIniciarSesion() {
    // Path to the SQLite database file
    $db_path = 'db.sqlite';

    // Attempt to connect to the SQLite database
    $db = new SQLite3($db_path);

    // Check if the connection was successful
    if (!$db) {
        die("Error connecting to the database.");
    }

    // Execute a SELECT query
    $query = "SELECT * FROM usuarios WHERE nombre = '$_GET[usuario]'";
    $result = $db->query($query);

    // Check if the query was successful
    if (!$result) {
        die("Error executing the query: " . $db->lastErrorMsg());
    } else {
        $row = $result->fetchArray();
        if ($row) {
            if ($row['contrasena'] == $_GET['contraseña']) {
                $respuesta = array();
                $respuesta["resultado"] = "true";
                $respuesta["mensaje"] = "Inicio de sesión exitoso";
                $respuesta["usuario"]["id"] = $row['id'];
                $respuesta["usuario"]["nombre"] = $row['nombre'];
                $respuesta["usuario"]["mail"] = $row['mail'];
                $respuesta["usuario"]["tlf"] = $row['tlf'];
                $respuesta["usuario"]["iban"] = $row['iban'];
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

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Execute the function for GET request
    handleIniciarSesion();
}

