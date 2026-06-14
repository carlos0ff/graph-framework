# graph-framework

![PHP](https://img.shields.io/badge/PHP-%5E8.2-777BB4?logo=php&logoColor=white)
![License](https://img.shields.io/badge/license-MIT-green)
![PHPUnit](https://img.shields.io/badge/tests-PHPUnit-3776AB)

Biblioteca de estruturas de dados e algoritmos de grafos implementada em PHP puro, sem dependências externas.

![Grafo](docs/images/graph.png)

## Sobre o projeto

Este projeto nasceu na cadeira de Teoria dos Grafos, onde as estruturas e algoritmos
foram implementados originalmente em Java. A proposta aqui foi recriar tudo do zero
em PHP — sem o uso de IA para gerar o código — como exercício para validar e fixar o
aprendizado dos conceitos, das estruturas de dados e dos algoritmos clássicos sobre
grafos.

## Requisitos

- PHP ^8.2
- [Composer](https://getcomposer.org/)

## Instalação

```bash
git clone git@github.com:carlos0ff/graph-framework.git
cd graph-framework
composer install
```

## Uso rápido

```php
use Algorithms\Graph\Graph;
use Algorithms\Graph\Algorithms\BuscaLarguraImperativa;

$grafo = new Graph(10, false); // capacidade máxima de vértices, direcionado?

$grafo->addVertice("A");
$grafo->addVertice("B");
$grafo->addVertice("C");
$grafo->addAresta("A", "B");
$grafo->addAresta("B", "C");

$busca = new BuscaLarguraImperativa($grafo);
$caminho = $busca->buscar("A");
```

Para rodar o exemplo principal:

```bash
php main.php
```

Exemplo de saída da execução:

![Exemplo de execução](docs/images/exemplo-execucao.png)

## Estrutura do projeto

```
graph-framework/
├── main.php                       # Exemplo de uso da biblioteca
├── src/
│   ├── Graph/
│   │   ├── Graph.php               # Grafo como lista de adjacência
│   │   ├── Vertex.php               # Vértice (rótulo, graus)
│   │   ├── Edge.php                 # Aresta (destino + peso)
│   │   ├── AdjacencyMatrix.php      # Representação alternativa por matriz
│   │   ├── Contracts/
│   │   │   └── GraphInterface.php   # Contrato implementado por Graph
│   │   ├── Exceptions/              # Exceções de domínio
│   │   └── Algorithms/              # Algoritmos sobre o grafo
│   └── Utils/
│       └── Printer.php              # Impressão de um Graph no console
├── examples/                        # Scripts prontos para executar
├── tests/                           # Testes PHPUnit
└── docs/                             # Documentação e exercícios
```

## Algoritmos e funcionalidades

| Item                                  | Status         |
|---------------------------------------|----------------|
| Grafo por lista de adjacência          | ✅ Concluído    |
| Grafo por matriz de adjacência         | ✅ Concluído    |
| Busca em Largura (BFS)                 | ✅ Concluído    |
| Dijkstra (caminho mínimo)              | 🚧 Em construção |
| Busca em Profundidade (DFS)            | 📋 Planejado    |
| Detecção de ciclo                      | 📋 Planejado    |
| Componentes conexas                    | 📋 Planejado    |
| Ordenação topológica                   | 📋 Planejado    |

Os itens planejados estão descritos como exercícios práticos em
[`docs/exercicios`](docs/exercicios/README.md).

## Exemplos

A pasta [`examples/`](examples/README.md) contém scripts prontos para executar
(`php examples/<arquivo>.php`) demonstrando grafos direcionados e não direcionados,
busca em largura, matriz de adjacência e impressão do grafo.

## Testes

```bash
composer test
# ou
vendor/bin/phpunit
```

## Documentação

A documentação completa, com a estrutura do projeto, descrição das classes e
exercícios práticos, está em [`docs/README.md`](docs/README.md).

## Licença

MIT
