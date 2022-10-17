<?php

namespace App\model\classe\entite;

use App\model\traits\Manger;

class Predateur extends Animal implements Carnivore{
    use Manger;

    public function __construct(string $espece) {
        parent::__construct($espece);
    }
}
?>