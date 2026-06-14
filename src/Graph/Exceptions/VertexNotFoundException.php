<?php

namespace Algorithms\Graph\Exceptions;

/**
 * Lançada quando um vértice referenciado não existe no grafo.
 */
class VertexNotFoundException extends GraphException
{
    /**
     * @param string $mensagem Descrição do erro.
     */
    public function __construct(string $mensagem)
    {
        parent::__construct($mensagem);
    }
}
