<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::orderby('id', 'desc')->get();

        return response()->json($clientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $cliente = $request->all();
            if(array_key_exists("photo", $cliente)){
                $ext = pathinfo($request->all('photo')['photo'], PATHINFO_EXTENSION);
                $cliente['photo'] = time() . '.' . $ext;
                Storage::putFileAs('public/clientes',$request->file('photoupload'),  $cliente['photo'] );
            }
            $cliente = Cliente::create($cliente);

            // Mail::send('mail.cliente', ['Novo Cliente' => 'NOvo CLiente Teste'], function ($sm) {
            //     $sm->from('wiltterfreitasw@gmail.com');
            //     $sm->to($request->all('email')['email']);
            // });
        } catch (Exception $e) {
            $cliente = $e->getMessage();
        }
        return response()->json([
            'status' => 'success',
            'cliente'   => $cliente
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    // public function show(Cliente $cliente)
    public function show($id)
    {
        $cliente = Cliente::find($id);

        return response()->json($cliente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    // public function edit(Cliente $cliente)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        $cliente->update($request->all());

        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        if($cliente['photo']){
            Storage::delete("public/clientes/" . $cliente['photo']);
        }
        $cliente->delete();

        return response()->json(['message' =>'Cliente Excluído da base de dados com sucesso']);
    }
}
