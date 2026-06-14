<?php

namespace Algorithms\Graph;

use Algorithms\Graph\Contracts\GraphInterface;
use Algorithms\Graph\Exceptions\QtdeMaximaException;
use Algorithms\Graph\Exceptions\VertexNotFoundException;

/**
 * Grafo       -> Graph
 */
class Graph implements GraphInterface {

    /** @var array<string, Vertex> */
    private array $vertices = [];

    /** @var array<string, Edge[]> */
    private array $adjacencias = [];

    /** @var int */
    private int $maxVertices;

    /** @var bool */
    private bool $direcionado;

    /**
     * @param int $maxVertices Quantidade máxima de vértices do grafo.
     * @param bool $direcionado Indica se o grafo é direcionado.
     */
    public function __construct(int $maxVertices, bool $direcionado)
    {
        $this->maxVertices = $maxVertices;
        $this->direcionado = $direcionado;
    }

    /**
     * Adiciona um vértice ao grafo.
     * @param string $rotulo O rótulo do vértice a ser adicionado.
     * @return Vertex
     */
    public function addVertice(string $rotulo): Vertex
    {
        if (count($this->vertices) >= $this->maxVertices) {
            throw new QtdeMaximaException("Quantidade máxima de vértices atingida.");
        }

        $vertice = new Vertex($rotulo);
        $this->vertices[$rotulo] = $vertice;
        $this->adjacencias[$rotulo] = [];

        return $vertice;
    }

    /**
     * Adiciona uma aresta ao grafo.
     * @param string $origem O rótulo do vértice de origem.
     * @param string $destino O rótulo do vértice de destino.
     * @param int $peso O peso da aresta.
     * @return void
     */
    public function addAresta(string $origem, string $destino, int $peso = 1): void
    {
        $verticeOrigem = $this->getVertice($origem);
        $verticeDestino = $this->getVertice($destino);

        if ($verticeOrigem === null || $verticeDestino === null) {
            throw new VertexNotFoundException("Vértice não encontrado.");
        }

        $this->adjacencias[$origem][] = new Edge($verticeDestino, $peso);
        
        $verticeOrigem->addGrau(1);
        $verticeOrigem->addGrauSaida(1);
        $verticeDestino->addGrau(1);
        $verticeDestino->addGrauEntrada(1);

        if (!$this->direcionado) {
            $this->adjacencias[$destino][] = new Edge($verticeOrigem, $peso);
            $verticeDestino->addGrauSaida(1);
            $verticeOrigem->addGrauEntrada(1);
        }
    }

    /**
     * Retorna o vértice com o rótulo informado, ou null se não existir.
     * @param string $rotulo
     * @return Vertex|null
     */
    public function getVertice(string $rotulo): ?Vertex
    {
        return $this->vertices[$rotulo] ?? null;
    }

    /**
     * Retorna a lista de vértices do grafo.
     * @return Vertex[]
     */
    public function getVertices(): array
    {
        return array_values($this->vertices);
    }

    /**
     * Retorna o mapa de adjacências (rótulo do vértice => arestas).
     * @return array<string, Edge[]>
     */
    public function getArestas(): array
    {
        return $this->adjacencias;
    }

    /**
     * Retorna os vértices adjacentes ao vértice com o rótulo informado.
     * @param string $rotulo
     * @return Vertex[]
     */
    public function getAdjacentes(string $rotulo): array
    {
        $vizinhos = [];

        foreach ($this->adjacencias[$rotulo] ?? [] as $aresta) {
            $vizinhos[] = $aresta->getDestino();
        }

        return $vizinhos;
    }
}
