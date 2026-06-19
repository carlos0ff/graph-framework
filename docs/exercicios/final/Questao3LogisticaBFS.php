<?php

namespace Exercicios\Final;

/**
 * Questão 3 — Sistema de Logística com BFS (0,25 pontos)
 *
 * Encontra o menor caminho (em nº de arestas) entre dois centros de
 * distribuição em um grafo não direcionado representado por matriz de
 * adjacência.
 *
 * Requisitos atendidos:
 *   - Grafo não direcionado com matriz de adjacência
 *   - BFS para menor caminho em quantidade de arestas
 *   - Reconstrução e exibição do caminho
 *   - Tratamento de caso sem caminho
 */
class Questao3LogisticaBFS
{
    /** @var int */
    private int $qtdVertices;

    /** @var int[][] */
    private array $matriz;

    /** @var string[] */
    private array $rotulos;

    /**
     * @param string[] $rotulos Nome de cada centro de distribuição.
     */
    public function __construct(array $rotulos)
    {
        $this->rotulos      = array_values($rotulos);
        $this->qtdVertices  = count($rotulos);
        $this->matriz       = array_fill(0, $this->qtdVertices,
                                array_fill(0, $this->qtdVertices, 0));
    }

    /** Adiciona uma aresta não direcionada entre os vértices de índice $u e $v. */
    public function addAresta(int $u, int $v): void
    {
        $this->matriz[$u][$v] = 1;
        $this->matriz[$v][$u] = 1;
    }

    /**
     * BFS: retorna o caminho (índices) de $origem a $destino,
     * ou [] se não existir caminho.
     *
     * @return int[]
     */
    public function menorCaminho(int $origem, int $destino): array
    {
        $visitado    = array_fill(0, $this->qtdVertices, false);
        $predecessor = array_fill(0, $this->qtdVertices, -1);

        $visitado[$origem] = true;
        $fila = [$origem];

        while (!empty($fila)) {
            $atual = array_shift($fila);

            if ($atual === $destino) {
                return $this->reconstruirCaminho($predecessor, $origem, $destino);
            }

            for ($v = 0; $v < $this->qtdVertices; $v++) {
                if ($this->matriz[$atual][$v] === 1 && !$visitado[$v]) {
                    $visitado[$v]    = true;
                    $predecessor[$v] = $atual;
                    $fila[]          = $v;
                }
            }
        }

        return []; // sem caminho
    }

    /**
     * Reconstrói o caminho seguindo os predecessores de trás para frente.
     *
     * @param  int[] $predecessor
     * @return int[]
     */
    private function reconstruirCaminho(array $predecessor, int $origem, int $destino): array
    {
        $caminho = [];
        $v       = $destino;

        while ($v !== $origem) {
            array_unshift($caminho, $v);
            $v = $predecessor[$v];
        }
        array_unshift($caminho, $origem);

        return $caminho;
    }

    /**
     * Exibe o resultado da busca para um par de centros informados por nome.
     */
    public function exibirCaminho(string $nomeOrigem, string $nomeDestino): void
    {
        $origem  = array_search($nomeOrigem,  $this->rotulos, true);
        $destino = array_search($nomeDestino, $this->rotulos, true);

        if ($origem === false || $destino === false) {
            echo "Centro de distribuição não encontrado.\n";
            return;
        }

        $caminho = $this->menorCaminho((int) $origem, (int) $destino);

        if (empty($caminho)) {
            echo "Não existe caminho entre '$nomeOrigem' e '$nomeDestino'.\n";
            return;
        }

        $nomes   = array_map(fn(int $i) => $this->rotulos[$i], $caminho);
        $arestas = count($caminho) - 1;
        printf(
            "Menor caminho de '%s' a '%s' (%d %s): %s\n",
            $nomeOrigem,
            $nomeDestino,
            $arestas,
            $arestas === 1 ? 'aresta' : 'arestas',
            implode(' → ', $nomes)
        );
    }
}

// ---------------------------------------------------------------------------
// Execução
// ---------------------------------------------------------------------------
require_once __DIR__ . '/../../../vendor/autoload.php';

/*
 * Rede de centros de distribuição:
 *
 *   CD-A --- CD-B --- CD-E
 *    |        |         |
 *   CD-C --- CD-D      CD-F
 *
 * Índices: CD-A=0, CD-B=1, CD-C=2, CD-D=3, CD-E=4, CD-F=5
 */
$centros = ['CD-A', 'CD-B', 'CD-C', 'CD-D', 'CD-E', 'CD-F'];
$sistema = new Questao3LogisticaBFS($centros);

$sistema->addAresta(0, 1); // CD-A — CD-B
$sistema->addAresta(0, 2); // CD-A — CD-C
$sistema->addAresta(1, 3); // CD-B — CD-D
$sistema->addAresta(1, 4); // CD-B — CD-E
$sistema->addAresta(2, 3); // CD-C — CD-D
$sistema->addAresta(4, 5); // CD-E — CD-F

echo "=== Sistema de Logística — BFS ===\n";
$sistema->exibirCaminho('CD-A', 'CD-F'); // A→B→E→F  (3 arestas)
$sistema->exibirCaminho('CD-C', 'CD-E'); // C→A→B→E  (3 arestas)
$sistema->exibirCaminho('CD-D', 'CD-F'); // D→B→E→F  (3 arestas)
$sistema->exibirCaminho('CD-F', 'CD-F'); // mesmo vértice (0 arestas)
$sistema->exibirCaminho('CD-A', 'CD-X'); // centro inexistente
