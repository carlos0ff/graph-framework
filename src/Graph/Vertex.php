<?php

namespace Algorithms\Graph;

/**
 * Classe que representa um vértice no grafo.
 * POJO-Bean
 * Vertice     -> Vertex
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
     *
     * @param int $value
     * @return int
     */
    public function addGrau(int $value): int
    {
        $this->grau += $value;
        return $this->grau;
    }

    /**
     *
     * @param int $value
     * @return int
     */
    public function addGrauEntrada(int $value): int
    {
        $this->grauEntrada += $value;
        
        return $this->grauEntrada;
    }

    /**
     *
     * @param int $value
     * @return int
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
