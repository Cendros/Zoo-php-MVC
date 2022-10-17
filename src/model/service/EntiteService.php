<?php 

namespace App\model\service;

use App\model\classe\Enclos;
use App\model\classe\entite\Animal;
use App\model\classe\entite\Carnivore;
use App\model\classe\entite\Predateur;
use App\model\classe\entite\Proie;

class EntiteService {
    function mangerAnimal(Carnivore $tueur, Enclos $enclos) {
        $proies = array();
        foreach($enclos->getAnimaux() as $animal) {
            if($animal instanceof Animal)
                array_push($proies, $animal);
        }
        if(count($proies) === 0)
            return null;
        foreach($proies as $proie)
            $proie->mort($tueur);
        return $proies;
    }

    function mangerProie(Predateur $tueur, Enclos $enclos) {
        $proies = array();
        foreach($enclos->getAnimaux() as $animal) {
            if($animal instanceof Proie)
                array_push($proies, $animal);
        }
        if(count($proies) === 0)
            return null;
        $mort = $proies[array_rand($proies)];
        $mort->mort($tueur);
        return $mort;
    }
}
?>