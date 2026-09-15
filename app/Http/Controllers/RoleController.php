<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $roles = Role::query();

        if ($buscar) {
            $roles->where('name', 'like', "%{$buscar}%");
        }

        $roles = $roles->paginate(10)->withQueryString();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50|unique:roles,name',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.roles.index')
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', 'modal-rol');
        }

        $role = new Role();
        $role->name = strtoupper($request->name);
        $role->save();

        return redirect()->route('admin.roles.index')->with('swal', [
            'icon' => 'success',
            'title' => '¡Creado!',
            'text' => 'Rol creado correctamente.',
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50|unique:roles,name,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.roles.index')
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', 'modal-rol-edit-' . $id);
        }

        $role = Role::findOrFail($id);
        $role->name = strtoupper($request->name);
        $role->save();

        return redirect()->route('admin.roles.index')->with('swal', [
            'icon' => 'success',
            'title' => '¡Actualizado!',
            'text' => 'Rol actualizado correctamente.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Rol eliminado correctamnente.');
    }

}
