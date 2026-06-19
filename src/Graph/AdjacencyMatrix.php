<?php

namespace Algorithms\Graph;

/**
 * Representação de um grafo por matriz de adjacência quadrada (n × n).
 *
 * Cada célula matriz[i][j] armazena o peso da aresta entre o vértice de índice
 * i e o de índice j (0 = sem aresta). Em grafos não direcionados a matriz é
 * simétrica: matriz[i][j] === matriz[j][i].
 *
 * @package Algorithms\Graph
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
     * @param Vertex[] $vertices    Lista ordenada de vértices; o índice na lista é o índice na matriz.
     * @param bool     $direcionado true = dígrafo (matriz assimétrica), false = não direcionado (simétrica).
     */
    public function __construct(array $vertices, bool $direcionado)
    {
        $this->vertices = $vertices;
        $this->qtdVertices = count($vertices);
        $this->direcionado = $direcionado;

        $this->matriz = array_fill(0, $this->qtdVertices, array_fill(0, $this->qtdVertices, 0));
    }

    /**
     * Registra uma aresta entre dois vértices identificados por seus índices na matriz.
     *
     * Em grafos não direcionados preenche também a célula simétrica [destino][origem].
     *
     * @param  int $indiceVerticeOrigem  Índice do vértice de origem.
     * @param  int $indiceVerticeDestino Índice do vértice de destino.
     * @param  int $peso                 Peso da aresta (padrão 1 para grafos sem peso).
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
     * Imprime a matriz de adjacência no formato tabular (linhas × colunas).
     *
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
