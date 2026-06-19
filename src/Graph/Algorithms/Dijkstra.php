<?php

namespace Algorithms\Graph\Algorithms;

use Algorithms\Graph\Graph;

/**
 * Algoritmo de Dijkstra — caminho mínimo em grafos ponderados sem pesos negativos.
 *
 * Dado um vértice de origem, calcula a menor distância acumulada até cada um dos
 * demais vértices alcançáveis do grafo. Complexidade: O(V²) na implementação
 * com busca linear do mínimo (sem heap).
 *
 * @package Algorithms\Graph\Algorithms
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
     * Calcula a distância mínima do vértice de origem a todos os demais vértices.
     *
     * @param  string             $origem Rótulo do vértice de partida.
     * @return array<string, int>         Mapa rótulo → distância mínima; vértices inacessíveis
     *                                    não aparecem no resultado (implementação a completar).
     */
    public function calcularDistancias(string $origem): array
    {
        // TODO: implementar algoritmo de Dijkstra
        return [];
    }
}
