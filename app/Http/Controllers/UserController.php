<?php

namespace App\Http\Controllers;

use App\Arl;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\BloodGroup;
use App\Compensation;
use App\DocumentType;
use App\Eps;
use App\Imports\UsersImport;
use App\Neighborhood;
use App\Sex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends FatherController
{
    public function getUser()
    {
        $user = User::where('id', Auth::id())->with(['permissions', 'roles.permissions'])->first();
        return  $this->responseApp($user, true, ['type' => 'success', 'content' => 'Registros consultados con éxito.']);
    }


    public function saveUser(Request $request)
    {

        $request->validate([
            'document' => 'required|unique:users',
            'email' => 'required|unique:users',
        ]);
        $success = false;
        DB::beginTransaction();
        try {
            $responsable =  $request->responsable;
            // return  json_encode(empty($responsable));
            if (isset($responsable['email']) && !isset($responsable['created_at']) && $request->newRol == 'STUDENT') {
                //crear acudiente
                $responsable = User::create([
                    'document_type_user_id' => $responsable['document_type']['id'],
                    'document' => $responsable['document'],
                    'names' => $responsable['names'],
                    'surnames' => $responsable['surnames'],
                    'email' => $responsable['email'],
                    'phone1' => $responsable['phone1'],
                    'phone2' => (isset($responsable['phone2'])) ? $responsable['phone2'] : null,
                    'password' => Hash::make($responsable['document']),
                    'remember_token' => Str::random(10),

                ])->assignRole('RESPONSABLE');
            }
            //crear estudiante
            User::create([
                'document_type_user_id' => $request->document_type['id'],
                'document' => $request->document,
                'names' => $request->names,
                'address' => $request->address,
                'surnames' => (isset($request->surnames)) ? $request->surnames : null,
                'email' => $request->email,
                'phone1' => $request->phone1,
                'phone2' => (isset($request->phone2)) ? $request->phone2 : null,
                'neighborhood_user_id' => (isset($request->neighborhood['id'])) ? $request->neighborhood['id'] : null,
                'eps_user_id' => (isset($request->eps['id'])) ? $request->eps['id'] : null,
                'sexe_user_id' => $request->sex['id'],
                'arl_user_id' => (isset($request->arl['id'])) ? $request->arl['id'] : null,
                'compensation_box_id' => (isset($request->compensation['id'])) ? $request->compensation['id'] : null,
                'blood_group_id' => (isset($request->blood_group['id'])) ? $request->blood_group['id'] : null,
                'birth_date' => (isset($request->birth_date)) ?  Carbon::parse($request->birth_date)->toDateTimeString() : null,
                'name_ref' => (isset($request->name_ref)) ? $request->name_ref : null,
                'phone_ref' => (isset($request->phone_ref)) ? $request->phone_ref : null,
                'relationship_ref' => (isset($request->relationship_ref)) ? $request->relationship_ref : null,
                'responable_user_id' => empty($responsable) ? null : $responsable['id'],
                'remember_token' => Str::random(10),
                'password' => Hash::make($request->document)
                // 'pension_user_id' => $request->sex['id'],name_ref
            ])->assignRole($request->newRol);

            DB::commit();
            $success = true;
        } catch (\Throwable $th) {
            $success = false;
            $error = $th->getMessage();
            DB::rollBack();
        }

        if ($success) {
            return $this->responseApp($this->getUsersAll($request->newRol)['data'], $success, []);
        } else {
            return $this->responseApp([], $success, ['type' => 'error', 'content' => $error]);
        }
    }


    public function editUsers(Request $request)
    {



        $request->validate([
            'document' => 'required|unique:users,document,' . $request->id,
            'email' => 'required|unique:users,email,' . $request->id,
        ]);

        $success = false;
        DB::beginTransaction();
        try {




            $responsable =  $request->responsable;
            if (isset($responsable['email']) && !isset($responsable['created_at']) && $request->newRol == 'STUDENT') {
                //crear acudiente
                $responsable = User::create([
                    'document_type_user_id' => $responsable['document_type']['id'],
                    'document' => $responsable['document'],
                    'names' => $responsable['names'],
                    'surnames' => $responsable['surnames'],
                    'email' => $responsable['email'],
                    'phone1' => $responsable['phone1'],
                    'phone2' => (isset($responsable['phone2'])) ? $responsable['phone2'] : null,
                    'password' => Hash::make($responsable['document']),
                    'remember_token' => Str::random(10),
                ])->assignRole('RESPONSABLE');
            }
            User::where('id', $request->id)->update([
                'document_type_user_id' => $request->document_type['id'],
                'document' => $request->document,
                'names' => $request->names,
                'address' => $request->address,
                'surnames' => (isset($request->surnames)) ? $request->surnames : null,
                'email' => $request->email,
                'phone1' => $request->phone1,
                'phone2' => (isset($request->phone2)) ? $request->phone2 : null,
                'neighborhood_user_id' => (isset($request->neighborhood['id'])) ? $request->neighborhood['id'] : null,
                'eps_user_id' => (isset($request->eps['id'])) ? $request->eps['id'] : null,
                'sexe_user_id' => $request->sex['id'],
                'arl_user_id' => (isset($request->arl['id'])) ? $request->arl['id'] : null,
                'compensation_box_id' => (isset($request->compensation['id'])) ? $request->compensation['id'] : null,
                'blood_group_id' => (isset($request->blood_group['id'])) ? $request->blood_group['id'] : null,
                'birth_date' => (isset($request->birth_date)) ?  Carbon::parse($request->birth_date)->toDateTimeString() : null,
                'name_ref' => (isset($request->name_ref)) ? $request->name_ref : null,
                'phone_ref' => (isset($request->phone_ref)) ? $request->phone_ref : null,
                'relationship_ref' => (isset($request->relationship_ref)) ? $request->relationship_ref : null,
                'responable_user_id' => empty($responsable) ? null : $responsable['id'],
                'remember_token' => Str::random(10),
                'password' => Hash::make($request->document)
            ]);
            DB::commit();
            $success = true;
        } catch (\Throwable $th) {
            $success = false;
            $error = $th->getMessage();
            DB::rollBack();
        }

        if ($success) {
            return $this->responseApp($this->getUsersAll($request->newRol)['data'], $success, []);
        } else {
            return $this->responseApp([], $success, ['type' => 'error', 'content' => $error]);
        }
    }
    public function changeState($user_id, $newState, $rol)
    {
        $success = false;
        DB::beginTransaction();
        try {
            User::whereId($user_id)->update(['is_active'  => $newState]);
            DB::commit();
            $success = true;
        } catch (\Throwable $th) {
            $success = false;
            $error = $th->getMessage();
            DB::rollBack();
        }

        if ($success) {
            return $this->responseApp($this->getUsersAll($rol)['data'], $success, []);
        } else {
            return $this->responseApp([], $success, ['type' => 'error', 'content' => $error]);
        }
    }

    public function getComplements()
    {
        return $this->responseApp(
            [
                'arl' => Arl::all(),
                'bloodGroup' => BloodGroup::all(),
                'compensation' => Compensation::all(),
                'eps' => Eps::all(),
                'neighborhood' => Neighborhood::all(),
                'sex' => Sex::all(),
                'documentType' => DocumentType::all(),
                'responsables' => User::with(['roles', 'document_type'])->whereHas('roles', function ($q) {
                    $q->whereName('RESPONSABLE');
                })->get()
            ],
            true,
            []
        );
    }




    public function getUsersAll($rol)
    {
        $users = User::with(['permissions', 'roles', 'responsable.document_type', 'sex', 'document_type', 'neighborhood', 'eps', 'blood_group', 'arl', 'compensation'])->whereHas('roles', function ($q) use ($rol) {
            $q->whereName($rol);
        })->get();

        return  $this->responseApp($users, true, ['type' => 'success', 'content' => 'Registros consultados con éxito.']);
    }

    public function importUsers(Request $request)
    {
        set_time_limit(300);
        $success = false;
        DB::beginTransaction();
        try {
            $import = new UsersImport($request->rol);
            // $import->onlySheets('Hoja 1');
            Excel::import($import, $request->file);
            // return $import->data;




            foreach ($import->data as $key => $row) {


                if (isset($row['documento'])) {
                    # code...
                    $documentType = DocumentType::whereName($row['tipo_documento'])->first();
                    $sex = Sex::whereName($row['sexo'])->first();
                    $neighborhood = Neighborhood::whereName($row['barrio'])->first();
                    User::create([
                        'document_type_user_id' => $documentType['id'],
                        'document' => $row['documento'],
                        'names' => $row['nombres'],
                        'surnames' => $row['apellidos'],
                        'email' => $row['email'],
                        'address' => $row['direccion'],
                        'phone1' => $row['telefono'],
                        'sexe_user_id' => $sex['id'],
                        'neighborhood_user_id' => $neighborhood['id'],
                        'password' => Hash::make($row['documento']),
                        'remember_token' => Str::random(10),
                    ])->assignRole($request->rol);
                }
                # code...
            }



            DB::commit();
            $success = true;
        } catch (\Throwable $th) {
            $success = false;
            $error = $th->getMessage();
            DB::rollBack();
        }

        if ($success) {
            return $this->responseApp($this->getUsersAll($request->rol)['data'], $success, []);
        } else {
            return $this->responseApp([], $success, ['type' => 'error', 'content' => $error]);
        }
    }
}
