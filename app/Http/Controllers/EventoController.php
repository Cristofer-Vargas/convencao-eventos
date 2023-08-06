<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
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

        $evento->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id) {
        
        $evento = Evento::findOrFail($id);

        return view('eventos.show', ['evento' => $evento]);
    }
}
