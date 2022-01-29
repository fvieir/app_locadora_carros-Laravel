<?php

namespace App\Http\Controllers;

use App\Models\Locacao;
use App\Repositories\LocacaoRepositories;
use Illuminate\Http\Request;
use App\Http\Requests\LocacaoRequest;
use Carbon\Carbon;

class LocacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Locacao $locacao)
    {
        $this->locacao = $locacao;
    }

    public function index(Request $request)
    {
        $locacaoRepo = new LocacaoRepositories($this->locacao);

        if ($request->has('filtro')) {
            $locacaoRepo->filtro($request->get('filtro'));
        }

        if ($request->has('atributos')) {
            $locacaoRepo->selectAtr($request->get('atributos'));
        }
       
        $locacao = $locacaoRepo->getResultados();

        return $locacao;
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
    public function store(LocacaoRequest $request)
    {
        try {
            $locacao = $this->locacao::create([
                'cliente_id' => $request['cliente_id'],
                'carro_id' => $request['carro_id'],
                'valor_diaria' => $request['valor_diaria'],
                'data_inicio_periodo' => Carbon::parse($request['data_inicio_periodo'])->format('Y-m-d'),
                'data_final_realizado' => Carbon::parse($request['data_final_realizado'])->format('Y-m-d'),
                'data_final_previsto' => Carbon::parse($request['data_final_previsto'])->format('Y-m-d'),
                'km_inicial' => $request['km_inicial'],
                'km_final' => $request['km_final']
            ]);
    
            return response()->json($locacao, 201);
            
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $locacao = $this->locacao->find($id);
            if ($locacao === null) return response()->json(['msg' => 'Registro não encontrado'], 400);
            return response()->json($locacao, 200);
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function update(LocacaoRequest $request, $id)
    {
        try {
            $locacao = $this->locacao->find($id);
            if ($locacao === null ) return response()->json(['msg' => 'Registro não encontrado'], 400);
           
            $locacao->cliente_id = $request['cliente_id'];
            $locacao->carro_id = $request['carro_id'];
            $locacao->valor_diaria = $request['valor_diaria'];
            $locacao->data_inicio_periodo = Carbon::parse($request['data_inicio_periodo'])->format('Y-m-d');
            $locacao->data_final_realizado = Carbon::parse($request['data_final_realizado'])->format('Y-m-d');
            $locacao->data_final_previsto = Carbon::parse($request['data_final_previsto'])->format('Y-m-d');
            $locacao->km_inicial = $request['km_inicial'];
            $locacao->km_final = $request['km_final'];

            $locacao->save();

            return response()->json($locacao, 200);
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Locacao $locacao)
    {
        //
    }
}
