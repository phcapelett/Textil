<?php

namespace App\Http\Controllers;

use App\Models\Dependente;
use Illuminate\Http\Request;

class DependenteController extends Controller
{

    public function index()
    {
        $dependentes = Dependente::all();
        $nameModal = md5(uniqid('', TRUE));

        $trans = LanguageController::getLanguage();

        $file =  resource_path().DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR."dependente".DIRECTORY_SEPARATOR."dependente.json";
        $content = json_decode(file_get_contents($file));

        $obj = new \stdClass();
        $obj->global = $trans['global'];
        $obj->translate = $trans['dependentes'];
        $obj->datatable = $trans['datatable'];
        $obj->urlbase = 'dependentes';
        $obj->classebase = 'dependente';

        return view('grid.grid')->with(
            array(
                'lista'=>$dependentes,
                'nameModal'=>$nameModal,
                'obj'=>$obj,
                'json' => $content
                // 'auth' => $this->permission
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
