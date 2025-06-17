<?php

namespace App\Http\Controllers;

use App\Models\StatusFactura;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StatusFacturaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class StatusFacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $statusFacturas = StatusFactura::paginate();

        return view('status-factura.index', compact('statusFacturas'))
            ->with('i', ($request->input('page', 1) - 1) * $statusFacturas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $statusFactura = new StatusFactura();

        return view('status-factura.create', compact('statusFactura'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatusFacturaRequest $request): RedirectResponse
    {
        StatusFactura::create($request->validated());

        return Redirect::route('status-facturas.index')
            ->with('success', 'StatusFactura created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $statusFactura = StatusFactura::find($id);

        return view('status-factura.show', compact('statusFactura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $statusFactura = StatusFactura::find($id);

        return view('status-factura.edit', compact('statusFactura'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatusFacturaRequest $request, StatusFactura $statusFactura): RedirectResponse
    {
        $statusFactura->update($request->validated());

        return Redirect::route('status-facturas.index')
            ->with('success', 'StatusFactura updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        StatusFactura::find($id)->delete();

        return Redirect::route('status-facturas.index')
            ->with('success', 'StatusFactura deleted successfully');
    }
}
