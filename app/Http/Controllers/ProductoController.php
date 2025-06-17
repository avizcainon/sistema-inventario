<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\StatusProducto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ProductoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log; 

class ProductoController extends Controller
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
        $productos = Producto::with('statusProducto')->paginate();

        return view('producto.index', compact('productos'))
            ->with('i', ($request->input('page', 1) - 1) * $productos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $producto = new Producto();
        $status_productos = StatusProducto::All();

        return view('producto.create', compact('producto','status_productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request): RedirectResponse
    {
        $request->validated();
        $producto = $request->all();

        if($imagenProductoForm = $request->file('imagen_producto')){
            $rutaGuardar = 'imagenes/';
            $nombreImagenProducto = date('YmdHis').".".$imagenProductoForm->getClientOriginalExtension();
            
            $producto['imagen_producto'] = $nombreImagenProducto;
        }
        if (Producto::create($producto)) {
            $imagenProductoForm->move($rutaGuardar,$nombreImagenProducto);
        }
        

        return Redirect::route('productos.index')
            ->with('success', 'Producto created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $producto = Producto::with('statusProducto')->find($id);

        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $producto = Producto::find($id);
        $status_productos = StatusProducto::All();

        return view('producto.edit', compact('producto','status_productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, Producto $producto): RedirectResponse
    {
        $producto->update($request->validated());

        return Redirect::route('productos.index')
            ->with('success', 'Producto updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Producto::find($id)->delete();

        return Redirect::route('productos.index')
            ->with('success', 'Producto deleted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function buscar(Request $request)
    {
        // 1. Obtener el término de búsqueda enviado por AJAX.
        // Tu jQuery envía el dato como 'term' en la propiedad 'data'.
        $searchTerm = $request->input('term');
        $front = $request->front;

        Log::info("********************************************* Valor de entrada para búsqueda: {$searchTerm}");
        Log::info("********************************************* Valor de entrada para búsqueda: {$front}");
        // 2. Realizar la consulta a la base de datos para buscar productos.
        // Si el término de búsqueda está vacío, devuelve una colección vacía.
        if (empty($searchTerm)) {
            $productos = collect(); // Devuelve una colección vacía
        } else {
            switch ($front) {
                case 'productos':
                    $productos = Producto::with('statusProducto')
                                 ->where('productos.codigo_producto', 'LIKE', '%' . $searchTerm . '%') // Asumiendo que la columna a buscar es 'name'
                                 // Opcional: Si quieres buscar en más columnas:
                                 ->orWhere('productos.descripcion_producto', 'LIKE', '%' . $searchTerm . '%')
                                 ->paginate();  
                    break;
                
                case 'facturas':
                   $productos = Producto::with('statusProducto')
                                ->where('productos.id_status_producto', 1)
                                ->where(function ($query) use ($searchTerm) { // <--- ¡Esto agrupa las condiciones OR!
                                    $query->where('productos.codigo_producto', 'LIKE', '%' . $searchTerm . '%')
                                    ->orWhere('productos.descripcion_producto', 'LIKE', '%' . $searchTerm . '%');
                                })
                                ->paginate(); 
                    break;
            }
            // Usamos 'where' con 'LIKE' para buscar el término dentro de la columna 'name'.
            // También cargamos la relación 'statusProducto' con 'with()'.
            
        }

        // 3. Devolver una vista (fragmento HTML) con los resultados.
        // Esto es CRÍTICO porque tu jQuery espera HTML (`.html(response)`).
        // Necesitarás crear este archivo Blade: `resources/views/productos/search_results.blade.php`.

        
        return view('producto.item_producto', compact('productos','front'));
    }

}
