<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);
        if (!isset($usuario)) {
            return response(['Error' => "Usuario no encontrado"], 404);
        }
        return $usuario;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $valida = Validator::make($request->all(), [
            'telefono' => 'required',
            'nombre' => 'required',
            'apellidoP' => 'required',
            'apellidoM' => 'required',
            'direccion' => 'required'
        ]);
        if ($valida->fails()) {
            return response($valida->errors(), 400);
        }
        $usuario = User::find($id);
        $usuario->nombre = $request->input('nombre');
        $usuario->apellidoP = $request->input('apellidoP');
        $usuario->apellidoM = $request->input('apellidoM');
        $usuario->telefono = $request->input('telefono');
        $usuario->direccion = $request->input('direccion');
        $usuario->update();

        return $usuario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function registro(Request $request)
    {
        $valida = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'telefono' => 'required',
            'nombre' => 'required',
            'apellidoP' => 'required',
            'apellidoM' => 'required',
            'password' => 'required|min:8',
            'direccion' => 'required'
        ]);
        if ($valida->fails()) {
            return response($valida->errors(), 400);
        }
        $usuario = new User();
        $usuario->nombre = $request->input('nombre');
        $usuario->apellidoP = $request->input('apellidoP');
        $usuario->apellidoM = $request->input('apellidoM');
        $usuario->email = $request->input('email');
        $usuario->password = Hash::make($request->input('password'));
        $usuario->telefono = $request->input('telefono');
        $usuario->direccion = $request->input('direccion');

        $usuario->save();

        $token = $usuario->createToken('token')->plainTextToken;

        return $token;
    }

    public function acceso(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $usuario = Auth::user();
            $token = $usuario->createToken('token');
            return $token;
        }
        return response(['message' => 'Error de autenticacion'], 401);
    }
}
