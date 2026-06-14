<?php

namespace Algorithms\Graph\Algorithms;

use Algorithms\Graph\Graph;

/**
 * BuscaLargura -> BFS
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
     * Realiza uma busca em largura (BFS).
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
