<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;
use App\Traits\ErrorException;
use Illuminate\Support\Facades\Storage;

class ModeloController extends Controller
{
    use ErrorException;

    public function __construct(Modelo $modelo)
    {
        $this->modelo = $modelo;        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $modelo = [];

        //Relacionamento com atributos selecionados ou todos
        if ($request->has('atributos_marca')) 
        {      
            $atributos_marca = $request->atributos_marca; 
            $modelo = $this->modelo->with('marca:id,'.$atributos_marca);
        } else {
            $modelo = $this->modelo->with('marca');
        }

        // Filtros no Where
        if($request->has('filtro')) {

            $filtros = \explode(';',$request->filtro);
            
            foreach ($filtros as $key => $condições) {
                $c = explode(':',$condições);
                $modelo = $modelo->where($c[0],$c[1],$c[2]);
            }
        }
        
        // Retornando dados 
        if ($request->has('atributos')) 
        {
            $atributos = $request->atributos;
            $modelo = $modelo->selectRaw($atributos)->get();
            return response()->json($modelo, 200);
        } else {
            $modelo = $modelo->get();
            return \response()->json($modelo, 200);
        }
    
        return false;
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
    public function store(Request $request)
    {
        $request->validate($this->modelo->rules());

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('marca/modelo','public');
        
        $modelo = $this->modelo->create([
            'marca_id' => $request->marca_id,
            'nome' => $request->nome,
            'imagem' => $imagem_urn,
            'numero_portas' => $request->numero_portas,
            'lugares' => $request->lugares,
            'air_bag'=> $request->air_bag,
            'abs' => $request->air_bag,
        ]);
        
        return response()->json($modelo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modelo = $this->modelo->with('marca')->find($id);

        if ($modelo === null) return response()->json(['erro' => 'Recurso pesquisado não existe'], 404); 

        return \response()->json($modelo, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $modelo = $this->modelo->find($id);
        $imagem = $request->file('imagem');

        if ($modelo === null) {
            return response()->json(['error' => 'Impossível realizar a atualização, registro não encontrado no BD'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regras_dinamicas = array();

            foreach ($modelo->rules() as $input => $regra) {
                if (array_key_exists($input,\request()->all())) {
                    $regras_dinamicas[$input] = $regra; 
                }
            }
            
            $request->validate($regras_dinamicas);

        } else {
            $request->validate($modelo->rules());
        }


        if($imagem && isset($modelo->imagem)) {
            Storage::disk('public')->delete($modelo->imagem);
        }

        $imagem_urn = $imagem->store('marca/modelo','public');

        $modelo->fill($request->all());
        $modelo->imagem = $imagem_urn;
        $modelo->save();

        // $modelo->update([
        //     'marca_id' => $request->marca_id,
        //     'nome' => $request->nome,
        //     'imagem' => $imagem_urn,
        //     'numeros_portas' => $request->numeros_portas,
        //     'lugares' => $request->lugares,
        //     'air_bag' => $request->air_bag,
        //     'abs' => $request->abs,
        // ]);

        return \response()->json($modelo, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        try {
            $modelo = $this->modelo->find($id);

            if ($modelo === null) {
                return response()->json(['error' => 'Impossível realizar a exclusão. Registro não existe'], 404);
            }

            Storage::disk('public')->delete($modelo->imagem);

            $modelo->delete();

            return \response()->json(['msg' => 'O modelo foi removido com sucesso!'], 200);
        } 
        catch (\Exception $e) {
            return $this->ErrorException($e);
        }
    }
}
