<?php

namespace App\model\classe\entite;

class Proie extends Animal{
    public function __construct(string $espece) {
        parent::__construct($espece);
    }
}
?>