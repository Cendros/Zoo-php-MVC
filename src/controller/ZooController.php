<?php

namespace app\controller;

use App\model\classe\Zoo;
use App\router\{Request, Response};
use App\view\View;
use \Exception;

class ZooController
{
    protected $request;
    protected $response;
    protected $auth;
    protected $view;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function getView()
    {
        return $this->view;
    }

    public function execute($action)
    {
        if (method_exists($this, $action)) {
            $this->$action();
        } else {
            throw new Exception("Action {$action} non trouvée");
        }
    }

    public function defaultAction()
    {
        return $this->home();
    }

    public function home()
    {
        $zoo = new Zoo();
        $this->view = new View('templates/zoo.php');
        $this->view->setPart('title', "Zoo");
        $content['zoo'] = $zoo;
        $this->view->setPart('content', $content);
    }

    public function monstres() {
        $zoo = new Zoo();
        $zoo->addMonstre("Zombie", "Ferme");
        $zoo->addMonstre("Plante Carnivore", "1");
        $zoo->vie();
        $this->view = new View('templates/zoo.php');
        $this->view->setPart('title', "Zoo");
        $content['text'] = "Un zombie est entré dans l'enclos Ferme.<br>";
        $content['text'] .= "Une Plante Carnivore est entrée dans l'enclos Ferme.<br>";
        $content['zoo'] = $zoo;
        $this->view->setPart('content', $content);
    }
}