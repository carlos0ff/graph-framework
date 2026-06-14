<?php

namespace Algorithms\Graph\Algorithms;

use Algorithms\Graph\Graph;
use SplQueue;

/**
 * BuscaLarguraImperativa -> BFS usando SplQueue como fila.
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
     * Realiza uma busca em largura (BFS).
     *
     * @param string $rotulo
     * @return array
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