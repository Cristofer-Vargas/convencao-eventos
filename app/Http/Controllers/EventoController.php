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

    public function create() {
        return view('eventos\create');
    }

    public function store(Request $request) {
        $evento = new Evento;

        $evento->titulo = $request->titulo;
        $evento->cidade = $request->cidade;
        $evento->descricao = $request->descricao;
        $evento->privado = $request->privado;

        $evento->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }
}
