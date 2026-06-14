<?php

namespace Exercicios;

use Algorithms\Graph\Graph;

/**
 * Exercício 2 - Detecção de ciclo
 *
 * Implemente a verificação de existência de ciclo em um grafo (direcionado
 * ou não), usando Graph::getVertices e Graph::getAdjacentes para percorrer
 * o grafo.
 *
 * Dica: para grafos não direcionados, controle o vértice "pai" durante a
 * busca para não confundir a aresta de volta com um ciclo. Para grafos
 * direcionados, controle os vértices que estão na pilha de recursão atual.
 */
class DetectarCiclo
{
    /** @var Graph */
    private Graph $grafo;

    public function __construct(Graph $grafo)
    {
        $this->grafo = $grafo;
    }

    /**
     * Retorna true se o grafo possuir ao menos um ciclo.
     *
     * @return bool
     */
    public function possuiCiclo(): bool
    {
        // TODO: implementar a detecção de ciclo
        return false;
    }
}
