<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends FatherController
{


    public function allRoles()
    {
        return $this->responseApp(Role::with('permissions')->get(), true, []);
    }

    public function allUsers()
    {
        return $this->responseApp(User::with(['permissions'])->get(), true, []);
    }

    public function allPermissions()
    {
        return $this->responseApp(Permission::all(), true, []);
    }

    public function assignPermissionsToUser(Request $request)
    {
        // return $request;
        $succes = '';
        $error = "";
        DB::beginTransaction();
        try {
            $user = User::find($request->id);
            $user->syncPermissions($request->permissions);
            $succes = true;
            DB::commit();
        } catch (\Throwable $th) {
            $succes = false;
            $error = $th->getMessage();
            DB::rollBack();
        }
        if ($succes) {
            return $this->responseApp(User::with('permissions')->get(), true, []);
        } else {
            return $this->responseApp([], false, ['message' => $error]);
        }
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
        $error = "";
        DB::beginTransaction();
        try {
            //Editar el rol, y luego asignale los permisos que vienen creados
            $role = $request->name;
            // $permissions = [];

            // foreach ($request->permissions as $key => $value) {
            //     array_push($permissions, $value['name']);
            // }
            // Falta actualizar el rol
            // Role::where('id', $request->id)->update([
            //     'name' => $role
            // ]);
            $role = Role::find($request->id);
            $role->syncPermissions($request->permissions);
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
            return $this->responseApp($error, false, []);
        }
    }
}
