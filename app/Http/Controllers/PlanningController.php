<?php

namespace App\Http\Controllers;

use App\Degrees;
use Illuminate\Http\Request;

class PlanningController extends FatherController
{
    public function getOptions()
    {

        $degrees = Degrees::with('level')->get();

        return $this->responseApp(['degrees' => $degrees], true, []);
    }
}
