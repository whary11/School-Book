<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Degrees;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MatriculaController extends FatherController
{
    public function getOptions()
    {
        $degrees = Degrees::with('level')->get();
        $years = [
            Carbon::now()->format('Y'),
            Carbon::now()->addYear(1)->format('Y')

        ];

        return $this->responseApp(['degrees' => $degrees, 'years' => $years], true, []);
    }

    public function getStudents($year, $degree)
    {
        $student_year = User::with(['roles', 'document_type', 'degree'])->whereHas('roles', function ($q) {
            $q->whereName('STUDENT');
        })
            ->whereHas('degree', function ($q) use ($year, $degree) {
                $q->where('school_year', $year - 1);
                $q->whereNotIn('status_id', [2]);
                $q->orWhere('name', '>=', $degree);
                $q->orWhere('name', '<', $degree - 1);
            })
            ->pluck('id');

        $students = User::with(['roles', 'document_type', 'degree'])
            ->whereNotIn('id', $student_year)
            ->whereHas('roles', function ($q) {
                $q->whereName('STUDENT');
            })->get();
        return $this->responseApp($students, true, []);
    }

    public function assignStudentDegrees(Request $request)
    {
        DB::beginTransaction();
        try {
            $degrees = Degrees::find($request->degrees['id']);
            foreach ($request->details as $key => $user) {
                $degrees->users()->attach($user['id'], [
                    'school_year' => $request->year,
                    'status_id' => 1 // en curso
                ]);
            }
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
        return $request;
    }
}
