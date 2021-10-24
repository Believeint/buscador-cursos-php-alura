#!/usr/bin/env php
<?php

use Alura\BuscadorDeCursos\Buscador;
use Alura\Teste;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

require_once 'vendor/autoload.php';

$client = new Client([
    'base_uri' => 'https://www.alura.com.br/',
    'verify' => false
]);

$crawler = new Crawler();

$buscador = new Buscador($client, $crawler);
$cursos = $buscador->buscar('/cursos-online-programacao/php');

echo '<ul>';
foreach ($cursos as $curso) {
    exibeItemLista($curso);
}
echo '</ul>';
