<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecretController extends Controller
{
    public function index()
    {
        return $request->user()->secrets;
    }
}
