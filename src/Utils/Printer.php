<?php

namespace Algorithms\Utils;

use Algorithms\Graph\Graph;

/**
 * Utilitário para impressão de grafos.
 */
class Printer
{
    /**
     * Imprime os vértices do grafo e seus respectivos adjacentes.
     * @param Graph $grafo
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
