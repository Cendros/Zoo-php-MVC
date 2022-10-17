<?php

namespace App\model\classe;

use App\model\classe\entite\Animal;
use App\model\classe\entite\Entite;
use App\model\classe\entite\Monstre;
use App\model\classe\entite\Predateur;
use App\model\classe\entite\Proie;
use \Throwable;

class Zoo {
    private array $enclos;
    private static $instance;

    public function __construct() {
        $this->setEnclos(array());
        $this->init();
    }

    public static function getInstance() {
        if(is_null(self::$instance))
            self::$instance = new Zoo();
        return self::$instance;
    }

    public function setEnclos(array $enclos) {
        $this->enclos = $enclos;
    }

    public function getEnclos() : array {
        return $this->enclos;
    }

    public function getSingleEnclos(string $idEnclos) : Enclos{
        return $this->enclos[$idEnclos];
    }

    public function vie() {
        foreach($this->getEnclos() as $enclos) {
            $morts = $enclos->vie();
            foreach($morts as $mort)
            unset($mort);
        }
    }
    
    public function addPredateur(string $espece, string $idEnclos) {
        $animal = new Predateur($espece);
        $this->newEntite($animal, $idEnclos);
    }

    public function addProie(string $espece, string $idEnclos) {
        $animal = new Proie($espece);
        $this->newEntite($animal, $idEnclos);
    }

    public function addMonstre(string $espece, string $idEnclos) {
        $monstre = new Monstre($espece);
        $this->newEntite($monstre, $idEnclos);
    }

    public function newEntite(Entite $entite, string $idEnclos) {
        $this->checkAndCreateEnclos($idEnclos);
        try {
            $this->addEntite($entite, $idEnclos);
        } catch(Throwable $th) {
            $this->findEnclos($entite, $idEnclos);
        }
        
    }

    public function addEntite(Entite $entite, string $idEnclos) {
        try {
            $this->enclos[$idEnclos]->addEntite($entite);
        } catch(Throwable $th) {
            throw $th;
        }
    }
    
    public function findEnclos(Animal $animal, string $idEnclos) {
        foreach($this->getEnclos() as $id => $enclos) {
            if($id === $idEnclos)
            continue;
            try{
                $this->enclos[$id]->addEntite($animal);
                trigger_error($animal->getEspece() . " a été ajouté à l'enclos " . $id, E_USER_NOTICE);
            } catch(Throwable $th) {
                continue;
            }
            return;
        }
        $newId = count($this->getEnclos()) + 1 . " (généré automatiquement)";
        $this->checkAndCreateEnclos($newId);
        try {
            $this->addEntite($animal, $newId);
        } catch(Throwable $th) {
            trigger_error("Problème lors de la création d'un nouvel enclos avec l'id " . $newId, E_USER_ERROR);
        }
    }

    public function checkAndCreateEnclos(string $idEnclos) {
        if(!key_exists($idEnclos, $this->enclos)) {
            $this->enclos[$idEnclos] = new Enclos();
        }
    }

    public function display() {
        foreach($this->getEnclos() as $id => $enclos) {
            echo 'Enclos ' . $id . ' : <br>';
            $enclos->display();
        }
    }

    public function getAnimaux(): array {
        $totalAnimaux = array();
        foreach($this->getEnclos() as $enclos)
            $totalAnimaux = array_merge($enclos->getAnimaux(), $totalAnimaux);
        return $totalAnimaux;
    }

    function init() {
        $this->addPredateur("Tigre", "1");
        $this->addProie("Lapin", "1");
        $this->addPredateur("Tigre", "Prédateur");
        $this->addPredateur("Lion", "Prédateur");
        $this->addProie("Lapin", "Ferme");
        $this->addProie("Poule", "Ferme");
        $this->addProie("Dindon", "Ferme");
        $this->addPredateur("Panthère", "3");
        $this->addProie("Canard", "Ferme");
        $this->addPredateur("Tigre", "Ferme");
    }
}
?>