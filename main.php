<?php

require_once __DIR__ . '/vendor/autoload.php';

use Algorithms\Graph\Graph;
use Algorithms\Graph\Algorithms\BuscaLarguraImperativa;

$graph = new Graph(10, false);

$graph->addVertice("A");
$graph->addVertice("B");
$graph->addVertice("C");
$graph->addAresta("A", "B");
$graph->addAresta("B", "C");

$busca = new BuscaLarguraImperativa($graph);
$caminho = $busca->buscar("A");

foreach ($caminho as $vertice) {
    echo $vertice . PHP_EOL;
}