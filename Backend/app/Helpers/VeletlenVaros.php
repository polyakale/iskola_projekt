<?php

namespace App\Helpers;
class VeletlenVaros
{
    public static function randomVaros() {
        $varosok = ["Budapest", "Debrecen", "Pécs", "Szolnok"];
        $randomIndex = array_rand($varosok);
        $veletlenVaros = $varosok[$randomIndex];
        return $veletlenVaros;
    }
}