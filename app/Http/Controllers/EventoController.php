<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Exception;

class EventoController extends Controller
{
    public function index() {
        
        try {
            $data['eventos'] = Evento::all();
            $data['res'] = true;
        } catch (Exception $ex) {
            $data['res'] = false;
            $data['info'] = 'Erro ao conectar com o banco de dados na tabela "Eventos"';
        }

        return view('welcome', ['data' => $data]);
    }
}
