<?php

namespace Algorithms\Graph;

/**
 * Aresta      -> Edge
 */
class Edge {

    /** @var Vertex */
    private Vertex $destino;

    /** @var int **/
    private int $peso;

    /**
     * @param Vertex $destino O vértice de destino da aresta.
     * @param int $peso O peso da aresta.
     */
    public function __construct(Vertex $destino, int $peso)
    {
        $this->destino = $destino;
        $this->peso = $peso;
    }

    /**
     * Retorna o vértice de destino da aresta.
     * @return Vertex
     */
    public function getDestino(): Vertex
    {
        return $this->destino;
    }

    /**
     * Retorna o peso da aresta.
     * @return int
     */
    public function getPeso(): int
    {
        return $this->peso;
    }


    /**
     * Retorna a representação string da aresta.
     * @return string
     */
    public function __toString(): string
    {
        return sprintf("Aresta{destino=%s, peso=%s}", $this->destino, $this->peso);
    }
}
