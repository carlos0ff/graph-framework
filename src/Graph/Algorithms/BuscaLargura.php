<?php

namespace Algorithms\Graph\Algorithms;

use Algorithms\Graph\Graph;

/**
 * Busca em Largura (BFS) usando array como fila (FIFO com array_shift).
 *
 * Visita todos os vértices alcançáveis a partir de uma origem, nível a nível,
 * garantindo que cada vértice seja processado exatamente uma vez.
 *
 * @see BuscaLarguraImperativa para a variante com {@see \SplQueue}.
 * @package Algorithms\Graph\Algorithms
 */
class BuscaLargura {
    /**@var array */
    private array $fila;

    /**@var array */
    private array $visitados;

    /** @var Graph */
    private Graph $grafo;

    /**
     * Construtor da classe BuscaLargura.
     * @param Graph $grafo
     */
    public function __construct(Graph $grafo)
    {
        $this->grafo = $grafo;
        $this->fila = [];
        $this->visitados = [];
    }

    /**
     * Percorre o grafo em largura a partir do vértice identificado por $rotulo.
     *
     * @param  string   $rotulo Rótulo do vértice de origem.
     * @return Vertex[]         Vértices na ordem de visitação (BFS), ou [] se a origem não existir.
     */
    public function buscar(string $rotulo): array
    {
        $caminho = [];

        $origem = $this->grafo->getVertice($rotulo);

        if ($origem === null) {
            return $caminho;
        }

        $this->fila[] = $origem;
        $this->visitados[$origem->getRotulo()] = true;

        while (!empty($this->fila)) {
            $atual = array_shift($this->fila);
            $caminho[] = $atual;

            foreach ($this->grafo->getAdjacentes($atual->getRotulo()) as $vizinho) {
                if (!isset($this->visitados[$vizinho->getRotulo()])) {
                    $this->visitados[$vizinho->getRotulo()] = true;
                    $this->fila[] = $vizinho;
                }
            }
        }

        return $caminho;
    }
}
