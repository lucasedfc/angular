<?php
require_once "vendor/autoload.php";

$app = new \Slim\Slim();

$db = new mysqli('localhost', 'root', '', 'curso_angular4');

// Configuración de cabeceras
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

$app->get("/pruebas", function() use($app, $db){
    echo "Hola mundo desde Slim PHP";
});

$app->get("/probando", function() use($app){
    echo "Otro texto cualquiera";
});

//Listar todos los productos
$app->get('/productos', function() use($db, $app){
        $sql = 'SELECT * FROM productos ORDER BY id DESC;';
        $query = $db->query($sql);

        //var_dump($query->fetch_all());

        //array de objetos
        $productos = array();
        while ($producto = $query->fetch_assoc()) {
            $productos[] = $producto;

        }

        $result = array(
            'status' => 'success',
            'code' => 200,
            'data' => $productos
        );

        echo json_encode($result);
});


//Devolver un producto
$app->get('/productos/:id', function($id) use($db, $app){
    $sql = 'SELECT * FROM productos WHERE id = '.$id;
    $query = $db->query($sql);

    $result = array(
        'status' => 'error',
        'code' => '404',
        'message' => 'producto NO encontrado'
    );

    if($query->num_rows == 1) {
        $producto = $query->fetch_assoc();
        $result = array(
            'status' => 'success',
            'code' => "200",
            'data' => $producto
        );
    }

    echo json_encode($result);
    
});


//Eliminar un producto
$app->get('/delete-producto/:id', function($id) use($db, $app){
    $sql = 'DELETE FROM productos WHERE id = '.$id;
    $query = $db->query($sql);

    if($query) {
        $result = array(
            'status' => 'success',
            'code' => 200,
            'message' => 'El producto se ha eliminado correctamente'
        );
    }
    else {
        $result = array(
            'status' => 'error',
            'code' => 404,
            'message' => 'El producto NO se ha eliminado'
        );
    }

    echo json_encode($result);
});


//Actualizar un producto
$app->post('/update-producto/:id', function($id) use($app, $db){
$json = $app->request->post('json');
$data = json_decode($json, true);

$sql = "UPDATE productos SET ".
"nombre = '{$data["nombre"]}', ".
"description = '{$data["description"]}', ";

if(isset($data['imagen'])) {
    $sql .= "imagen = '{$data["imagen"]}', ";
}

$sql .= "precio = '{$data["precio"]}' WHERE id = {$id}";

var_dump($sql);
$query = $db->query($sql);




if($query){
    $result = array(
        'status' => 'success',
        'code' => 200,
        'message' => 'El producto se ha actualizado'
    );
}

else {
    $result = array(
        'status' => 'error',
        'code' => 404,
        'message' => 'El producto NO se ha actualizado'
    );
}

echo json_encode($result);

});


//Subir imagen a un producto

$app->post('/upload-file', function() use($db, $app){
    $result = array(
        'status' => 'error',
        'code' => 404,
        'message' => 'Archivo no se ha subido correctamente'
    );

    if(isset($_FILES['uploads'])) {
        echo "Llegan los datos";
        $piramideUploader = new PiramideUploader();

                                            // prefijo  namefile    carpeta     formato
        $upload = $piramideUploader->upload('image', "uploads", "uploads", array('image/jpeg', 'imagen/png', 'image/gif'));

        $file = $piramideUploader->getInfoFile();
        $file_name = $file['complete_name'];

        var_dump($file);

        if(isset($upload) && $upload['uploaded'] == false) {
            $result = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Archivo no se ha subido correctamente'
            );
        }

        else {
            $result = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Archivo se ha subido correctamente',
                'filename' => $file_name
            );
        }
        

    }
   
    echo json_encode($result);
});



//Guardar productos 
$app->post('/productos', function() use($app, $db){
    $json = $app->request->post('json');
    $data = json_decode($json, true);
    
    //var_dump($json);
    //var_dump($data);

    if(!isset($data['imagen'])){
        $data['imagen']=null;

    }

    if(!isset($data['nombre'])){
        $data['nombre']=null;

    }

    if(!isset($data['precio'])){
        $data['precio']=null;

    }

    if(!isset($data['description'])){
        $data['description']=null;

    }

    $query = "INSERT INTO productos VALUES(NULL,".
    "'{$data['nombre']}',".
    "'{$data['description']}',".
    "'{$data['precio']}',".
    "'{$data['imagen']}'".
    ");";

    //var_dump($query);
    $insert = $db->query($query);

    $result = array(
        'status' => 'error',
        'code' => 404,
        'message' => 'El producto NO se ha creado correctamente'
    );

    if($insert){
        $result = array(
            'status' => 'success',
            'code' => 200,
            'message' => 'Productos creado correctamente'
        );
    }

    echo json_encode($result);

});

$app->run();
