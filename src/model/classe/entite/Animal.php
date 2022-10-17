<?php

namespace App\model\classe\entite;

abstract class Animal extends Entite {

    public function __construct(string $espece) {
        parent::__construct($espece);
    }
}
?>