<?php

namespace Algorithms\Graph\Algorithms;

use Algorithms\Graph\Graph;

/**
 * Dijkstra -> cálculo do caminho mínimo entre vértices de um grafo ponderado.
 */
class Dijkstra
{
    /** @var Graph */
    private Graph $grafo;

    /**
     * @param Graph $grafo
     */
    public function __construct(Graph $grafo)
    {
        $this->grafo = $grafo;
    }

    /**
     * Calcula as distâncias mínimas a partir do vértice de origem.
     *
     * @param string $origem O rótulo do vértice de origem.
     * @return array<string, int> Mapa de rótulo do vértice => distância mínima a partir da origem.
     */
    public function calcularDistancias(string $origem): array
    {
        // TODO: implementar algoritmo de Dijkstra
        return [];
    }
}
