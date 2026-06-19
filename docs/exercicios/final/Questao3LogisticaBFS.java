import java.util.ArrayDeque;
import java.util.Arrays;
import java.util.Queue;

/**
 * Questão 3 — Sistema de Logística com BFS (0,25 pontos)
 *
 * Encontra o menor caminho (em nº de arestas) entre dois centros de
 * distribuição em um grafo não direcionado representado por matriz de
 * adjacência.
 *
 * Requisitos atendidos:
 *   - Linguagem Java
 *   - Grafo não direcionado com matriz de adjacência
 *   - BFS para menor caminho em quantidade de arestas
 *   - Reconstrução e exibição do caminho
 *   - Tratamento de caso sem caminho
 */
public class Questao3LogisticaBFS {

    private final int    qtdVertices;
    private final int[][] matriz;       // 1 = aresta, 0 = sem aresta
    private final String[] rotulos;     // nome de cada centro (índice = vértice)

    public Questao3LogisticaBFS(String[] rotulos) {
        this.qtdVertices = rotulos.length;
        this.rotulos     = Arrays.copyOf(rotulos, qtdVertices);
        this.matriz      = new int[qtdVertices][qtdVertices];
    }

    /** Adiciona uma aresta não direcionada entre origem e destino. */
    public void addAresta(int origem, int destino) {
        matriz[origem][destino] = 1;
        matriz[destino][origem] = 1;
    }

    /**
     * BFS: retorna o caminho (índices de vértices) de origem a destino,
     * ou um array vazio se não existir caminho.
     */
    public int[] menorCaminho(int origem, int destino) {
        boolean[] visitado   = new boolean[qtdVertices];
        int[]     predecessor = new int[qtdVertices];
        Arrays.fill(predecessor, -1);

        Queue<Integer> fila = new ArrayDeque<>();
        visitado[origem] = true;
        fila.add(origem);

        while (!fila.isEmpty()) {
            int atual = fila.poll();

            if (atual == destino) {
                return reconstruirCaminho(predecessor, origem, destino);
            }

            for (int vizinho = 0; vizinho < qtdVertices; vizinho++) {
                if (matriz[atual][vizinho] == 1 && !visitado[vizinho]) {
                    visitado[vizinho]     = true;
                    predecessor[vizinho]  = atual;
                    fila.add(vizinho);
                }
            }
        }

        return new int[0]; // sem caminho
    }

    /** Reconstrói o caminho seguindo os predecessores de trás para frente. */
    private int[] reconstruirCaminho(int[] predecessor, int origem, int destino) {
        // conta o tamanho do caminho
        int tamanho = 0;
        int v = destino;
        while (v != origem) {
            tamanho++;
            v = predecessor[v];
        }
        tamanho++; // inclui a origem

        int[] caminho = new int[tamanho];
        v = destino;
        for (int i = tamanho - 1; i >= 0; i--) {
            caminho[i] = v;
            if (v != origem) {
                v = predecessor[v];
            }
        }
        return caminho;
    }

    /** Exibe o resultado da busca no console. */
    public void exibirCaminho(String nomeOrigem, String nomeDestino) {
        int origem  = indexOf(nomeOrigem);
        int destino = indexOf(nomeDestino);

        if (origem == -1 || destino == -1) {
            System.out.println("Centro de distribuição não encontrado.");
            return;
        }

        int[] caminho = menorCaminho(origem, destino);

        if (caminho.length == 0) {
            System.out.printf("Não existe caminho entre '%s' e '%s'.%n",
                    nomeOrigem, nomeDestino);
            return;
        }

        StringBuilder sb = new StringBuilder();
        for (int i = 0; i < caminho.length; i++) {
            if (i > 0) sb.append(" → ");
            sb.append(rotulos[caminho[i]]);
        }

        System.out.printf("Menor caminho de '%s' a '%s' (%d arestas): %s%n",
                nomeOrigem, nomeDestino, caminho.length - 1, sb);
    }

    private int indexOf(String rotulo) {
        for (int i = 0; i < qtdVertices; i++) {
            if (rotulos[i].equals(rotulo)) return i;
        }
        return -1;
    }

    // -----------------------------------------------------------------------
    // Demonstração
    // -----------------------------------------------------------------------
    public static void main(String[] args) {
        /*
         * Rede de centros de distribuição:
         *
         *   CD-A --- CD-B --- CD-E
         *    |       |         |
         *   CD-C --- CD-D     CD-F
         *
         * Índices: CD-A=0, CD-B=1, CD-C=2, CD-D=3, CD-E=4, CD-F=5
         */
        String[] centros = {"CD-A", "CD-B", "CD-C", "CD-D", "CD-E", "CD-F"};
        Questao3LogisticaBFS sistema = new Questao3LogisticaBFS(centros);

        sistema.addAresta(0, 1); // CD-A — CD-B
        sistema.addAresta(0, 2); // CD-A — CD-C
        sistema.addAresta(1, 3); // CD-B — CD-D
        sistema.addAresta(1, 4); // CD-B — CD-E
        sistema.addAresta(2, 3); // CD-C — CD-D
        sistema.addAresta(4, 5); // CD-E — CD-F

        System.out.println("=== Sistema de Logística — BFS ===");
        sistema.exibirCaminho("CD-A", "CD-F"); // caminho: A→B→E→F (3 arestas)
        sistema.exibirCaminho("CD-C", "CD-E"); // caminho: C→A→B→E ou C→D→B→E (3 arestas)
        sistema.exibirCaminho("CD-D", "CD-F"); // caminho: D→B→E→F (3 arestas)
        sistema.exibirCaminho("CD-F", "CD-F"); // mesmo vértice (0 arestas)
    }
}
