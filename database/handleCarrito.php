<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, GET");
header("Access-Control-Allow-Headers: Content-Type");


$action = $_GET['action'];
$carrito_id = $_GET['carrito_id'];
$usuario_id = $_GET['usuario'];
$producto_id = $_GET['producto'];
$cantidad = $_GET['cantidad'];

$db_path = 'db.sqlite';

$db = new SQLite3($db_path);

if (!$db)
{
    die("Error connecting to the database.");
}

function eliminar() {
    global $db;
    global $carrito_id;

    // Preparar la consulta con marcadores de posición
    $query = "DELETE FROM carrito WHERE id = $carrito_id;";
    $statement = $db->prepare($query);


    // Ejecutar la consulta
    $result = $statement->execute();

    // Verificar si la consulta fue exitosa
    if (!$result) {
        die("Error executing the query: " . $db->lastErrorMsg());
    } else {
        echo "Producto eliminado: ", $carrito_id;
    }
}

function mas()
{

}

function menos()
{

}

// Check if the request method is GET
if ($action === 'eliminar') {
    eliminar();
}elseif ($action === 'menos') {
    menos();
}elseif ($action === 'mas') {
    mas();
};

$db->close();