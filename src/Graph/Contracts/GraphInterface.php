<?php

namespace Algorithms\Graph\Contracts;

use Algorithms\Graph\Edge;
use Algorithms\Graph\Vertex;

/**
 * Contrato para implementações de grafo.
 */
interface GraphInterface
{
    /**
     * Adiciona um vértice ao grafo.
     * @param string $rotulo O rótulo do vértice a ser adicionado.
     * @return Vertex
     */
    public function addVertice(string $rotulo): Vertex;

    /**
     * Adiciona uma aresta ao grafo.
     * @param string $origem O rótulo do vértice de origem.
     * @param string $destino O rótulo do vértice de destino.
     * @param int $peso O peso da aresta.
     * @return void
     */
    public function addAresta(string $origem, string $destino, int $peso = 1): void;

    /**
     * Retorna o vértice com o rótulo informado, ou null se não existir.
     * @param string $rotulo
     * @return Vertex|null
     */
    public function getVertice(string $rotulo): ?Vertex;

    /**
     * Retorna a lista de vértices do grafo.
     * @return Vertex[]
     */
    public function getVertices(): array;

    /**
     * Retorna o mapa de adjacências (rótulo do vértice => arestas).
     * @return array<string, Edge[]>
     */
    public function getArestas(): array;

    /**
     * Retorna os vértices adjacentes ao vértice com o rótulo informado.
     * @param string $rotulo
     * @return Vertex[]
     */
    public function getAdjacentes(string $rotulo): array;
}
