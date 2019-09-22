<?php

namespace App\Http\Controllers;

class FatherController extends Controller
{
    public function responseApp($data, $transaction, $message)
    {
        return [
            'transaction' => [
                'status' => $transaction
            ],
            'data' => $data,
            'message' => $message
        ];
    }
}
