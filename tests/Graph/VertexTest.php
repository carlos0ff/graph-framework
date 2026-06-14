<?php

namespace Tests\Graph;

use Algorithms\Graph\Vertex;
use PHPUnit\Framework\TestCase;

class VertexTest extends TestCase
{
    public function testCriacaoComRotulo(): void
    {
        $vertice = new Vertex("A");

        $this->assertSame("A", $vertice->getRotulo());
        $this->assertSame(0, $vertice->getGrau());
    }

    public function testAddGrau(): void
    {
        $vertice = new Vertex("A");

        $this->assertSame(2, $vertice->addGrau(2));
        $this->assertSame(3, $vertice->addGrau(1));
        $this->assertSame(3, $vertice->getGrau());
    }

    public function testAddGrauEntradaESaida(): void
    {
        $vertice = new Vertex("A");

        $this->assertSame(1, $vertice->addGrauEntrada(1));
        $this->assertSame(1, $vertice->addGrauSaida(1));
    }

    public function testToString(): void
    {
        $vertice = new Vertex("A");
        $vertice->addGrau(2);

        $this->assertSame("Vertice{rotulo='A', grau=2}", (string) $vertice);
    }
}
