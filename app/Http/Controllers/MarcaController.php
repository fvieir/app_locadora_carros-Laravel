<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarcaRequest;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{

    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $marcas = Marca::all();
        $marcas = $this->marca::all();
        return response()->json($marcas, 200);
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
    public function store(MarcaRequest $request)
    {
        // $marca = Marca::create($request->all())->dd();

        $file = $request->file('imagem');
        $nome = $request->input('nome');

        $file_name = $file->store('Marca','public');

        $marca = $this->marca::create([
            'nome' => $nome,
            'imagem' => $file_name
        ]);
        
        return response()->json($marca, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $marca = $this->marca->find($id);
            if ($marca === null) return response()->json(['msg' => 'Registro não encontrado'], 404);
            return response()->json($marca, 200);
        } catch (\Exception $e) {
            return $e;
        }        
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(MarcaRequest $request, Marca $marca)
    {
        // $marca = $this->marca->find($id);

        if ($marca === null) return \response()->json(['msg' => 'Registro => '. $marca->id .' não encontrado no BD'],404);

        // $request->validate($marca->rules(), $marca->messages()); // Chama validações que estão no Model

        $marca->update($request->all());

        return \response()->json($marca, 200);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $marca = $this->marca->find($id);
            if ($marca === null) return \response()->json(['msg' => 'Registro => '. $id .' não encontrado no BD'], 404);
            $marca->delete();
            return \response()->json(['Message' => true], 200);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
