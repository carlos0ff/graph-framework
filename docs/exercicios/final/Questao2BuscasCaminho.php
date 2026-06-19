<?php

namespace Exercicios\Final;

use Algorithms\Graph\Graph;

/**
 * Questão 2 — BFS e DFS para menor caminho a → z (0,25 pontos)
 *
 * Executa BFS (garante caminho mínimo em arestas) e DFS (encontra um caminho,
 * não necessariamente mínimo) em cada um dos três grafos abaixo.
 *
 * Topologias extraídas do enunciado (grafos não direcionados e sem peso):
 *
 * Grafo 1 — lattice em forma de diamante (21 vértices):
 *
 *         c       f
 *       b   e   h   i   j
 *     a   d   g   p   s     z
 *       k   m   o   q
 *         n   r   t
 *
 * Grafo 2 — diamantes encadeados (12 vértices):
 *
 *     b   e   g   i
 *   a   d   h   k   z
 *     c   f   l
 *
 * Grafo 3 — malha em forma de pipa (13 vértices):
 *
 *     b   f   i   m
 *   a   c   h   j   z
 *     d   g   k   s
 */
class Questao2BuscasCaminho
{
    // -----------------------------------------------------------------------
    // Definição dos grafos
    // -----------------------------------------------------------------------

    /**
     * Grafo 1: lattice em diamante, 21 vértices.
     */
    public static function criarGrafo1(): Graph
    {
        $vertices = ['a','b','c','d','e','f','g','h','i','j','k','m','n','o','p','q','r','s','t','z'];
        $g = new Graph(count($vertices), false);
        foreach ($vertices as $v) {
            $g->addVertice($v);
        }

        // camada a → {b, d, k}
        $g->addAresta('a', 'b'); $g->addAresta('a', 'd'); $g->addAresta('a', 'k');
        // camada b → {c, e}
        $g->addAresta('b', 'c'); $g->addAresta('b', 'e');
        // camada d → {e, g, m}
        $g->addAresta('d', 'e'); $g->addAresta('d', 'g'); $g->addAresta('d', 'm');
        // camada k → {m, n}
        $g->addAresta('k', 'm'); $g->addAresta('k', 'n');
        // camada c → {f}
        $g->addAresta('c', 'f');
        // camada e → {f, g, h, i}
        $g->addAresta('e', 'f'); $g->addAresta('e', 'g');
        $g->addAresta('e', 'h'); $g->addAresta('e', 'i');
        // camada g → {h, i, o, p}
        $g->addAresta('g', 'h'); $g->addAresta('g', 'i');
        $g->addAresta('g', 'o'); $g->addAresta('g', 'p');
        // camada m → {o, q}
        $g->addAresta('m', 'o'); $g->addAresta('m', 'q');
        // camada n → {r}
        $g->addAresta('n', 'r');
        // camada h → {j, s}
        $g->addAresta('h', 'j'); $g->addAresta('h', 's');
        // camada i → {j, s}
        $g->addAresta('i', 'j'); $g->addAresta('i', 's');
        // camada o → {p, q}
        $g->addAresta('o', 'p'); $g->addAresta('o', 'q');
        // camada p → {q, s}
        $g->addAresta('p', 'q'); $g->addAresta('p', 's');
        // camada q → {t}
        $g->addAresta('q', 't');
        // camada r → {t}
        $g->addAresta('r', 't');
        // camada → z
        $g->addAresta('j', 'z'); $g->addAresta('s', 'z'); $g->addAresta('t', 'z');

        return $g;
    }

    /**
     * Grafo 2: diamantes encadeados, 12 vértices.
     */
    public static function criarGrafo2(): Graph
    {
        $vertices = ['a','b','c','d','e','f','g','h','i','k','l','z'];
        $g = new Graph(count($vertices), false);
        foreach ($vertices as $v) {
            $g->addVertice($v);
        }

        $g->addAresta('a', 'b'); $g->addAresta('a', 'c');
        $g->addAresta('b', 'd'); $g->addAresta('b', 'e');
        $g->addAresta('c', 'd'); $g->addAresta('c', 'f');
        $g->addAresta('d', 'e'); $g->addAresta('d', 'f');
        $g->addAresta('d', 'g'); $g->addAresta('d', 'h');
        $g->addAresta('e', 'g');
        $g->addAresta('f', 'h'); $g->addAresta('f', 'l');
        $g->addAresta('g', 'h'); $g->addAresta('g', 'i');
        $g->addAresta('h', 'i'); $g->addAresta('h', 'k'); $g->addAresta('h', 'l');
        $g->addAresta('i', 'z');
        $g->addAresta('k', 'z');
        $g->addAresta('l', 'z');

        return $g;
    }

