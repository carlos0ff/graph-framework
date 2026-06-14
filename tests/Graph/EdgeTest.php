<?php

namespace Tests\Graph;

use Algorithms\Graph\Edge;
use Algorithms\Graph\Vertex;
use PHPUnit\Framework\TestCase;

class EdgeTest extends TestCase
{
    public function testCriacaoComDestinoEPeso(): void
    {
        $destino = new Vertex("B");
        $aresta = new Edge($destino, 5);

        $this->assertSame($destino, $aresta->getDestino());
        $this->assertSame(5, $aresta->getPeso());
    }
}
