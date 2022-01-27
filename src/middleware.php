<?php
// Application middleware
// @ O middleware é um filtro em que antes que acessamos as rotas requeridas passamos por ele 

// title: fazendo autenticaçao da requisição usando Jwt
//@ para que antes de acessarmos a requisição sabermos se tem autorização.
$app->add(
    new Tuupola/Middleware\JwtAuthentication([
        "header" => "C-Token",
        "regexp" => "/(.*)/",
        "path"   => "/api",
        "ignore" => ["/api/token"],
        "secret" => $this->get('settings')['secretKey']
    ])
);

// title: Definindo o cabeçalho da resposta da requisição.
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://mysite')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});


/* @ Como o middleware é um filtre e todas as rotas antes de ser acessadas passa por aqui é definido coisas 
    padrões de set são definidos aqui. */

// e.g: $app->add(new \Slim\Csrf\Guard);