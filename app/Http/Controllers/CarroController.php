<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarroRequest;
use App\Models\Carro;
use App\Repositories\CarroRepositories;
use Illuminate\Http\Request;

class CarroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Carro $carro)
    {
        $this->carro = $carro;
    }
    
    public function index(Request $request)
    {
        $carroRepo = new CarroRepositories($this->carro);

        if ($request->has('atributos_modelo')) {
            $atributos_carro = 'modelo:id,'.$request->atributos_modelo;
            $carroRepo->selectAtrRegistrosRelacionados($atributos_carro);
        } else {
            $carroRepo->selectAtrRegistrosRelacionados('modelo');
        }

        if ($request->has('filtro')) {
            $carroRepo->filtro($request->get('filtro'));
        }

        if ($request->has('atributos')) {
            $carroRepo->selectAtr($request->get('atributos'));
        }

        $carro = $carroRepo->getResultados();

        return $carro;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarroRequest $request)
    {
        $modelo_id = $request->get('modelo_id');
        $placa = $request->get('placa');
        $disponivel = $request->get('disponivel');
        $km = $request->get('km');

        $carro = $this->carro::create([
            'placa' => $placa,
            'disponivel' => $disponivel,
            'km' => $km,
            'modelo_id' => $modelo_id
        ]);

        return \response()->json($carro);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $carro = $this->carro::with('modelo')->find($id);
            if ($carro === null) return response()->json(['msg' => 'Registro não encontrado']);
            return response()->json($carro, 200);
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function update(CarroRequest $request, Carro $carro)
    {
        try {
            if ($carro === null) return response()->json(['msg' => 'Registro não encontrado'], 404);

            $carro->fill($request->all());
            $carro->save();

            return response()->json($carro, 200);
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $carro = $this->carro->find($id);
            if($carro === null) return response()->json(['msg' => 'Registro não encontrado!'], 404);
    
            $carro->delete();
            return response()->json(['message' => true], 200);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
