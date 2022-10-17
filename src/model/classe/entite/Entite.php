<?php

namespace App\model\classe\entite;

abstract class Entite {
    private string $espece;
    private $tueur;

    public function __construct(string $espece) {
        $this->setEspece($espece);
        $this->tueur = null;
    }

    public function getEspece() : string {
        return $this->espece;
    }

    public function setEspece(string $espece) {
        $this->espece = $espece;
    }

    public function isDead() : bool {
        return $this->tueur != null;
    }

    public function setMort(Entite $tueur) {
        $this->tueur = $tueur;
    }

    public function mort(Entite $tueur) {
        $this->setMort($tueur);
        trigger_error($this->getEspece() . ' a été tué par ' . $tueur->getEspece(), E_USER_WARNING);
    }

    public function display() {
        if($this->tueur != null)
            echo"----{$this->getEspece()} a été mangé par {$this->tueur->getEspece()} <br>";
        else echo "----{$this->getEspece()} <br>";
    }
}
?>