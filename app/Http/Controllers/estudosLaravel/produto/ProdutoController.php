<?php

namespace App\Http\Controllers\estudosLaravel\produto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
	public function index() {
		$busca = request('search');

		return view('estudos-laravel.produtos', ['busca' => $busca]);
	}

	public function buscarProdutoPorId($id) {
		return view('estudos-laravel.produto', ['id' => $id]);
	}
}
