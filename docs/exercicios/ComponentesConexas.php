<?php

namespace Exercicios;

use Algorithms\Graph\Graph;

/**
 * Exercício 3 - Componentes conexas
 *
 * Implemente a contagem/listagem das componentes conexas de um grafo não
 * direcionado, reaproveitando uma busca (BFS ou DFS) a partir de cada
 * vértice ainda não visitado.
 */
class ComponentesConexas
{
    /** @var Graph */
    private Graph $grafo;

    public function __construct(Graph $grafo)
    {
        $this->grafo = $grafo;
    }

    /**
     * Retorna uma lista de componentes, cada uma representada por um array
     * com os rótulos dos vértices que a compõem.
     *
     * @return array<int, array<int, string>>
     */
    public function listar(): array
    {
        // TODO: implementar a listagem das componentes conexas
        return [];
    }
}
