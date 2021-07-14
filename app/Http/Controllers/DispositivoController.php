<?php

namespace App\Http\Controllers;

use App\Models\Dispositivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class DispositivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Dispositivo::all();
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
            'nombreUbicacion' => 'required',
            'ip' => 'required',
        ]);
        if ($valida->fails()) {
            return response($valida->errors(), 400);
        }

        $res = Http::timeout(15)->get("http://" . $request->input('ip') . "/");

        $dispositivo = new Dispositivo();
        $dispositivo->nombreUbicacion = $request->input('nombreUbicacion');
        $dispositivo->ip = $request->input('ip');
        $dispositivo->idChip = json_decode($res['chipID']);
        $dispositivo->idUsuario = Auth::user()->id;
        $dispositivo->save();

        

        return $dispositivo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function show(Dispositivo $dispositivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Dispositivo $dispositivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dispositivo $dispositivo)
    {
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dispositivo $dispositivo)
    {
        //
    }
}
