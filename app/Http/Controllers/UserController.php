<?php

namespace App\Http\Controllers;

use App\Arl;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\BloodGroup;
use App\Compensation;
use App\DocumentType;
use App\Eps;
use App\Neighborhood;
use App\Sex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class UserController extends FatherController
{
    public function getUser()
    {
        $user = User::where('id', Auth::id())->with(['permissions', 'roles'])->first();
        return  $this->responseApp($user, true, ['type' => 'success', 'content' => 'Registros consultados con éxito.']);
    }


    public function saveUser(Request $request)
    {

        $success = false;
        DB::beginTransaction();
        try {
            $responsable =  $request->responsable;
            if (!isset($responsable->created_at)) {
                //crear acudiente
                $responsable = User::create([
                    'document_type_user_id' => $responsable['documentType']['id'],
                    'document' => $responsable['document'],
                    'names' => $responsable['names'],
                    'surnames' => $responsable['surnames'],
                    'email' => $responsable['email'],
                    'phone1' => $responsable['phone1'],
                    'phone2' => (isset($responsable['phone2'])) ? $responsable['phone2'] : null,
                    'password' => Hash::make($responsable['document']),
                    'remember_token' => Str::random(10),

                ]);
            }
            //crear estudiante


            // return Carbon::parse($request->birth_date)->toDateTimeString();
            User::create([
                'document_type_user_id' => $request->documentType['id'],
                'document' => $request->document,
                'names' => $request->names,
                'surnames' => (isset($request->surnames)) ? $request->surnames : null,
                'email' => $request->email,
                'phone1' => $request->phone1,
                'phone2' => (isset($request->phone2)) ? $request->phone2 : null,
                'neighborhood_user_id' => (isset($request->neighborhood['id'])) ? $request->neighborhood['id'] : null,
                'eps_user_id' => (isset($request->eps['id'])) ? $request->eps['id'] : null,
                'sexe_user_id' => $request->sex['id'],
                'arl_user_id' => (isset($request->arl['id'])) ? $request->arl['id'] : null,
                'compensation_box_id' => (isset($request->compensation['id'])) ? $request->compensation['id'] : null,
                'blood_group_id' => (isset($request->bloodGroup['id'])) ? $request->bloodGroup['id'] : null,
                'birth_date' => (isset($request->birth_date)) ?  Carbon::parse($request->birth_date)->toDateTimeString() : null,
                'name_ref' => (isset($request->name_ref)) ? $request->name_ref : null,
                'phone_ref' => (isset($request->phone_ref)) ? $request->phone_ref : null,
                'relationship_ref' => (isset($request->relationship_ref)) ? $request->relationship_ref : null,
                'responable_user_id' => $responsable->id,
                'remember_token' => Str::random(10),
                'password' => Hash::make($request->document)
                // 'pension_user_id' => $request->sex['id'],name_ref
            ]);


            DB::commit();
            $success = true;
        } catch (\Throwable $th) {
            $success = false;
            $error = $th->getMessage();
            DB::rollBack();
        }




        if ($success) {
            return $this->responseApp([], $success, []);
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
                'documentType' => DocumentType::all()
            ],
            true,
            []
        );
    }




    public function getUsersAll()
    {
        $users = User::where('responable_user_id', '!=', null)->with(['permissions', 'roles', 'responsable'])->get();
        return  $this->responseApp($users, true, ['type' => 'success', 'content' => 'Registros consultados con éxito.']);
    }
}
