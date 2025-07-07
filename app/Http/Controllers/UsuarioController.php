<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;

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

        $roles = Rol::all();
        return view('admin.usuarios.index', compact('usuarios','roles'));
    }

    public function create()
    {
        //
    }
    public function store(Request $request, User $usuario)
    {
        $request->validate([
            'user' => 'required|string|min:5|max:50',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=(?:.*\d){3,})(?=.*[!@#$%^&*()_\-+=\[\]{};:\'",.<>\/?\\|`~]).+$/'
            ],
            'documento_usuario' => 'required|digits_between:6,10',
            'telefono_usuario' => 'required|digits_between:6,10',
            'nombre_usuario' => 'required|string|max:50',
            'apellido_usuario' => 'required|string|max:50',
            'correo_usuario' => 'required|string|email|max:100',
            'id_rol' => 'required|exists:rol,id_rol'
        ]);

        $request->merge([
            'password' => Hash::make($request->password)
        ]);

        $existingUsuario = User::where('id_rol', $request->id_rol)
            ->where('documento_usuario', $request->documento_usuario)
            ->where('telefono_usuario', $request->telefono_usuario)
            ->where('correo_usuario', $request->correo_usuario)
            ->where('user', $request->user)
            ->where('id_usuario', '!=', $usuario->id_usuario)
            ->first();

        if ($existingUsuario) {
            return redirect()->route('admin.usuarios.index')->with('message', [
                'type' => 'error',
                'text' => 'El usuario ya existe en la base de datos.'
            ]);
        } else {
            $usuario = User::create($request->all());
            return redirect()->route('admin.usuarios.index')->with('message', [
                'type' => 'success',
                'text' => 'El usuario se ha creado correctamente.'
            ]);
        }
    }
    public function show(User $usuario)
    {
        return response()->json([
            'nombre_usuario' => $usuario->nombre_usuario,
            'apellido_usuario' => $usuario->apellido_usuario,
            'documento_usuario' => $usuario->documento_usuario,
            'telefono_usuario' => $usuario->telefono_usuario,
            'correo_usuario' => $usuario->correo_usuario,
            'user' => $usuario->user,
            'password' => $usuario->password,
            'id_rol' => $usuario->id_rol,
            'nombre_rol' => $usuario->rol ? $usuario->rol->nombre_rol : 'Sin categoría'
        ]);
    }

    public function edit(User $usuarios)
    {
        $usuarios = User::all();
        $roles = Rol::all();

        return view('admin.usuarios.index', compact('usuarios', 'roles'));
    }

    public function update(Request $request, User $producto)
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
        $usuario = User::find($id_usuario);
        if (!$usuario) {
            return redirect()->back()->with('message', [
                'type' => 'error',
                'text' => 'El usuario no existe en la base de datos.'
            ]);
        }

        $usuario->delete();

        return redirect()->back()->with('message', [
            'type' => 'success',
            'text' => 'El usuario se ha eliminado correctamente.'
        ]);
    }
}
