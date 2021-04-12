<?php

namespace App\Http\Controllers\MO113\ME5\SM1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MO113\ME5\SM1\Fth5001AExport;
use App\Exports\MO113\ME5\SM1\Fth5001BExport;
use App\Http\Traits\GlobalFunction;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Redirect;

class Fth5001Controller extends Controller
{
    use GlobalFunction;

    public function index()
    {
        return Inertia::render("MO113/ME5/SM1/index");
    }

    public function store(Request $request)
    {
        switch ($request['radio']):
            case 1:
                $data = DB::select("SELECT  prmprnpre AS npre, 'FONDEFAMILIA' AS tpag,
                                prdeucage AS tcag, b.gbagendid AS tdni, b.gbagenomb AS tnom, 
                                prmprcage AS dcag, a.gbagendid AS ddni, a.gbagenomb AS dnom,
                                NVL(prppgfech,'PAGADA') AS fpag, 
                                (
                                    (SELECT COUNT(*) FROM prppg WHERE prppgnpre = prmprnpre ) -
                                    (SELECT COUNT(*) FROM prppg WHERE prppgnpre = prmprnpre AND prppgmpag = 0) + 1
                                ) AS ncuo,
                                NVL(prppgtota,0) AS mcuo, 
                                (SELECT COUNT(*) FROM prppg WHERE prppgnpre = prmprnpre ) AS tcuo,
                                (SELECT COUNT(*) FROM prppg WHERE prppgnpre = prmprnpre AND prppgmpag = 0) AS pcuo,
                                prmprsald AS sald
                            FROM prmpr
                            LEFT JOIN prdeu ON prdeunpre = prmprnpre AND prdeucage <> prmprcage
                            INNER JOIN adusr ON adusrcage = prdeucage AND adusrmrcb = 0
                            LEFT JOIN prppg ON prppgnpre = prmprnpre AND (SELECT MONTH(gbpmtfdia) FROM gbpmt) = MONTH(prppgfech)
                                                AND (SELECT YEAR(gbpmtfdia) FROM gbpmt) = YEAR(prppgfech)
                                                AND prppgmpag = 0
                            LEFT JOIN gbage a ON a.gbagecage = prmprcage AND a.gbagemrcb = 0
                            LEFT JOIN gbage b ON b.gbagecage = adusrcage AND b.gbagemrcb = 0
                            WHERE prmprtcre = 10 AND prmprctpp = 29 AND prmprstat = 2 AND prmprmrcb = 0
                            
                            UNION
                            
                            SELECT  prmprnpre AS npre, 'ADMINISTRATIVO' AS tpag,
                                prmprcage AS tcag, gbagendid AS tdni, gbagenomb AS tnom, 
                                prmprcage AS dcag, gbagendid AS ddni, gbagenomb AS dnom,
                                NVL(prppgfech,'PAGADA') AS fpag, 
                                (
                                    (SELECT COUNT(*) FROM prppg WHERE prppgnpre = prmprnpre ) -
                                    (SELECT COUNT(*) FROM prppg WHERE prppgnpre = prmprnpre AND prppgmpag = 0) + 1
                                ) AS ncuo,
                                NVL(prppgtota,0) AS mcuo, 
                                (SELECT COUNT(*) FROM prppg WHERE prppgnpre = prmprnpre ) AS tcuo,
                                (SELECT COUNT(*) FROM prppg WHERE prppgnpre = prmprnpre AND prppgmpag = 0) AS pcuo,
                                prmprsald AS sald
                            FROM prmpr
                            INNER JOIN adusr ON adusrcage = prmprcage AND adusrmrcb = 0
                            LEFT JOIN prppg ON prppgnpre = prmprnpre AND (SELECT MONTH(gbpmtfdia) FROM gbpmt) = MONTH(prppgfech)
                                                AND (SELECT YEAR(gbpmtfdia) FROM gbpmt) = YEAR(prppgfech)
                                                AND prppgmpag = 0
                            LEFT JOIN gbage ON gbagecage = prmprcage AND gbagemrcb = 0
                            WHERE prmprstat = 2 AND prmprmrcb = 0
                            ORDER BY 1");
            break;
            
            case 2:
                $data = DB::select("SELECT tcag, tdni, tnom, COUNT(*) AS cant, SUM(mcuo) AS tota
                        FROM (
                        SELECT  prppgfech AS fech, prmprnpre AS npre, NVL(prppgtota,0) AS mcuo, 
                                    prdeucage AS tcag, prmprcage AS dcag, prmprsald AS sald, 'FONDEFAMILIA' AS fpag,
                                    (SELECT COUNT(*) FROM prppg WHERE prppgnpre = prmprnpre ) AS tcuo,
                                    (SELECT COUNT(*) FROM prppg WHERE prppgnpre = prmprnpre AND prppgmpag = 0) AS pcuo,
                                    a.gbagenomb AS dnom, b.gbagenomb AS tnom, a.gbagendid AS ddni, b.gbagendid AS tdni
                                FROM prmpr
                                LEFT JOIN prdeu ON prdeunpre = prmprnpre AND prdeucage <> prmprcage
                                INNER JOIN adusr ON adusrcage = prdeucage AND adusrmrcb = 0
                                INNER JOIN prppg ON prppgnpre = prmprnpre AND (SELECT MONTH(gbpmtfdia) FROM gbpmt) = MONTH(prppgfech)
                                                    AND (SELECT YEAR(gbpmtfdia) FROM gbpmt) = YEAR(prppgfech)
                                                    AND prppgmpag = 0
                                LEFT JOIN gbage a ON a.gbagecage = prmprcage AND a.gbagemrcb = 0
                                LEFT JOIN gbage b ON b.gbagecage = adusrcage AND b.gbagemrcb = 0
                                WHERE prmprtcre = 10 AND prmprctpp = 29 AND prmprstat = 2 AND prmprmrcb = 0
                                
                                UNION
                                
                                SELECT  prppgfech AS fpag, prmprnpre AS npre, NVL(prppgtota,0) AS mcuo, 
                                    prmprcage AS tcag, prmprcage AS dcag, prmprsald AS sald, 'PROPIO' AS fpag,
                                    (SELECT COUNT(*) FROM prppg WHERE prppgnpre = prmprnpre ) AS tcuo,
                                    (SELECT COUNT(*) FROM prppg WHERE prppgnpre = prmprnpre AND prppgmpag = 0) AS pcuo,
                                    gbagenomb AS dnom, gbagenomb AS tnom, gbagendid AS ddni, gbagendid AS tdni
                                FROM prmpr
                                INNER JOIN adusr ON adusrcage = prmprcage AND adusrmrcb = 0
                                INNER JOIN prppg ON prppgnpre = prmprnpre AND (SELECT MONTH(gbpmtfdia) FROM gbpmt) = MONTH(prppgfech)
                                                    AND (SELECT YEAR(gbpmtfdia) FROM gbpmt) = YEAR(prppgfech)
                                                    AND prppgmpag = 0
                                LEFT JOIN gbage ON gbagecage = prmprcage AND gbagemrcb = 0
                                WHERE prmprstat = 2 AND prmprmrcb = 0
                            )
                            GROUP BY 1,2,3");
            break;
        endswitch;

        if($request['radio'] == 1):
            if(count($data)):
                return Excel::download(new Fth5001AExport($data), 'DescuentosCredInterno.xlsx');
            else:
                return "000";
            endif;
        else:
            if(count($data)):
                return Excel::download(new Fth5001BExport($data), 'DescuentosCredInterno.xlsx');
            else:
                return "000";
            endif;
        endif;
    }
}
