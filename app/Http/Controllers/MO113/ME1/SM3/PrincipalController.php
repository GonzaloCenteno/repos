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
use Inertia\Inertia;
use Redirect;

class PrincipalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("MO113/ME1/SM3/index", [
            'opciones' => Tadcon::where([['tadconpref','>',7],['tadconcorr','!=',0]])->get(), 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($num)
    {
        $limit = 5;
        $start = ($limit * $num) - $limit;
        return response()->json([
            'total' => Gbage::join('adusr as a', 'a.adusrcage', '=', 'gbage.gbagecage')
                                ->join('adagn', 'adagn.adagnagen', '=', 'a.adusragen')
                                ->leftjoin('adusr as b', 'b.adusrusrn', '=', 'a.adusrperf')
                                ->join('adcon', 'adcon.adconabre', '=', 'a.adusrstat')->where('adconpref',7)->count(),
            'data' => Gbage::select('gbagetdid','gbagenruc','gbagendid','gbage.gbagenomb','gbage.gbagecage','a.adusrusrn','a.adusrperf','b.adusrnomb','a.adusragen','adagndesc','a.adusrstat','a.adusrmrcb','adcondesc')
                            ->join('adusr as a', 'a.adusrcage', '=', 'gbage.gbagecage')
                            ->join('adagn', 'adagn.adagnagen', '=', 'a.adusragen')
                            ->leftjoin('adusr as b', 'b.adusrusrn', '=', 'a.adusrperf')
                            ->join('adcon', 'adcon.adconabre', '=', 'a.adusrstat')->where('adconpref',7)
                            ->skip($start)->take($limit)->get()
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
