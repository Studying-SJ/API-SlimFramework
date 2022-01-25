<?php
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;

// title: Rotas para listar produtos
$app->group('/api/v1', function(){
    $this->get('/produtos/lista', function($request, $response){
        $produtos = Produto::get();
        return $response->withJson( $produtos );
    });
});

// title: Rotas para listar produto por id
$app->group('/api/v1', function(){
    $this->get('/produtos/lista/{id}', function($request, $response, $args){
        $produtos = Produto::findOrFail($args['id']);
        return $response->withJson( $produtos );
    });
});

// title: Rota para cadastrar produtos
$app->group('/api/v1', function(){
    $this->post('/produtos/adiciona', function($request, $response){
        $dados = $request->getParsedBody();
        $produto = Produto::create( $dados );
        return $response->withJson( $produto );
    });
});

// title: Rotas para update em produto por id
$app->group('/api/v1', function(){
    $this->put('/produtos/atualiza/{id}', function($request, $response, $args){
        $dados = $request->getParsedBody();
        $produtos = Produto::findOrFail($args['id']);
        $produtos->update( $dados );
        return $response->withJson( $produtos );
    });
});

// title: Rotas para Remover produto por id
$app->group('/api/v1', function(){
    $this->get('/produtos/remove/{id}', function($request, $response, $args){
        $produtos = Produto::findOrFail($args['id']);
        $produtos->delete();
        return $response->withJson( $produtos );
    });
});
