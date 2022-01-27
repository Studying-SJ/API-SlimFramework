<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;
use App\Models\Usuario;
use \Firebase\JWT\JWT;

// title: Rotas para listar produtos
$app->post('/api/token', function($request, $response){ 

    $dados = $request->getParsedBody();

    $dados = $dados['email'] ?? null;
    $dados = $dados['senha'] ?? null;

    $usuarios = Usuario::where('email', $email)->first(); 

    if(!is_null($usuario) && (md5($senha) === $usuario->senha) ){
        // @ Gerar token
        //Criando a secretkey, ela é a chave para criptografar e descriptografar os dados.
        $secretKey = $this->get('settings')['secretKey'];
        $chaveAcesso = JWT::encode($usuario, $secretKey);

        return  $response->withJson([
            'chave' => $chaveAcesso
        ]);

    }
    return $response_>withJson([
        'status' => 'erro'
    ]);
});
