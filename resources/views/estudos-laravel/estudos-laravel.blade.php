@extends('layouts.main')

@section('title', 'Estudos Laravel')
@section('styles')
  @vite(['resources/scss/estudos-laravel/estudos-laravel.scss'])
@endsection

@section('script')
  @vite(['resources/js/estudos-laravel/estudos-laravel.js'])
@endsection

@section('content-main')

  <section class="main-fullsize">
    <section class="banner text-white">
      <h1>Estudos de Laravel</h1>
    </section>
  </section>

  <section class="main-content">
    <article class="markdown-body">
      <section>

        <section id="sumario-document">
        </section>

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

        <h3>Parâmetros obrigatórios</h3>

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
          podendo preparar as views com os dados provenientes do banco de dados, sejam eles tratados ou uma resposta de
          erro
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
          As colunas da tabela do banco de dados podem ser acessadas como propriedades do Model. Por exemplo, se houver
          uma
          coluna chamada name na tabela, você pode acessá-la como $model->name.
        </p>

        <p>
          No exemplo a seguir, foi criado usando migrations, a tabela <code>eventos</code> (no plurar) e usando o comando
          a baixo,
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
          O Model <code>Evento</code>, agora extendido do Eloquent (ORM) do Laravel, possui o método <code>all()</code>
          que captura
          todos os dados da tabela <code>Eventos</code> do banco e podendo no arquivo <code>welcome</code> mostra-los da
          seguinte
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

        <h2>Adicionando registro ao banco</h2>

        <ul>
          <li>No Laravel é comum ter uma <code>action</code> / <code>método</code> específica para o <code>POST</code>
            , chamada de <code>store</code></li>
          <li>Lá vamos criar o objeto e compor ele com basse nos dados enviados pelo <code>POST</code></li>
          <li>Com o objeto formado utilizamos o método <code>save</code> para persistir os dados</li>
        </ul>

        <p>
          Primeiramente criamos o formulário com os inputs necessários, não esquecendo de por o atributo
          <code>name</code> para acessá-los posteriormente, e então definirmos <code>action</code> do formulário
          para <code>/eventos/</code> e o <code>method</code> como <code>POST</code>
        </p>

        <p>
          Com base nesta <code>action</code>, nós criamos a rota corresponde usando <code>Route::post('')</code> da
          seguinte forma:
        </p>

        <h4>~/routes/web.php</h4>

        <pre>
Route::post('/eventos', [EventoController::class, 'store']);
</pre>

        <p>
          Assim, tendo o método no controller <code>EventoController</code>, estaremos recebendo esses dados do tipo
          <code>Request</code>, onde iremos preencher o <code>Model</code> de Evento no método da seguinte forma:
        </p>

        <h4>~/EventoController.php</h4>

        <pre>
public function store(Request $request) &#123;

$evento = new Evento;

$evento->titulo = $request->titulo;
$evento->cidade = $request->cidade;
$evento->privado = $request->privado;
$evento->descricao = $request->descricao;

$evento->save();

return redirect('/');

&#125;
</pre>

        <p>
          Desta forma respeitamos que a Request complete o Model com os dados para então usar o método
          <code>$evento->save()</code> para salva-los no banco de dados. Em seguida redirecionamos o usuário para
          a página inicial com o comando <code>return redirect('')</code>.
        </p>

        <h2>Flash Messages</h2>

        <ul>
          <li>Podemos adicionar mensagens ao usuário por <code>session</code></li>
          <li>Estas mensagens são conhecidas por <code>Flash Messages</code></li>
          <li>Podemos adicionar com o método <code>with</code> no <code>Controller</code></li>
          <li>Utilizadas para apresentar um feedback ao usuário</li>
          <li>No blade podemos verificar a presença da mensagem pela diretiva <code>&#64;session</code></li>
        </ul>

        <p>
          Por exemplo, quando criamos um evento, é super intuitivo e prático usar este recurso do Laravel, pois permite
          que possamos apresentar uma menssagem de sucesso ou de feedback para o usuário sobre o status do evento criado
          , neste caso, devemos usar o método <code>with('')</code> no <code>redirect('')</code> para que possamos
          retornar
          a menssagem desejada:
        </p>

        <h4>~/EventoController.php</h4>

        <pre>
