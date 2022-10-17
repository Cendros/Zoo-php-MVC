<?php

namespace App\model\classe;

use App\model\classe\entite\Animal;
use App\model\classe\entite\Carnivore;
use App\model\classe\entite\Entite;
use App\model\classe\entite\Predateur;
use App\model\classe\entite\Proie;
use \Exception;

class Enclos {

    private array $animaux;

    public function __construct() {
        $this->setAnimaux(array());
    }

    public function setAnimaux(array $animaux) {
        $this->animaux = $animaux;
    }

    public function getAnimaux() : array {
        return $this->animaux;
    }

    public function addEntite(Entite $entite) {
        if($entite instanceof Animal) {
            foreach($this->getAnimaux() as $animalEnclos) {
                if($animalEnclos instanceof Proie && $entite instanceof Predateur || $animalEnclos instanceof Predateur && $entite instanceof Proie)
                    throw new Exception("Espèces imcompatibles");

                if($entite->getEspece() !== $animalEnclos->getEspece()) {
                    if($entite instanceof Predateur)
                        throw new Exception("Espèces imcompatibles");
                    $msg = $entite->getEspece() . " se retrouve dans le même enclos que d'autres espèces";
                    trigger_error($msg, E_USER_NOTICE);
                }
            }
        }
        array_push($this->animaux, $entite);
    }

    public function vie() {
        foreach($this->getAnimaux() as $animal) {
            if(!$animal instanceof Carnivore) continue;
            $animal->manger($animal, $this);
        }
    }

    public function display() {
        foreach($this->getAnimaux() as $animal)
            $animal->display();
    }
}
?>