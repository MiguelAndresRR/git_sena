<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('buscar')) {
            $query->where('user', 'like', '%' . $request->buscar . '%');
        }

        $porPagina = $request->input('entries', 15);
        $usuarios = $query->paginate($porPagina)->appends($request->query());

        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        //
    }
    public function store(Request $request, Usuario $usuario)
    {
        $request->validate([
            // 'nombre_producto' => 'required|string|max:20',
            // 'precio_producto' => 'required|numeric|min:0',
            // 'id_categoria_producto' => 'required|exists:categoria_producto,id_categoria_producto',
            // 'id_unidad_peso_producto' => 'required|exists:unidad_peso_producto,id_unidad_peso_producto',
            'user' => 'required|string|min:5|max:50',
            'password' => 'required|string|', //necesito que me registre con minimo una Mayuscula, 3 numeros y un caracter especial 
            'documento_usuario' => 'required|numeric|min:0|max:10',
            'telefono_usuario' => 'required|numeric|max:10',
            'nombre_usuario' => 'required|string|max:50',
            'apellido_usuario' => 'required|string|max.50',
            'correo_usuario' => 'required|string|max:100' //necesito mirar que me registre con @ o .
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
        // return response()->json([
        //     'id_producto' => $producto->id_producto,
        //     'nombre_producto' => $producto->nombre_producto,
        //     'precio_producto' => $producto->precio_producto,
        //     'id_categoria_producto' => $producto->id_categoria_producto,
        //     'categoria' => $producto->categoria ? $producto->categoria->categoria : 'Sin categoría',
        //     'id_unidad_peso_producto' => $producto->id_unidad_peso_producto,
        //     'unidad' => $producto->unidad ? $producto->unidad->unidad_peso : 'Sin unidad',
        // ]);
    }

    public function edit(Producto $producto)
    {
        // $categorias = Categoria::all();
        // $unidades = Unidad::all();

        // return view('admin.productos.index', compact('productos', 'categorias', 'unidades'));
    }

    public function update(Request $request, Producto $producto)
    {
        // $request->validate([
        //     'nombre_producto' => 'required|string|max:20',
        //     'precio_producto' => 'required|numeric|min:0',
        //     'id_categoria_producto' => 'required|exists:categoria_producto,id_categoria_producto',
        //     'id_unidad_peso_producto' => 'required|exists:unidad_peso_producto,id_unidad_peso_producto',
        // ]);

        // $existingProduct = Producto::where('id_categoria_producto', $request->id_categoria_producto)
        //     ->where('id_unidad_peso_producto', $request->id_unidad_peso_producto)
        //     ->where('nombre_producto', $request->nombre_producto)
        //     ->where('id_producto', '!=', $producto->id_producto)
        //     ->first();

        // if ($existingProduct) {
        //     return redirect()->route('admin.productos.index')->with('message', [
        //         'type' => 'error',
        //         'text' => 'El producto ya existe en la base de datos.'
        //     ]);
        // } else {
        //     $producto->nombre_producto = $request->nombre_producto;
        //     $producto->precio_producto = $request->precio_producto;
        //     $producto->id_categoria_producto = $request->id_categoria_producto;
        //     $producto->id_unidad_peso_producto = $request->id_unidad_peso_producto;
        //     $producto->save();
        //     return redirect()->route('admin.productos.index')->with('message', [
        //         'type' => 'success',
        //         'text' => 'El producto se ha actualizado correctamente.'
        //     ]);
        // }
    }

    public function destroy($id_usuario)
    {
        $usuario = Producto::find($id_usuario);
        if (!$usuario) {
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
