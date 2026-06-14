<?php

namespace Algorithms\Graph\Exceptions;

/**
 * Lançada quando o grafo atinge a quantidade máxima de vértices.
 */
class QtdeMaximaException extends GraphException
{
    /**
     * @param string $mensagem Descrição do erro.
     */
    public function __construct(string $mensagem)
    {
        parent::__construct($mensagem);
    }
}
