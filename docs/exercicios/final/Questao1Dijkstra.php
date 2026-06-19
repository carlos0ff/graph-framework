<?php

namespace Exercicios\Final;

use Algorithms\Graph\Graph;

/**
 * Questão 1 — Dijkstra (0,25 pontos)
 *
 * Encontra o comprimento dos caminhos mais curtos do vértice "a" a cada um
 * dos outros vértices dos grafos G1 e G2, exibindo também o caminho.
 *
 * G1 (6 vértices, não direcionado):
 *        b
 *      2/ \6
 *     a----c
 *    14\  5|3
 *      f---d
 *       \8/
 *        e (e-d:5)
 *
 * G2 (7 vértices, não direcionado):
 *       a
 *     20/ \12
 *     g     b
 *   4/ \8 14/ \12
 *  f    e---c
 *   \6 /6\6 \4
 *    d----d   (f-d:6, e-d:6, c-d:4)
 */
class Questao1Dijkstra
{
    /**
     * G1: a-b:2  b-c:6  a-c:8  c-d:3  a-f:14  f-d:6  f-e:8  e-d:5
     * 
     */
    public static function criarG1(): Graph
    {
        $g = new Graph(6, false);

        foreach (['a', 'b', 'c', 'd', 'e', 'f'] as $v) {
            $g->addVertice($v);
        }

        $g->addAresta('a', 'b', 2);
        $g->addAresta('b', 'c', 6);
        $g->addAresta('a', 'c', 8);
        $g->addAresta('c', 'd', 3);
        $g->addAresta('a', 'f', 14);
        $g->addAresta('f', 'd', 6);
        $g->addAresta('f', 'e', 8);
        $g->addAresta('e', 'd', 5);

        return $g;
    }

    /**
     * G2: a-g:20  a-b:12  g-f:4  g-e:8  b-e:14  b-c:12  f-e:6  f-d:6  e-d:6  c-d:4
     */
    public static function criarG2(): Graph
    {
        $g = new Graph(7, false);

        foreach (['a', 'b', 'c', 'd', 'e', 'f', 'g'] as $v) {
            $g->addVertice($v);
        }

        $g->addAresta('a', 'g', 20);
        $g->addAresta('a', 'b', 12);
        $g->addAresta('g', 'f', 4);
        $g->addAresta('g', 'e', 8);
        $g->addAresta('b', 'e', 14);
        $g->addAresta('b', 'c', 12);
        $g->addAresta('f', 'e', 6);
        $g->addAresta('f', 'd', 6);
        $g->addAresta('e', 'd', 6);
        $g->addAresta('c', 'd', 4);

        return $g;
    }

    /**
     * Algoritmo de Dijkstra: distâncias mínimas e predecessores a partir da origem.
     *
     * @param Graph  $grafo
     * @param string $origem
     * @return array{distancias: array<string,int>, predecessores: array<string,string|null>}
     */
    public static function dijkstra(Graph $grafo, string $origem): array
    {
        $INF = PHP_INT_MAX;

        $distancias   = [];
        $predecessores = [];
        $naoVisitados = [];

        foreach ($grafo->getVertices() as $v) {
            $r = $v->getRotulo();
            $distancias[$r]    = $INF;
            $predecessores[$r] = null;
            $naoVisitados[$r]  = true;
        }

        $distancias[$origem] = 0;

        while (!empty($naoVisitados)) {
            // seleciona vértice não visitado com menor distância acumulada
            $u = null;
            foreach ($naoVisitados as $r => $_) {
                if ($u === null || $distancias[$r] < $distancias[$u]) {
                    $u = $r;
                }
            }

            if ($distancias[$u] === $INF) {
                break; // vértices restantes são inacessíveis
            }

            unset($naoVisitados[$u]);

            foreach ($grafo->getArestas()[$u] as $aresta) {
                $v   = $aresta->getDestino()->getRotulo();
                $alt = $distancias[$u] + $aresta->getPeso();

                if ($alt < $distancias[$v]) {
                    $distancias[$v]    = $alt;
                    $predecessores[$v] = $u;
                }
            }
        }

        return ['distancias' => $distancias, 'predecessores' => $predecessores];
    }

    /**
     * Reconstrói o caminho até $destino usando o array de predecessores.
     *
     * @param  array<string,string|null> $predecessores
     * @param  string                    $destino
     * @return string[]
     */
    public static function reconstruirCaminho(array $predecessores, string $destino): array
    {
        $caminho = [];
        $atual   = $destino;

        while ($atual !== null) {
            array_unshift($caminho, $atual);

            $atual = $predecessores[$atual];
        }
        return $caminho;
    }
}

// ---------------------------------------------------------------------------
// Execução
// ---------------------------------------------------------------------------
require_once __DIR__ . '/../../../vendor/autoload.php';

$grafos = [
    'G1' => Questao1Dijkstra::criarG1(), 
    'G2' => Questao1Dijkstra::criarG2()
];

foreach ($grafos as $nome => $grafo) {

    echo "=== $nome — Dijkstra a partir de 'a' ===\n";

    ['distancias' => $dist, 'predecessores' => $pred] = Questao1Dijkstra::dijkstra($grafo, 'a');

    foreach ($dist as $v => $d) {
        if ($v === 'a') {
            continue;
        }

        $caminho = implode(' → ', Questao1Dijkstra::reconstruirCaminho($pred, $v));
        $distStr = $d === PHP_INT_MAX ? '∞ (inacessível)' : (string) $d;

        printf("  a → %-2s  distância: %-4s  caminho: %s\n", $v, $distStr, $caminho);
    }

    echo "\n";
}
