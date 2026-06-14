<?php

namespace Exercicios;

use Algorithms\Graph\Graph;

/**
 * Exercício 4 - Ordenação topológica
 *
 * Implemente a ordenação topológica de um grafo direcionado acíclico (DAG),
 * retornando os rótulos dos vértices em uma ordem válida.
 *
 * Dica: implemente o algoritmo de Kahn (baseado no grau de entrada,
 * Vertex::getGrau) ou uma DFS com pilha de finalização.
 */
class OrdenacaoTopologica
{
    /** @var Graph */
    private Graph $grafo;

    public function __construct(Graph $grafo)
    {
        $this->grafo = $grafo;
    }

    /**
     * Retorna os rótulos dos vértices em uma ordem topológica válida.
     *
     * @return array<int, string>
     */
    public function ordenar(): array
    {
        // TODO: implementar a ordenação topológica
        return [];
    }
}
