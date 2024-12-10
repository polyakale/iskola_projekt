<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueriesController extends Controller
{
    public function queryOsztalynevsor(){
        $query= 'SELECT  osztalyNev, nev from diaks d inner join osztalies o
            on d.osztalyId = o.id order by osztalyNev, nev';
        $rows= DB::select($query);
        $data = [
            'message' => 'ok',
            'data' => $rows
        ];
        return response()->json($data, options:JSON_UNESCAPED_UNICODE);
    }
    public function queryOsztalytarsak(string $nev){
        $query= 'select nev, osztalyId from diaks where osztalyId = ( select osztalyId
            from diaks where nev = ? ) and nev <> ? order by nev';
        $rows= DB::select($query, [$nev, $nev]);
        $data = [
            'message' => 'ok',
            'data' => $rows
        ];
        return response()->json($data, options:JSON_UNESCAPED_UNICODE);
    }
    public function queryDiakOldalankent(int $oldal, int $darab)
    {
        $offset = ($oldal - 1) * $darab;
        $query = 'SELECT * from diaks
            LIMIT ? OFFSET ?';
        $rows = DB::select($query, [$darab, $offset]);
        $osszes = DB::select('SELECT COUNT(*) darab from diaks'); 
        $osszes = $osszes[0]->darab;
        $osszesOldal = ceil($osszes / $darab);
        if (!($oldal > $osszesOldal || $oldal < 1)) {
            $data = [
                'message' => 'ok',
                'oldal' => "{$oldal}|{$osszesOldal}",
                'data' => $rows
            ];
        } else {
            $data = [
                'message' => 'Hiba',
                'data' => []
            ];
        }
   
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function queryDiakKeres(string $nev) {
        // return response()->json($nev, options:JSON_UNESCAPED_UNICODE);
        // $query = 'SELECT * FROM diaks WHERE nev = "'.$nev.'"';
        // $rows= DB::select($query);
        $query = 'SELECT * FROM diaks WHERE nev = ?';
        $rows= DB::select($query, [$nev]);
        $data = [
            'message' => 'ok',
            'data' => $rows,
            'sql' => $query
        ];
        return response()->json($data, options:JSON_UNESCAPED_UNICODE);
    }
    
}
