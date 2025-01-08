<?php

namespace Tests\Unit;

use App\Helpers\VeletlenVaros;
use Tests\TestCase;

class HelperTest extends TestCase
{
    public function test_helper_function_veletlenvaros(): void
    {
        for ($i = 0; $i < 100; $i++) {
            # code...
            $veletlenvaros = VeletlenVaros::randomVaros();
            $varosok = ["Budapest", "Debrecen", "Pécs", "Szolnok"];
            $this->assertContains($veletlenvaros, $varosok, "Flawed city: " . $veletlenvaros);
        }
        // dd($veletlenvaros);
    }

    // public function test_sajat_test(): void{
    //     $valami = 2;
    //     $this->assertGreaterThan(1,$valami);
    // }
}
