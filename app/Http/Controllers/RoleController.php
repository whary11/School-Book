<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends FatherController
{
    public function allRoles()
    {
        // $role = Role::find(1)->givePermissionTo('edit stuedent');
        return $this->responseApp(Role::with('permissions')->get(), true, []);
    }

    public function allPermissions()
    {
        return $this->responseApp(Permission::all(), true, []);
    }

    public function createRole(Request $request)
    {
        $succes = '';
        $error = "";
        DB::beginTransaction();
        try {
            //Crear rol y luego añadir los permisos
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'web'
            ]);
            $permissions = [];
            foreach ($request->permissions as $key => $value) {
                array_push($permissions, $value['name']);
            }
            $role->syncPermissions($permissions);
            $succes = true;
            DB::commit();
        } catch (\Throwable $th) {
            $succes = false;
            $error = $th->getMessage();
            DB::rollBack();
        }
        if ($succes) {
            return $this->responseApp(Role::with('permissions')->get(), true, []);
        } else {
            return $this->responseApp([], false, ['message' => $error]);
        }
    }

    public function editRole(Request $request)
    {
        $succes = '';
        DB::beginTransaction();
        try {
            //Editar el rol, y luego asignale los permisos que vienen creados
            $role = $request->name;
            $permissions = [];

            foreach ($request->permissions as $key => $value) {
                array_push($permissions, $value['name']);
            }
            // Falta actualizar el rol
            // Role::where('id', $request->id)->update([
            //     'name' => $role
            // ]);
            $role = Role::find($request->id);
            $role->syncPermissions($permissions);
            $succes = true;
            DB::commit();
        } catch (\Throwable $th) {
            $succes = false;
            $error = $th->getMessage();
            DB::rollBack();
        }
        if ($succes) {
            return $this->responseApp(Role::with('permissions')->get(), true, []);
        } else {
            return $this->responseApp([], false, []);
        }
    }
}
