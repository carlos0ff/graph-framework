<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Algorithms\Graph\Algorithms\BuscaLargura;
use Algorithms\Graph\Graph;
use Algorithms\Utils\Printer;

// Grafo direcionado: a aresta A -> B não implica B -> A.
$grafo = new Graph(10, true);

$grafo->addVertice("A");
$grafo->addVertice("B");
$grafo->addVertice("C");

$grafo->addAresta("A", "B");
$grafo->addAresta("A", "C");
$grafo->addAresta("B", "C");

echo "Grafo:" . PHP_EOL;
Printer::imprimirGrafo($grafo);

echo PHP_EOL . "Grau total do vértice C (entrada + saída):" . PHP_EOL;

$c = $grafo->getVertice("C");

echo $c->getGrau() . PHP_EOL;

echo PHP_EOL . "BFS a partir de A:" . PHP_EOL;

$busca = new BuscaLargura($grafo);

foreach ($busca->buscar("A") as $vertice) {
    echo $vertice . PHP_EOL;
}
