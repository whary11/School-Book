<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public $rol;
    public $data = [];
    public function __construct($rol)
    {
        $this->rol = $rol;
    }

    // public function sheets(): array
    // {
    //     $first = new FirstSheetImport($this->rol);
    //     return [
    //         0 => $first,
    //     ];
    // }

    public function model(array $row)
    {
        array_push($this->data, $row);
        // return $row;
        // $documentType = DocumentType::whereName($row[0])->first();
        // $sex = Sex::whereName($row['sexo'])->first();
        // $neighborhood = Neighborhood::whereName($row['barrio'])->first();
        // return User::create([
        //     'document_type_user_id' => $documentType['id'],
        //     'document' => $row['documento'],
        //     'names' => $row['nombres'],
        //     'surnames' => $row['apellidos'],
        //     'email' => $row['email'],
        //     'address' => $row['direccion'],
        //     'phone1' => $row['telefono'],
        //     'sexe_user_id' => $sex['id'],
        //     'neighborhood_user_id' => $neighborhood['id'],
        //     'password' => Hash::make($row['documento']),
        //     'remember_token' => Str::random(10),
        // ]);
    }
}
