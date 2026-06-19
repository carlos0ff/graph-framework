<?php

namespace Algorithms\Graph;

/**
 * Representa um vértice do grafo.
 *
 * Armazena o rótulo e os contadores de grau total, grau de entrada e grau de
 * saída, que são incrementados pelo {@see Graph} a cada aresta conectada.
 *
 * @package Algorithms\Graph
 */
class Vertex {

    /** @var string **/
    private string $rotulo;

    /** @var int **/
    private int $grau = 0;

    /** @var int **/
    private int $grauEntrada = 0;

    /** @var int **/
    private int $grauSaida = 0;

    /**
     * Construtor da classe Vertex.
     * @param string $rotulo O rótulo do vértice.
     */
    public function __construct(string $rotulo)
    {
        $this->rotulo = $rotulo;
    }

    /**
     * Retorna o rótulo do vértice.
     * @return string
     */
    public function getRotulo(): string
    {
        return $this->rotulo;
    }

    /**
     * Retorna o grau do vértice.
     * @return int
     */
    public function getGrau(): int
    {
        return $this->grau;
    }

    /**
     * Incrementa o grau total do vértice e retorna o novo valor.
     *
     * @param  int $value Quantidade a incrementar (normalmente 1).
     * @return int        Grau total atualizado.
     */
    public function addGrau(int $value): int
    {
        $this->grau += $value;
        return $this->grau;
    }

    /**
     * Incrementa o grau de entrada (arestas que chegam) e retorna o novo valor.
     *
     * @param  int $value Quantidade a incrementar (normalmente 1).
     * @return int        Grau de entrada atualizado.
     */
    public function addGrauEntrada(int $value): int
    {
        $this->grauEntrada += $value;
        return $this->grauEntrada;
    }

    /**
     * Incrementa o grau de saída (arestas que partem) e retorna o novo valor.
     *
     * @param  int $value Quantidade a incrementar (normalmente 1).
     * @return int        Grau de saída atualizado.
     */
    public function addGrauSaida(int $value): int
    {
        $this->grauSaida += $value;
        return $this->grauSaida;
    }

    /**
     * Retorna a representação string do vértice.
     * @return string
     */
    public function __toString(): string
    {
        return sprintf("Vertice{rotulo='%s', grau=%d}", $this->rotulo, $this->grau);
    }

    /**
     * Retorna o hashcode do vértice.
     * @return string
     */
    public function hashCode(): string
    {
        return md5($this->rotulo . $this->grau);
    }
}
