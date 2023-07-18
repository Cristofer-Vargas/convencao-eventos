@extends('layouts.main')

@section('title', 'Estudos Laravel')
@section('content-main')

  <article class="estudos-content-main markdown-body">
    <section>

      <h1>Estudos de Laravel</h1>

      <p>Ducumentação dos estudos...</p>
      <a href="/">Página Inicial</a>

      <h2>Parâmetros nas rotas</h2>

      <ul>
        <li>Podemos mudar como a view nos responde, adicionando parâmetros em uma rota</li>
        <li>Ao definir a rota, devemos colocar o parâmetro desta maneira: <code>&#123;id&#125;</code></li>
        <li>Podemos ter parâmetros opcionais adicionando um <code>?</code></li>
        <li>O Laravel também aceita <code>query paramenters</code>, utilizando a seguinte sintaxe:
          <code>?nome=TextName&idade=27</code>
        </li>
      </ul>

      <h3>Parâmtros obrigatórios</h3>

      <p>
        Em nossa aplicação podemos possuir rotas, onde os parâmetros deverão ser consedidos obrigatoriamente.
        Para que os parâmetros sejam devidamente fornecidos para que a página funcione, usamos
        da seguinte sintaxe no arquivo de rotas ( <code>/resources/routes/web.php</code> ):
      </p>

      <h4>~/web.php</h4>

      <pre>
