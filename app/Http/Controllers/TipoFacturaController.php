<?php

namespace App\Http\Controllers;

use App\Models\TipoFactura;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TipoFacturaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TipoFacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $tipoFacturas = TipoFactura::paginate();

        return view('tipo-factura.index', compact('tipoFacturas'))
            ->with('i', ($request->input('page', 1) - 1) * $tipoFacturas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tipoFactura = new TipoFactura();

        return view('tipo-factura.create', compact('tipoFactura'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipoFacturaRequest $request): RedirectResponse
    {
        TipoFactura::create($request->validated());

        return Redirect::route('tipo-facturas.index')
            ->with('success', 'TipoFactura created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $tipoFactura = TipoFactura::find($id);

        return view('tipo-factura.show', compact('tipoFactura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $tipoFactura = TipoFactura::find($id);

        return view('tipo-factura.edit', compact('tipoFactura'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoFacturaRequest $request, TipoFactura $tipoFactura): RedirectResponse
    {
        $tipoFactura->update($request->validated());

        return Redirect::route('tipo-facturas.index')
            ->with('success', 'TipoFactura updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        TipoFactura::find($id)->delete();

        return Redirect::route('tipo-facturas.index')
            ->with('success', 'TipoFactura deleted successfully');
    }
}
