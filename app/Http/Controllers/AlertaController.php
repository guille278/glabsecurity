<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Alerta::orderBy('created_at', 'DESC')->get();
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
    public function store(Request $request)
    {
        $valida = Validator::make($request->all(), [
            'tipo' => 'required',
            'nombreArchivo' => 'required',
            'idChip' => 'required'
        ]);
        if ($valida->fails()) {
            return response($valida->errors(), 400);
        }
        $video = new Video();
        $video->ruta = 'https://glab.com.mx/captures/'.$request->input('nombreArchivo');
        $video->save();
        
        $alerta = new Alerta();
        $alerta->tipo = $request->input('tipo');
        $alerta->idVideo = $video->id;
        $alerta->idChip = $request->input('idChip');
        $alerta->save();

        return $alerta;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alerta  $alerta
     * @return \Illuminate\Http\Response
     */
    public function show(Alerta $alerta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alerta  $alerta
     * @return \Illuminate\Http\Response
     */
    public function edit(Alerta $alerta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alerta  $alerta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alerta $alerta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alerta  $alerta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alerta $alerta)
    {
        //
    }
}
