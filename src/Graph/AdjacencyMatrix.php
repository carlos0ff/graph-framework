<?php

namespace Algorithms\Graph;

/**
 * Representação de um grafo por matriz de adjacência.
 */
class AdjacencyMatrix
{
    /** @var Vertex[] */
    private array $vertices;

    /** @var int */
    private int $qtdVertices;

    /** @var int[][] */
    private array $matriz;

    /** @var bool */
    private bool $direcionado;

    /**
     * @param Vertex[] $vertices
     * @param bool $direcionado
     */
    public function __construct(array $vertices, bool $direcionado)
    {
        $this->vertices = $vertices;
        $this->qtdVertices = count($vertices);
        $this->direcionado = $direcionado;

        $this->matriz = array_fill(0, $this->qtdVertices, array_fill(0, $this->qtdVertices, 0));
    }

    /**
     * Conecta dois vértices pelos seus índices na matriz.
     * @param int $indiceVerticeOrigem
     * @param int $indiceVerticeDestino
     * @param int $peso
     * @return void
     */
    public function conectarVertices(int $indiceVerticeOrigem, int $indiceVerticeDestino, int $peso = 1): void
    {
        $this->matriz[$indiceVerticeOrigem][$indiceVerticeDestino] = $peso;

        if (!$this->direcionado) {
            $this->matriz[$indiceVerticeDestino][$indiceVerticeOrigem] = $peso;
        }
    }

    /**
     * Imprime a matriz de adjacência.
     * @return void
     */
    public function imprimir(): void
    {
        for ($i = 0; $i < $this->qtdVertices; $i++) {
            for ($j = 0; $j < $this->qtdVertices; $j++) {
                echo $this->matriz[$i][$j] . ' ';
            }
            echo PHP_EOL;
        }
    }
}
