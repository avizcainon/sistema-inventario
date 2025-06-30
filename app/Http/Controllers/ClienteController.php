<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;


class ClienteController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth')->except('logout');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $clientes = Cliente::get();

        return view('cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $cliente = new Cliente();

        return view('cliente.create', compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ClienteRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
   public function store(ClienteRequest $request): RedirectResponse
{
    try {
        Cliente::create($request->validated());
        return Redirect::route('clientes.index')->with('success', 'Cliente creado exitosamente.');
   
    } catch (\Throwable $th) { // <-- Captura otras excepciones
        Log::error("Error al crear cliente: " . $th->getMessage());
        return back()->withInput()->withErrors(['errors' => $th->getMessage()]); // <-- Pasa el error como 'errors' en el ViewErrorBag
    }
}

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $cliente = Cliente::find($id);

        return view('cliente.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $cliente = Cliente::find($id);

        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClienteRequest $request, Cliente $cliente): RedirectResponse
    {

        try {
            $cliente->update($request->validated());

            
            return Redirect::route('clientes.index')
                ->with('success', 'Cliente updated successfully');
        } catch (\Throwable $th) {
            Log::error("Error al actualizar cliente: " . $th->getMessage());

            return back()->withInput()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function destroy($id): RedirectResponse
    {

        try {
            Cliente::find($id)->delete();

            return Redirect::route('clientes.index')
                ->with('success', 'Cliente deleted successfully');
        } catch (\Throwable $th) {
            Log::error("Error al eliminar cliente: " . $th->getMessage());

            return back()->withInput()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function buscar(Request $request)
    {

        try {
            $searchTerm = $request->input('id_cliente');
            $front = $request->front;
            if (empty($searchTerm)) {
                $clientes = collect();
            } else {
                $clientes = Cliente::where('dni', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('nombre', 'LIKE', '%' . $searchTerm . '%')
                    ->get();
            }
        } catch (\Throwable $th) {
            return back()->withErrors(['errors' => $th->getMessage()]);
        }

        return view('cliente.item_cliente', compact('clientes', 'front'));
    }
}
