<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarcaRequest;
use App\Models\Marca;
use App\Repositories\MarcaRepositories;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\ErrorException;

class MarcaController extends Controller
{
    use ErrorException;

    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $marcaRepo = new MarcaRepositories($this->marca);

        if ($request->has('atributos_modelo')) {
            $atributos_modelo = 'modelos:marca_id,'. $request->atributos_modelo;
            $marcaRepo->selectAtrRegistrosRelacionados($atributos_modelo);
        } else {
            $marcaRepo->selectAtrRegistrosRelacionados('modelos');
        }
        
        if ($request->has('filtro')) {
            $marcaRepo->filtro($request->get('filtro'));
        }

        if ($request->has('atributos')) {
            $marcaRepo->selectAtr($request->get('atributos'));
        }

        $marca = $marcaRepo->getResultados();

        return $marca;
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

        $file_name = $file->store('marca','public');

        $marca = $this->marca::create([
            'nome' => $nome,
            'imagem' => $file_name
        ]);
        
        return $marca;
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
            $marca = $this->marca->with('modelos')->find($id);
            if ($marca === null) return response()->json(['msg' => 'Registro n??o encontrado'], 404);
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
    public function update(MarcaRequest $request, $id)
    {
        try {
            $marca = $this->marca->find($id);
            
            if ($marca === null) return \response()->json(['msg' => 'Registro => '. $id .' n??o encontrado no BD'],404);
            
            if ($request->file('imagem')) {
                Storage::disk('public')->delete($marca->imagem);
            }
            
            $imagem = $request->file('imagem');
            $imagem_urn = $imagem->store('marca','public');
            
            $marca->imagem = $imagem_urn;
            $marca->fill($request->all());
            
            $marca->save();
           
            return \response()->json($marca, 200);
        } 
        catch (Exception $e) {
            return $this->ErrorException($e);
        }
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
            if ($marca === null) return \response()->json(['msg' => 'Registro => '. $id .' n??o encontrado no BD'], 404);

            if (isset ($marca->imagem) ) {
                Storage::disk('public')->delete($marca->imagem);
            }

            $marca->delete();
            return \response()->json(['Message' => true], 200);
        } catch (\Exception $e) {
            return $this->ErrorException($e);
        }
    }
}
