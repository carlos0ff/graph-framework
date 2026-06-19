<?php

namespace Algorithms\Graph\Algorithms;

use Algorithms\Graph\Graph;
use SplQueue;

/**
 * Busca em Largura (BFS) usando {@see \SplQueue} como fila.
 *
 * Variante imperativa da BFS com fila de dupla-extremidade da SPL, que oferece
 * desempenho O(1) para enqueue/dequeue em contraste com o array_shift O(n) de
 * {@see BuscaLargura}.
 *
 * @package Algorithms\Graph\Algorithms
 */
class BuscaLarguraImperativa
{
    /** @var Graph */
    private Graph $grafo;

    /**@var SplQueue */
    private SplQueue $fila;

    /**@var array */
    private array $visitados;

    /**
     * Construtor da classe BuscaLarguraImperativa.
     * @param Graph $grafo
     */
    public function __construct(Graph $grafo)
    {
        $this->grafo = $grafo;
        $this->fila = new SplQueue();
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

        $this->fila->enqueue($origem);
        $this->visitados[$origem->getRotulo()] = true;

        while (!$this->fila->isEmpty()) {
            $atual = $this->fila->dequeue();
            $caminho[] = $atual;

            foreach ($this->grafo->getAdjacentes($atual->getRotulo()) as $vizinho) {
                if (!isset($this->visitados[$vizinho->getRotulo()])) {
                    $this->visitados[$vizinho->getRotulo()] = true;
                    $this->fila->enqueue($vizinho);
                }
            }
        }

        return $caminho;
    }
}