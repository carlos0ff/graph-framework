<?php

namespace Exercicios;

use Algorithms\Graph\Graph;

/**
 * Exercício 1 - Busca em Profundidade (DFS)
 *
 * Implemente a busca em profundidade a partir de um vértice de origem,
 * seguindo o mesmo padrão de Algorithms\Graph\Algorithms\BuscaLargura
 * (que usa Graph::getVertice e Graph::getAdjacentes).
 *
 * Dica: use uma pilha (array + array_pop, ou recursão) em vez da fila do BFS.
 */
class BuscaProfundidade
{
    /** @var Graph */
    private Graph $grafo;

    public function __construct(Graph $grafo)
    {
        $this->grafo = $grafo;
    }

    /**
     * Retorna os vértices na ordem em que foram visitados pela DFS.
     *
     * @param string $rotulo Rótulo do vértice de origem.
     * @return array
     */
    public function buscar(string $rotulo): array
    {
        // TODO: implementar a busca em profundidade (DFS)
        return [];
    }
}
