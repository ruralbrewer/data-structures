<?php
declare(strict_types=1);

namespace Minimax\State\Node;

class Node
{
    /**
     * @var mixed
     */
    private $name;

    /**
     * @var mixed
     */
    private $value;

    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function name()
    {
        return $this->name;
    }

    public function value()
    {
        return $this->value;
    }

    public function setValue($value): void
    {
        $this->value = $value;
    }

    public function isEmpty(): bool
    {
        return empty($this->value);
    }
}