return redirect('/')->with('msg', 'Evento criado com sucesso!');
</pre>

        <p>
          Desta forma mandamos para a rota '/' com um <code>sessiona('msg')</code> que será o identificador desta
          menssagem.
        </p>

        <p>
          Agora no blade devemos verificar se esta mensagem existe / está atribuida, e imprimi-la conforme quisermos.
        </p>

        <h4>~/views/welcome.blade.php</h4>

        <pre>
&#64;if (session('msg'))

  &lt;div class="alert alert-success" role="alert">
    &#123;&#123; session('msg') &#125;&#125;
  &lt;/div>

&#64;endif
</pre>

        <p>
          Neste caso estamos utilizando um estilo do <code>Bootstrap</code> para apresentarmos a menssagem.
        </p>

        <h2>Salvando imagem no Laravel</h2>

        <ul>
          <li>Para fazer o upload de imagens precisamos mudar o <code>enctype</code> do form e também criar o input
            de envio</li>
          <li>No controller fazemos um tratamento de verificação da imagem que foi enviada</li>
          <li>Depois salvaremos com um nome <code>único</code> em um diretório do projeto</li>
          <li>No banco salvamos apenas o <code>path</code> para a imagem</li>
        </ul>

        <p>
          Primeiramente inserimos a coluna <code>imagem</code> na tabela de <code>eventos</code> no banco de dados.
          Para isso, como mostrado anteriormente rodaremos uma <code>migration</code> usando da convenção do laravel,
          para inserir uma coluna com o seguinte comando:
        </p>

        <pre>
php artisan make:migration add_imagem_to_eventos_table
</pre>

        <p>
          Agora tendo a coluna na tabela, podemos adicionar um <code>input</code> do tipo <code>file</code> para podermos
          carregar um arquivo de imagem. Juntamente com esse input no formulário, é de suma importância de adicionarmos
          a propriedade <code>enctype="multipart/form-data"</code> na tag <code>form</code>, pois estaremos indicando
          que o formulário estará enviando multi formatos encriptados.
        </p>

        <p>
          Depois disso, deveremos receber e tratar os dados no controller responsável. Como dito e feito anteriormente,
          a rota que o formulário envia os dados, está definido para o método post, onde ativará o seguinte método
          <code>store()</code>, que por convenção recebe este nome pois trata de dados vindos de formulário.
        </p>

        <h4>~/EventoController</h4>

        <pre>
public function store(Request $request) &#123;
  $evento = new Evento;

  $evento->titulo = $request->titulo;
  $evento->cidade = $request->cidade;
  $evento->descricao = $request->descricao;
  $evento->privado = $request->privado;

  if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) &#123;
      
      $requestImage = $request->imagem;
      $extension = $requestImage->extension();
      $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;

      $requestImage->move(public_path('imgs/eventos'), $imageName);
      $evento->imagem = $imageName;

  &#125;

  $evento->save();

  return redirect('/')->with('msg', 'Evento criado com sucesso!');
&#125;
</pre>

        <p>
          Neste caso estamos recebendo os dados como uma <code>Request</code>, e preencheremos o Model <code>Evento</code>
          com os dados capturados pela request. É importante que o nome acessado nas propriedades do request devem ser
          iguais as propriedades <code>name</code> de cada respectivo <code>input</code>.
        </p>

        <p>
          Se houver uma imagem sendo enviada pela request, será verificada se possui um arquivo com o nome
          <code>imagem</code>
          e se este aqui é válido. Assim sendo, entrará no block, e <strong>capturará a extensão da imagem</strong>,
          <strong>encriptará o nome original do arquivo Juntamente com a data de agora em string</strong> e
          <strong>concatenará com a extensão</strong>. Logo após será pego este arquivo e enviado para o diretório
          público de origem <code>imgs/eventos</code> e o nome da imagem, depois será atribuido na propriedade
          <code>imagem</code> do <code>model Eventos</code> o caminho desta imagem, assim será salvo no banco de dados
        </p>

        <h2>Resgatando registro individualmente</h2>

        <ul>
          <li>Resgataremos a penas um registro pelo <code>Eloquent</code></li>
          <li>Será utilizado o método <code>findOrFail</code></li>
          <li>Criaremos também uma view com rota para esta nova página</li>
          <li>Esta view exibirá todas as funções do evento, informações e botões para interação</li>
        </ul>

        <p>
          Primeiramente, constumizaremos o botão de <code>saiba mais</code> na view que lista todos os eventos
          , definimos o <code>href=""</code> para mandarmos o <code>id</code> do evento para a rota a seguir:
        </p>

        <h4>~/web.php</h4>

        <pre>