    /**
     * Grafo 3: malha em forma de pipa, 13 vértices.
     */
    public static function criarGrafo3(): Graph
    {
        $vertices = ['a','b','c','d','f','g','h','i','j','k','m','s','z'];
        $g = new Graph(count($vertices), false);
        foreach ($vertices as $v) {
            $g->addVertice($v);
        }

        $g->addAresta('a', 'b'); $g->addAresta('a', 'c'); $g->addAresta('a', 'd');
        $g->addAresta('b', 'f'); $g->addAresta('b', 'c');
        $g->addAresta('c', 'f'); $g->addAresta('c', 'g');
        $g->addAresta('d', 'g');
        $g->addAresta('f', 'h'); $g->addAresta('f', 'i');
        $g->addAresta('g', 'h'); $g->addAresta('g', 'k');
        $g->addAresta('h', 'i'); $g->addAresta('h', 'j'); $g->addAresta('h', 'k');
        $g->addAresta('i', 'j'); $g->addAresta('i', 'm');
        $g->addAresta('j', 'm'); $g->addAresta('j', 's');
        $g->addAresta('k', 's');
        $g->addAresta('m', 'z');
        $g->addAresta('s', 'z');

        return $g;
    }

    // -----------------------------------------------------------------------
    // Algoritmos
    // -----------------------------------------------------------------------

    /**
     * BFS com reconstrução de caminho: retorna o caminho mais curto (em nº de
     * arestas) de $origem a $destino, ou [] se não existir.
     *
     * @param  Graph  $grafo
     * @param  string $origem
     * @param  string $destino
     * @return string[]
     */
    public static function bfsCaminho(Graph $grafo, string $origem, string $destino): array
    {
        $visitados    = [$origem => true];
        $predecessores = [$origem => null];
        $fila         = [$origem];

        while (!empty($fila)) {
            $atual = array_shift($fila);

            if ($atual === $destino) {
                return self::reconstruir($predecessores, $destino);
            }

            foreach ($grafo->getAdjacentes($atual) as $vizinho) {
                $r = $vizinho->getRotulo();
                if (!isset($visitados[$r])) {
                    $visitados[$r]     = true;
                    $predecessores[$r] = $atual;
                    $fila[]            = $r;
                }
            }
        }

        return []; // sem caminho
    }

    /**
     * DFS com reconstrução de caminho: retorna um caminho de $origem a $destino
     * (não necessariamente o mais curto), ou [] se não existir.
     *
     * @param  Graph  $grafo
     * @param  string $origem
     * @param  string $destino
     * @return string[]
     */
    public static function dfsCaminho(Graph $grafo, string $origem, string $destino): array
    {
        $visitados = [];
        $caminho   = [];

        if (self::dfsRecursivo($grafo, $origem, $destino, $visitados, $caminho)) {
            return $caminho;
        }

        return []; // sem caminho
    }

    /**
     * @param  string[]  $visitados (por referência)
     * @param  string[]  $caminho   (por referência, acumula vértices visitados)
     */
    private static function dfsRecursivo(
        Graph $grafo,
        string $atual,
        string $destino,
        array &$visitados,
        array &$caminho
    ): bool {
        $visitados[$atual] = true;
        $caminho[]         = $atual;

        if ($atual === $destino) {
            return true;
        }

        foreach ($grafo->getAdjacentes($atual) as $vizinho) {
            $r = $vizinho->getRotulo();
            if (!isset($visitados[$r])) {
                if (self::dfsRecursivo($grafo, $r, $destino, $visitados, $caminho)) {
                    return true;
                }
            }
        }

        array_pop($caminho); // retrocede (backtrack)
        return false;
    }

    /**
     * Reconstrói caminho a partir do mapa de predecessores.
     *
     * @param  array<string,string|null> $pred
     * @param  string                    $destino
     * @return string[]
     */
    private static function reconstruir(array $pred, string $destino): array
    {
        $caminho = [];
        $atual   = $destino;
        while ($atual !== null) {
            array_unshift($caminho, $atual);
            $atual = $pred[$atual];
        }
        return $caminho;
    }
}

// ---------------------------------------------------------------------------
// Execução
// ---------------------------------------------------------------------------
require_once __DIR__ . '/../../../vendor/autoload.php';

$grafos = [
    'Grafo 1' => Questao2BuscasCaminho::criarGrafo1(),
    'Grafo 2' => Questao2BuscasCaminho::criarGrafo2(),
    'Grafo 3' => Questao2BuscasCaminho::criarGrafo3(),
];

foreach ($grafos as $nome => $grafo) {
    echo "=== $nome — caminho de 'a' até 'z' ===\n";

    $bfs = Questao2BuscasCaminho::bfsCaminho($grafo, 'a', 'z');
    $dfs = Questao2BuscasCaminho::dfsCaminho($grafo, 'a', 'z');

    if (empty($bfs)) {
        echo "  BFS: sem caminho\n";
    } else {
        printf("  BFS (menor): %s  [comprimento: %d arestas]\n",
            implode(' → ', $bfs), count($bfs) - 1);
    }

    if (empty($dfs)) {
        echo "  DFS: sem caminho\n";
    } else {
        printf("  DFS (um caminho): %s  [comprimento: %d arestas]\n",
            implode(' → ', $dfs), count($dfs) - 1);
    }

    echo "\n";
}
