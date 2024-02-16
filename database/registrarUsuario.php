<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

function handleRegister() {
    // Path to the SQLite database file
    $db_path = 'db.sqlite';

    // Attempt to connect to the SQLite database
    $db = new SQLite3($db_path);

    // Check if the connection was successful
    if (!$db) {
        die("Error connecting to the database.");
    }
    
    // Prepare the user data for insertion
    $user_data = [
        'usuario' => $_POST['usuario'],
        'contrasena' => $_POST['contrasena'],
        'mail' => $_POST['mail'],
        'tlf' => $_POST['tlf'],
        'iban' => $_POST['iban']
    ];
   
    
    // Execute a SELECT query to check if the user already exists
    $query = "SELECT * FROM usuarios WHERE nombre = '$user_data[usuario]'";
    $result = $db->query($query);

    // Check if the query was successful
    if (!$result) {
        die("Error executing the query: " . $db->lastErrorMsg());
    } else {
        $row = $result->fetchArray();
        $respuesta = array();
        if ($row) {
            $respuesta["resultado"] = "false";
            $respuesta["mensaje"] = "El usuario ya existe";
        } else {
            // Execute an INSERT query to add the new user
            $insertQuery = "INSERT INTO usuarios (nombre, mail, contrasena, iban, tlf) VALUES ('$user_data[usuario]', '$user_data[mail]', '$user_data[contrasena]', '$user_data[iban]', '$user_data[tlf]')";
            $insertResult = $db->exec($insertQuery);
            
            if ($insertResult) {
                $respuesta["resultado"] = "true";
                $respuesta["usuario"]["nombre"] = $user_data['usuario'];
                $respuesta["usuario"]["mail"] = $user_data['mail'];
                $respuesta["usuario"]["tlf"] = $user_data['tlf'];
                $respuesta["usuario"]["iban"] = $user_data['iban'];
                
                $respuesta["mensaje"] = "Registro exitoso";
            } else {
                $respuesta["resultado"] = "false";
                $respuesta["mensaje"] = "Error al registrar el usuario: " . $db->lastErrorMsg(); // Include the error message here
            }
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
    handleRegister();
}

