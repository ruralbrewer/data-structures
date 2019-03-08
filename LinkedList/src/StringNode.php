<?php
declare(strict_types=1);

namespace LinkedList;

class StringNode implements Node
{
    /**
     * @var Uuid
     */
    private $id;

    /**
     * @var string
     */
    private $value;

    /**
     * @var StringNode
     */
    private $next;


    public function  __construct(Uuid $id, string $value)
    {
        $this->id = $id;
        $this->value = $value;
    }

    public function id(): Uuid
    {
        return $this->id;
    }


    public function setNext(Node $node)
    {
        $this->next = $node;
    }

    public function next(): Node
    {
        return $this->next;
    }

    /**
     * @throws LinkedListException
     */
    public function find($value): Node
    {
        return $this->findString($value);
    }

    /**
     * @throws LinkedListException
     */
    private function findString(string $value): Node
    {
        if ($this->value == $value) {
            return $this;
        }

        if (is_null($this->next)) {
            throw new LinkedListException(
                sprintf("%s not found", $value)
            );
        }

        return $this->next()->find($value);
    }

    public function equals(Node $other): bool
    {
        return ($this->value() === $other->value());
    }

    public function value(): string
    {
        return $this->value;
    }

    public function asArray(): array
    {
        $arrayValue = [$this->value];

        return (!is_null($this->next)) ? array_merge($arrayValue, $this->next()->asArray()) : $arrayValue;
    }
}