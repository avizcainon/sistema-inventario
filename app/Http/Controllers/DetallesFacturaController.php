<?php

namespace App\Http\Controllers;

use App\Models\DetallesFactura;
use App\Models\Factura;
use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DetallesFacturaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;


class DetallesFacturaController extends Controller
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
        $detallesFacturas = DetallesFactura::paginate();

        return view('detalles-factura.index', compact('detallesFacturas'))
            ->with('i', ($request->input('page', 1) - 1) * $detallesFacturas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $detallesFactura = new DetallesFactura();

        return view('detalles-factura.create', compact('detallesFactura'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DetallesFacturaRequest $request): View
    {
        // Los datos ya están validados por DetallesFacturaRequest
        $validatedData = $request->validated();

        Log::info('Datos validados recibidos en el controlador:', $validatedData);
        $id_factura = $validatedData['idFactura'];
        $tipo_factura = $validatedData['tipoFactura'];
        $cantidad = 0;
        $id_producto = 0;
       
            foreach ($validatedData['detalles_factura'] as $detalleProductoData) {
                $cantidad = $detalleProductoData['cantidad_producto_factura'];
                $id_producto = $detalleProductoData['id_producto'];
               
                $detalleData = [
                    'id_factura' =>$id_factura,
                    'id_producto' => $detalleProductoData['id_producto'],
                    'id_status_producto_factura' => $detalleProductoData['id_status_producto_factura'],
                    'cantidad_producto_factura' => $detalleProductoData['cantidad_producto_factura'],
                    'monto_producto_factura' => $detalleProductoData['monto_producto_factura'],
                ];

                
                if (DetallesFactura::create($detalleData)) {
                    $producto = Producto::find($id_producto);
                    switch ($tipo_factura) {
                        case "1": ##para compra
                            $producto->increment('cantidad_producto', $cantidad);
                            break;
                        case "2": ##para venta
                           $producto->decrement('cantidad_producto', $cantidad);
                            break;
                        case "3":##para devolucion
                           $producto->increment('cantidad_producto', $cantidad);
                            break;
                        default:
                            echo "valor ineseperado";
                    }
                    //
                    $factura = Factura::find($id_factura);
                    $factura->id_status_factura = 2;
                    $factura->save();
                    
                }
            }
        $detallesFacturas = DetallesFactura::with('producto')->where('id_factura', $id_factura)->get();
        $factura = Factura::with('cliente')->with('statusFactura')->with('tipoFactura')->where('facturas.id', $id_factura)->first();

        return view('detalles-factura.show', compact('detallesFacturas','factura'));
        /*return Redirect::route('detalles-factura.index')
            ->with('success', 'DetallesFactura created successfully.');*/
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $detallesFacturas = DetallesFactura::where('id_factura', $id)->get();
        $factura = Factura::with('cliente')
        ->with('statusFactura')
        ->with('tipoFactura')
        ->where('facturas.id', $id)
        ->first();
        Log::info('Datos entregado por el controlador:'.json_encode($detallesFacturas) );
         Log::info('***************************************************************************' );
        Log::info('Datos entregado por el controlador:'.json_encode($factura) );
        return view('detalles-factura.show', compact('detallesFacturas','factura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $detallesFactura = DetallesFactura::find($id);

        return view('detalles-factura.edit', compact('detallesFactura'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DetallesFacturaRequest $request, DetallesFactura $detallesFactura): RedirectResponse
    {
        $detallesFactura->update($request->validated());

        return Redirect::route('detalles-facturas.index')
            ->with('success', 'DetallesFactura updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        DetallesFactura::find($id)->delete();

        return Redirect::route('detalles-facturas.index')
            ->with('success', 'DetallesFactura deleted successfully');
    }
}
