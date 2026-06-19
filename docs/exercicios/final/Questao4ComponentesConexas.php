<?php

namespace Exercicios\Final;

use Algorithms\Graph\Graph;

/**
 * Questão 4 — Componentes conexas (0,25 pontos)
 *
 * Dado o grafo não direcionado G = (V, E):
 *
 *   V = {A, B, C, D, E, F, G}
 *   E = {(A,B), (A,C), (B,C), (C,D), (E,F)}
 *
 * a) Identifique todos os componentes conexos do grafo.
 * b) Explique se o grafo é conexo ou não.
 *
 * Representação visual:
 *
 *   A --- B         E --- F
 *    \   /
 *     \ /
 *      C             G
 *      |
 *      D
 *
 * Componentes:
 *   C1 = {A, B, C, D}  (conectados por arestas)
 *   C2 = {E, F}         (conectados entre si, isolados do C1)
 *   C3 = {G}            (vértice isolado — sem arestas)
 *
 * Conclusão: o grafo NÃO é conexo, pois possui 3 componentes distintos.
 * Para ser conexo, precisaria existir caminho entre todo par de vértices.
 */
class Questao4ComponentesConexas
{
    /**
     * Constrói o grafo da questão 4.
     */
    public static function criarGrafo(): Graph
    {
        $g = new Graph(7, false);

        foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G'] as $v) {
            $g->addVertice($v);
        }

        $g->addAresta('A', 'B');
        $g->addAresta('A', 'C');
        $g->addAresta('B', 'C');
        $g->addAresta('C', 'D');
        $g->addAresta('E', 'F');

        // G não possui arestas (vértice isolado)
        return $g;
    }

    /**
     * Encontra todos os componentes conexos via BFS a partir de cada vértice
     * ainda não visitado.
     *
     * @return array<int, array<int, string>>  lista de componentes (cada uma = array de rótulos)
     */
    public static function encontrarComponentes(Graph $grafo): array
    {
        $visitados  = [];
        $componentes = [];

        foreach ($grafo->getVertices() as $vertice) {
            $r = $vertice->getRotulo();

            if (isset($visitados[$r])) {
                continue;
            }

            /** BFS a partir de $r para mapear toda a componente **/
            $componente = [];
            $fila       = [$r];
            $visitados[$r] = true;

            while (!empty($fila)) {
                $atual       = array_shift($fila);
                $componente[] = $atual;

                foreach ($grafo->getAdjacentes($atual) as $vizinho) {
                    $rv = $vizinho->getRotulo();
                    if (!isset($visitados[$rv])) {
                        $visitados[$rv] = true;
                        $fila[]         = $rv;
                    }
                }
            }

            $componentes[] = $componente;

        }

        return $componentes;
    }

    /**
     * Responde às alíneas a) e b) do enunciado.
     * @param Graph $grafo
     * @return void
     */
    public static function analisar(Graph $grafo): void
    {
        $componentes = self::encontrarComponentes($grafo);
        $qtd         = count($componentes);

        echo "=== Questão 4 — Componentes Conexas ===\n\n";

        echo "a) Componentes conexos identificados:\n";
        foreach ($componentes as $i => $comp) {
            $idx = $i + 1;
            sort($comp);
            echo "   C$idx = {" . implode(', ', $comp) . "}\n";
        }

        echo "\nb) O grafo é conexo? ";
        if ($qtd === 1) {
            echo "SIM.\n";
            echo "   Existe caminho entre todo par de vértices — o grafo possui apenas 1 componente.\n";
        } else {
            echo "NÃO.\n";
            echo "   O grafo possui $qtd componentes distintos.\n";
            echo "   Um grafo é conexo somente quando existe caminho entre qualquer par de vértices.\n";
            echo "   Aqui, por exemplo, não existe caminho de A até E, nem de qualquer vértice até G.\n";
        }
    }
}

// ---------------------------------------------------------------------------
// Execução
// ---------------------------------------------------------------------------
require_once __DIR__ . '/../../../vendor/autoload.php';

Questao4ComponentesConexas::analisar(Questao4ComponentesConexas::criarGrafo());
