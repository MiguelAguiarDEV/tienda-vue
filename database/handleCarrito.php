<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, GET");
header("Access-Control-Allow-Headers: Content-Type");


$action = $_GET['action'];
$carrito_id = $_GET['carrito_id'];
$usuario_id = $_GET['usuario'];
$producto_id = $_GET['producto'];
$cantidad = $_GET['cantidad'];

echo "Datos: " . $action . " " . $carrito_id . " " . $usuario_id . " " . $producto_id . " " . $cantidad;
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


function menos()
{
    global $db;
    global $usuario_id;
    global $producto_id;

    //Verifcar si el producto ya esta en el carrito
    $query = "SELECT * FROM carrito WHERE id_usuario = $usuario_id AND id_producto = $producto_id;";
    $statement = $db->prepare($query);

    // Ejecutar la consulta
    $result = $statement->execute();

    $row = $result->fetchArray();

    //Recogemos la cantidad y declaramos una varable para sumarle 1
    $cantidad = $row['cantidad'];

    $cantidad = $cantidad - 1;
    //Se actualizan los cambios en la BD
    if($cantidad < 1)
    {
        $query = "DELETE FROM carrito WHERE id_usuario = $usuario_id AND id_producto = $producto_id;";
        $result = $db->query($query);
        if (!$result) {
            echo "Error executing the query: " . $db->lastErrorMsg();
            die("Error executing the query: " . $db->lastErrorMsg());
        } else {
            echo "Producto eliminado: ", $producto_id;
        }
    }
    else
    {
        $query = "UPDATE carrito SET cantidad = $cantidad WHERE id_usuario = $usuario_id AND id_producto = $producto_id;";
        $result = $db->query($query);
        if (!$result) {
            echo "Error executing the query: " . $db->lastErrorMsg();
            die("Error executing the query: " . $db->lastErrorMsg());
        } else {
            echo "Producto actualizado: ", $producto_id;
        }
    
    }

}

function agregar()
{
    global $db;
    global $usuario_id;
    global $producto_id;

    //Verifcar si el producto ya esta en el carrito
    $query = "SELECT * FROM carrito WHERE id_usuario = $usuario_id AND id_producto = $producto_id;";
    $statement = $db->prepare($query);

    // Ejecutar la consulta
    $result = $statement->execute();

    $row = $result->fetchArray();
    if ($row) {
        echo "Existe";
        //Recogemos la cantidad y declaramos una varable para sumarle 1
        $cantidad = $row['cantidad'];
        $cantidad = $cantidad + 1;
        //Se actualizan los cambios en la BD
        $query = "UPDATE carrito SET cantidad = $cantidad WHERE id_usuario = $usuario_id AND id_producto = $producto_id;";
        $result = $db->query($query);
        if (!$result) {
            echo "Error executing the query: " . $db->lastErrorMsg();
            die("Error executing the query: " . $db->lastErrorMsg());
        } else {
            echo "Producto actualizado: ", $producto_id;
        }
    } else {
        echo "No existe";
        //Agregar el producto al carrito
        $query = "INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES ($usuario_id, $producto_id, 1);";
        $result = $db->query($query);
        if (!$result) {
            die("Error executing the query: " . $db->lastErrorMsg());
        } else {
            echo "Producto agregado: ", $producto_id;
        }
    }
}

// Check if the request method is GET
if ($action === 'eliminar') {
    eliminar();
}elseif ($action === 'menos') {
    menos();
}elseif($action === 'agregar') {
    agregar();
}elseif($action === 'vaciar') {
    $query = "DELETE FROM carrito WHERE id_usuario = $usuario_id;";
    $result = $db->query($query);
    if (!$result) {
        echo "Error executing the query: " . $db->lastErrorMsg();
        die("Error executing the query: " . $db->lastErrorMsg());
    } else {
        echo "Carrito vaciado";
    }
}

$db->close();

