<?php

namespace App\Http\Controllers\MO113\ME1\SM3;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PrincipalRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Tadcon;
use App\Http\Models\Gbage;
use App\Http\Models\Tthdat;
use App\Http\Models\Gbpmt;
use App\Http\Models\Tthpgp;
use App\Http\Models\Tthbon;
use Carbon\Carbon;
use Inertia\Inertia;
use Redirect;

class PrincipalController extends Controller
{
    public function index()
    {
        return Inertia::render("MO113/ME1/SM3/create", [
            'opciones' => Tadcon::where([['tadconpref','>',7],['tadconcorr','!=',0]])->get(),
            'oficinasbs' => DB::select('SELECT tadsofcofi,
                                            (CASE WHEN tadsofcofi = tadsofcagp 
                                                    THEN (SELECT adagndesc FROM adagn WHERE adagnagen = tadsofcofi) 
                                                    ELSE tadsofnomb END) AS tadsofnomb
                                        FROM tadsof 
                                        WHERE tadsofestd = 1 AND tadsofmrcb = 0
                                        ORDER BY tadsofcofi')
        ]);
    }

    public function create()
    {
        //
    }

    public function store(PrincipalRequest $request)
    {
        DB::beginTransaction();
        try{
            $trabajador = $this->asigarValoresDefecto($request->trabajador,'tthdatfpro','tthdatfreg','tthdathora','tthdatusrn','tthdatestd','tthdatmrcb');
            $pago = $this->asigarValoresDefecto($request->pago,'tthpgpfpro','tthpgpfreg','tthpgphora','tthpgpusrn','tthpgpestd','tthpgpmrcb');
            $trab = Tthdat::create($trabajador);
            $trab->pago()->create($pago);
            foreach ($request->bonos as $i => $data): 
                $bono[] = $this->asigarValoresDefecto($request->bonos[$i],'tthbonfpro','tthbonfreg','tthbonhora','tthbonusrn','tthbonestd','tthbonmrcb');
                $trab->bonos()->create([ 'tthbonitem' => $bono[$i]['tthbonitem'],
                                        'tthbonmont' => $bono[$i]['tthbonmont'],
                                        'tthbonestd' => $bono[$i]['tthbonestd'],
                                        'tthbonmrcb' => $bono[$i]['tthbonmrcb'],
                                        'tthbonfpro' => $bono[$i]['tthbonfpro'],
                                        'tthbonfreg' => $bono[$i]['tthbonfreg'],
                                        'tthbonhora' => $bono[$i]['tthbonhora'],
                                        'tthbonusrn' => $bono[$i]['tthbonusrn'] ]);
            endforeach;

            DB::commit();
            return Redirect::route('programa.index');
        } catch (\Exception $ex) {
            DB::rollback();  
            return $ex->getMessage();                
        }
    }

    private function asigarValoresDefecto($arreglo,$pro,$freg,$hora,$usr,$std,$mrcb)
    {
        $fechafpro = Gbpmt::select('gbpmtfdia')->first();
        $arreglo[$pro] = (string)$fechafpro->gbpmtfdia;
        $arreglo[$freg] = date('Y-m-d');
        $arreglo[$hora] = (string)date('H:i:s');
        $arreglo[$usr] = (string)'GCZ';
        $arreglo[$std] = 1;
        $arreglo[$mrcb] = 0;
        return $arreglo;
    }

    public function show(Request $request, $num)
    {
        if($request['tipo'] == 1):
            return datatables()->of(Gbage::select('gbagetdid','gbagenruc','gbagendid','gbage.gbagenomb','gbage.gbagecage','a.adusrusrn','a.adusrperf','b.adusrnomb','a.adusragen','adagndesc','a.adusrstat','a.adusrmrcb','adcondesc')
                ->join('adusr as a', 'a.adusrcage', '=', 'gbage.gbagecage')
                ->join('adagn', 'adagn.adagnagen', '=', 'a.adusragen')
                ->leftjoin('adusr as b', 'b.adusrusrn', '=', 'a.adusrperf')
                ->join('adcon', 'adcon.adconabre', '=', 'a.adusrstat')->where('adconpref',7))
                ->addColumn('action', function ($c) {
                    return "<button data-object='$c' class='btn btn-primary btn-relief-danger btn-icon btnExtraer'>+</button>";
                })
                ->make(true);
        elseif($request['tipo'] == 2):
            return DB::select('SELECT DISTINCT gbbcocbpr AS cbco, gbbcodesc AS nbco FROM gbbco WHERE gbbcoacdp = ?', array($request['valor']));
        elseif($request['tipo'] == 3):
            $arreglo[0] = [ "ncta" => 'SIN CUENTA ACTIVA'];
            $data = DB::select('SELECT camcancta AS ncta FROM camca WHERE camcacage = ? AND camcatpca = ? AND camcacmon = ? AND camcastat = ? ORDER BY camcafumv DESC', array($request['valor'],2,1,1));
            return (empty($data)) ? $arreglo : $data; 
        else:
            $resultado = $this->valoresContrato($request['valor']);
                if($resultado[0]->cant > 0 ):
                    $arreglo = $this->traerFechas($resultado, $request['valor']);
                else:
                    $arreglo['fing'] = 'SIN DATOS';
                    $arreglo['frei'] = 'SIN DATOS';
                    $arreglo['fces'] = 'SIN DATOS';
                endif;
            return $arreglo;
        endif;  
    }

    private function valoresContrato($gbagecage)
    {
        $sql = DB::select("SELECT COUNT(*) AS cant,
                            (SELECT MIN(b.tthcttitem) FROM tthctt b WHERE b.tthcttcage = $gbagecage AND b.tthcttmrcb = 0) as imin,
                            (SELECT MAX(c.tthcttitem) FROM tthctt c WHERE c.tthcttcage = $gbagecage AND c.tthcttmrcb = 0) AS imax
                        FROM tthctt WHERE tthcttcage = $gbagecage AND tthcttmrcb = 0" );
        return $sql;
    }

    private function traerFechas($data, $gbagecage)
    {
        $fing = DB::select("SELECT tthcttfini AS fing FROM tthctt WHERE tthcttcage = $gbagecage AND tthcttitem = ".$data[0]->imin." AND tthcttmrcb = 0");
        $fces = DB::select("SELECT tthcttffin AS fces FROM tthctt WHERE tthcttcage = $gbagecage AND tthcttitem = ".$data[0]->imax." AND tthcttmrcb = 0");
        $datos['fing'] = Carbon::parse($fing[0]->fing)->format('d/m/Y');
        $datos['fces'] = ($fces[0]->fces == '') ? 'INDETERMINADO' : Carbon::parse($fces[0]->fces)->format('d/m/Y');

        if ( $data[0]->imin == $data[0]->imax ):
            $datos['frei'] = 'SIN DATOS';
        else:
            for($i = $data[0]->imin; $i < $data[0]->imax; $i++): 
                $sql = DB::select("SELECT (SELECT tthcttfini AS fing FROM tthctt WHERE tthcttcage = $gbagecage AND tthcttitem = $i + 1 AND tthcttmrcb = 0) -
                            (SELECT tthcttffin AS fing FROM tthctt WHERE tthcttcage = $gbagecage AND tthcttitem = $i AND tthcttmrcb = 0) AS ddif,
                            (SELECT tthcttfini AS fing FROM tthctt WHERE tthcttcage = $gbagecage AND tthcttitem = $i + 1 AND tthcttmrcb = 0) AS fini FROM gbpmt");
                if($sql[0]->ddif > 1):
                    $fechaReingreso = $sql[0]->fini;
                endif;
            endfor;
            $datos['frei'] = ($fechaReingreso != '') ? Carbon::parse($fechaReingreso)->format('d/m/Y') : 'SIN REINGRESO';
        endif;
        return $datos;
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
