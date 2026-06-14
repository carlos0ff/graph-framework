# graph-algorithms

Biblioteca de algoritmos e estruturas de grafos em PHP.

![Grafo](docs/images/graph.png)

## Requisitos

- PHP ^8.2
- [Composer](https://getcomposer.org/)

## Instalação

```bash
composer install
```

## Uso

```bash
php main.php
```

O `main.php` cria um grafo, adiciona vértices e arestas e executa uma busca
em largura (BFS) a partir de um vértice de origem.

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

Exemplo de saída da execução:

![Exemplo de execução](docs/images/exemplo-execucao.png)

## Exemplos

A pasta [`exemplos/`](exemplos/README.md) contém scripts prontos para
executar (`php exemplos/<arquivo>.php`) demonstrando grafos direcionados e
não direcionados, busca em largura, matriz de adjacência e impressão do
grafo.

## Testes

```bash
composer test
# ou
vendor/bin/phpunit
```

## Documentação

A documentação completa, com a estrutura do projeto, descrição das classes
e exercícios práticos, está em [`docs/README.md`](docs/README.md).

## Licença

MIT
