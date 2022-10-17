<?php

namespace App\model\traits;

use App\model\classe\Enclos;
use App\model\classe\entite\Carnivore;
use App\model\classe\entite\Monstre;
use App\model\classe\entite\Predateur;
use App\model\service\EntiteService;

trait Manger {
    function manger(Carnivore $tueur, Enclos $enclos) {
        if($tueur instanceof Monstre)
            return (new EntiteService())->mangerAnimal($tueur, $enclos);
        else if($tueur instanceof Predateur)
            return (new EntiteService())->mangerProie($tueur, $enclos);
    }
}
?>