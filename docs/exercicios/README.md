# Exercícios

Esta pasta contém exercícios práticos para fixar os algoritmos e estruturas
de grafos da biblioteca. Cada exercício é uma classe em `Exercicios\*` com
um método contendo um `// TODO` para você implementar.

As classes têm acesso direto à biblioteca (`Algorithms\Graph\*`) através do
autoload de desenvolvimento configurado no `composer.json`:

```json
"autoload-dev": {
    "psr-4": {
        "Exercicios\\": "docs/exercicios/"
    }
}
```

Após editar os arquivos, rode `composer dump-autoload` se uma nova classe
não estiver sendo encontrada.

## Lista de exercícios

| # | Classe | Descrição | Nível |
|---|--------|-----------|-------|
| 1 | [`BuscaProfundidade`](BuscaProfundidade.php) | Implementar a busca em profundidade (DFS) a partir de um vértice. | Fácil |
| 2 | [`DetectarCiclo`](DetectarCiclo.php) | Detectar se o grafo possui ciclos. | Médio |
| 3 | [`ComponentesConexas`](ComponentesConexas.php) | Listar as componentes conexas de um grafo não direcionado. | Médio |
| 4 | [`OrdenacaoTopologica`](OrdenacaoTopologica.php) | Ordenar topologicamente um grafo direcionado acíclico (DAG). | Difícil |
| 5 | [`Dijkstra::calcularDistancias`](../../src/Graph/Algorithms/Dijkstra.php) | Completar o cálculo das distâncias mínimas a partir de uma origem (já existe um `// TODO` no método). | Difícil |

## Como testar sua solução

Você pode escrever um pequeno script em `main.php` (ou um arquivo próprio)
montando um `Graph` de exemplo e chamando a sua implementação:

```php
use Algorithms\Graph\Graph;
use Exercicios\BuscaProfundidade;

$grafo = new Graph(10, false);
$grafo->addVertice("A");
$grafo->addVertice("B");
$grafo->addVertice("C");
$grafo->addAresta("A", "B");
$grafo->addAresta("B", "C");

$dfs = new BuscaProfundidade($grafo);
print_r($dfs->buscar("A"));
```

Ou, melhor ainda, escreva testes em `tests/` (veja `tests/Graph/GraphTest.php`
como exemplo) e rode:

```bash
vendor/bin/phpunit
```
