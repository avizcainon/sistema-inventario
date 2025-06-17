<?php

namespace App\Http\Controllers;

use App\Models\StatusProducto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StatusProductoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class StatusProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $statusProductos = StatusProducto::paginate();

        return view('status-producto.index', compact('statusProductos'))
            ->with('i', ($request->input('page', 1) - 1) * $statusProductos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $statusProducto = new StatusProducto();

        return view('status-producto.create', compact('statusProducto'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatusProductoRequest $request): RedirectResponse
    {
        StatusProducto::create($request->validated());

        return Redirect::route('status-productos.index')
            ->with('success', 'StatusProducto created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $statusProducto = StatusProducto::find($id);

        return view('status-producto.show', compact('statusProducto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $statusProducto = StatusProducto::find($id);

        return view('status-producto.edit', compact('statusProducto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatusProductoRequest $request, StatusProducto $statusProducto): RedirectResponse
    {
        $statusProducto->update($request->validated());

        return Redirect::route('status-productos.index')
            ->with('success', 'StatusProducto updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        StatusProducto::find($id)->delete();

        return Redirect::route('status-productos.index')
            ->with('success', 'StatusProducto deleted successfully');
    }
}
