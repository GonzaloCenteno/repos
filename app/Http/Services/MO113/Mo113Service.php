<?php

namespace App\Http\Services\MO113;
// use App\Models\Tblepps_epp;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Mo113Service
{
	// private $model;

	// function __construct()
	// {
	// 	$this->model = new Tblepps_epp();
	// }
    
    public function valoresContrato($gbagecage)
    {
        $sql = DB::select("SELECT COUNT(*) AS cant,
                            (SELECT MIN(b.tthcttitem) FROM tthctt b WHERE b.tthcttcage = $gbagecage AND b.tthcttmrcb = 0) as imin,
                            (SELECT MAX(c.tthcttitem) FROM tthctt c WHERE c.tthcttcage = $gbagecage AND c.tthcttmrcb = 0) AS imax
                        FROM tthctt WHERE tthcttcage = $gbagecage AND tthcttmrcb = 0" );
        return $sql[0];
    }

    public function traerFechas($data, $gbagecage)
    {
        if($data->cant == 0):
            $datos['fing'] = 'SIN DATOS';
            $datos['fces'] = 'SIN DATOS';
            $datos['frei'] = 'SIN DATOS';
        else:
            $fing = DB::select("SELECT tthcttfini AS fing FROM tthctt WHERE tthcttcage = $gbagecage AND tthcttitem = ".$data->imin." AND tthcttmrcb = 0");
            $fces = DB::select("SELECT tthcttffin AS fces FROM tthctt WHERE tthcttcage = $gbagecage AND tthcttitem = ".$data->imax." AND tthcttmrcb = 0");
            $datos['fing'] = Carbon::parse($fing[0]->fing)->format('d/m/Y');
            $datos['fces'] = ($fces[0]->fces == '') ? 'INDETERMINADO' : Carbon::parse($fces->fces)->format('d/m/Y');

            if ( $data->imin == $data->imax ):
                $datos['frei'] = 'SIN DATOS';
            else:
                for($i = $data->imin; $i < $data->imax; $i++): 
                    $sql = DB::select("SELECT (SELECT tthcttfini AS fing FROM tthctt WHERE tthcttcage = $gbagecage AND tthcttitem = $i + 1 AND tthcttmrcb = 0) -
                                (SELECT tthcttffin AS fing FROM tthctt WHERE tthcttcage = $gbagecage AND tthcttitem = $i AND tthcttmrcb = 0) AS ddif,
                                (SELECT tthcttfini AS fing FROM tthctt WHERE tthcttcage = $gbagecage AND tthcttitem = $i + 1 AND tthcttmrcb = 0) AS fini FROM gbpmt");
                    if($sql[0]->ddif > 1):
                        $fechaReingreso = $sql[0]->fini;
                    endif;
                endfor;
                $datos['frei'] = ($fechaReingreso != '') ? Carbon::parse($fechaReingreso)->format('d/m/Y') : 'SIN REINGRESO';
            endif;
        endif;
        return $datos;
    }
	
}