<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\StatusProducto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ProductoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
        // Iniciar una transacción de base de datos para asegurar la atomicidad
        // Si algo falla (DB o archivo), todo se revierte.
        DB::beginTransaction();
        try {
            $request->validated();
            $producto = $request->all();

            if($imagenProductoForm = $request->file('imagen_producto')){
                $rutaGuardar = 'imagenes/';
                $nombreImagenProducto = date('YmdHis').".".$imagenProductoForm->getClientOriginalExtension();
                
                $producto['imagen_producto'] = $nombreImagenProducto;
            }else {
                $producto['imagen_producto'] = 'producto-generico.webp';
            }
            if (Producto::create($producto)) {
                $imagenProductoForm->move($rutaGuardar,$nombreImagenProducto);
            }

             // 4. Confirmar la transacción si todas las operaciones fueron exitosas
            DB::commit();

            Log::info("Producto actualizado exitosamente.");
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors(['error' => $th->getMessage()]);
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
        try {
            $producto = Producto::find($id);
            $status_productos = StatusProducto::All();
        } catch (\Throwable $th) {
             return back()->withErrors(['error' => $th->getMessage()]);
        }
        

        return view('producto.edit', compact('producto','status_productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, Producto $producto): RedirectResponse
    {
        // Iniciar una transacción de base de datos para asegurar la atomicidad
        // Si algo falla (DB o archivo), todo se revierte.
        DB::beginTransaction();

        try {
            // Validar los datos del formulario y obtener solo los datos validados
            $validatedData = $request->validated();
            Log::info('Datos validados para actualización:', $validatedData);

            // Manejo de la imagen del producto
            if ($request->hasFile('imagen_producto')) {
                $imagenProductoForm = $request->file('imagen_producto');
                $rutaGuardar = 'imagenes/'; // Ruta relativa a 'public'
                $nombreImagenProducto = date('YmdHis') . "." . $imagenProductoForm->getClientOriginalExtension();

                // Almacenar el nuevo nombre de la imagen en los datos validados
                $validatedData['imagen_producto'] = $nombreImagenProducto;

                // 1. Eliminar la imagen antigua si existe y si no es la imagen por defecto
                // Asegúrate de que 'producto-generico.webp' es tu imagen por defecto y no debe ser borrada.
                if ($producto->imagen_producto && $producto->imagen_producto != 'producto-generico.webp') {
                    $oldImagePath = public_path('imagenes/' . $producto->imagen_producto);
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                        Log::info('Imagen antigua eliminada: ' . $oldImagePath);
                    } else {
                        Log::warning('Imagen antigua no encontrada para eliminar: ' . $oldImagePath);
                    }
                }

                // 2. Mover la nueva imagen al disco
                $imagenProductoForm->move(public_path($rutaGuardar), $nombreImagenProducto);
                Log::info('Nueva imagen subida: ' . $nombreImagenProducto);

            } else {
                //si no tiene imagen desde el formulario, se deja la misma que estaba guardada
                 if (!isset($validatedData['imagen_producto'])) { 
                     $validatedData['imagen_producto'] = $producto->imagen_producto; 
                 }
                 
            }

            // 3. Actualizar el registro del producto en la base de datos
            // El método update() en el modelo $producto (ya una instancia) utiliza los datos validados.
            $producto->update($validatedData);

            // 4. Confirmar la transacción si todas las operaciones fueron exitosas
            DB::commit();

            Log::info('Producto actualizado exitosamente.', ['producto_id' => $producto->id]);

            // Redirigir al índice de productos con un mensaje de éxito
            return Redirect::route('productos.index')
                ->with('success', 'Producto actualizado exitosamente.');

        } catch (\Exception $e) { // Capturar cualquier tipo de excepción
            // Revertir la transacción si ocurre un error
            DB::rollBack();
            Log::error('Error al actualizar producto: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all() // Incluir datos del request para depuración
            ]);

            // Redirigir de vuelta con un mensaje de error y mantener los datos de entrada
            return back()->withInput()->with('error', 'Error al actualizar producto: ' . $e->getMessage());
        }
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

        try {
            $searchTerm = $request->input('term');
            $front = $request->front;
            
            if (empty($searchTerm)) {
                $productos = collect(); 
            } else {
                switch ($front) {
                    case 'productos':
                        $productos = Producto::with('statusProducto')
                                    ->where(function ($query) use ($searchTerm) { // <--- ¡Esto agrupa las condiciones OR!
                                        $query->where('productos.codigo_producto', 'LIKE', '%' . $searchTerm . '%')
                                        ->orWhere('productos.descripcion_producto', 'LIKE', '%' . $searchTerm . '%');
                                    })->get();  
                        break;
                    
                    case 'facturas':
                    $productos = Producto::with('statusProducto')
                                    ->where('productos.id_status_producto', 1)
                                    ->where(function ($query) use ($searchTerm) { // <--- ¡Esto agrupa las condiciones OR!
                                        $query->where('productos.codigo_producto', 'LIKE', '%' . $searchTerm . '%')
                                        ->orWhere('productos.descripcion_producto', 'LIKE', '%' . $searchTerm . '%');
                                    })
                                    ->get(); 
                        break;
                }

                
            }
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => $th->getMessage()]);
        }
   
        return view('producto.item_producto', compact('productos','front'));
    }

}
