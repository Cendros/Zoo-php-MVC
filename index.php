<?php
    
    use App\router\{Request, Response};
    use App\controller\FrontController;

    require_once 'src/autoloader.php';
    Autoloader::register();

    $server = $_SERVER;

    $request = new Request($_GET, $_POST, $server);
    $response = new Response();
    $router = new FrontController($request, $response);
    $router->execute();
?>