Route::get('/evento/&#123;id&#125;', [EventoController::class, 'show']);
</pre>

        <p>
          O método <code>show</code> é uma convenção, assim como <code>index</code> e <code>store</code>,
          e indica que será tratado a penas um dado do banco, ou um evento específico neste caso.
          No exemplo a seguir, estamos usando o método do <code>Eloquent</code> chamado <code>findOrFail</code>
          e passaremos como parâmetro o <code>id</code> do evento em específico. Este método está preparado
          para retornar o objeto com os dados encontrados, ou um erro.
        </p>

        <h4>~/EventoController</h4>

        <pre>
public function show($id) &#123;

  $evento = Evento::findOrFail($id);

  return view('eventos.show', ['evento' => $evento]);
&#125;
</pre>

        <p>
          Neste caso podemos tratar com <code>try... catch</code> para entregarmos ao usuário, um possível
          erro de forma clara.
        </p>

        <h2>Salvando JSON no banco</h2>

        <ul>
          <li>Podemos salvar um conjunto de dados no banco para itens de múltipla escolha</li>
          <li>Vamos criar um campo determinado de <code>json</code> via <code>migration</code></li>
          <li>No front-end podemos utilizar <code>inputs com checkbox</code></li>
        </ul>

        <p>
          Salvar em JSON no banco de dados pode ser de grande praticidade caso seja necessário salvar no
          banco, múltiplos dados em um único campo. Por exemplo, quando temos de salvar as opções de
          inputs do tipo <code>checkbox</code>, como neste caso:
        </p>

        <h4>~/create.blade.php</h4>

        <pre>
&lt;div class="col-md-12">
  &lt;input type="checkbox" name="items[]" id="item1" value="cadeiras">
  &lt;label for="item1">Cadeiras&lt;/label>
&lt;/div>
&lt;div class="col-md-12">
  &lt;input type="checkbox" name="items[]" id="item2" value="comida-livre">
  &lt;label for="item2">Comida Livre&lt;/label>
&lt;/div>
&lt;div class="col-md-12">
  &lt;input type="checkbox" name="items[]" id="item3" value="palco">
  &lt;label for="item3">Palco&lt;/label>
&lt;/div>
&lt;div class="col-md-12">
  &lt;input type="checkbox" name="items[]" id="item4" value="brindes">
  &lt;label for="item4">Brindes&lt;/label>
&lt;/div>
</pre>

        <p>
          Neste caso para capturamos pelo <code>controller</code> posteriormente, devemos definirmos o
          <code>name</code> como um array, para que seja capturado dentro de um array. A partir disto,
          no <code>controller</code> salvamos normalmente como uma propriedade de <code>Evento</code>
        </p>

        <div class="alert alert-warning" role="alert">
          <i class="fa fa-warning" aria-hidden="true"></i>
          Note que ao mexer no <code>controller</code> e salvar em sua propriedade, ele estará sendo refletido das
          colunas que possuem no banco de dados, ou seja, deve ser adicionado o campo com uma migration.
        </div>

        <pre>
php artisan make:migration add_items_to_eventos_table
</pre>

        <h4>~/Migration</h4>

        <pre>
$table->json('items');
</pre>

        <h2>Salvando Datas</h2>

        <p>
          Para salvar data e hora no geral é muito simples. Faremos o mesmo que os demais, adicionando a coluna
          <code>data</code> com <code>migration</code>, e adicionamos o input com
          <code>type="datetime-local"</code> para mandarmos uma data e horário.
        </p>

        <p>
          Feito isso, agora devemos modificar o <code>Model</code> de <code>Evento</code> da seguinte forma:
        </p>

        <h4>~/Models/Evento.php</h4>

        <pre>
class Evento extends Model
&#123;
  ...

  protected $dates = [
    'data'
  ];
&#125;
</pre>

        <p>
          Quando definimos <code>data</code> em uma propriedade <code>$dates</code>, estamos dizendo ao Laravel
          que esta(s) coluna, terá propriedades e objeto do tipo de data e hora, onde o Laravel fornece / extende
          de uma biblioteca "especializada" em manipular data e hora, assim, fornecendo métodos extras para estas
          manipulações.
        </p>

        <p>
          Feito isso, no <code>EventoController</code> fazemos de forma normal como ja o fizemos anteriormente:
        </p>

        <h4>~/EventoController</h4>

        <pre>
