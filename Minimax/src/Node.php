<?php
declare(strict_types=1);

namespace Minimax;

class Node
{
    /**
     * @var mixed
     */
    private $value;


    public function __construct($value)
    {
        $this->value = $value;
    }

    public function setValue($value): void
    {
        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }
}