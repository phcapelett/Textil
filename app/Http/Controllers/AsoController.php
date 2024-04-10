<?php

namespace App\Http\Controllers;

use App\Models\Aso;
use App\Validators\AsoValidator;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AsoController extends Controller
{
    // protected $validator;
    // protected $permission;

    // public function __construct(AsoValidator $validator)
    // {
    //     $this->validator = $validator;

    //     $this->middleware(function ($request, $next) {
    //         if (!Auth::user()) {
    //             return Redirect::to('login');
    //         } else {
    //             if (\App\Utils\Functions::validaMenuNameController('aso', Auth::user()) == false) {
    //                 return Redirect::to('/error/403');
    //             }
    //             $this->permission = \App\Utils\Functions::validaMenuNameJsonController('aso', Auth::user());
    //             return $next($request);
    //         }
    //     });
    // }
    public function index()
    {
        $aso = Aso::all();
        $nameModal = md5(uniqid('', TRUE));

        $trans = LanguageController::getLanguage();

        $file =  resource_path() . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "aso" . DIRECTORY_SEPARATOR . "aso.json";
        $content = json_decode(file_get_contents($file));

        $obj = new \stdClass();
        $obj->global = $trans['global'];
        $obj->translate = $trans['aso'];
        $obj->datatable = $trans['datatable'];
        $obj->urlbase = 'aso';
        $obj->classebase = 'aso';

        return view('grid.grid')->with(
            array(
                'lista' => $aso,
                'nameModal' => $nameModal,
                'obj' => $obj,
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
