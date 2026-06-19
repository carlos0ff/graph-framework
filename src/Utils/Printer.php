<?php

namespace Algorithms\Utils;

use Algorithms\Graph\Graph;

/**
 * Utilitários de exibição para estruturas do grafo.
 *
 * @package Algorithms\Utils
 */
class Printer
{
    /**
     * Imprime cada vértice do grafo seguido de seus adjacentes no formato:
     * <code>Vertice{rotulo='X', grau=N} -> [Y, Z]</code>
     *
     * @param  Graph $grafo Grafo a ser exibido.
     * @return void
     */
    public static function imprimirGrafo(Graph $grafo): void
    {
        foreach ($grafo->getVertices() as $vertice) {
            $adjacentes = array_map(
                fn ($vizinho) => $vizinho->getRotulo(),
                $grafo->getAdjacentes($vertice->getRotulo())
            );

            echo $vertice . ' -> [' . implode(', ', $adjacentes) . ']' . PHP_EOL;
        }
    }
}
