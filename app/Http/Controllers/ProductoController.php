<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Unidad;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Producto::query();

        if ($request->filled('buscar')) {
            $query->where('nombre_producto', 'like', '%' . $request->buscar . '%');
        }

        if ($request->filled('categoria')) {
            $query->where('id_categoria_producto', $request->categoria);
        }
        if ($request->filled('unidad')) {
            $query->where('id_unidad_peso_producto', $request->unidad);
        }

        $porPagina = $request->input('entries', 15);
        $productos = $query->paginate($porPagina)->appends($request->query());

        if ($request->ajax()) {
            return view('admin.productos.layoutproductos.tablaproductos', compact('productos'))->render();
        }


        $categorias = Categoria::all();
        $unidades = Unidad::all();

        return view('admin.productos.index', compact('productos', 'categorias', 'unidades'));
    }


    public function create()
    {
        //
    }
    public function store(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre_producto' => 'required|string|max:20',
            'precio_producto' => 'required|numeric|min:0',
            'id_categoria_producto' => 'required|exists:categoria_producto,id_categoria_producto',
            'id_unidad_peso_producto' => 'required|exists:unidad_peso_producto,id_unidad_peso_producto',
        ]);

        $existingProduct = Producto::where('id_categoria_producto', $request->id_categoria_producto)
            ->where('id_unidad_peso_producto', $request->id_unidad_peso_producto)
            ->where('nombre_producto', $request->nombre_producto)
            ->where('id_producto', '!=', $producto->id_producto)
            ->first();

        if ($existingProduct) {
            return redirect()->route('admin.productos.index')->with('message', [
                'type' => 'error',
                'text' => 'El producto ya existe en la base de datos.'
            ]);
        } else {
            $producto = Producto::create($request->all());
            return redirect()->route('admin.productos.index')->with('message', [
                'type' => 'success',
                'text' => 'El producto se ha creado correctamente.'
            ]);
        }
    }
    public function show(Producto $producto)
    {
        return response()->json([
            'id_producto' => $producto->id_producto,
            'nombre_producto' => $producto->nombre_producto,
            'precio_producto' => $producto->precio_producto,
            'id_categoria_producto' => $producto->id_categoria_producto,
            'categoria' => $producto->categoria ? $producto->categoria->categoria : 'Sin categoría',
            'id_unidad_peso_producto' => $producto->id_unidad_peso_producto,
            'unidad' => $producto->unidad ? $producto->unidad->unidad_peso : 'Sin unidad',
        ]);
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $unidades = Unidad::all();

        return view('admin.productos.index', compact('productos', 'categorias', 'unidades'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre_producto' => 'required|string|max:20',
            'precio_producto' => 'required|numeric|min:0|max:9999999.99',
            'id_categoria_producto' => 'required|exists:categoria_producto,id_categoria_producto',
            'id_unidad_peso_producto' => 'required|exists:unidad_peso_producto,id_unidad_peso_producto',
        ]);

        $existingProduct = Producto::where('id_categoria_producto', $request->id_categoria_producto)
            ->where('id_unidad_peso_producto', $request->id_unidad_peso_producto)
            ->where('nombre_producto', $request->nombre_producto)
            ->where('id_producto', '!=', $producto->id_producto)
            ->first();

        if ($existingProduct) {
            return redirect()->route('admin.productos.index')->with('message', [
                'type' => 'error',
                'text' => 'El producto ya existe en la base de datos.'
            ]);
        } else {
            $producto->nombre_producto = $request->nombre_producto;
            $producto->precio_producto = $request->precio_producto;
            $producto->id_categoria_producto = $request->id_categoria_producto;
            $producto->id_unidad_peso_producto = $request->id_unidad_peso_producto;
            $producto->save();
            return redirect()->route('admin.productos.index')->with('message', [
                'type' => 'success',
                'text' => 'El producto se ha actualizado correctamente.'
            ]);
        }
    }

    public function destroy($id_producto)
    {
        $producto = Producto::find($id_producto);
        if (!$producto) {
            return redirect()->back()->with('message', [
                'type' => 'error',
                'text' => 'El producto no existe en la base de datos.'
            ]);
        }

        $producto->delete();

        return redirect()->back()->with('message', [
            'type' => 'success',
            'text' => 'El producto se ha eliminado correctamente.'
        ]);
    }
}