... 
$evento->data = $request->data;
... 
</pre>

        <p>
          O que muda agora, neste caso, é como iremos mostrar ao usuário, como a data será formatada usando o blade:
        </p>

        <h4>~/welcome.blade.php e ~/show.blade.php</h4>

        <pre>
...
&lt;p>&#123;&#123; date('d/m/Y H:i:s', strtotime($evento->data)) &#125;&#125;&lt;/p>
...
</pre>

        <p>
          Desta forma, estamos formatando a data vindo do controller para que seja exibida no formato 
          <code><b>DIA</b>/<b>MÊS</b>/<b>ANO_INTEIRO</b> <b>HORA_EM_ 24H</b>/<b>MINUTOS</b>/<b>SEGUNDOS</b></code>
        </p>

        <h2>Busca no Laravel</h2>

        <ul>
          <li>Para realizar a busca utilizaremos o <code>Eloquent</code> sedido ao <code>Model</code></li>
          <li>Utilizaremos o método <code>where</code> para escolhermos como selecionar os dados por coluna</li>
        </ul>

        <p>
          De uma forma geral, pesquisar no banco de dados pode ser uma tarefa fácil utilizando o <code>Eloquent</code>
          a nosso favor, por exemplo:
        </p>

        <h4>~/EventoController</h4>

        <pre>
if (!empty($request)) &#123;
  $busca = $request->busca;

  $data['eventos'] = Evento::where([
      ['titulo', 'like', '%'.$busca.'%']
  ])->get();
  $data['busca'] = true;
  $data['textBusca'] = $busca;
  
&#125; else &#123;
  $data['eventos'] = Evento::all();
&#125;
</pre>

        <p>
          Neste caso estamos armazenando os dados em um array <code>$data</code>, mas poderíamos salvar e mandar 
          separamente pela <code>view</code>. Usando o <code>Model</code> de evento, usamos o método sedido pelo 
          <code>Eloquent</code>, <code>where</code>, que representa uma busca por dados em uma coluna com dados
          específicos. Passamos um array de arrays, para que futuramente possamos passar outras campoes e dados
          específicos para pesquisar na tabela. Neste caso de array, pedimos para que seja feito na coluna 
          <code>titulo</code>, com a atribuição <code>like</code> que na hora de buscar dados, ele não buscara 
          dados precisamente como foi mandando, mas tais dados "como" ou semelhante ao que foi passado.
          E depois utilizamos a formatação <code>% $busca %</code> para que possamos buscar em qualquer parte 
          do título.
        </p>

        <p>
          Depois só seguimos a lógica e na view podemos capturar esses dados, ou como eu coloquei em outra chave 
          de valor, o texto que foi utilizado para realizar a busca, assim só apresentamos na view com o blade.
        </p>

        <h2>Autentiação no Laravel</h2>

        <ul>
          <li>A autenticação pode ser aplicada utilizando o <code>Jetstream</code></li>
          <li>O pacote deve ser instalado usando o <code>composer</code></li>
          <li>Instalamos também o <code>Livewire</code>, que são componenetes de autenticação para o Blade</li>
        </ul>

        <h3>Jetstream</h3>

        <p>
          O <code>Jetstream</code> é um kit de pacotes ou kit de ferramentas, que junta alguns pacotes com finalidades distintas que auxiliam fortementes o desenvolvimento de aplicações em Laravel, neste caso irá nos fornecer métodos de realizar autentiação, registro, login, etc.
        </p>

        <p>
          O <code>Jetstream</code> possui duas principais "stacks", e a que iremos trabalhar aqui, é o <code>Livewire</code>, que nos permite trabalhar com reatividade de dados, autenticação, etc, no lado do servidor utilizando o próprio blade do Laravel.
        </p>

        <p>
          Principais pacotes são:
        </p>

        <h5>Fortify</h5>
        
        <p>
          É responsável por gerenciar usuários e fornecer autentiação, registro, login de usuário, eutenticação de email, autenticação de dois fatores, etc.
        </p>

        <h5>Sanctum</h5>

        <p>
          É responsável por gerenciar e aplicar autenticações por tokens, verificar token do usuário, etc.
        </p>

        <p>
          Para instalar ambos os recursos, <code>Jetstream</code> e <code>Livewire</code> usaremos os seguintes comandos:
        </p>

        <pre>
