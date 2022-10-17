<?php

namespace App\controller;

use App\router\{Request, Response, Router};
use App\view\View;
use \Exception;

class FrontController
{

    protected $request;
    protected $response;

    public function __construct($request, $response)
    {
        $this->setRequest($request);
        $this->setResponse($response);
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    public function execute()
    {
        $view = null;

        try {
            $router = new Router($this->request);
            $className = $router->getControllerClassName();
            $action = $router->getControllerAction();
            $controller = new $className($this->request, $this->response);
            $controller->execute($action);
            $view = $controller->getView();
        } catch (Exception $e) {
            $view = new View('templates/home.php');
            $view->setPart('title', 'Erreur');
            $content = $e->getMessage();
            $content .= "<div>" . nl2br($e->getTraceAsString()) . "</div>";
            $view->setPart('content', $content);
        }
        $content = $view->render();

        $this->response->send($content);
    }
}