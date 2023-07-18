<?php

namespace App\Http\Controllers\EstudosLaravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstudosLaravel extends Controller
{
    public function index() {
        return view('estudos-laravel.estudos-laravel');
    }
}
