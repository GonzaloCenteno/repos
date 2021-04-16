<?php

namespace App\Http\Controllers\MO113\ME4\SM1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\MO113\Mo113Service;
use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\MO113\ME5\SM1\Fth5001AExport;
use App\Exports\MO113\ME4\SM1\Fth5000Export;
use App\Http\Traits\GlobalFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Gbcon;
use App\Http\Models\Adagn;
use App\Http\Models\Gbage;
use Inertia\Inertia;
use Redirect;

class Fth5000Controller extends Controller
{
    use GlobalFunction;

    private $mo113service;

    public function __construct(Mo113Service $mo113service)
    {
        $this->mo113service = $mo113service;
    }

    public function index()
    {
        return Inertia::render("MO113/ME4/SM1/index", [
            'plazas' => Gbcon::where([['gbconpfij',71],['gbconcorr','!=',0]])->get(),
            'agencias' => Adagn::get()
        ]);
    }

    public function show(Request $request, $num)
    {
        if($request['tipo'] == 1):
            $datos = '';
            $datos .= (empty($request['parametros']['busqueda']['nombre'])) ? '' : 'and gbagenomb like "%'.strtoupper($request['parametros']['busqueda']['nombre']).'%"';
            $datos .= (empty($request['parametros']['busqueda']['codigo'])) ? '' : 'and gbagecage = '.$request['parametros']['busqueda']['codigo'];
            $datos .= (empty($request['parametros']['busqueda']['dni'])) ? '' : 'and gbagendid = '.$request['parametros']['busqueda']['dni'];
            return datatables()->of(Gbage::select('gbage.*')->join('adusr as a', 'a.adusrcage', '=', 'gbage.gbagecage')
                ->whereRaw('1 = 1 '.$datos)->where('a.adusrmrcb',$request['parametros']['estado'])->orderBy('gbage.gbagenomb','asc'))
                ->addColumn('action', function ($c) {
                    return "<button type='button' data-object='$c' class='btn btn-primary btn-relief-danger btn-icon btnExtraer'>+</button>";
                })
                ->make(true);
        endif;  
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $whr = "";
            switch ($request['tipo']) {
                case 1:
                    $whr .= ' AND gbagecage = '.$request['gbagecage'];
                break;
    
                case 2:
                    switch ( $request['rdobloque'] ) {
                        case 1:
                            $whr .= ' AND a.adusrplaz BETWEEN '.$request['plazainicial'].' AND '.$request['plazafinal'];
                        break;
    
                        case 2:
                            $whr .= ' AND a.adusragen BETWEEN '.$request['agenciainicial'].' AND '.$request['agenciafinal'];
                        break;
                    }
                    break;
            }

            $whr .= ' AND a.adusrmrcb = '.$request['est'];

            $columnas = array( 'CODIGO', //A
                            'T. DOCUMENTO', //B
                            '# DOCUMENTO', //C
                            'F. NACIMIENTO', //D
                            'DPTO. NACI.', //E
                            'PROV. NACI.', //F
                            'DIST. NACI.', //G
                            'AP. PATERNO', //H
                            'AP. MATERNO', //I
                            'NOMBRES', //J
                            'SEXO', //K
                            'ESTADO CIVIL', //L
                            'AGENCIA', //M
                            'ESTADO', //N
                            'F. INGRESO', //O
                            'F. REINGRESO', //P
                            'F. CESE'); //Q

            $rspta = $this->getReportData($whr, $request['chbopciones']);

            DB::commit();

            if($rspta):
                return Excel::download(new Fth5000Export($rspta,$columnas), 'DATOSPERSONALFONDESURCO.xlsx');
            else:
                return "000";
            endif;
            // if ( $data->drep->error == 0 ){
            //     $rxls = f5002_generateXLSReport_fth5000($cnx, $data->drep->data,  $data->opts);
            //     if ( $rxls->error == 0 ){
            //         $dataset->ruta = $rxls->ruta;
            //         $dataset->msj = 'Reporte generado correctamente.';
            //     } else {
            //         $dataset->cmsj = 0;
            //         throw new Exception("Error generando Excel.");
            //     }
            // } else {
            //     $dataset->cmsj = 0;
            //     throw new Exception("Error cargando Datos.");
            // }
        } catch (\Exception $ex) {
            DB::rollback();  
            return $ex->getMessage();                
        }
    }

    private function getReportData($cadena, $opciones)
    {
        $sql = DB::select("SELECT  gbagecage AS cage, 
                            (CASE gbagetdid WHEN 1 THEN 'DNI' ELSE 'RUC' END) AS tdoc,
                            (CASE gbagetdid WHEN 1 THEN gbagendid ELSE gbagenruc END) AS ndoc,
                            gbagefnac AS fnac, 
                            NVL(UPPER(gbdptdesc),'SIN REGISTRO') AS ndto, 
                            NVL(UPPER(gbprvdesc),'SIN REGISTRO') AS npro, 
                            NVL(UPPER(gbmunnomb),'SIN REGISTRO') AS ndis,
                            gbdacape1 AS appt, gbdacape2 AS apmt, gbdacnomb AS nomb, 
                            c.gbcondesc AS dsex, d.gbcondesc AS decv, adagndesc AS agen,
                            (CASE a.adusrmrcb WHEN 0 THEN 'ACTIVO' ELSE 'CESADO' END) AS stat
                        FROM gbage
                        INNER JOIN adusr a ON a.adusrcage = gbagecage
                        INNER JOIN adagn ON adagnagen = a.adusragen
                        LEFT JOIN gbcon c ON c.gbconcorr = gbagesexo AND c.gbconpfij = 2
                        LEFT JOIN gbcon d ON d.gbconcorr = gbageeciv AND d.gbconpfij = 3
                        LEFT JOIN gbdac ON gbdaccage = gbagecage
                        LEFT JOIN tthdat ON tthdatcage = gbagecage AND tthdatestd = 1 AND tthdatmrcb = 0
                        LEFT JOIN gbdir ON gbdircage = gbagecage AND gbdirmrcb = 0  AND gbdirtdir = 9
                        LEFT JOIN gbdpt ON gbdptdpto = gbdirdpto AND gbdptpais = 9
                        LEFT JOIN gbprv ON gbprvcprv = gbdircprv AND gbprvpais = 9
                        LEFT JOIN gbmun ON gbmuncmun = gbdirciud AND gbmunpais = 9
                        WHERE 1 = 1 " . $cadena . " ORDER BY gbagecage");

        foreach($sql as $clave => $data):
            $resultado[] = $this->mo113service->valoresContrato($data->cage);
            $fechas = $this->mo113service->traerFechas($resultado[$clave], $data->cage);
            $sql[$clave]->fing = $fechas['fing'];
            $sql[$clave]->frei = $fechas['frei'];
            $sql[$clave]->fces = $fechas['fces'];
        endforeach;
        return $sql;
    }
}
