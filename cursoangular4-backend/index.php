<?php
require_once "vendor/autoload.php";

$app = new \Slim\Slim();

$db = new mysqli('localhost', 'root', 'Qa12pl09', 'curso_angular4');

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



//Eliminar un producto



//Actualizar un producto



//Subir imagen a un producto



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
