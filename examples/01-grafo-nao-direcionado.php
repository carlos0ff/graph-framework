<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Algorithms\Graph\Algorithms\BuscaLarguraImperativa;
use Algorithms\Graph\Graph;
use Algorithms\Utils\Printer;

// Grafo não direcionado: cada aresta também cria a ligação de volta.
$grafo = new Graph(10, false);

$grafo->addVertice("A");
$grafo->addVertice("B");
$grafo->addVertice("C");
$grafo->addVertice("D");

$grafo->addAresta("A", "B");
$grafo->addAresta("B", "C");
$grafo->addAresta("C", "D");

echo "Grafo:" . PHP_EOL;
Printer::imprimirGrafo($grafo);

echo PHP_EOL . "BFS a partir de A:" . PHP_EOL;

$busca = new BuscaLarguraImperativa($grafo);

foreach ($busca->buscar("A") as $vertice) {
    echo $vertice . PHP_EOL;
}
