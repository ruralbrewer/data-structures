<?php
declare(strict_types=1);

namespace LinkedList;

abstract class AbstractLinkedList
{
    /**
     * @var Node
     */
    protected $root;

    /**
     * @var Node
     */
    protected $lastIn;

    protected function addNode(Node $node)
    {
        if (is_null($this->root)) {
            $this->root = $node;
        }

        if (!is_null($this->lastIn)) {
            $this->lastIn->setNext($node);
        }

        $this->lastIn = $node;
    }

    public function asArray(): array
    {
        return $this->root->asArray();
    }

    /**
     * @throws LinkedListException
     */
    abstract public function find($value): Node;
}