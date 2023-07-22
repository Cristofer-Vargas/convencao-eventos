@extends('layouts.main')

@section('title', 'Estudos Laravel')
@section('styles')
  @vite(['resources/scss/estudos-laravel.scss'])
@endsection

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


      <h3>Migrations #1</h3>

      <ul>
        <li>As <code>migrations</code> funcionam como um versionamento de banco de dados</li>
        <li>Podemos <code>avançar</code> e <code>retroceder</code> a qualquer momento</li>
        <li>Adicionar colunas e remover de forma facilitada</li>
        <li>Fazer o setup de DB de uma nova instalação em apenas um comando</li>
        <li>Podemos verificas as migrations com <code>migrate:status</code></li>
      </ul>

      <h4>Na prática</h4>

      <p>
        Para criarmos mais tabelas no banco de dados usando o migration, rodamos o seguinte comando:
      </p>

      <pre>
php artisan make:migration name_table
</pre>

      <p>
        Assim que criado teremos o seguinte arquivo padrão para as migrations:
      </p>

      <pre>
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
&#123;
    /**
      * Run the migrations.
      */
    public function up(): void
    &#123;
        Schema::create('products', function (Blueprint $table) &#123;
            $table->id();
            $table->timestamps();
        &#125;);
    &#125;

    /**
      * Reverse the migrations.
      */
    public function down(): void
    &#123;
        Schema::dropIfExists('products');
    &#125;
&#125;;        
</pre>

      <p>
        O método <code>up()</code> serve para a criação da tabela, e ali podemos inserir e atualizar
        os dados e respectivos tipos para quando criar a tabela. Também temos o método
        <code>down()</code>, que serve para dar <code>drop table</code>, ou, deletar a tabela para
        que a mesma possa ser atualizada devidamente e entrar no <code>versionamento</code> da versão
        daquela tabela no tempo / histórico de criação.
      </p>

      <p>
        Quando criamos uma <code>migration</code> usando o comando mencionado, fará com que a tabela
        fique pendende, e podemos ver os status de migration usando o comando:
      </p>

      <pre>
php artisan migrate:status
</pre>

      <p>
        Com isso poderemos ver as tabelas criadas no banco de dados, ou pendente para criação.
        Com o comando a seguir, nós damos o " <code>up()</code> " para que a tabela seja criada.
      </p>

      <pre>
php artisan migrate
</pre>

      <p>
        E para atualizarmos as migrates, podemos rodar o seguinte comando:
      </p>

      <pre>
php artisan migrate:fresh
</pre>

      <p>
        Podemos também fazermos da seguinte forma para gerenciarmos os tipos e tamanho de cada
        coluna no migration:
      </p>

      <pre>
public function up(): void
&#123;
  Schema::create('products', function (Blueprint $table) &#123;
    $table->id();
    $table->string('nome', 100);
    $table->integer('qtde');
    $table->text('descricao');
    $table->timestamps();
  &#125;);
&#125;
</pre>

      <h3>Migrations #2</h3>

      <ul>
        <li>Quando precisamos adicionar um novo campo a uma tabela, devemos
          <code>criar uma nova migration</code>
        </li>
        <li>Devemos ter o <code>cuidado</code> para não rodarmos o comando <code>fresh</code>
          , e apagar os dados já existentes</li>
        <li>O comando <code>rollback</code> pode ser utilizado para voltar uma migration</li>
        <li>Para voltar todas podemos utilizar o <code>reset</code></li>
        <li>Para voltar todas e rodar o <code>migrate</code> novamente, utilizamos o
          <code>refresh</code>
        </li>
      </ul>

      <p>
        Primeiramente, quando iremos adicionar um novo campo na tabela, não devemos alterar
        o arquivo padrão, por exemplo: Temos a tabela <code>products</code> com o nome da migration
        de <code>create_products_table</code>. A partir disto, quando criamos esta tabela e executamos
        <code>php artisan migrate</code> fazemos com que o banco de dados seja criado está mesma tabela
        , porém quando e si dermos migrate novamente neste arquivo, mesmo que atualizarmos um campo
        ou outro, e fizermos a <code>migration</code>, <code>TODOS OS DADOS</code> desta tabela
        serão apagados.
      </p>

      <p>
        No momento que executamos a <code>migration</code> e criamos a tabela no banco de dados
        , este arquivo php serviu a penas para a criação, e quando precisarmos adicionar um novo
        campo por exemplo, devemos criar outro arquivo para fazermos <code>migration</code>, neste
        caso por exemplo, se quisermos adicionar a coluna <code>categoria</code> a tabela
        <code>products</code>, devemos criar outra <code>migration</code> seguindo a convenção do
        Laravel desta forma:
      </p>

      <pre>
php artisan make:migration add_categoria_to_products_table
</pre>

      <p>
        Está é uma convenção do Laravel, e significa que, será adicionado (add) a categoria, para (to)
        a tabela (table) products. No respectiv arquivo criado, virá com uma estrutura diferente de
        esquema. Antes vinha com <code>Schema::create</code> pois criava a tabela, neste caso, o
        Laravel subentende-se que será feito a adição de uma coluna, e usa o <code>Schema::table</code>
        dando a liberdade que seja inserido os comandos necessários para adições no método <code>up()</code>
        , sabendo que <code>up()</code> e <code>down()</code> possuem a mesma função que ao criarmos
        uma tabela. Segue como o respectivo arquivo ficará:
      </p>

      <pre>
return new class extends Migration
&#123;
  /**
    * Run the migrations.
    */
  public function up(): void
  &#123;
    Schema::table('products', function (Blueprint $table) &#123;
      $table->string('categoria', 100);
    &#125;);
  &#125;

  /**
    * Reverse the migrations.
    */
  public function down(): void
  &#123;
    Schema::table('products', function (Blueprint $table) &#123;
      $table->dropColumn('categoria');
    &#125;);
  &#125;
&#125;;
</pre>

      <h2>Eloquent</h2>

      <ul>
        <li>Eloquent é a <code>ORM</code> do Laravel</li>
        <li>Cada tabela tem um <code>Model</code> que é responsável pela interação entre
          as requisições ao banco</li>
        <li>A convenção para o <code>Model</code> é o nome da entidade em singular.
          Enquanto a tabela é a entidade no plural: Evento e Eventos</li>
        <li>No <code>Model</code> faremos poucas alterações dos arquivos, geralmente
          configurações específicas</li>
      </ul>

      <p>
        Os Models no Laravel são classes PHP que estendem a classe <code>Illuminate\Database\Eloquent\Model</code>. 
        Eles permitem que você execute operações de consulta no banco de dados, insira, atualize e exclua registros 
        e também definam relações entre diferentes tabelas do banco de dados.
      </p>

      <p>
        Cada <code>Model</code> representa uma tabela do banco de dados. Por padrão, o Laravel assume que o nome do
        <code>Model</code> corresponde ao nome da tabela no <code>plural</code> (por exemplo, um Model chamado
        <code>User</code> corresponderia a uma tabela chamada <code>users</code>). Caso o nome da tabela seja diferente,
        você pode especificar o nome da tabela no Model através da <code>propriedade $table</code>.
      </p>

      <p>
        As colunas da tabela do banco de dados podem ser acessadas como propriedades do Model. Por exemplo, se houver uma
        coluna chamada name na tabela, você pode acessá-la como $model->name.
      </p>

      <p>
        No exemplo a seguir, foi criado usando migrations, a tabela <code>eventos</code> (no plurar) e usando o comando a baixo,
        o Model corresponde <code>Evento</code> (maiúsculo e no singular):
      </p>

      <pre>
php artisan make:model Evento
</pre>

      <p>
        Desta forma recemos o seguinte arquivo criado:
      </p>

      <h4>/App/Models/Evento.php</h4>

      <pre>
&lt;?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
&#123;
  use HasFactory;
&#125;
</pre>

      <p>
        Com este Model, agora podemo usar o <code>EventoController</code> para passar os dados para o banco de dados
        da seguinte forma:
      </p>

      <h4>/App/Http/Controllers/EventoController</h4>

      <pre>
use App\Models\Evento;

class EventoController extends Controller
&#123;
  public function index() &#123;
      
    $eventos = Evento::all();

    return view('welcome', ['eventos' => $eventos]);
  &#125;
&#125;
</pre>

      <p>
        O Model <code>Evento</code>, agora extendido do Eloquent (ORM) do Laravel, possui o método <code>all()</code> que captura
        todos os dados da tabela <code>Eventos</code> do banco e podendo no arquivo <code>welcome</code> mostra-los da seguinte 
        sintaxe de diretivas do Blade:
      </p>

      <h4>~/welcome.blade.php<small>Exemplo:</small></h4>

      <pre>
&lt;ul>
  &#64;foreach ($eventos as $evento)
    &lt;li>
      Título :: &#123;&#123; $evento->titulo &#125;&#125; &lt;br>
      Descrição :: &#123;&#123; $evento->descricao &#125;&#125; &lt;br>
      Cidade :: &#123;&#123; $evento->cidade &#125;&#125; &lt;br>
    &lt;/li> &lt;br>
  &#64;endforeach
&lt;/ul>
</pre>

    </section>
  </article>

@endsection