composer require laravel/jetstram
php artisan jetstram:install livewire
</pre>

        <p>
          Apóes instalar o <code>jetstram</code>, o mesmo irá nos conseder muitas coisas prontas, tais como <code>views</code> e <code>classes</code> especializadas para o que possamos realizar autenticações, verificações de token, entre outras funcionalidades que as classes nos permitem trabalhar.
        </p>
        
        <p>
          Fora classes, views e componentes prontos do <code>jetstram</code>, também teremos algumas <code>migrations</code>, onde precisaremos enviar ao banco.
        </p>

        <p>
          Logo após, executaremos estes comandos para instalar as dependências e construir o front-end da aplciação:
        </p>

        <pre>
npm install
npm run dev
</pre>

        <h3>Exibir conteúdo se estiver logado</h3>

        <p>
          Agora, melhor do que usar um <code>if()...else</code> para mostrar um determinado conteúdo se o usuário estiver ou não logado no sistema, é nós utilizarmos uma diretiva específica, cedida pelo <code>livewire</code>, chamada de <code>&#64;auth</code> para mostrar um conteúdo se o usuário estiver logado e autenticado, e a diretiva <code>&#64;guest</code> para conteúdo se o mesmo não estiver logado e autenticado. Segue um exemplo:
        </p>

        <h4>~/layouts/main.blade.php</h4>

        <pre>
&#64;auth
  &lt;p>Conteúdo para usuários logados&lt;/p>
&#64;endauth

&#64;guest
  &lt;p>Conteúdo para usuários não logados&lt;/p>
&#64;endguest
</pre>

        <p>
          E para fazermos o <code>logou</code>, ou no caso, para sairmos da conta / desautenticarmos o usuário, nós teremos de incrimentar um formulário, enves de simplesmente um link de redirecionamento.
        </p>

        <p>
          Por exemplo, no header temos uma navbar construido com <code>ul</code> e <code>li</code>, e no item para sair ou fazer <code>logout</code> deve ser feito da seguinte forma:
        </p>

        <h4>~/layouts/main.blade.php</h4>

        <pre>
&lt;li class="text-center">
  &lt;form action="/logout" method="POST">
  &#64;csrf
    &lt;button type="submit" class="btn w-full">Sair&lt;/button>
  &lt;/form>
&lt;/li>
</pre>

        <p>
          O <code>logout</code> deve ser feito com um formulário pois enviamos a requisição como <code>POST</code> para que o <code>jetstram</code> possa receber a de fazer realziar a função de <code>logout</code>. Poderíamos utilizar um <code>&#64;a></code> âncora, mas teríamos de utilizar <code>javascript</code> para previnirmos seu reridicionamento e para submeter o formulário para caminho em questão
        </p>

        <h2>Relações entre tabelas</h2>

        <h3>One to many</h3>

        <ul>
          <li>Será criado relação de um para muitos entre usuário e eventos</li>
          <li>Será alterado as <code>migrations</code>, adicionando uma chave estrangeira no model <code>Evento</code></li>
        </ul>

        <p>
          A possibilidade de poder estabelecer esta relação de um para muitos, é excencial para banco de dados relacionais, pois permite que um único usuário possa ter vários eventos sendo dono de todos os mesmos.
        </p>

        <p>
          Primeiramente iremos adicionar a coluna de chave estrangeira na tabela <code>Eventos</code> usando uma migration, respeitando as boas práticas do Laravel, usando o seguinte comando no terminal <code>php artisan make:migration add_usuario_id_to_eventos_table</code>, e definiremos o arquivo da seguinte forma para adicionar a coluna com chave estrangeira:
        </p>

        <h4>Migration - add_usuario_id_to_eventos_table</h4>

        <pre>
