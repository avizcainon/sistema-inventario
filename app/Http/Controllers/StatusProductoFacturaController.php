<?php

namespace App\Http\Controllers;

use App\Models\StatusProductoFactura;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StatusProductoFacturaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class StatusProductoFacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $statusProductoFacturas = StatusProductoFactura::paginate();

        return view('status-producto-factura.index', compact('statusProductoFacturas'))
            ->with('i', ($request->input('page', 1) - 1) * $statusProductoFacturas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $statusProductoFactura = new StatusProductoFactura();

        return view('status-producto-factura.create', compact('statusProductoFactura'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatusProductoFacturaRequest $request): RedirectResponse
    {
        StatusProductoFactura::create($request->validated());

        return Redirect::route('status-producto-facturas.index')
            ->with('success', 'StatusProductoFactura created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $statusProductoFactura = StatusProductoFactura::find($id);

        return view('status-producto-factura.show', compact('statusProductoFactura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $statusProductoFactura = StatusProductoFactura::find($id);

        return view('status-producto-factura.edit', compact('statusProductoFactura'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatusProductoFacturaRequest $request, StatusProductoFactura $statusProductoFactura): RedirectResponse
    {
        $statusProductoFactura->update($request->validated());

        return Redirect::route('status-producto-facturas.index')
            ->with('success', 'StatusProductoFactura updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        StatusProductoFactura::find($id)->delete();

        return Redirect::route('status-producto-facturas.index')
            ->with('success', 'StatusProductoFactura deleted successfully');
    }
}
