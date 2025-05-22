<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Models\Municipio;
use Illuminate\Support\Facades\DB;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $municipios = DB::table('tb_municipio')
            ->orderBy('muni_nomb')
            ->get();
            return json_encode(['municipios' => $municipios]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'muni_nomb' => ['required','max:30','unique'],
            'comu_codi' => ['required','numeric','min:1'],
        ]);
        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validacion de la informacion',
                'statusCode' => 400,

            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $municipio = Municipio::find($id);
        if(is_null($municipio)){
            return abort(404);
            
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $municipio = Municipio::find($id);
        $municipio->muni_nomb = $request->muni_nomb;
        $municipio->comu_codi = $request->cepa_codi;
        $municipio->save();
        return json_encode(['municipio' => $municipio]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $municipio = Municipio::find($id);
        $municipio->delete();
        $municipio = DB::table('tb_municipio')
        ->join('tb_departamento', 'tb_municipio.depa_codi', '=', 'tb_departamento.depa_codi')
        ->select('tb_municipio.*','tb_departamento.depa_codi')
        ->get();
        return json_encode(['municipio' => $municipio, 'success' => 'true']);
    }
}
