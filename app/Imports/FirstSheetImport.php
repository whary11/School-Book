<?php

namespace App\Imports;

use App\DocumentType;
use App\Neighborhood;
use App\Sex;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;


class FirstSheetImport implements ToCollection, WithHeadingRow
{
    public $data = [];
    public $newRol = [];
    public function __construct($rol)
    {
        $this->newRol = $rol;
    }
    public function collection(Collection $rows)
    {
        set_time_limit(300);

        $this->data = $rows;
        $success = false;
        $error = "";
        DB::beginTransaction();
        try {
            foreach ($rows as $key => $row) {
                # code...
                $documentType = DocumentType::whereName($row['tipo_documento'])->first();
                $sex = Sex::whereName($row['sexo'])->first();
                $neighborhood = Neighborhood::whereName($row['barrio'])->first();
                User::create([
                    'document_type_user_id' => $documentType['id'],
                    'document' => $row['documento'],
                    'naes' => $row['nombres'],
                    'surnames' => $row['apellidos'],
                    'email' => $row['email'],
                    'address' => $row['direccion'],
                    'phone1' => $row['telefono'],
                    'sexe_user_id' => $sex['id'],
                    'neighborhood_user_id' => $neighborhood['id'],
                    'password' => Hash::make($row['documento']),
                    'remember_token' => Str::random(10),
                ])->assignRole($this->newRol);
            }
            DB::commit();
            $success = true;
        } catch (\Throwable $th) {
            $success = false;
            $error = $th->getMessage();
            DB::rollBack();
        }


        if ($success) {
            return true;
        } else {
            return $error;
        }
    }
}
