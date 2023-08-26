<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\User;
use Exception;

class EventoController extends Controller
{
    public function index(Request $request) {
        
        try {

            if (!empty($request)) {
                $busca = $request->busca;
                $data['eventos'] = Evento::where([
                    ['titulo', 'like', '%'.$busca.'%']
                ])->get();
                $data['busca'] = true;
                $data['textBusca'] = $busca;
            } else {
                $data['eventos'] = Evento::all();
            }
            $data['res'] = true;
        } catch (Exception $ex) {
            $data['res'] = false;
            $data['info'] = 'Erro ao conectar com o banco de dados';
        }

        return view('welcome', ['data' => $data]);
    }

    public function create() {
        return view('eventos.create');
    }

    public function store(Request $request) {
        $evento = new Evento;

        $evento->titulo = $request->titulo;
        $evento->data = $request->data;
        $evento->cidade = $request->cidade;
        $evento->descricao = $request->descricao;
        $evento->privado = $request->privado;
        $evento->items = $request->items;

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requestImage = $request->imagem;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('imgs/eventos'), $imageName);
            $evento->imagem = $imageName;
        }

        $usuario = auth()->user();
        $evento->user_id = $usuario->id;
        $evento->save();
        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id) {
        $evento = Evento::findOrFail($id);
        $usuario = User::where('id', $evento->user_id)->first();
        $asParticipant = null;
        if (auth()->user()) {
            $usuarioParticipante = auth()->user();

            if ($usuarioParticipante->eventosComParticipantes()->wherePivot('evento_id', $id)->exists()) {
                $btn = 'Cancelar presença';
                $asParticipant = 'Sua presença está confirmada!';
            } else {
                $btn = 'Confirmar presença';
            }

        } else {
            $btn = 'Confirmar presença';
        }
        return view('eventos.show', ['evento' => $evento, 'user' => $usuario, 'btn' => $btn, 'asParticipant' => $asParticipant]);
    }

    public function dashboard() {
        $usuario = auth()->user();
        $eventos = $usuario->eventos;
        return view('eventos.dashboard', ['eventos' => $eventos]);
    }

    public function destroy($id) {
        Evento::findOrFail($id)->delete();
        return redirect('/dashboard')->with('msg', 'Evento Excluído com sucesso!');
    }

    public function edit($id) {
        $evento = Evento::findOrFail($id);
        return view('eventos.edit', ['evento' => $evento]);
    }

    public function update(Request $request) {

        $data = $request->all();
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requestImage = $request->imagem;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
            $requestImage->move(public_path('imgs/eventos'), $imageName);
            $data['imagem'] = $imageName;
        }

        Evento::findOrFail($request->id)->update($data);
        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');
    }

    public function entrarEvento($id) {
        $usuario = auth()->user();
        $evento = Evento::findOrFail($id);

        if ($usuario->eventosComParticipantes()->wherePivot('evento_id', $id)->exists()) {
            $msg = 'Presença cancelada em ' . $evento->titulo;
        } else {
            $msg = 'Presença confirmada em ' . $evento->titulo;
        }
        $usuario->eventosComParticipantes()->toggle($id);

        return redirect('/dashboard')->with('msg', $msg);
    }

};