public function up(): void
&#123;
  Schema::table('eventos', function (Blueprint $table) &#123;
    $table->foreignId('usuario_id')->constrained();
  &#125;);
&#125;

public function down(): void
&#123;
  Schema::table('eventos', function (Blueprint $table) &#123;
    $table->foreignId('usuario_id')->constrained()->onDelete('cascade');
  &#125;);
&#125;
</pre>

        <h5>function up()</h5>

        <p>
          Neste método utilizamos para criar a tabela estrangeira. Ma criação da mesma, utilizamos <code>foreignId</code> que o Laravel nos proporciona de maneira mais prática que esta coluna tem um tipo específico, essa é uma forma curta e direta da expressão abaixo:
        </p>

        <pre>
$table->unsignedBigInteger('usuario_id');

$table->foreign('usuario_id')->references('id')->on('users');
</pre>

        <p>
          Também usamos o método <code>constrained()</code> para dizermos que <code>usuario_id</code> é uma chave estrangeira, e nesse caso devemos usar a convenção do Laravel e expressar corretamente o nome da coluna, para que essa associação seja feita de forma automática, onde logo ja será especificado que pelo nome, está chave esta associada a coluna <code>id</code> de <code>users</code>.
        </p>

        <h5>function down()</h5>

        <p>
          Neste caso o que muda é que encadeamos o método <code>onDelete('cascade')</code> que nos permite deletar todos os dados encadeados deste usuário.
        </p>

        <h4>~/Models/Evento.php</h4>

        <p>
          Incrementaremos no Model de <code>Evento</code> o seguinte trecho de código:
        </p>

        <pre>
public function user() &#123;
  return $this->belongsTo('App\Models\User');
&#125;
</pre>

        <p>
          Estamos adicionando ese código pois como cada evento precisa pertencer a um usuário, nós devemos associa-lo no Model para que seja feito o request do mesmo. O método <code>belongsTo()</code> refere-se que este <code>Evento</code> tera um único usuário, baseado no Model <code>User</code>.
        </p>

        <p>
          Assim sendo, quando chamamos os dados de Evento, ele irá retornar atráves do método <code>user()</code> um objeto do usuário relacionado em questão.
        </p>

        <h4>~/Models/User.php</h4>

        <p>
          Da mesma forma que esclarecemos no <code>Evento</code> que terá um único <code>User</code>, nós passamos ao <code>User</code> que terá muitos eventos do tipo <code>Evento</code>, neste caso usamos outro método:
        </p>

        <pre>
public function eventos() &#123;
  return $this->hasMany('App\Models\Evento');
&#125;
</pre>

        <p>
          Este método condiz que haverá muitos ( <code>hasMany()</code> ) de <code>Evento</code>
        </p>

        <h4>~/EventoController</h4>

        <p>
          Agora, para salvar o usuário dono do evento que está sendo criado, precisaremos pegar o usuário logado na sessão, desta forma , antes de salvar os dados do formulário:
        </p>

        <pre>
$usuario = auth()->user();
$evento->usuario_id = $usuario->id;
        </pre>

        <p>
          Antes de dar <code>$evento->save()</code> para salvar no banco, nós salvamos o usuário autenticado na sessão e logo salvamos seu <code>id</code> com a coluna <code>usuario_id</code> de eventos.
        </p>

        <h4>~/routes/web.php</h4>

        <p>
          Agora, como salvamos eventos apenas com usuários autenticados, devemos ter certeza que usuário não autenticados acessem esta parte da aplicação. Neste caso usaremos o método <code>middleware('auth')</code> que irá verificar se há usuário autenticado na sessão, para então permitir que o mesmo acesse a rota.
        </p>

        <pre>
Route::get('/eventos/criar/', [EventoController::class, 'create'])->middleware('auth');
        </pre>

        <h3>Exibindo usuário da relação</h3>

        <p>
          Para exibir os dados do dono/user do evento na view, primeiramente precisamos encrontra-lo no banco com base o <code>usuario_id</code> da tabela eventos com o seguinte código no <code>EventoController</code> no método que é chamado na exibição da view:
        </p>

        <h4>~/EventoController</h4>

        <pre>
$usuario = User::where('id', $evento->usuario_id)->first();

return view('eventos.show', ['evento' => $evento, 'user' => $usuario]);
        </pre>

        <p>
          Desta forma estamos buscando o usuário corresponde ao <code>usuario_id</code> utilizando o <code>where</code> do <code>Eloquent</code>, e em seguida pegamos apenas o objeto do primeiro, com o método <code>first()</code>, depois passamo para a view com a chave <code>user</code>.
        </p>

        <h4>~/show.blade.php</h4>

        <p>
          E para exibir esse dado, é muito fácil, pois capturamos o objeto de usuário, então só precisamos exibir o 'name' da seguinte forma:
        </p>

        <pre>
&lt;p>&lt;i class="fa fa-user" aria-hidden="true">&lt;/i> &#123;&#123; $user->name &#125;&#125;&lt;/p>
</pre>

      </section>
    </article>
  </section>

@endsection