Route::get('/produto/&#123;/id&#125;', function ($id) &#123;/
	return view('produto', ['id' => $id]);
&#125;);
</pre>

      <p>
        Desta forma, se usarmos a rota <code>/produto/</code>, onde teremos que obrigatoriamente
        informarmos um <code>id</code>, caso contrário, a <code>view</code> não retornará devidamente.
      </p>

      <p>
        E para recebermos esse parâmetro da URL na view, podemos fazer simplesmente com se fosse um dado
        normal passando da rota para a view da seguinte forma:
      </p>

      <h4>~/produto.blade.php</h4>

      <pre>
&lt;h2&gt; Produto de ID :: &#123;&#123; $id &#125;&#125; &lt;/h2&gt;
</pre>

      <h3>Parâmetro Opcional</h3>

      <p>
        Podemos definir uma URL de forma que possa receber ou não um parâmetro de entrada, como por exemplo,
        estabelecermos um <code>id</code> padrão caso não seja passado nada na <code>URL</code>, ou, como
        exemplicarei, será atribuido como <code>null</code> e se realmente não for passado um <code>id</code>
        como parâmetro, ele resultará em um conteúdo diferente dentro da página.
      </p>

      <h4>~/web.php</h4>

      <pre>
Route::get('/produto/&#123;id?&#125;', function ($id = null) &#123;
	return view('produto', ['id' => $id]);
&#125;);
</pre>

      <h4>~/produto.blade.php</h4>

      <pre>
&#64;if ($id != null)
	&#64;section('title', 'Produto &#123;&#123; $id &#125;&#125;')
	&lt;h2>Produto de ID :: &#123;&#123; $id &#125;&#125;&lt;/h2>

&#64;else
	&#64;section('title', 'Produto Não Encontrado!')
	&lt;h2>	Produto não informado! &lt;/h2>

	&lt;p> Informe um produto na URL da requisição. Exemplo:&lt;/p>

	&lt;pre>
	~/produto/2
	&lt;/pre>

&#64;endif
</pre>

      <h3>Query String</h3>

      <p>
        Está é uma forma muito comum e muito usada em qualquer aplicação WEB. Usando <code>Query String</code>
        podemos informar mais de um parâmetro na mesma requisição na <code>URL</code>. Seguimos um exemplo
        de <code>URL</code> e seguir o código:
        <code>/produtos/?search=Samsung</code>
      </p>

      <h4>~/web.php</h4>

      <pre>
Route::get('/produtos', function () &#123;

  $busca = request('search');

  return view('produtos', ['busca' => $busca]);
&#125;);
</pre>

      <h4>~/produtos.blade.php</h4>

      <pre>
&lt;h2>Tela dos Produtos&lt;/h2>

&#64;if($busca != '')
  &lt;p>Usuário buscando por: &#123;&#123; $busca &#125;&#125;&lt;/p>
&#64;endif
</pre>

      <h2>Controllers</h2>

      <p>
        O objetivo dos controllers é fazer o "meio campo" entre as <code>views</code> e o <code>banco de dados</code>,
        podendo preparar as views com os dados provenientes do banco de dados, sejam eles tratados ou uma resposta de erro
        ou maneira distinta de mostrar os dados dependendo do resultado.
      </p>

      <ul>
        <li>Os controllers servem para gerir toda a parte da <code>lógica</code> da página</li>
        <li>Tem o papel de enviar e esperar resposta do banco de dados</li>
        <li>Também receber e enviar resposta para a view</li>
        <li>Os controllers podem ser criados via <code>Artisan</code></li>
        <li>É comum retornar uma view ou redirecionar para uma URL pelo Controller</li>
      </ul>

      <p>
        Primeiramente, devemos percebemos que a maneira como estávamos fazendo anteriormente no arquivo de rotas, é
        tecnicamente inadequado, pois estávamos mexendo com dados e valores diretamente no arquivo de rotas. Agora
        iremos reescrever uma das rotas para exemplificar melhor
      </p>

      <p>
        Temos o seguinte exemplo:
      </p>

      <pre>
Route::get('/produtos', function () &#123;

  $produtos = [
    'camisa',
    'jaqueta',
    'tenis all-stars',
    'regata',
    'camisa polo'
  ]

  return view('produtos', ['produtos' => $produtos]);
&#125;);
</pre>

      <p>
        Desta forma poderíamos capturar facilmente na nossa <code>view</code>, os dados passados, usando um:
        <code>&#123;&#123; $produtos &#125;&#125;</code>
      </p>

      <p>
        Esta forma de fazer é o incorreto, se seguirmos a ideia de MVC do Laravel, devemos separarmos a camada de lógica
        e dados da aplicação, ou seja, deixar como responssabilidade do Controller para receber e gerenciar os dados.
      </p>

      <p>
        Para tratarmos com controllers, podemos começar usando o <code>Artisan</code> do Laravel e criar um controller
        que por convenção, se chamará <code>ProdutoController</code>, que fará parte hierarquicamente dos
        demais controllers no arquivo <code>/App/Http/Controllers</code>.
        Porém neste caso para exemplificação e organização será criado sub-pastas usando o seguinte comando no console:
      </p>

      <pre>
php artisan make:controller estudosLaravel/produto/ProdutoController
</pre>

      <p>
        Então teremos a Seguinte classe criada:
      </p>

      <h4>~/ProdutoController.php</h4>

      <pre>
&lt;?php

namespace App\Http\Controllers\estudosLaravel\produto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdutoController extends Controller
&#123;
  public function index() &#123;
    $busca = request('search');

    return view('estudos-laravel.produtos', ['busca' => $busca]);
  &#125;
&#125;
</pre>

      <p>
        Percebe-se que agora tendo o controller separado do arquivo de rotas, devemos estabelecer quaisquer regra lógica
        neste controller. Assim no arquivo de rotas, devemos importar o controller
        ( <code>use App\Http\Controllers\estudosLaravel\produto\ProdutoController;</code> ) e usa-lo da seguinte forma:
      </p>

      <h4>~/web.php</h4>

      <pre>
Route::get('/estudos-laravel/produtos', [ProdutoController::class, 'index']);
</pre>

      <p>
        Obedecendo que será passado como parâmetro do <code>get()</code>, o caminho, e posteriormente um array, contendo
        a classe do controller a ser usado, e o nome da função responsável por aquela rota.
      </p>

      <h2>Conexão com Banco de dados MySQL</h2>

      <ul>
        <li>A conexão do Laravel co o banco é configurada pelo arquivo <code>.env</code></li>
        <li>Desta forma, nos dá mais liberdade e segurança para a aplicação</li>
        <li>O Laravel utiliza um <code>ORM</code> (Object-Relational Mapping) chamada <code>Eloquent</code></li>
        <li>E também para a criação de tabelas, as <code>migrations</code></li>
      </ul>

      <p>
        
      </p>

    </section>
  </article>

@endsection
