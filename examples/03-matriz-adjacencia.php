<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Algorithms\Graph\AdjacencyMatrix;
use Algorithms\Graph\Vertex;

// Representação de um grafo não direcionado por matriz de adjacência.
$vertices = [
    new Vertex("A"),
    new Vertex("B"),
    new Vertex("C"),
];

$matriz = new AdjacencyMatrix($vertices, false);

// Índices correspondem à posição do vértice no array $vertices.
$matriz->conectarVertices(0, 1); // A - B
$matriz->conectarVertices(1, 2); // B - C

$matriz->imprimir();
