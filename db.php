<?php
if (PHP_SAPI != 'cli') {
    exit('Rodar via CLI');
}

require __DIR__ . '/vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/src/dependencies.php';

$db = $container->get('db');

$schema = $db->schema();
$table = 'produtos';

$schema->dropIfExists( $table );

//Create a table products
$schema->create($table, function($table){
    $table->increments('id');
    $table->string('titulo', 100);
    $table->text('descricao');
    $table->decimal('preco', 11, 2);
    $table->string('fabricante', 60);
    $table->timestamps();
});
//Populate table
$db->table($table)->insert([
    'titulo' => 'Samatphone Motorola Moto G6 32GB Dual chip',
    'descricao' => 'Android Oreo - 8.0 Tela 5.7" Octa-core 1.8 GHz 4G Câmera 12 + 5MP (Dual Traseira) - Índigo',
    'preco' => 899.00,
    'fabricante' => 'Motorola',
    'dt_criacao' => '2019-10-22'
]);
$db->table($table)->insert([
    'titulo' => 'Iphone X Cinza Espacial 64GB',
    'descricao' => 'Tela 5.8" IOS 12 4GB Wi-Fi Câmera 12MP - Apple',
    'preco' => 4999.00,
    'fabricante' => 'Apple',
    'dt_criacao' => '2020-01-10'
]);