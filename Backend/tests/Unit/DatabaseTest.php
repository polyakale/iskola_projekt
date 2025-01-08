<?php

namespace Tests\Unit;

use App\Models\Diak;
use App\Models\Osztaly;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    // sss12
    use DatabaseTransactions;

    public function test_database_creation_and_tables_exists(): void
    {
        $databaseNameConn = DB::connection()->getDatabaseName();
        $databaseNameEnv = env('DB_DATABASE');
        // dd($databaseNameEnv);
        $this->assertEquals($databaseNameConn, $databaseNameEnv);

        #sdss
        $this->assertDatabaseHas('diaks');
        $this->assertDatabaseHas('osztalies');
        $this->assertDatabaseHas('sportolas');
        $this->assertDatabaseHas('sports');
        $this->assertDatabaseHas('users');
    }
    public function test_sports_table_structure()
    {
        // sus
        $this->assertDatabaseHas('sports');
        // cai
        $this->assertTrue(Schema::hasColumn('sports', 'id'));
        $this->assertTrue(Schema::hasColumn('sports', 'sportNev'));

        // Ellenőrizzük az oszlopok típusát
        $this->assertEquals('int', Schema::getColumnType('sports', 'id'));
        $this->assertEquals('varchar', Schema::getColumnType('sports', 'sportNev'));

        //Fisthed key 
        $indexes = DB::select("SHOW INDEX FROM sports");
        $primaryIndex = collect($indexes)->firstWhere('Key_name', 'PRIMARY');
        // ss
        $this->assertNotNull($primaryIndex);
        $id = $primaryIndex->Column_name;
        // ww
        $this->assertEquals("id", $id);
        // dd($primaryIndex->Column_nam);
    }
    public function test_ostalies_table_structure()
    {
        $this->assertTrue(Schema::hasTable('osztalies'), 'Az "osztalies" tábla nem létezik.');

        $columns = DB::select('DESCRIBE osztalies');
        // dd($columns[1]->Type);
        $this->assertContains('id', array_column($columns, 'Field'));
        $this->assertContains('osztalyNev', array_column($columns, 'Field'));
        // $this->assertEquals('int(11)', $columns[0]->Type); // Feltételezzük, hogy az 'id' az első oszlop - EZ A JÓ
        $this->assertEquals('int(10) unsigned', $columns[0]->Type); // rossz
        $this->assertEquals('varchar(50)', $columns[1]->Type); // Feltételezzük, hogy az 'osztalyNev' a második

        // Elsődleges kulcs ellenőrzése
        $primaryKeys = DB::select('SHOW KEYS FROM osztalies WHERE Key_name = "PRIMARY"');
        // dd($primaryKeys[0]->Column_name);
        // eeee
        $this->assertCount(1, $primaryKeys);
        $this->assertEquals('id', $primaryKeys[0]->Column_name);
    }
    public function test_diaks_osztalies_relationships()
    {
        //A diák tábla kapcsolatai
        $databaseName = env('DB_DATABASE');
        $tableName = "diaks";
        $contstraint_name = "PRIMARY";

        $query = "
        SELECT
        TABLE_NAME,
        COLUMN_NAME,
        CONSTRAINT_NAME,
        REFERENCED_TABLE_NAME,
        REFERENCED_COLUMN_NAME
        FROM
        information_schema.KEY_COLUMN_USAGE
        WHERE
        TABLE_NAME = ? and CONSTRAINT_SCHEMA = ? and CONSTRAINT_NAME <> ?";

        $rows = DB::select($query, [$tableName, $databaseName, $contstraint_name]);
        // dd($rows);
        //Idegen kulcs neve: osztalyId
        $this->assertEquals('osztalyId', $rows[0]->COLUMN_NAME);
        //Referencia tábla neve: osztalies
        $this->assertEquals('osztalies', $rows[0]->REFERENCED_TABLE_NAME);
        //Referencia oszlop neve: id
        $this->assertEquals('id', $rows[0]->REFERENCED_COLUMN_NAME);
        
        
        //Készítünk egy osztályt
        $dataOsztaly =
        [
            'osztalyNev' => '99.d'
        ];
        $osztaly = Osztaly::factory()->create($dataOsztaly);
        // dd($osztaly);

        //Az új osztállyal készítek egy diákot
        $dataDiak =
            [
                'osztalyId' => $osztaly->id,
                'nev' => 'Rudi',
                'neme' => true,
                'szuletett' =>
                '2018-01-12',
                'helyseg' =>
                'Szolnok',
                'osztondij' => 5000,
                'atlag' => 3.5
            ];
        $diak = Diak::factory()->create($dataDiak);

        //visszakeressük a diákot
        $diak = DB::table('diaks')
            ->where('id', $diak->id)
            ->first();

        //A megtalált diák osztalyId-je megegyezik a új osztály id-jével        
        $this->assertEquals($osztaly->id, $diak->osztalyId);
        // dd($diak);
    }
}
