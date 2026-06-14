<?php

namespace Tests\Graph;

use Algorithms\Graph\Exceptions\QtdeMaximaException;
use Algorithms\Graph\Exceptions\VertexNotFoundException;
use Algorithms\Graph\Graph;
use PHPUnit\Framework\TestCase;

class GraphTest extends TestCase
{
    public function testAddVerticeRetornaVertice(): void
    {
        $grafo = new Graph(10, false);

        $vertice = $grafo->addVertice("A");

        $this->assertSame("A", $vertice->getRotulo());
        $this->assertSame([$vertice], $grafo->getVertices());
    }

    public function testAddVerticeLancaExcecaoQuandoAtingeMaximo(): void
    {
        $grafo = new Graph(1, false);
        $grafo->addVertice("A");

        $this->expectException(QtdeMaximaException::class);

        $grafo->addVertice("B");
    }

    public function testAddArestaLancaExcecaoParaVerticeInexistente(): void
    {
        $grafo = new Graph(10, false);
        $grafo->addVertice("A");

        $this->expectException(VertexNotFoundException::class);

        $grafo->addAresta("A", "B");
    }

    public function testAddArestaNaoDirecionadaAtualizaAdjacentesDosDoisLados(): void
    {
        $grafo = new Graph(10, false);
        $grafo->addVertice("A");
        $grafo->addVertice("B");

        $grafo->addAresta("A", "B");

        $adjacentesDeA = $grafo->getAdjacentes("A");
        $adjacentesDeB = $grafo->getAdjacentes("B");

        $this->assertSame("B", $adjacentesDeA[0]->getRotulo());
        $this->assertSame("A", $adjacentesDeB[0]->getRotulo());
    }

    public function testAddArestaDirecionadaAtualizaApenasOrigem(): void
    {
        $grafo = new Graph(10, true);
        $grafo->addVertice("A");
        $grafo->addVertice("B");

        $grafo->addAresta("A", "B");

        $this->assertCount(1, $grafo->getAdjacentes("A"));
        $this->assertCount(0, $grafo->getAdjacentes("B"));
    }
}
